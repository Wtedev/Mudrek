<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'has_viewed_program_details' => filter_var(
                $this->input('has_viewed_program_details'),
                FILTER_VALIDATE_BOOLEAN
            ),
            'nationality' => $this->filled('nationality') ? (string) $this->input('nationality') : null,
        ]);

        if ($this->input('referral_source') !== 'أخرى') {
            $this->merge(['referral_source_other' => null]);
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'has_viewed_program_details' => ['required', 'accepted'],
            'full_name' => ['required', 'string', 'max:255'],
            'national_id' => ['required', 'string', 'max:255', 'unique:participants,national_id'],
            'mobile' => ['required', 'string', 'max:255', 'unique:participants,mobile'],
            'email' => ['required', 'email', 'max:255', 'unique:participants,email'],
            'nationality' => ['required', 'string', 'in:سعودي,غير سعودي'],
            'education_stage' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'commitment_status' => ['required', 'string', 'max:255'],
            'referral_source' => ['required', 'string', 'max:255'],
            'referral_source_other' => ['nullable', 'required_if:referral_source,أخرى', 'string', 'max:255'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'has_viewed_program_details.required' => 'يرجى الإجابة عن سؤال الاطلاع على التفاصيل.',
            'has_viewed_program_details.accepted' => 'يجب الاطلاع على تفاصيل البرنامج للمتابعة.',
            'full_name.required' => 'الإسم الرباعي مطلوب.',
            'national_id.required' => 'رقم الهوية مطلوب.',
            'national_id.unique' => 'رقم الهوية مسجّل مسبقاً.',
            'nationality.required' => 'يرجى اختيار الجنسية.',
            'nationality.in' => 'يرجى اختيار «سعودي» أو «غير سعودي» فقط.',
            'mobile.required' => 'رقم الجوال مطلوب.',
            'mobile.unique' => 'رقم الجوال مسجّل مسبقاً.',
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.unique' => 'البريد الإلكتروني مسجّل مسبقاً.',
            'education_stage.required' => 'يرجى اختيار المرحلة الدراسية.',
            'gender.required' => 'يرجى اختيار الجنس.',
            'region.required' => 'يرجى اختيار المنطقة.',
            'commitment_status.required' => 'يرجى الإفصاح عن حالة الالتزام.',
            'referral_source.required' => 'يرجى اختيار مصدر المعرفة.',
            'referral_source_other.required_if' => 'يرجى توضيح مصدر المعرفة.',
        ];
    }
}
