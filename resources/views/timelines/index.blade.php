<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- 左侧边栏 -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <h3 class="text-lg font-semibold text-purple-700 mb-4">发现</h3>
                <nav class="space-y-2">
                    <a href="{{ route('home') }}" class="flex items-center text-gray-700 hover:text-purple-600">
                        <i class="fas fa-home mr-2"></i> 首页
                    </a>
                    <a href="{{ route('timelines.index') }}" class="flex items-center text-purple-600">
                        <i class="fas fa-stream mr-2"></i> 时间线
                    </a>
                    <a href="{{ route('nearby.index') }}" class="flex items-center text-gray-700 hover:text-purple-600">
                        <i class="fas fa-map-marker-alt mr-2"></i> 附近
                    </a>
                </nav>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-purple-700 mb-4">热门话题</h3>
                <div class="space-y-2">
                    @foreach($hotTopics as $topic)
                        <a href="{{ route('topics.show', $topic) }}" class="block text-gray-700 hover:text-purple-600">
                            #{{ $topic->name }}
                            <span class="text-sm text-gray-500">({{ $topic->posts_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 右侧内容区 -->
        <div class="md:col-span-3">
            <!-- 筛选选项 -->
            <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                <div class="flex space-x-4">
                    <a href="?filter=all" class="text-purple-600 font-medium">全部</a>
                    <a href="?filter=following" class="text-gray-600 hover:text-purple-600">关注</a>
                    <a href="?filter=hot" class="text-gray-600 hover:text-purple-600">热门</a>
                </div>
            </div>

            <!-- 帖子列表 -->
            <div class="space-y-6">
                @foreach($posts as $post)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <a href="{{ route('users.show', $post->author) }}">
                                <img src="{{ $post->author->avatar }}" class="w-12 h-12 rounded-full">
                            </a>
                            <div>
                                <a href="{{ route('users.show', $post->author) }}" class="font-semibold text-gray-900 hover:text-purple-600">
                                    {{ $post->author->username }}
                                </a>
                                <div class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                            </div>
                        </div>

                        @if($post->images->count() > 0)
                            <div class="grid grid-cols-2 gap-2 mb-4">
                                @foreach($post->images as $image)
                                    <img src="{{ $image->url }}" class="rounded-lg w-full h-48 object-cover">
                                @endforeach
                            </div>
                        @endif

                        <p class="text-gray-800 mb-4">{{ $post->content }}</p>

                        <!-- 话题标签 -->
                        @if($post->topics->count() > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($post->topics as $topic)
                                    <a href="{{ route('topics.show', $topic) }}" class="text-sm text-purple-600 hover:text-purple-800">
                                        #{{ $topic->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <!-- 互动按钮 -->
                        <div class="flex items-center justify-between border-t pt-4">
                            <div class="flex items-center space-x-6">
                                <button onclick="handleLike({{ $post->id }})" 
                                    id="like-button-{{ $post->id }}"
                                    class="flex items-center text-gray-500 hover:text-purple-600 {{ $post->isLikedBy(auth()->user()) ? 'text-purple-600' : '' }}">
                                    <i class="fas fa-heart mr-1"></i>
                                    <span id="like-count-{{ $post->id }}">{{ $post->likes_count }}</span>
                                </button>
                                <a href="{{ route('posts.show', $post) }}" class="flex items-center text-gray-500 hover:text-purple-600">
                                    <i class="fas fa-comment mr-1"></i>
                                    <span>{{ $post->comments_count }}</span>
                                </a>
                            </div>
                            <button class="text-gray-500 hover:text-purple-600">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- 分页 -->
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-layout> 