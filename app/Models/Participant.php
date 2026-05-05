<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable([
    'has_viewed_program_details',
    'full_name',
    'national_id',
    'mobile',
    'email',
    'nationality',
    'education_stage',
    'gender',
    'region',
    'commitment_status',
    'referral_source',
    'referral_source_other',
    'status',
    'score',
    'notes',
    'acceptance_sent_at',
    'checked_in_at',
])]
class Participant extends Model
{
    /**
     * Route model binding uses the opaque check-in token (never numeric id).
     */
    public function getRouteKeyName(): string
    {
        return 'checkin_token';
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'has_viewed_program_details' => 'boolean',
            'acceptance_sent_at' => 'datetime',
            'checked_in_at' => 'datetime',
            'score' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Participant $participant): void {
            if ($participant->checkin_token === null || $participant->checkin_token === '') {
                $participant->checkin_token = (string) Str::uuid();
            }
        });
    }
}
