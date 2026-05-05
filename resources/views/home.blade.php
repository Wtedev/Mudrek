@extends('layouts.gov')

@section('title', 'الرئيسية — مدرك 4')

@section('content')
<div class="medrek-premium-shell">
    <section id="about" class="medrek-hero-stage px-4 py-12 md:py-20">
        <div class="mx-auto max-w-5xl">
            <div class="medrek-hero-panel px-2 py-14 text-center md:px-6 md:py-20">
                <p class="text-sm text-[var(--gov-accent)]">جمعية كفاءات لبناء قدرات الشباب</p>
                <h1 class="mt-3 text-3xl font-bold tracking-tight text-[var(--gov-navy)] md:text-5xl">مدرك 4</h1>
                <p class="mt-4 text-lg text-[var(--gov-navy-light)] md:text-xl">بوابتك لاختيار تخصصك الجامعي بثقة</p>
                <p class="mx-auto mt-6 max-w-2xl text-pretty text-base leading-relaxed text-[var(--gov-muted)]">
                    نرافقك من المرحلة الثانوية لاكتشاف التخصصات، وفهم الحياة الجامعية، وبناء مسارك الأكاديمي بإرشاد نخبة من الأكاديميين . خطوة بخطوة نحو مستقبلك.
                </p>
                <p class="mx-auto mt-4 max-w-xl text-sm text-[var(--gov-muted)]">
                    يسر جمعية كفاءات لبناء قدرات الشباب دعوتك للتسجيل في ملتقى مدرك 4
                </p>
                <div class="mt-10">
                    <a href="{{ route('registration') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[var(--gov-accent)] px-8 py-3.5 text-base font-medium text-white shadow-md shadow-[rgba(24,147,153,0.24)] transition duration-300 ease-out hover:bg-[var(--gov-accent-hover)] hover:shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--gov-accent)] focus-visible:ring-offset-2">
                        سجل الآن
                        <x-medrek-icon name="arrow-right" class="h-5 w-5 text-white rotate-180" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="medrek-card-layer px-3 pb-10 sm:px-5 md:px-8 md:pb-14">
        <div class="medrek-main-card mx-auto max-w-[min(94vw,82rem)] overflow-hidden rounded-[2rem] border border-[var(--gov-border)]/80 bg-[var(--gov-surface)]/96 shadow-[0_24px_70px_-24px_rgba(15,23,42,0.28)] backdrop-blur-sm sm:rounded-[2.25rem] md:rounded-[2.75rem]">
            <section id="event-details" class="event-details scroll-mt-24 bg-transparent py-8 md:py-10" aria-labelledby="details-heading">
                <div class="mx-auto max-w-5xl px-4 sm:px-6 [font-family:inherit]">
                    <h2 id="details-heading" class="text-center text-base text-[var(--gov-navy)] md:text-lg" data-reveal>تفاصيل الملتقى</h2>
                    <div class="mt-5 grid grid-cols-4 gap-x-2 gap-y-6 sm:mt-6 sm:gap-x-3 sm:gap-y-0 md:gap-x-5 lg:gap-x-6" data-reveal>
                        @foreach ([
                        ['label' => 'المكان', 'value' => 'القصيم، بريدة', 'value_secondary' => 'مدارس قيم التعليمية', 'icon' => 'map-pin', 'title' => null],
                        ['label' => 'المدة', 'value' => 'يوم واحد', 'value_secondary' => null, 'icon' => 'clock', 'title' => null],
                        ['label' => 'التاريخ', 'value' => '17 مايو', 'value_secondary' => null, 'icon' => 'calendar', 'title' => null],
                        ['label' => 'الوقت', 'value' => '4 م - 10 م', 'value_secondary' => null, 'icon' => 'sun', 'title' => 'من 4 مساء إلى 10 مساء'],
                        ] as $card)
                        <div @if (! empty($card['title'])) title="{{ $card['title'] }}" @endif class="flex min-h-0 w-full min-w-0 flex-col items-center gap-2.5 text-center sm:gap-3">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-[var(--gov-accent-soft)] text-[var(--gov-accent)] sm:h-12 sm:w-12">
                                <x-medrek-icon :name="$card['icon']" class="h-4 w-4 sm:h-[1.125rem] sm:w-[1.125rem]" />
                            </span>
                            <p class="flex w-full min-w-0 max-w-full flex-col items-center gap-0.5 text-center sm:gap-1">
                                <span class="sr-only">
                                    {{ $card['label'] }}:
                                    {{ $card['value'] }}@if (! empty($card['value_secondary'])). {{ $card['value_secondary'] }}@endif
                                </span>
                                @if (! empty($card['value_secondary']))
                                <span aria-hidden="true" class="block w-full min-w-0 whitespace-nowrap text-[10px] font-normal leading-tight text-[var(--gov-navy)] sm:text-[11px] sm:leading-tight md:text-sm">{{ $card['value'] }}</span>
                                <span aria-hidden="true" class="block max-w-full text-pretty text-[9px] font-light leading-snug text-[var(--gov-accent-muted)]/80 sm:text-[10px] md:text-[11px]">{{ $card['value_secondary'] }}</span>
                                @else
                                <span aria-hidden="true" class="block w-full max-w-full text-pretty text-[11px] font-normal leading-snug text-[var(--gov-navy)] sm:text-sm sm:leading-snug md:text-[0.9375rem]">{{ $card['value'] }}</span>
                                @endif
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section class="border-y border-[var(--gov-border)]/70 bg-transparent py-9 md:py-11 [font-family:inherit]" aria-labelledby="features-heading">
                <div class="mx-auto max-w-5xl px-4 sm:px-6">
                    <div class="text-center" data-reveal>
                        <p class="text-xs font-semibold text-[var(--gov-muted)] sm:text-sm">محتوى البرنامج</p>
                        <h2 id="features-heading" class="mt-2 text-xl font-bold text-[var(--gov-navy)] md:text-2xl">ماذا يقدم لك مدرك؟</h2>
                    </div>
                    <div class="mx-auto mt-6 grid max-w-5xl grid-cols-2 gap-2.5 sm:mt-7 sm:grid-cols-3 sm:gap-3" role="list">
                        @foreach ([
                        ['title' => 'برامج تدريبية', 'icon' => 'film'],
                        ['title' => 'ورش عمل', 'icon' => 'briefcase'],
                        ['title' => 'جلسات حوارية', 'icon' => 'chat'],
                        ['title' => 'استشارات أكاديمية', 'icon' => 'book'],
                        ['title' => 'فهم التخصصات', 'icon' => 'magnify'],
                        ['title' => 'الاستعداد للحياة الجامعية', 'icon' => 'academic'],
                        ] as $item)
                        <a href="#event-details" class="group flex min-h-[2.875rem] w-full min-w-0 items-center justify-center gap-2.5 rounded-xl border border-slate-200/80 bg-white px-2.5 py-2 text-center shadow-[0_1px_2px_rgba(15,23,42,0.04)] transition-[border-color,box-shadow,background-color] duration-200 [font-family:inherit] hover:border-[var(--gov-accent)]/30 hover:bg-[var(--gov-accent-soft)]/40 hover:shadow-[0_2px_10px_rgba(24,147,153,0.08)] focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--gov-accent)]/30 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--gov-surface-muted)] sm:px-3.5 sm:py-2.5" data-reveal role="listitem">
                            <span class="grid h-8 w-8 shrink-0 place-items-center overflow-hidden rounded-lg bg-[var(--gov-accent-soft)]/50 text-[var(--gov-accent)] ring-1 ring-[var(--gov-accent)]/10 transition-[opacity,background-color] group-hover:bg-[var(--gov-accent-soft)] group-hover:opacity-100 sm:h-9 sm:w-9">
                                <x-medrek-icon :name="$item['icon']" class="h-4 w-4 sm:h-[1.125rem] sm:w-[1.125rem]" />
                            </span>
                            <span class="min-w-0 flex-1 text-pretty text-center text-[11px] font-semibold leading-snug text-[var(--gov-navy)] sm:text-xs md:text-[0.8125rem]">
                                {{ $item['title'] }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="program-perks" class="scroll-mt-24 border-y border-[var(--gov-border)]/70 bg-transparent py-10 md:py-12 [font-family:inherit]" aria-labelledby="perks-heading">
    <div class="mx-auto max-w-3xl px-4 sm:px-6">
        <div class="text-center" data-reveal>
            <h2 id="perks-heading" class="text-xl font-bold text-[var(--gov-navy)] md:text-2xl">المميزات</h2>
        </div>
        <div class="mx-auto mt-6" data-reveal>
            <div class="flex flex-col gap-4 rounded-2xl border border-[var(--gov-border)] bg-gradient-to-b from-[var(--gov-accent-soft)]/35 to-white p-5 shadow-[0_1px_3px_rgba(15,23,42,0.08)] sm:flex-row sm:items-center sm:gap-5 sm:p-6">
                <span class="mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[var(--gov-accent-soft)] text-[var(--gov-accent)] sm:mx-0 sm:h-14 sm:w-14">
                    <x-medrek-icon name="chart-up" class="h-6 w-6 sm:h-7 sm:w-7" />
                </span>
                <p class="min-w-0 flex-1 text-center text-sm font-semibold leading-relaxed text-[var(--gov-navy)] sm:text-start sm:text-base">
                    خصومات خاصة للاشتراك بدورة القدرات العامة
                </p>
            </div>
        </div>
    </div>
            </section>

            <section class="border-y border-[var(--gov-border)]/70 bg-transparent py-10 md:py-14" aria-labelledby="topics-heading">
    <div class="mx-auto max-w-3xl px-4 sm:px-6">
        <div class="text-center" data-reveal>
            <h2 id="topics-heading" class="text-2xl font-bold text-[var(--gov-navy)] md:text-3xl">محاور البرنامج</h2>
            <p class="mt-2 text-sm text-[var(--gov-muted)]">هيكل المحتوى التدريبي لليوم — اضغط على المحاور الوسطى لعرض المقدّمين أو إخفائهم</p>
        </div>
        <div class="mx-auto mt-6 space-y-2 [font-family:inherit]" x-data="{ open: null }" x-on:keydown.escape.window="open = null">
            @foreach ([
            ['ar' => 'قياس الميول التخصصية', 'icon' => 'chart-bar', 'static' => true],
            ['ar' => 'مفتاح النجاح وصناعة الأولويات', 'icon' => 'target', 'axis' => 1, 'presenters' => ['م. عبدالسلام الصغير', 'أ. فارس الحميد']],
            ['ar' => 'كيف أختار التخصص؟', 'icon' => 'compass', 'axis' => 2, 'presenters' => ['أ. أحمد الرفاعي', 'أ. فارس الحميد']],
            ['ar' => 'تحديات السنة الجامعية الأولى', 'icon' => 'book', 'axis' => 3, 'presenters' => ['أ. عبدالله الضحيان']],
            ['ar' => 'مسارات مهنية مختلفة', 'icon' => 'route', 'axis' => 4, 'presenters' => ['أ. الوطبان', 'د. السراح', 'أ. أباالخيل', 'د. المعتق']],
            ['ar' => 'الأنظمة والقوانين الأكاديمية للجامعات', 'icon' => 'clipboard', 'axis' => 5, 'presenters' => ['د. عادل السعوي']],
            ['ar' => 'معرض الاستشارات الأكاديمية', 'icon' => 'handshake', 'static' => true],
            ] as $ti => $topic)
            @php
            $topicStatic = ! empty($topic['static']);
            @endphp
            <article class="overflow-hidden rounded-lg bg-white shadow-[0_1px_3px_rgba(15,23,42,0.08)] transition-colors duration-150 data-reveal">
                @if ($topicStatic)
                <div class="flex w-full items-start gap-2.5 p-3 text-start sm:gap-3 sm:p-3.5">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-[var(--gov-accent-soft)]/70 text-[var(--gov-accent)] sm:h-10 sm:w-10">
                        <x-medrek-icon :name="$topic['icon']" class="h-4 w-4 sm:h-[1.125rem] sm:w-[1.125rem]" />
                    </span>
                    <span class="min-w-0 flex-1 self-center">
                        <span class="block text-sm font-semibold leading-snug text-[var(--gov-navy)] sm:text-[0.9375rem]">{{ $topic['ar'] }}</span>
                    </span>
                </div>
                @else
                <button type="button" class="flex w-full items-start gap-2.5 p-3 text-start outline-none transition-colors hover:bg-slate-50/90 focus-visible:ring-2 focus-visible:ring-[var(--gov-accent)]/25 sm:gap-3 sm:p-3.5" x-on:click="open = open === {{ $ti }} ? null : {{ $ti }}" :aria-expanded="open === {{ $ti }}" aria-controls="topics-axis-panel-{{ $ti }}" id="topics-axis-trigger-{{ $ti }}">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-[var(--gov-accent-soft)]/70 text-[var(--gov-accent)] sm:h-10 sm:w-10">
                        <x-medrek-icon :name="$topic['icon']" class="h-4 w-4 sm:h-[1.125rem] sm:w-[1.125rem]" />
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="block text-[11px] font-semibold text-[var(--gov-muted)]">محور {{ $topic['axis'] }}</span>
                        <span class="mt-0.5 block text-sm font-semibold leading-snug text-[var(--gov-navy)] sm:text-[0.9375rem]">{{ $topic['ar'] }}</span>
                    </span>
                    <span class="mt-0.5 inline-flex shrink-0 text-slate-400 transition-transform duration-200 ease-out" :class="open === {{ $ti }} ? 'rotate-180 text-[var(--gov-accent)]' : ''">
                        <x-medrek-icon name="chevron-down" class="h-4 w-4" />
                    </span>
                </button>
                <div class="grid overflow-hidden transition-[grid-template-rows] duration-200 ease-out" :class="open === {{ $ti }} ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'">
                    <div id="topics-axis-panel-{{ $ti }}" class="min-h-0 overflow-hidden" role="region" :aria-hidden="open !== {{ $ti }}">
                        <div class="border-t border-slate-100 px-3 pb-2.5 pt-1.5 sm:px-3.5 sm:pb-3 sm:pt-2">
                            <p class="text-[10px] font-semibold text-[var(--gov-muted)] sm:text-[11px]">المقدمون:</p>
                            <div class="mt-1.5 flex flex-wrap gap-1">
                                @foreach ($topic['presenters'] as $name)
                                <span class="inline-flex max-w-full items-center rounded border border-slate-200/90 bg-slate-50 px-1.5 py-0.5 text-[10px] font-medium leading-none text-[var(--gov-navy-light)] sm:px-2 sm:text-[11px]">{{ $name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </article>
            @endforeach
        </div>
    </div>
            </section>

@php
$partnerLogoFiles = [
'Full Logo WB.png',
'masarat-1.png',
'moe_logo.png',
'Qyem.png',
'ccaf5315-373d-477c-9781-9252b0511311.png',
];
@endphp
            <section class="py-14 md:py-16 [font-family:inherit]" aria-labelledby="partners-heading">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
        <h2 id="partners-heading" class="text-center text-2xl font-bold text-[var(--gov-navy)] md:text-3xl">شركاء النجاح</h2>
        <p class="mx-auto mt-2 max-w-xl text-center text-sm text-[var(--gov-muted)]">شعارات الشركاء المعتمدين</p>

        {{-- dir=ltr على الحاوية: حركة translateX لا نهائية متسقة داخل الصفحة dir=rtl --}}
        <div class="medrek-partners-viewport relative mx-auto mt-8 overflow-hidden py-4" role="region" aria-label="شعارات الشركاء — تمرير تلقائي" dir="ltr">
            <div class="medrek-partners-track medrek-partners-track--paused">
                @foreach ([0, 1, 2] as $loopPart)
                <div class="medrek-partners-set" @if ($loopPart> 0) aria-hidden="true" @endif
                    >
                    @foreach ($partnerLogoFiles as $logoFile)
                    {{-- ثلاث نسخ متطابقة + translate(-33.333%) لحلقة بلا ثغرة وحشو أفضل على الشاشات الضيقة --}}
                    <div class="medrek-partner-slot shrink-0">
                        <img src="{{ asset('images/partners/'.rawurlencode($logoFile)) }}" alt="" width="200" height="64" loading="lazy" decoding="async" draggable="false" class="medrek-partner-img" />
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
            </section>
        </div>
    </div>
</div>
@endsection
