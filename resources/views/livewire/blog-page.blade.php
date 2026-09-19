<div class="relative mx-auto max-w-6xl px-4 py-16">

    {{-- درخشش‌های محیطی پس‌زمینه --}}
    <div class="pointer-events-none absolute -top-10 right-1/4 -z-10 h-72 w-72 rounded-full bg-yellow-400/10 blur-[100px] dark:bg-yellow-500/10"></div>
    <div class="pointer-events-none absolute top-40 left-10 -z-10 h-56 w-56 rounded-full bg-amber-500/10 blur-[90px]"></div>

    <div class="mb-16 text-center">
        <span class="mb-4 inline-flex items-center gap-1.5 rounded-full border border-yellow-500/20 bg-yellow-50 px-3 py-1 text-xs font-semibold text-yellow-700 dark:border-yellow-500/20 dark:bg-yellow-500/10 dark:text-yellow-400">
            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none">
                <path d="M4 6h16M4 12h16M4 18h10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
            مجله گلدینا
        </span>
        <h1 class="relative mb-4 inline-block text-4xl font-bold text-gray-900 dark:text-white">
            <span class="relative z-10">وبلاگ گلدینا</span>
            <span class="absolute inset-x-2 bottom-1 -z-0 h-3 rounded bg-yellow-400/20 dark:bg-yellow-500/20"></span>
        </h1>
        <p class="mx-auto max-w-lg text-gray-600 dark:text-gray-400">آخرین تحلیل‌ها، اخبار و راهنمای سرمایه‌گذاری در طلا و ارزها</p>
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach($posts as $post)
            <article
                wire:click="openPost({{ $post->id }})"
                class="lp-tilt group relative flex cursor-pointer flex-col overflow-hidden rounded-3xl border border-gray-200 bg-white transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-yellow-500/10 dark:border-gray-800 dark:bg-gray-900 {{ $post->is_pinned ? 'ring-2 ring-yellow-500/70' : '' }}"
            >
                @if($post->is_pinned)
                    <div class="absolute right-4 top-4 z-10">
                        <span class="flex items-center gap-1 rounded-full bg-gradient-to-l from-yellow-400 to-amber-600 px-3 py-1 text-xs font-bold text-white shadow-[0_4px_14px_rgba(217,158,10,0.35)]">
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor"><path d="M14.7 3.3a1 1 0 0 0-1.4 0L11 5.6 6.4 8.3a1 1 0 0 0-.2 1.6l1.9 1.9-4 4a1 1 0 1 0 1.4 1.4l4-4 1.9 1.9a1 1 0 0 0 1.6-.2L15.7 10l2.3-2.3a1 1 0 0 0 0-1.4l-3.3-3Z"/></svg>
                            سنجاق شده
                        </span>
                    </div>
                @endif

                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 via-gray-900/10 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-b from-yellow-500/0 to-yellow-500/0 transition-colors duration-300 group-hover:from-yellow-500/5 group-hover:to-transparent"></div>
                </div>

                <div class="flex flex-1 flex-col p-6">
                    <div class="mb-4 flex items-center gap-2">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-amber-600 text-xs font-bold text-white shadow-[0_3px_10px_rgba(217,158,10,0.3)]">
                            {{ mb_substr($post->admin->name, 0, 1) }}
                        </div>
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                            {{ $post->admin->name }} {{ $post->admin->last_name }}
                        </span>
                        <span class="text-xs text-gray-300 dark:text-gray-600">•</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $post->created_at->format('Y/m/d') }}
                        </span>
                    </div>

                    <h3 class="mb-3 text-xl font-bold text-gray-900 transition-colors group-hover:text-yellow-600 dark:text-white dark:group-hover:text-yellow-500">
                        {{ $post->title }}
                    </h3>

                    <p class="mb-6 flex-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ Str::words($post->content, 30, '...') }}
                    </p>

                    <div class="mt-auto flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                            <span class="rounded-lg bg-gray-100 px-2 py-1 text-[10px] font-medium text-gray-600 transition-colors group-hover:bg-yellow-50 group-hover:text-yellow-700 dark:bg-gray-800 dark:text-gray-400 dark:group-hover:bg-yellow-500/10 dark:group-hover:text-yellow-400">
                                #{{ $tag }}
                            </span>
                        @endforeach
                    </div>

                    <div class="mt-5 flex items-center gap-1 text-xs font-semibold text-yellow-600 opacity-0 transition-opacity duration-300 group-hover:opacity-100 dark:text-yellow-400">
                        ادامه مطلب
                        <svg class="h-3 w-3 -scale-x-100" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Post Detail Modal -->
    @if($selectedPost)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4 backdrop-blur-sm" wire:click.self="closePost">
            <div class="lp-glass relative max-h-[90vh] w-full max-w-3xl overflow-hidden rounded-3xl border border-white/10 bg-white shadow-2xl dark:bg-gray-900">

                <!-- Modal Header -->
                <div class="relative h-64 w-full">
                    <img src="{{ asset($selectedPost->image) }}" alt="{{ $selectedPost->title }}" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>

                    <button wire:click="closePost" class="absolute left-4 top-4 rounded-full border border-white/20 bg-white/10 p-2 text-white backdrop-blur-md transition hover:bg-white/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="absolute bottom-0 right-0 p-8 text-right">
                        <div class="mb-2 flex items-center justify-end gap-2 text-white/90">
                            <span class="text-sm font-medium">{{ $selectedPost->admin->name }} {{ $selectedPost->admin->last_name }}</span>
                            <span class="text-xs text-white/60">• {{ $selectedPost->created_at->format('Y/m/d') }}</span>
                        </div>
                        <h2 class="text-3xl font-bold text-white drop-shadow-sm">{{ $selectedPost->title }}</h2>
                    </div>
                </div>

                <!-- Modal Content -->
                <div class="max-h-[calc(90vh-16rem)] overflow-y-auto p-8">
                    <div class="mb-6 flex flex-wrap gap-2">
                        @foreach($selectedPost->tags as $tag)
                            <span class="rounded-full bg-gradient-to-l from-yellow-50 to-amber-50 px-3 py-1 text-xs font-medium text-yellow-700 dark:from-yellow-500/10 dark:to-amber-500/10 dark:text-yellow-500">
                                #{{ $tag }}
                            </span>
                        @endforeach
                    </div>
                    <div class="whitespace-pre-line text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                        {{ $selectedPost->content }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
