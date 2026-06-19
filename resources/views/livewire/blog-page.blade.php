<div class="max-w-6xl mx-auto py-16 px-4">
    <div class="text-center mb-16">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">وبلاگ گلدینا</h1>
        <p class="text-gray-600 dark:text-gray-400">آخرین تحلیل‌ها، اخبار و راهنمای سرمایه‌گذاری در طلا و ارزها</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
            <article 
                wire:click="openPost({{ $post->id }})"
                class="group relative flex flex-col bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 cursor-pointer {{ $post->is_pinned ? 'ring-2 ring-yellow-500' : '' }}"
            >
                @if($post->is_pinned)
                    <div class="absolute top-4 right-4 z-10">
                        <span class="px-3 py-1 text-xs font-bold bg-yellow-500 text-white rounded-full shadow-sm">سنجاق شده</span>
                    </div>
                @endif

                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
                </div>

                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center text-white text-xs font-bold">
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

                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-yellow-600 dark:group-hover:text-yellow-500 transition-colors">
                        {{ $post->title }}
                    </h3>

                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 flex-1">
                        {{ Str::words($post->content, 30, '...') }}
                    </p>

                    <div class="flex flex-wrap gap-2 mt-auto">
                        @foreach($post->tags as $tag)
                            <span class="px-2 py-1 text-[10px] font-medium bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded-lg">
                                #{{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Post Detail Modal -->
    @if($selectedPost)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" wire:click.self="closePost">
            <div class="relative w-full max-w-3xl max-h-[90vh] overflow-hidden bg-white dark:bg-gray-900 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-800 transition-all">
                
                <!-- Modal Header -->
                <div class="relative h-64 w-full">
                    <img src="{{ asset($selectedPost->image) }}" alt="{{ $selectedPost->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
                    
                    <button wire:click="closePost" class="absolute top-4 left-4 p-2 bg-white/20 hover:bg-white/40 text-white rounded-full backdrop-blur-md transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="absolute bottom-0 right-0 p-8 text-right">
                        <div class="flex items-center gap-2 mb-2 text-white/90">
                            <span class="text-sm font-medium">{{ $selectedPost->admin->name }} {{ $selectedPost->admin->last_name }}</span>
                            <span class="text-xs text-white/60">• {{ $selectedPost->created_at->format('Y/m/d') }}</span>
                        </div>
                        <h2 class="text-3xl font-bold text-white">{{ $selectedPost->title }}</h2>
                    </div>
                </div>

                <!-- Modal Content -->
                <div class="p-8 overflow-y-auto max-h-[calc(90vh-16rem)]">
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($selectedPost->tags as $tag)
                            <span class="px-3 py-1 text-xs font-medium bg-yellow-500/10 text-yellow-600 dark:text-yellow-500 rounded-full">
                                #{{ $tag }}
                            </span>
                        @endforeach
                    </div>
                    <div class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg whitespace-pre-line">
                        {{ $selectedPost->content }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
