@extends('layouts.gov')

@section('title', 'إعدادات الحساب — مدرك 4')

@push('head')
    <style>
        [data-reveal-settings] {
            opacity: 0;
            transform: translateY(12px);
            transition:
                opacity 0.52s cubic-bezier(0.22, 1, 0.36, 1),
                transform 0.52s cubic-bezier(0.22, 1, 0.36, 1);
        }
        [data-reveal-settings].is-visible { opacity: 1; transform: translateY(0); }
        @media (prefers-reduced-motion: reduce) {
            [data-reveal-settings] { opacity: 1; transform: none; transition: none; }
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-radius: 0.75rem;
            padding: 0.65rem 0.85rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gov-navy-light);
            transition:
                background 0.28s cubic-bezier(0.22, 1, 0.36, 1),
                color 0.28s cubic-bezier(0.22, 1, 0.36, 1),
                box-shadow 0.28s cubic-bezier(0.22, 1, 0.36, 1),
                transform 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .sidebar-link:hover {
            background: var(--gov-accent-soft);
            color: var(--gov-accent);
        }
    </style>
@endpush

@section('content')
    @php
        $inputClass = 'w-full rounded-xl border border-[var(--gov-border)] bg-white px-4 py-3 text-base text-[var(--gov-navy)] shadow-sm outline-none transition placeholder:text-slate-400 focus:border-[var(--gov-accent)] focus:ring-2 focus:ring-[var(--gov-accent)]/20';
        $btnPrimary = 'inline-flex items-center justify-center gap-2 rounded-xl bg-[var(--gov-accent)] px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-[rgba(24,147,153,0.22)] transition hover:bg-[var(--gov-accent-hover)] hover:shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--gov-accent)] focus-visible:ring-offset-2';
        $btnOutline = 'inline-flex items-center justify-center gap-2 rounded-xl border border-[var(--gov-border)] bg-white px-5 py-2.5 text-sm font-semibold text-[var(--gov-navy)] shadow-sm transition hover:border-[var(--gov-accent)]/40 hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--gov-accent)]/30';
        $card = 'rounded-2xl border border-[var(--gov-border)] bg-gradient-to-br from-white to-slate-50/80 p-6 shadow-[0_8px_30px_rgba(15,23,42,0.06)] md:p-8';
    @endphp

    <div
        class="mx-auto max-w-6xl px-4 py-8 md:px-6 md:py-10"
        x-data="accountSettingsUi(@js(route('registration')), @js($user->name))"
    >
        <div
            x-show="toast"
            x-transition
            class="fixed left-1/2 top-20 z-[60] -translate-x-1/2 rounded-xl border border-[var(--gov-border)] bg-white px-5 py-3 text-sm font-semibold text-[var(--gov-navy)] shadow-lg"
            role="status"
            x-cloak
        >
            <span x-text="toast"></span>
        </div>

        <header class="mb-8 md:mb-10" data-reveal-settings>
            <h1 class="text-2xl font-extrabold tracking-tight text-[var(--gov-navy)] md:text-4xl">إعدادات الحساب</h1>
            <p class="mt-2 max-w-2xl text-sm text-[var(--gov-muted)] md:text-base">
                إدارة الملف الشخصي، الأمان، والدعوات. واجهة منظمة وسهلة الاستخدام.
            </p>
        </header>

        @if (session('status') === 'saved')
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-900 shadow-sm" role="status" data-reveal-settings>
                تم حفظ التغييرات بنجاح.
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-900 shadow-sm" role="alert" data-reveal-settings>
                <p class="font-bold">تنبيه</p>
                <ul class="mt-2 list-disc space-y-1 pe-5">
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col gap-8 lg:flex-row lg:gap-10">
            <aside class="lg:w-64 lg:shrink-0" data-reveal-settings>
                <nav class="sticky top-24 space-y-1 rounded-2xl border border-[var(--gov-border)] bg-white/90 p-3 shadow-sm backdrop-blur-sm" aria-label="قائمة الإعدادات">
                    <a href="#panel-profile" class="sidebar-link">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-[var(--gov-accent-soft)] text-[var(--gov-accent)]">
                            <x-medrek-icon name="user" class="h-5 w-5" />
                        </span>
                        الحساب
                    </a>
                    <a href="#panel-notifications" class="sidebar-link">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-[var(--gov-navy)]">
                            <x-medrek-icon name="bell" class="h-5 w-5" />
                        </span>
                        الإشعارات
                    </a>
                    <a href="#panel-privacy" class="sidebar-link">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-[var(--gov-navy)]">
                            <x-medrek-icon name="shield" class="h-5 w-5" />
                        </span>
                        الخصوصية
                    </a>
                    <a href="#panel-invite" class="sidebar-link">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-[var(--gov-navy)]">
                            <x-medrek-icon name="envelope" class="h-5 w-5" />
                        </span>
                        دعوة
                    </a>
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="sidebar-link">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-[var(--gov-navy)]">
                            <x-medrek-icon name="cog" class="h-5 w-5" />
                        </span>
                        لوحة الإدارة
                    </a>
                </nav>
            </aside>

            <div class="min-w-0 flex-1 space-y-8">
                {{-- Profile photo (معاينة محلية فقط — لا يُرسل للخادم) --}}
                <section id="panel-profile" class="{{ $card }}" data-reveal-settings>
                    <div class="flex flex-col gap-6 border-b border-[var(--gov-border)] pb-6 md:flex-row md:items-start">
                        <div class="relative mx-auto shrink-0 md:mx-0">
                            <div class="flex h-28 w-28 items-center justify-center overflow-hidden rounded-2xl border border-[var(--gov-border)] bg-gradient-to-br from-[var(--gov-accent-soft)] to-white text-3xl font-bold text-[var(--gov-accent)] shadow-inner ring-2 ring-white">
                                <img x-show="previewUrl" :src="previewUrl" alt="" class="h-full w-full object-cover" width="112" height="112">
                                <span x-show="!previewUrl" class="select-none">{{ \Illuminate\Support\Str::substr($user->name, 0, 1) }}</span>
                            </div>
                            <input id="profile_photo_input" type="file" accept="image/*" class="sr-only" @change="onPhotoSelect($event)">
                        </div>
                        <div class="flex-1 text-center md:text-start">
                            <h2 class="text-xl font-bold text-[var(--gov-navy)]">الصورة الشخصية</h2>
                            <p class="mt-1 text-sm text-[var(--gov-muted)]">صيغ مدعومة: صور بحجم معقول. المعاينة على جهازك فقط حتى يُفعّل الحفظ لاحقاً.</p>
                            <div class="mt-4 flex flex-wrap justify-center gap-3 md:justify-start">
                                <label for="profile_photo_input" class="{{ $btnPrimary }} cursor-pointer">
                                    <x-medrek-icon name="camera" class="h-4 w-4 text-white" />
                                    رفع صورة
                                </label>
                                <button type="button" class="{{ $btnOutline }}" @click="clearPhoto()" x-bind:disabled="!previewUrl">
                                    <x-medrek-icon name="trash" class="h-4 w-4 text-slate-600" />
                                    إزالة
                                </button>
                                <a href="#form-personal" class="{{ $btnOutline }}">
                                    <x-medrek-icon name="pencil" class="h-4 w-4" />
                                    تعديل البيانات
                                </a>
                            </div>
                        </div>
                    </div>

                    <form method="post" action="{{ route('account.settings.update') }}" class="mt-8 space-y-8" id="form-personal">
                        @csrf
                        @method('put')

                        <div>
                            <h3 class="flex items-center gap-2 text-lg font-bold text-[var(--gov-navy)]">
                                <x-medrek-icon name="user" class="h-5 w-5 text-[var(--gov-accent)]" />
                                البيانات الشخصية
                            </h3>
                            <div class="mt-5 grid gap-5 md:grid-cols-2">
                                <div>
                                    <label for="name" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">الاسم الكامل</label>
                                    <input id="name" name="name" type="text" class="{{ $inputClass }}" value="{{ old('name', $user->name) }}" required autocomplete="name">
                                </div>
                                <div>
                                    <label for="email" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">البريد الإلكتروني</label>
                                    <input id="email" name="email" type="email" class="{{ $inputClass }} text-end" dir="ltr" value="{{ old('email', $user->email) }}" required autocomplete="username">
                                </div>
                            </div>
                        </div>

                        <div class="rounded-xl border border-[var(--gov-border)] bg-white/60 p-5 md:p-6">
                            <h3 class="flex items-center gap-2 text-lg font-bold text-[var(--gov-navy)]">
                                <x-medrek-icon name="lock" class="h-5 w-5 text-[var(--gov-accent)]" />
                                كلمة المرور
                            </h3>
                            <p class="mt-1 text-sm text-[var(--gov-muted)]">اترك الحقول فارغة إن لم ترغب بالتغيير.</p>
                            <div class="mt-5 grid gap-5 md:grid-cols-2">
                                <div class="md:col-span-2">
                                    <label for="current_password" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">كلمة المرور الحالية</label>
                                    <input id="current_password" name="current_password" type="password" class="{{ $inputClass }}" autocomplete="current-password">
                                </div>
                                <div>
                                    <label for="password" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">كلمة المرور الجديدة</label>
                                    <input id="password" name="password" type="password" class="{{ $inputClass }}" autocomplete="new-password">
                                </div>
                                <div>
                                    <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">تأكيد كلمة المرور</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="{{ $inputClass }}" autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-4 border-t border-[var(--gov-border)] pt-6">
                            <p class="text-sm text-[var(--gov-muted)]">تأكد من صحة البيانات قبل الحفظ</p>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('home') }}" class="{{ $btnOutline }}">إلغاء</a>
                                <button type="submit" class="{{ $btnPrimary }}">
                                    <x-medrek-icon name="save" class="h-4 w-4 text-white" />
                                    حفظ التغييرات
                                </button>
                            </div>
                        </div>
                    </form>
                </section>

                <section id="panel-notifications" class="{{ $card }}" data-reveal-settings>
                    <h2 class="flex items-center gap-2 text-lg font-bold text-[var(--gov-navy)]">
                        <x-medrek-icon name="bell" class="h-6 w-6 text-[var(--gov-accent)]" />
                        الإشعارات
                    </h2>
                    <p class="mt-3 text-sm leading-relaxed text-[var(--gov-muted)]">
                        ستُتاح لاحقاً إعدادات تفضيل الإشعارات البريدية والتذكيرات المتعلقة بالبرنامج.
                    </p>
                </section>

                <section id="panel-privacy" class="{{ $card }}" data-reveal-settings>
                    <h2 class="flex items-center gap-2 text-lg font-bold text-[var(--gov-navy)]">
                        <x-medrek-icon name="shield" class="h-6 w-6 text-[var(--gov-accent)]" />
                        الخصوصية
                    </h2>
                    <p class="mt-3 text-sm leading-relaxed text-[var(--gov-muted)]">
                        نلتزم بحماية بياناتك وفق السياسات المعتمدة. لمزيد من التفاصيل، تابع القنوات الرسمية للجمعية.
                    </p>
                </section>

                <section id="panel-invite" class="{{ $card }}" data-reveal-settings>
                    <h2 class="flex items-center gap-2 text-lg font-bold text-[var(--gov-navy)]">
                        <x-medrek-icon name="envelope" class="h-6 w-6 text-[var(--gov-accent)]" />
                        دعوة للتسجيل
                    </h2>
                    <p class="mt-2 text-sm text-[var(--gov-muted)]">أدخل بيانات مختصرة ثم انسخ الرابط أو نص الدعوة الجاهز.</p>
                    <div class="mt-6 grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="invite_email" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">البريد الإلكتروني للمدعو</label>
                            <input id="invite_email" type="email" class="{{ $inputClass }} text-end" dir="ltr" x-model="inviteEmail" placeholder="name@example.com" autocomplete="off">
                        </div>
                        <div>
                            <label for="invite_company" class="mb-1.5 block text-sm font-semibold text-[var(--gov-navy-light)]">اسم الجهة أو المدرسة</label>
                            <input id="invite_company" type="text" class="{{ $inputClass }}" x-model="inviteCompany" placeholder="اختياري">
                        </div>
                    </div>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <button type="button" class="{{ $btnPrimary }}" @click="copyRegistrationLink()">
                            <x-medrek-icon name="link" class="h-4 w-4 text-white" />
                            نسخ رابط التسجيل
                        </button>
                        <button type="button" class="{{ $btnOutline }}" @click="copyInvitationText()">
                            <x-medrek-icon name="clipboard" class="h-4 w-4" />
                            نسخ نص الدعوة
                        </button>
                    </div>
                </section>

                <section class="{{ $card }} border-red-100 bg-gradient-to-br from-red-50/80 to-white" data-reveal-settings>
                    <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                        <div class="flex items-start gap-3 text-center md:text-start">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-red-200 bg-white text-red-700">
                                <x-medrek-icon name="logout" class="h-5 w-5" />
                            </span>
                            <div>
                                <h2 class="text-base font-bold text-[var(--gov-navy)]">تسجيل الخروج</h2>
                                <p class="mt-1 text-sm text-[var(--gov-muted)]">إنهاء الجلسة على هذا الجهاز</p>
                            </div>
                        </div>
                        <form method="post" action="{{ route('logout') }}" class="shrink-0">
                            @csrf
                            <button type="submit" class="{{ $btnOutline }} border-red-200 text-red-900 hover:bg-red-50">
                                تسجيل الخروج
                            </button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <style>[x-cloak] { display: none !important; }</style>
    <script>
        function accountSettingsUi(registrationUrl, accountName) {
            return {
                toast: '',
                toastTimer: null,
                previewUrl: null,
                _objectUrl: null,
                inviteEmail: '',
                inviteCompany: '',

                showToast(msg) {
                    this.toast = msg;
                    var self = this;
                    clearTimeout(this.toastTimer);
                    this.toastTimer = setTimeout(function () { self.toast = ''; }, 3200);
                },

                async copyRegistrationLink() {
                    try {
                        await navigator.clipboard.writeText(registrationUrl);
                        this.showToast('تم نسخ رابط التسجيل');
                    } catch (e) {
                        this.showToast('تعذر النسخ من المتصفح');
                    }
                },

                invitationText() {
                    var org = (this.inviteCompany || '').trim();
                    var em = (this.inviteEmail || '').trim();
                    var s = 'السلام عليكم،\n\n';
                    s += 'ندعوكم للاطلاع على ملتقى مدرك 4 من جمعية كفاءات لبناء قدرات الشباب والتسجيل عبر الرابط التالي:\n';
                    s += registrationUrl + '\n\n';
                    s += 'مع خالص التحية،\n' + (accountName || '') + '\n';
                    if (org) {
                        s += '(' + org + ')';
                    }
                    if (em) {
                        s += '\n\nللتواصل: ' + em;
                    }
                    return s;
                },

                async copyInvitationText() {
                    try {
                        await navigator.clipboard.writeText(this.invitationText());
                        this.showToast('تم نسخ نص الدعوة');
                    } catch (e) {
                        this.showToast('تعذر النسخ من المتصفح');
                    }
                },

                onPhotoSelect(e) {
                    var f = e.target.files && e.target.files[0];
                    if (!f || !f.type || f.type.indexOf('image/') !== 0) return;
                    if (this._objectUrl) URL.revokeObjectURL(this._objectUrl);
                    this._objectUrl = URL.createObjectURL(f);
                    this.previewUrl = this._objectUrl;
                },

                clearPhoto() {
                    if (this._objectUrl) URL.revokeObjectURL(this._objectUrl);
                    this._objectUrl = null;
                    this.previewUrl = null;
                    var inp = document.getElementById('profile_photo_input');
                    if (inp) inp.value = '';
                },
            };
        }
    </script>
    <script>
        (function () {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                document.querySelectorAll('[data-reveal-settings]').forEach(function (el) { el.classList.add('is-visible'); });
                return;
            }
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                });
            }, { rootMargin: '0px 0px -5% 0px', threshold: 0.06 });
            document.querySelectorAll('[data-reveal-settings]').forEach(function (el) { io.observe(el); });
        })();
    </script>
@endpush
