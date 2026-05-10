@extends('layouts.gov')

@section('title', 'التسجيل — مدرك 4')

@push('head')
<style>
    [x-cloak] {
        display: none !important;
    }

</style>
@endpush

@section('content')
@php
$initialWizardStep = 1;
if ($errors->isNotEmpty()) {
if ($errors->has('has_viewed_program_details')) {
$initialWizardStep = 1;
} elseif ($errors->hasAny(['full_name', 'national_id', 'mobile', 'email', 'nationality'])) {
$initialWizardStep = 2;
} elseif ($errors->has('education_stage')) {
$initialWizardStep = 3;
} elseif ($errors->hasAny(['gender', 'region'])) {
$initialWizardStep = 4;
} elseif ($errors->has('commitment_status')) {
$initialWizardStep = 5;
} else {
$initialWizardStep = 6;
}
}
$field = 'w-full rounded-md border border-[var(--gov-border)] bg-white px-4 py-3 text-base text-[var(--gov-navy)] outline-none transition placeholder:text-slate-400 focus:border-[var(--gov-navy-light)] focus:ring-2 focus:ring-[var(--gov-navy)]/15';
$selectField = $field . ' appearance-none pe-12';
@endphp
<div class="py-10 md:py-14">
    <div class="mx-auto max-w-2xl px-6 text-center">
        <h1 class="text-2xl font-bold text-[var(--gov-navy)] md:text-3xl">التسجيل في البرنامج</h1>
        <p class="mt-3 text-sm leading-relaxed text-[var(--gov-muted)]">
            يُرجى إكمال الخطوات التالية بدقة. للاطلاع على تفاصيل البرنامج والمحتوى، تفضّل بزيارة
            <a href="{{ route('home') }}" class="font-semibold text-[var(--gov-accent)] underline-offset-2 hover:underline">الصفحة الرئيسية</a>.
        </p>
    </div>
</div>

<div class="mx-auto max-w-2xl px-6 py-10 md:py-14">
    @if ($errors->any())
    <div class="mb-8 rounded-md border border-red-200 bg-red-50 p-4 text-start text-sm text-red-900" role="alert">
        <p class="font-bold">يرجى تصحيح ما يلي:</p>
        <ul class="mt-2 list-disc space-y-1 pe-5">
            @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post" action="{{ route('registration.store') }}" class="medrek-hover-lift rounded-2xl border border-[var(--gov-border)] bg-gradient-to-b from-white to-slate-50/80 p-6 shadow-[0_8px_30px_rgba(15,23,42,0.06)] md:p-8" x-data="registrationWizard({{ (int) $initialWizardStep }})" @input="formTick++" @change="formTick++" @focusout="formTick++" @submit="if (!validateStep()) { $event.preventDefault(); }">
        @csrf

        <div class="mb-8 h-2 overflow-hidden rounded-full bg-slate-100" role="progressbar" aria-label="تقدّم التسجيل" aria-valuemin="1" x-bind:aria-valuemax="totalSteps" x-bind:aria-valuenow="step" x-bind:aria-valuetext="`الخطوة ${step} من ${totalSteps}`">
            <div class="h-full rounded-full bg-[var(--gov-accent)] transition-all duration-500 ease-out" :style="`width: ${(step / totalSteps) * 100}%`"></div>
        </div>

        <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-1.5" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="space-y-6">
            <fieldset>
                <legend class="text-lg font-bold text-[var(--gov-navy)]">هل اطلعت على تفاصيل البرنامج؟</legend>
                <input type="hidden" name="has_viewed_program_details" x-bind:value="viewedProgram ? '1' : '0'">
                <label for="program-details-ack" class="mt-6 flex cursor-pointer items-start gap-3 rounded-xl border border-[var(--gov-border)] bg-white p-4 transition hover:border-[var(--gov-accent)]/30 hover:bg-[var(--gov-accent-soft)]/25 sm:gap-3.5 sm:p-4">
                    <input id="program-details-ack" type="checkbox" x-model="viewedProgram" class="mt-0.5 h-4 w-4 shrink-0 rounded border-slate-300 text-[var(--gov-accent)] focus:ring-2 focus:ring-[var(--gov-accent)]/30 focus:ring-offset-0">
                    <span class="text-sm font-medium leading-relaxed text-[var(--gov-navy)]">
                        اطلعتُ على تفاصيل البرنامج والمحتوى في الصفحة الرئيسية وأرغب بالمتابعة.
                    </span>
                </label>
                <p class="mt-2 text-sm text-red-600" x-show="clientErrors.viewedProgram" x-text="clientErrors.viewedProgram"></p>
            </fieldset>
        </div>

        <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-1.5" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="space-y-5">
            <h2 class="text-lg font-bold text-[var(--gov-navy)]">البيانات الشخصية</h2>
            <div>
                <label for="full_name" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">الاسم الرباعي</label>
                <input id="full_name" type="text" name="full_name" value="{{ old('full_name') }}" autocomplete="name" class="{{ $field }}">
                <p class="mt-1 text-sm text-red-600" x-show="clientErrors.full_name" x-text="clientErrors.full_name"></p>
            </div>
            <div>
                <label for="national_id" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">رقم الهوية</label>
                <input id="national_id" type="text" name="national_id" value="{{ old('national_id') }}" inputmode="numeric" class="{{ $field }}">
                <p class="mt-1 text-sm text-red-600" x-show="clientErrors.national_id" x-text="clientErrors.national_id"></p>
            </div>
            <div>
                <label for="mobile" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">رقم الجوال</label>
                <input id="mobile" type="tel" name="mobile" value="{{ old('mobile') }}" dir="ltr" class="{{ $field }} text-end" placeholder="05xxxxxxxx">
                <p class="mt-1 text-sm text-red-600" x-show="clientErrors.mobile" x-text="clientErrors.mobile"></p>
            </div>
            <div>
                <label for="email" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">البريد الإلكتروني</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" dir="ltr" autocomplete="email" class="{{ $field }} text-end" placeholder="example@email.com">
                <p class="mt-1 text-sm text-red-600" x-show="clientErrors.email" x-text="clientErrors.email"></p>
            </div>
            <div>
                <label for="nationality" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">الجنسية</label>
                <div class="relative">
                    <select id="nationality" name="nationality" class="{{ $selectField }}">
                        <option value="">— اختر —</option>
                        <option value="سعودي" @selected(old('nationality')==='سعودي' )>سعودي</option>
                        <option value="غير سعودي" @selected(old('nationality')==='غير سعودي' )>غير سعودي</option>
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 end-4 flex items-center text-[var(--gov-muted)]">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 0 1 1.08 1.04l-4.25 4.51a.75.75 0 0 1-1.08 0L5.21 8.27a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <p class="mt-1 text-sm text-red-600" x-show="clientErrors.nationality" x-text="clientErrors.nationality"></p>
            </div>
        </div>

        <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-1.5" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="space-y-5">
            <h2 class="text-lg font-bold text-[var(--gov-navy)]">المرحلة الدراسية</h2>
            <div>
                <label for="education_stage" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">اختر مرحلتك</label>
                <div class="relative">
                    <select id="education_stage" name="education_stage" class="{{ $selectField }}">
                        <option value="">— اختر —</option>
                        @foreach ([
                        'الأول ثانوي', 'الثاني ثانوي', 'الثالث ثانوي', 'خريج ثانوي', 'طالب جامعي', 'أخرى',
                        ] as $opt)
                        <option value="{{ $opt }}" @selected(old('education_stage')===$opt)>{{ $opt }}</option>
                        @endforeach
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 end-4 flex items-center text-[var(--gov-muted)]">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 0 1 1.08 1.04l-4.25 4.51a.75.75 0 0 1-1.08 0L5.21 8.27a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <p class="mt-1 text-sm text-red-600" x-show="clientErrors.education_stage" x-text="clientErrors.education_stage"></p>
            </div>
        </div>

        <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-1.5" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="space-y-5">
            <h2 class="text-lg font-bold text-[var(--gov-navy)]">الجنس والمنطقة</h2>
            <div>
                <label for="gender" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">الجنس</label>
                <div class="relative">
                    <select id="gender" name="gender" class="{{ $selectField }}">
                        <option value="">— اختر —</option>
                        @foreach (['ذكر', 'أنثى'] as $g)
                        <option value="{{ $g }}" @selected(old('gender')===$g)>{{ $g }}</option>
                        @endforeach
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 end-4 flex items-center text-[var(--gov-muted)]">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 0 1 1.08 1.04l-4.25 4.51a.75.75 0 0 1-1.08 0L5.21 8.27a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <p class="mt-1 text-sm text-red-600" x-show="clientErrors.gender" x-text="clientErrors.gender"></p>
            </div>
            <div>
                <label for="region" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">المنطقة</label>
                <div class="relative">
                    <select id="region" name="region" class="{{ $selectField }}">
                        <option value="">— اختر —</option>
                        @foreach ([
                        'الرياض', 'مكة المكرمة', 'المدينة المنورة', 'الشرقية', 'القصيم', 'عسير', 'تبوك', 'حائل', 'الحدود الشمالية', 'الباحة', 'الجوف', 'نجران', 'جازان', 'خارج المملكة',
                        ] as $r)
                        <option value="{{ $r }}" @selected(old('region')===$r)>{{ $r }}</option>
                        @endforeach
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 end-4 flex items-center text-[var(--gov-muted)]">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 0 1 1.08 1.04l-4.25 4.51a.75.75 0 0 1-1.08 0L5.21 8.27a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <p class="mt-1 text-sm text-red-600" x-show="clientErrors.region" x-text="clientErrors.region"></p>
            </div>
        </div>

        <div x-show="step === 5" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-1.5" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="space-y-5">
            <h2 class="text-lg font-bold text-[var(--gov-navy)]">الالتزام بالحضور</h2>
            <div class="grid gap-3">
                @foreach ([
                'ملتزم بالحضور في الموعد المحدد',
                'أحتاج للتأكد من جدولي قبل الالتزام',
                'غير متأكد حالياً',
                ] as $c)
                <label class="flex cursor-pointer items-center gap-3 rounded-md border border-[var(--gov-border)] p-4 transition has-[:checked]:border-[var(--gov-accent)] has-[:checked]:bg-[var(--gov-accent-soft)]/60 hover:border-slate-300">
                    <input type="radio" name="commitment_status" value="{{ $c }}" class="h-4 w-4 shrink-0 border-[var(--gov-border)] text-[var(--gov-accent)] focus:ring-[var(--gov-navy)]" @checked(old('commitment_status')===$c)>
                    <span class="text-sm font-semibold text-[var(--gov-navy)] md:text-base">{{ $c }}</span>
                </label>
                @endforeach
            </div>
            <p class="text-sm text-red-600" x-show="clientErrors.commitment_status" x-text="clientErrors.commitment_status"></p>
        </div>

        <div x-show="step === 6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-1.5" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="space-y-5">
            <h2 class="text-lg font-bold text-[var(--gov-navy)]">مصدر المعرفة بالبرنامج</h2>
            <div>
                <label for="referral_source" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">كيف سمعت عن مدرك؟</label>
                <div class="relative">
                    <select id="referral_source" name="referral_source" x-model="referralSource" class="{{ $selectField }}" x-init="referralSource = $el.value || ''">
                        <option value="">— اختر —</option>
                        @foreach ([
                        'تويتر', 'إنستقرام', 'تيك توك', 'المدرسة أو الجهة التعليمية', 'صديق أو عائلة', 'إعلان', 'أخرى',
                        ] as $ref)
                        <option value="{{ $ref }}" @selected(old('referral_source')===$ref)>{{ $ref }}</option>
                        @endforeach
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 end-4 flex items-center text-[var(--gov-muted)]">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 0 1 1.08 1.04l-4.25 4.51a.75.75 0 0 1-1.08 0L5.21 8.27a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <p class="mt-1 text-sm text-red-600" x-show="clientErrors.referral_source" x-text="clientErrors.referral_source"></p>
            </div>
            <div x-show="referralSource === 'أخرى'" x-transition>
                <label for="referral_source_other" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">وضّح المصدر</label>
                <input id="referral_source_other" type="text" name="referral_source_other" value="{{ old('referral_source_other') }}" class="{{ $field }}">
                <p class="mt-1 text-sm text-red-600" x-show="clientErrors.referral_source_other" x-text="clientErrors.referral_source_other"></p>
            </div>
        </div>

        <div class="mt-10 flex flex-wrap items-center justify-between gap-4 border-t border-[var(--gov-border)] pt-6">
            <button type="button" class="rounded-md border border-[var(--gov-accent)]/25 bg-[var(--gov-accent-soft)]/55 px-5 py-2.5 text-sm font-semibold text-[var(--gov-accent)] transition hover:bg-[var(--gov-accent-soft)]" @click="step === 1 ? window.location.assign('{{ route('home') }}#event-details') : prev()">
                <span x-text="step === 1 ? 'العودة للتفاصيل' : 'السابق'"></span>
            </button>
            <button type="button" class="rounded-md bg-[var(--gov-accent)] px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[var(--gov-accent-hover)] disabled:cursor-not-allowed disabled:opacity-40" x-show="step < totalSteps" @click="next()" :disabled="!canGoNext()">
                التالي
            </button>
            <button type="submit" class="rounded-md bg-[var(--gov-accent)] px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[var(--gov-accent-hover)] disabled:cursor-not-allowed disabled:opacity-40" x-show="step === totalSteps" :disabled="!canGoNext()">
                إرسال التسجيل
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function registrationWizard(initialStep = 1) {
        return {
            step: Math.min(Math.max(initialStep, 1), 6)
            , totalSteps: 6
            , viewedProgram: @json(
                old('has_viewed_program_details') === true ||
                old('has_viewed_program_details') === 1 ||
                old('has_viewed_program_details') === '1' ||
                old('has_viewed_program_details') === 'on'
            )
            , referralSource: @json(old('referral_source', '')),
            /** يُحدَّث عند أي إدخال/اختيار ليعاد تقييم :disabled على «التالي» (Alpine لا يراقب DOM تلقائياً). */
            formTick: 0
            , clientErrors: {},

            clearClientErrors() {
                this.clientErrors = {};
            },

            canGoNext() {
                void this.formTick;
                if (this.step === 1) return this.viewedProgram === true;
                if (this.step === 2) {
                    const full = document.getElementById('full_name') ?.value ?.trim();
                    const nid = document.getElementById('national_id') ?.value ?.trim();
                    const mob = document.getElementById('mobile') ?.value ?.trim();
                    const em = document.getElementById('email') ?.value ?.trim();
                    const nat = document.getElementById('nationality') ?.value;
                    if (!full || !nid || !mob || !em || !nat) return false;
                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em);
                }
                if (this.step === 3) return !!document.getElementById('education_stage') ?.value;
                if (this.step === 4) {
                    return !!document.getElementById('gender') ?.value && !!document.getElementById('region') ?.value;
                }
                if (this.step === 5) return !!document.querySelector('input[name="commitment_status"]:checked');
                if (this.step === 6) {
                    const ref = document.getElementById('referral_source') ?.value;
                    if (!ref) return false;
                    if (ref === 'أخرى') return !!document.getElementById('referral_source_other') ?.value ?.trim();
                    return true;
                }
                return true;
            },

            validateStep() {
                this.clearClientErrors();
                if (this.step === 1) {
                    if (!this.viewedProgram) {
                        this.clientErrors.viewedProgram = 'يُرجى تأكيد الاطلاع على تفاصيل البرنامج (وضع علامة في المربّع).';
                        return false;
                    }
                    return true;
                }
                if (this.step === 2) {
                    const full = document.getElementById('full_name') ?.value ?.trim();
                    const nid = document.getElementById('national_id') ?.value ?.trim();
                    const mob = document.getElementById('mobile') ?.value ?.trim();
                    const em = document.getElementById('email') ?.value ?.trim();
                    const nat = document.getElementById('nationality') ?.value;
                    let ok = true;
                    if (!full) {
                        this.clientErrors.full_name = 'هذا الحقل مطلوب.';
                        ok = false;
                    }
                    if (!nid) {
                        this.clientErrors.national_id = 'هذا الحقل مطلوب.';
                        ok = false;
                    }
                    if (!mob) {
                        this.clientErrors.mobile = 'هذا الحقل مطلوب.';
                        ok = false;
                    }
                    if (!em) {
                        this.clientErrors.email = 'هذا الحقل مطلوب.';
                        ok = false;
                    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em)) {
                        this.clientErrors.email = 'صيغة البريد غير صحيحة.';
                        ok = false;
                    }
                    if (!nat) {
                        this.clientErrors.nationality = 'يرجى اختيار الجنسية.';
                        ok = false;
                    }
                    return ok;
                }
                if (this.step === 3) {
                    const v = document.getElementById('education_stage') ?.value;
                    if (!v) {
                        this.clientErrors.education_stage = 'يرجى اختيار المرحلة الدراسية.';
                        return false;
                    }
                    return true;
                }
                if (this.step === 4) {
                    let ok = true;
                    if (!(document.getElementById('gender')?.value)) {
                        this.clientErrors.gender = 'يرجى اختيار الجنس.';
                        ok = false;
                    }
                    if (!(document.getElementById('region')?.value)) {
                        this.clientErrors.region = 'يرجى اختيار المنطقة.';
                        ok = false;
                    }
                    return ok;
                }
                if (this.step === 5) {
                    if (!document.querySelector('input[name="commitment_status"]:checked')) {
                        this.clientErrors.commitment_status = 'يرجى اختيار أحد الخيارات.';
                        return false;
                    }
                    return true;
                }
                if (this.step === 6) {
                    const ref = document.getElementById('referral_source') ?.value;
                    if (!ref) {
                        this.clientErrors.referral_source = 'يرجى اختيار مصدر المعرفة.';
                        return false;
                    }
                    if (ref === 'أخرى') {
                        const o = document.getElementById('referral_source_other') ?.value ?.trim();
                        if (!o) {
                            this.clientErrors.referral_source_other = 'يرجى التوضيح.';
                            return false;
                        }
                    }
                    return true;
                }
                return true;
            },

            next() {
                if (!this.validateStep()) return;
                if (this.step < this.totalSteps) this.step++;
            },

            prev() {
                if (this.step > 1) this.step--;
            },
        };
    }

</script>
@endpush
