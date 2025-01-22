<x-layout>
    <div class="max-w-5xl mx-auto">
        <!-- 用户信息头部 -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center space-x-6">
                <img src="{{ $user->avatar }}" class="w-32 h-32 rounded-full">
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $user->username }}</h1>
                    <p class="text-gray-600 mb-4">{{ $user->bio }}</p>
                    
                    <div class="flex items-center space-x-6 text-sm">
                        <span><strong>{{ $user->postCount }}</strong> 帖子</span>
                        <span><strong>{{ $user->followerCount }}</strong> 粉丝</span>
                        <span><strong>{{ $user->followingCount }}</strong> 关注</span>
                    </div>
                </div>
                
                @if(auth()->id() !== $user->id)
                    <button class="bg-purple-600 text-white px-8 py-2 rounded-lg hover:bg-purple-700 transition">
                        {{ $user->isFollowing ? '取消关注' : '关注' }}
                    </button>
                @endif
            </div>
        </div>

        <!-- 标签页导航 -->
        <div class="bg-white rounded-lg shadow-md mb-6">
            <nav class="flex border-b">
                <a href="#" class="px-6 py-3 text-purple-700 border-b-2 border-purple-700">帖子</a>
                <a href="#" class="px-6 py-3 text-gray-600 hover:text-purple-700">相册</a>
                <a href="#" class="px-6 py-3 text-gray-600 hover:text-purple-700">收藏</a>
            </nav>
        </div>

        <!-- 帖子列表 -->
        <x-post-list :posts="$user->posts" />
    </div>
</x-layout> 