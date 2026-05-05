<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\AttendanceCheckIn;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceScanController extends Controller
{
    public function index(): View
    {
        return view('admin.attendance-scan');
    }

    public function check(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'token' => ['required', 'string', 'max:2048'],
        ]);

        $normalized = AttendanceCheckIn::normalizeToken($validated['token']);
        if ($normalized === '') {
            return response()->json([
                'status' => 'error',
                'message' => 'الرجاء إدخال رمز صالح.',
            ], 422);
        }

        $result = AttendanceCheckIn::process($normalized);

        return response()->json($this->toScanResponse($result));
    }

    /**
     * @param  array{ok: bool, kind?: string, message: string, participant?: array<string, mixed>}  $result
     * @return array{status: string, message: string, participant?: array{full_name: string, mobile: string, checked_in_at: string}}
     */
    private function toScanResponse(array $result): array
    {
        $participant = isset($result['participant']) && is_array($result['participant'])
            ? $this->publicParticipantPayload($result['participant'])
            : null;

        if (($result['ok'] ?? false) === true) {
            return [
                'status' => 'success',
                'message' => 'تم تحضير المشارك بنجاح',
                'participant' => $participant,
            ];
        }

        if (($result['kind'] ?? '') === 'already_attended') {
            return [
                'status' => 'warning',
                'message' => 'تم تحضير هذا المشارك مسبقًا',
                'participant' => $participant,
            ];
        }

        return [
            'status' => 'error',
            'message' => $result['message'] ?? 'حدث خطأ',
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array{full_name: string, mobile: string, checked_in_at: string}
     */
    private function publicParticipantPayload(array $payload): array
    {
        return [
            'full_name' => (string) ($payload['full_name'] ?? ''),
            'mobile' => (string) ($payload['mobile'] ?? ''),
            'checked_in_at' => (string) ($payload['checked_in_at_display'] ?? ''),
        ];
    }
}
