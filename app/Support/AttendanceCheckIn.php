<?php

namespace App\Support;

use App\Models\Participant;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

final class AttendanceCheckIn
{
    public static function normalizeToken(string $raw): string
    {
        $trimmed = trim($raw);
        if (preg_match('/check-in\/([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})/i', $trimmed, $m)) {
            return strtolower($m[1]);
        }

        return strtolower($trimmed);
    }

    /**
     * @return array{ok: bool, kind?: string, message: string, participant?: array{full_name: string, mobile: string, checked_in_at: ?string, checked_in_at_display: string}}
     */
    public static function process(string $normalizedToken): array
    {
        return DB::transaction(function () use ($normalizedToken): array {
            /** @var Participant|null $participant */
            $participant = Participant::query()
                ->where('checkin_token', $normalizedToken)
                ->lockForUpdate()
                ->first();

            if ($participant === null) {
                return [
                    'ok' => false,
                    'kind' => 'not_found',
                    'message' => 'رمز غير صحيح أو غير مسجل',
                ];
            }

            if ($participant->checked_in_at !== null || $participant->status === 'attended') {
                return [
                    'ok' => false,
                    'kind' => 'already_attended',
                    'message' => 'تم تسجيل حضور هذا المشارك مسبقاً',
                    'participant' => self::participantPayload($participant),
                ];
            }

            $participant->forceFill([
                'status' => 'attended',
                'checked_in_at' => now(),
            ])->save();

            $participant->refresh();

            return [
                'ok' => true,
                'kind' => 'checked_in',
                'message' => 'تم التحضير بنجاح',
                'participant' => self::participantPayload($participant),
            ];
        });
    }

    /**
     * @return array{full_name: string, mobile: string, checked_in_at: string|null, checked_in_at_display: string}
     */
    public static function participantPayload(Participant $participant): array
    {
        $at = $participant->checked_in_at;
        $carbon = $at instanceof Carbon ? $at->copy()->timezone(config('app.timezone')) : null;

        return [
            'full_name' => (string) $participant->full_name,
            'mobile' => (string) $participant->mobile,
            'checked_in_at' => $carbon?->toIso8601String(),
            'checked_in_at_display' => $carbon
                ? $carbon->locale('ar')->translatedFormat('j F Y، H:i')
                : '',
        ];
    }
}
