@extends('layouts.admin')

@section('title', __('admin.dashboard'))
@section('page-title', __('admin.dashboard'))

@section('content')
    <div class="space-y-8">
        <section
            class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-blue-600 to-sky-500 text-white shadow-xl">
            <div class="absolute -top-32 -right-16 h-64 w-64 rounded-full bg-white/20 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-10 h-48 w-48 rounded-full bg-sky-400/40 blur-2xl"></div>
            <div class="relative z-10 p-8 lg:p-10">
                <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                    <div class="max-w-2xl">
                        <p class="text-xs font-semibold tracking-[0.35em] uppercase text-white/70">
                            {{ __('Executive Overview') }}</p>
                        <h1 class="mt-4 text-3xl font-semibold lg:text-4xl">
                            {{ __('Welcome back, :name', ['name' => auth()->user()->name]) }}</h1>
                        <p class="mt-3 text-sm text-white/80">
                            {{ __('Monitor performance, customer touchpoints, and operational status in a single glance.') }}
                        </p>
                        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm">
                                <p class="text-xs font-semibold uppercase tracking-wide text-white/70">
                                    {{ __('Active Projects') }}</p>
                                <p class="mt-2 text-2xl font-semibold">{{ number_format($activeProjects) }}</p>
                                <p class="text-xs text-white/60">{{ __('Featured :count', ['count' => $featuredProjects]) }}
                                </p>
                            </div>
                            <div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm">
                                <p class="text-xs font-semibold uppercase tracking-wide text-white/70">
                                    {{ __('Weekly Interactions') }}</p>
                                <p class="mt-2 text-2xl font-semibold">{{ number_format($weeklyInteractions) }}</p>
                                <p class="text-xs text-white/60">
                                    {{ __('Contacts :contacts • Inquiries :inquiries', ['contacts' => $contactsThisWeek, 'inquiries' => $inquiriesThisWeek]) }}
                                </p>
                            </div>
                            <div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm">
                                <p class="text-xs font-semibold uppercase tracking-wide text-white/70">
                                    {{ __('Response Health') }}</p>
                                <p class="mt-2 text-2xl font-semibold">{{ $contactResponse }}%</p>
                                <p class="text-xs text-white/60">
                                    {{ __('Contacts resolved :count', ['count' => $resolvedContacts]) }}</p>
                            </div>
                        </div>
                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="{{ route('admin.contacts.index') }}"
                                class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-indigo-600 shadow-md transition hover:bg-slate-100">
                                <i class="fas fa-envelope-open text-indigo-500"></i>
                                {{ __('View Inbox') }}
                            </a>
                            <a href="{{ route('admin.posts.create') }}"
                                class="inline-flex items-center gap-2 rounded-full border border-white/60 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">
                                <i class="fas fa-plus"></i>
                                {{ __('Create Update') }}
                            </a>
                            <a href="{{ route('admin.recruitments.index') }}"
                                class="inline-flex items-center gap-2 rounded-full border border-white/60 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">
                                <i class="fas fa-briefcase"></i>
                                {{ __('Hiring Board') }}
                            </a>
                        </div>
                    </div>

                    <div class="w-full max-w-md">
                        <div class="rounded-2xl border border-white/25 bg-white/10 p-6 backdrop-blur-sm shadow-lg">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-white">{{ __('Today\'s Focus') }}</p>
                                <span
                                    class="rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white/80">{{ __('Updated :date', ['date' => $now->format('M d, Y')]) }}</span>
                            </div>
                            <div class="mt-5 space-y-4">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-white">{{ __('Respond to contacts') }}</p>
                                        <p class="text-xs text-white/70">
                                            {{ __(':count pending replies', ['count' => $unreadContacts]) }}</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center rounded-full bg-white/15 px-3 py-1 text-sm font-semibold">{{ number_format($unreadContacts) }}</span>
                                </div>
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-white">{{ __('Resolve inquiries') }}</p>
                                        <p class="text-xs text-white/70">
                                            {{ __(':count awaiting confirmation', ['count' => $openInquiries]) }}</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center rounded-full bg-white/15 px-3 py-1 text-sm font-semibold">{{ number_format($openInquiries) }}</span>
                                </div>
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-white">{{ __('Check recruiting timeline') }}</p>
                                        <p class="text-xs text-white/70">
                                            {{ __(':count open positions', ['count' => $openRecruitments->count()]) }}</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center rounded-full bg-white/15 px-3 py-1 text-sm font-semibold">{{ number_format($openRecruitments->count()) }}</span>
                                </div>
                            </div>
                            <div class="mt-6 grid grid-cols-1 gap-3">
                                <a href="{{ route('admin.product-inquiries.index') }}"
                                    class="inline-flex items-center justify-between rounded-xl bg-white/15 px-4 py-3 text-sm font-medium text-white transition hover:bg-white/25">
                                    <span>{{ __('Review product inquiries') }}</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="{{ route('admin.projects.index') }}"
                                    class="inline-flex items-center justify-between rounded-xl bg-white/15 px-4 py-3 text-sm font-medium text-white transition hover:bg-white/25">
                                    <span>{{ __('Update project milestones') }}</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="{{ route('admin.settings.index') }}"
                                    class="inline-flex items-center justify-between rounded-xl bg-white/15 px-4 py-3 text-sm font-medium text-white transition hover:bg-white/25">
                                    <span>{{ __('Adjust site settings') }}</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div
                class="relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition hover:shadow-md">
                <div class="absolute -right-10 -top-10 h-24 w-24 rounded-full bg-indigo-100"></div>
                <div class="relative z-10 flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">{{ __('Products') }}</p>
                        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ number_format($totalProducts) }}</p>
                        <p class="text-xs text-gray-500">
                            {{ __('Active :active • Featured :featured', ['active' => $activeProducts, 'featured' => $featuredProducts]) }}
                        </p>
                    </div>
                    <span class="inline-flex items-center justify-center rounded-full bg-indigo-50 p-3 text-indigo-500">
                        <i class="fas fa-box-open"></i>
                    </span>
                </div>
            </div>

            <div
                class="relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition hover:shadow-md">
                <div class="absolute -right-10 -top-10 h-24 w-24 rounded-full bg-sky-100"></div>
                <div class="relative z-10 flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">{{ __('Projects') }}</p>
                        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ number_format($totalProjects) }}</p>
                        <p class="text-xs text-gray-500">
                            {{ __('Active :active • Featured :featured', ['active' => $activeProjects, 'featured' => $featuredProjects]) }}
                        </p>
                    </div>
                    <span class="inline-flex items-center justify-center rounded-full bg-sky-50 p-3 text-sky-500">
                        <i class="fas fa-diagram-project"></i>
                    </span>
                </div>
            </div>

            <div
                class="relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition hover:shadow-md">
                <div class="absolute -right-10 -top-10 h-24 w-24 rounded-full bg-purple-100"></div>
                <div class="relative z-10 flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">{{ __('Published Posts') }}
                        </p>
                        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ number_format($publishedPosts) }}</p>
                        <p class="text-xs text-gray-500">
                            {{ __('Content completion :percent%', ['percent' => $contentProgress]) }}</p>
                    </div>
                    <span class="inline-flex items-center justify-center rounded-full bg-purple-50 p-3 text-purple-500">
                        <i class="fas fa-rss"></i>
                    </span>
                </div>
            </div>

            <div
                class="relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition hover:shadow-md">
                <div class="absolute -right-10 -top-10 h-24 w-24 rounded-full bg-amber-100"></div>
                <div class="relative z-10 flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">{{ __('Support Queue') }}
                        </p>
                        <p class="mt-2 text-2xl font-semibold text-gray-900">
                            {{ number_format($unreadContacts + $openInquiries) }}</p>
                        <p class="text-xs text-gray-500">
                            {{ __('Contacts :contacts • Inquiries :inquiries', ['contacts' => $unreadContacts, 'inquiries' => $openInquiries]) }}
                        </p>
                    </div>
                    <span class="inline-flex items-center justify-center rounded-full bg-amber-50 p-3 text-amber-500">
                        <i class="fas fa-headset"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <div class="xl:col-span-2 rounded-3xl border border-gray-100 bg-white p-6 lg:p-8 shadow-sm">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('Performance Overview') }}</h3>
                        <p class="text-sm text-gray-500">
                            {{ __('Seven-day snapshot across publishing, delivery, and service teams.') }}</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-gray-200 px-4 py-2 text-sm font-medium text-gray-600 transition hover:border-gray-300 hover:text-gray-900">
                        <i class="fas fa-download text-gray-400"></i>
                        {{ __('Download report') }}
                    </a>
                </div>

                <div class="mt-8 grid gap-6 md:grid-cols-2">
                    <div class="space-y-5">
                        <div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">{{ __('Content Publishing') }}</p>
                                <span class="text-sm font-semibold text-purple-600">{{ $contentProgress }}%</span>
                            </div>
                            <div class="mt-3 h-2 rounded-full bg-gray-100">
                                <div class="h-full rounded-full bg-gradient-to-r from-purple-500 to-purple-400"
                                    style="width: {{ $contentProgress }}%;"></div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">
                                {{ __('Published :published of :total posts', ['published' => $publishedPosts, 'total' => $totalPosts]) }}
                            </p>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">{{ __('Project Delivery') }}</p>
                                <span class="text-sm font-semibold text-indigo-600">{{ $projectDelivery }}%</span>
                            </div>
                            <div class="mt-3 h-2 rounded-full bg-gray-100">
                                <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-blue-500"
                                    style="width: {{ $projectDelivery }}%;"></div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">
                                {{ __('Active :active of :total projects', ['active' => $activeProjects, 'total' => $totalProjects]) }}
                            </p>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">{{ __('Inquiry Resolution') }}</p>
                                <span class="text-sm font-semibold text-blue-600">{{ $inquiryResolution }}%</span>
                            </div>
                            <div class="mt-3 h-2 rounded-full bg-gray-100">
                                <div class="h-full rounded-full bg-gradient-to-r from-blue-500 to-sky-400"
                                    style="width: {{ $inquiryResolution }}%;"></div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">
                                {{ __('Resolved :resolved • Open :open', ['resolved' => $resolvedInquiries, 'open' => $openInquiries]) }}
                            </p>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-dashed border-indigo-200 bg-indigo-50/70 p-6">
                        <p class="text-sm font-semibold text-indigo-700">{{ __('Weekly Interactions Trend') }}</p>
                        <p class="text-xs text-indigo-500">{{ __('Combined contacts and inquiries captured each day.') }}
                        </p>
                        <div class="mt-6 flex h-32 items-end justify-between gap-2">
                            @foreach ($sparkHeights as $height)
                                <span class="w-full rounded-t-lg bg-gradient-to-t from-indigo-500 to-sky-400"
                                    style="height: {{ $height }}%;"></span>
                            @endforeach
                        </div>
                        <div class="mt-4 flex items-center justify-between text-xs text-indigo-500">
                            <span>{{ __('Mon') }}</span>
                            <span>{{ __('Tue') }}</span>
                            <span>{{ __('Wed') }}</span>
                            <span>{{ __('Thu') }}</span>
                            <span>{{ __('Fri') }}</span>
                            <span>{{ __('Sat') }}</span>
                            <span>{{ __('Sun') }}</span>
                        </div>
                        <p class="mt-4 text-xs font-medium text-indigo-600">
                            {{ __('Total interactions this week: :count', ['count' => $weeklyInteractions]) }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-6 lg:p-8 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900">{{ __('Team Focus') }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ __('Prioritize the most impactful actions for today.') }}</p>

                <div class="mt-6 space-y-4">
                    <div class="flex items-start justify-between rounded-2xl border border-gray-100 p-4">
                        <div class="flex items-start gap-3">
                            <span
                                class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-indigo-500">
                                <i class="fas fa-bell"></i>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ __('Campaign Status Review') }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ __('Ensure featured banners are aligned with live promotions.') }}</p>
                            </div>
                        </div>
                        <span
                            class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">{{ __('15 min') }}</span>
                    </div>

                    <div class="flex items-start justify-between rounded-2xl border border-gray-100 p-4">
                        <div class="flex items-start gap-3">
                            <span
                                class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-50 text-emerald-500">
                                <i class="fas fa-chart-line"></i>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ __('Quarterly KPI Sync') }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ __('Align product, project, and marketing priorities for Q4.') }}</p>
                            </div>
                        </div>
                        <span
                            class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">{{ __('This afternoon') }}</span>
                    </div>

                    <div class="flex items-start justify-between rounded-2xl border border-gray-100 p-4">
                        <div class="flex items-start gap-3">
                            <span
                                class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-amber-50 text-amber-500">
                                <i class="fas fa-people-group"></i>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ __('Recruitment Pipeline') }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ __('Confirm interview slots and publish the updated job brief.') }}</p>
                            </div>
                        </div>
                        <span
                            class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-600">{{ __('Due tomorrow') }}</span>
                    </div>
                </div>

                <div class="mt-6 rounded-2xl bg-gray-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">{{ __('Shortcuts') }}</p>
                    <div class="mt-3 grid grid-cols-2 gap-3 text-sm font-medium text-gray-600">
                        <a href="{{ route('admin.banners.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 transition hover:border-gray-300 hover:text-gray-900">
                            <i class="fas fa-bullhorn text-gray-400"></i>{{ __('Banners') }}
                        </a>
                        <a href="{{ route('admin.testimonials.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 transition hover:border-gray-300 hover:text-gray-900">
                            <i class="fas fa-star text-gray-400"></i>{{ __('Testimonials') }}
                        </a>
                        <a href="{{ route('admin.pages.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 transition hover:border-gray-300 hover:text-gray-900">
                            <i class="fas fa-file-lines text-gray-400"></i>{{ __('Pages') }}
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 transition hover:border-gray-300 hover:text-gray-900">
                            <i class="fas fa-user-gear text-gray-400"></i>{{ __('Users') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <div class="xl:col-span-2 rounded-3xl border border-gray-100 bg-white p-6 lg:p-8 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('Activity Timeline') }}</h3>
                        <p class="text-sm text-gray-500">{{ __('The latest touchpoints captured across the platform.') }}
                        </p>
                    </div>
                    <a href="{{ route('admin.contacts.index') }}"
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-700">{{ __('View all') }}</a>
                </div>

                <div class="mt-6 space-y-6">
                    @forelse($activityFeed as $activity)
                        <div class="relative pl-8">
                            <span
                                class="absolute left-0 top-1.5 flex h-6 w-6 items-center justify-center rounded-full border-2 border-indigo-200 bg-indigo-50 text-indigo-500">
                                @if ($activity['type'] === 'contact')
                                    <i class="fas fa-user"></i>
                                @else
                                    <i class="fas fa-store"></i>
                                @endif
                            </span>
                            <div
                                class="rounded-2xl border border-gray-100 p-4 shadow-sm transition hover:border-indigo-100 hover:shadow-md">
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $activity['title'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $activity['subtitle'] }}</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="text-xs text-gray-400">{{ $activity['created_at']->diffForHumans() }}</span>
                                        <a href="{{ $activity['link'] }}"
                                            class="inline-flex items-center justify-center rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-600 hover:bg-indigo-100">
                                            {{ __('Open') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">{{ __('No recent activity yet.') }}</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-6 lg:p-8 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900">{{ __('Customer Experience') }}</h3>
                <p class="mt-1 text-sm text-gray-500">
                    {{ __('Track handling efficiency and pulse across support channels.') }}</p>

                <div class="mt-6 space-y-5">
                    <div class="rounded-2xl border border-gray-100 p-4">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-gray-900">{{ __('Contact response rate') }}</p>
                            <span class="text-sm font-semibold text-emerald-500">{{ $contactResponse }}%</span>
                        </div>
                        <div class="mt-3 h-2 rounded-full bg-gray-100">
                            <div class="h-full rounded-full bg-gradient-to-r from-emerald-500 to-emerald-400"
                                style="width: {{ $contactResponse }}%;"></div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">
                            {{ __('Resolved :resolved • Open :open', ['resolved' => $resolvedContacts, 'open' => $unreadContacts]) }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-gray-100 p-4">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-gray-900">{{ __('Inquiry resolution') }}</p>
                            <span class="text-sm font-semibold text-blue-500">{{ $inquiryResolution }}%</span>
                        </div>
                        <div class="mt-3 h-2 rounded-full bg-gray-100">
                            <div class="h-full rounded-full bg-gradient-to-r from-blue-500 to-sky-500"
                                style="width: {{ $inquiryResolution }}%;"></div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">
                            {{ __('Resolved :resolved • Awaiting :open', ['resolved' => $resolvedInquiries, 'open' => $openInquiries]) }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                {{ __('New contacts (7d)') }}</p>
                            <p class="mt-2 text-xl font-semibold text-gray-900">{{ number_format($contactsThisWeek) }}
                            </p>
                        </div>
                        <div class="rounded-2xl border border-gray-100 bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                {{ __('New inquiries (7d)') }}</p>
                            <p class="mt-2 text-xl font-semibold text-gray-900">{{ number_format($inquiriesThisWeek) }}
                            </p>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-indigo-100 bg-indigo-50/60 p-4">
                        <p class="text-sm font-semibold text-indigo-700">{{ __('Service health status') }}</p>
                        <p class="mt-1 text-xs text-indigo-600">
                            {{ __('All channels operating normally. Next SLA checkpoint in 3 hours.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Top performing products') }}</h3>
                    <a href="{{ route('admin.products.index') }}"
                        class="text-xs font-medium text-indigo-600 hover:text-indigo-700">{{ __('Manage') }}</a>
                </div>
                <p class="mt-1 text-sm text-gray-500">{{ __('Based on lifetime view counts.') }}</p>

                <div class="mt-5 space-y-4">
                    @forelse($topProducts as $product)
                        <div
                            class="flex items-center justify-between rounded-2xl border border-gray-100 p-4 transition hover:border-indigo-100">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ optional($product->category)->name ?? __('Uncategorized') }}</p>
                            </div>
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">
                                <i class="fas fa-eye"></i>{{ number_format($product->view_count ?? 0) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">{{ __('No products available yet.') }}</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Active projects') }}</h3>
                    <a href="{{ route('admin.projects.index') }}"
                        class="text-xs font-medium text-indigo-600 hover:text-indigo-700">{{ __('Manage') }}</a>
                </div>
                <p class="mt-1 text-sm text-gray-500">{{ __('Latest initiatives currently in delivery.') }}</p>

                <div class="mt-5 space-y-4">
                    @forelse($activeProjectsList as $project)
                        <div class="rounded-2xl border border-gray-100 p-4 transition hover:border-sky-100">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-gray-900">{{ $project->title }}</p>
                                @if ($project->is_featured)
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-sky-50 px-2 py-1 text-[11px] font-semibold text-sky-600">
                                        <i class="fas fa-star"></i>{{ __('Featured') }}
                                    </span>
                                @endif
                            </div>
                            <p class="mt-1 text-xs text-gray-500">{{ $project->client_name ?? __('Client TBD') }}</p>
                            <p class="mt-2 text-xs text-gray-400">
                                {{ __('Updated :date', ['date' => optional($project->project_date ?? $project->updated_at)->format('M d, Y')]) }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">{{ __('No active projects at the moment.') }}</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Open positions') }}</h3>
                    <a href="{{ route('admin.recruitments.index') }}"
                        class="text-xs font-medium text-indigo-600 hover:text-indigo-700">{{ __('Manage') }}</a>
                </div>
                <p class="mt-1 text-sm text-gray-500">{{ __('Active hiring opportunities and deadlines.') }}</p>

                <div class="mt-5 space-y-4">
                    @forelse($openRecruitments as $job)
                        <div class="rounded-2xl border border-gray-100 p-4 transition hover:border-emerald-100">
                            <p class="text-sm font-semibold text-gray-900">{{ $job->title }}</p>
                            <p class="mt-1 text-xs text-gray-500">{{ $job->location ?? __('Flexible location') }} •
                                {{ $job->job_type ?? __('Full-time') }}</p>
                            @if ($job->deadline)
                                <p
                                    class="mt-2 inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold text-emerald-600">
                                    <i
                                        class="fas fa-clock"></i>{{ __('Deadline :date', ['date' => $job->deadline->format('M d, Y')]) }}
                                </p>
                            @else
                                <p
                                    class="mt-2 inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold text-emerald-600">
                                    <i class="fas fa-infinity"></i>{{ __('Open until filled') }}
                                </p>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">{{ __('No active recruitments currently.') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
