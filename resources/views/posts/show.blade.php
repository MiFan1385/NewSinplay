<x-layout>
    <div class="max-w-4xl mx-auto">
        <!-- 帖子内容 -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center space-x-4 mb-6">
                <img src="{{ $post->author->avatar }}" class="w-12 h-12 rounded-full">
                <div>
                    <h4 class="font-semibold text-purple-700">{{ $post->author->username }}</h4>
                    <span class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>

            <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
            
            @if($post->images)
                <div class="grid grid-cols-2 gap-4 mb-6">
                    @foreach($post->images as $image)
                        <img src="{{ $image->url }}" class="rounded-lg w-full">
                    @endforeach
                </div>
            @endif

            <div class="text-gray-700 mb-6">
                {{ $post->content }}
            </div>

            <div class="flex items-center justify-between border-t pt-4">
                <div class="flex items-center space-x-6">
                    <button class="flex items-center text-gray-500 hover:text-purple-700">
                        <i class="fas fa-thumbs-up mr-1"></i>
                        <span>{{ $post->likeCount }}</span>
                    </button>
                    <button class="flex items-center text-gray-500 hover:text-purple-700">
                        <i class="fas fa-comment mr-1"></i>
                        <span>{{ $post->commentCount }}</span>
                    </button>
                </div>
                <button class="text-gray-500 hover:text-purple-700">
                    <i class="fas fa-share-alt"></i>
                </button>
            </div>
        </div>

        <!-- 评论区 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">评论 ({{ $post->commentCount }})</h3>
            
            <!-- 评论输入框 -->
            <div class="mb-6">
                <textarea 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    rows="3"
                    placeholder="分享你的想法..."></textarea>
                <button class="mt-2 bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                    发表评论
                </button>
            </div>

            <!-- 评论列表 -->
            <div class="space-y-4">
                @foreach($post->comments as $comment)
                    <x-comment :comment="$comment" />
                @endforeach
            </div>
        </div>
    </div>
</x-layout> 