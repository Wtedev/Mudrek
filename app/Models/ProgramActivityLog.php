<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramActivityLog extends Model
{
    public $timestamps = false;

    protected $table = 'program_activity_logs';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'body',
        'created_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public static function log(string $body): void
    {
        static::query()->create([
            'body' => $body,
            'created_at' => now(),
        ]);
    }

    public static function logRegistration(string $fullName): void
    {
        static::log($fullName.' سجل في ملتقى مدرك');
    }

    public static function logDeleted(string $fullName): void
    {
        static::log('تم حذف المستفيد '.$fullName);
    }

    public static function logCheckedIn(string $fullName): void
    {
        static::log('تم تحضير المستفيد '.$fullName);
    }

    public static function logEmailSent(int $recipientCount): void
    {
        static::log('تم ارسال ايميل بعدد مستفيدين '.$recipientCount);
    }
}
