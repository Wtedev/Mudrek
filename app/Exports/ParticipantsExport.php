<?php

namespace App\Exports;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticipantsExport implements FromQuery, WithHeadings, WithMapping
{
    public function __construct(
        private readonly Builder $query,
    ) {}

    public function query(): Builder
    {
        return $this->query->clone();
    }

    /**
     * @return array<int, string>
     */
    public function headings(): array
    {
        return [
            '#',
            'الاسم الرباعي',
            'رقم الهوية',
            'الجوال',
            'البريد',
            'الجنسية',
            'المرحلة الدراسية',
            'الجنس',
            'المنطقة',
            'حالة الالتزام',
            'مصدر المعرفة',
            'مصدر آخر',
            'الحالة',
            'وقت التحضير',
            'اطلاع على التفاصيل',
            'الملاحظات',
            'تاريخ التسجيل',
        ];
    }

    /**
     * @param  Participant  $participant
     * @return array<int, mixed>
     */
    public function map($participant): array
    {
        return [
            $participant->id,
            $participant->full_name,
            $participant->national_id,
            $participant->mobile,
            $participant->email,
            $participant->nationality,
            $participant->education_stage,
            $participant->gender,
            $participant->region,
            $participant->commitment_status,
            $participant->referral_source,
            $participant->referral_source_other,
            $participant->status,
            $participant->checked_in_at?->timezone(config('app.timezone'))->format('Y-m-d H:i:s'),
            $participant->has_viewed_program_details ? 'نعم' : 'لا',
            $participant->notes,
            $participant->created_at?->timezone(config('app.timezone'))->format('Y-m-d H:i:s'),
        ];
    }
}
