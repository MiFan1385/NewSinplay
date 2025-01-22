@props(['user'])

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="text-center">
        <img src="{{ $user->avatar }}" class="w-24 h-24 rounded-full mx-auto mb-4">
        <h3 class="text-xl font-semibold text-purple-700">{{ $user->username }}</h3>
        <p class="text-gray-500 mb-4">{{ $user->bio }}</p>
    </div>
    
    <div class="grid grid-cols-3 gap-4 text-center border-t pt-4">
        <div>
            <div class="text-xl font-semibold text-purple-700">{{ $user->postCount }}</div>
            <div class="text-sm text-gray-500">帖子</div>
        </div>
        <div>
            <div class="text-xl font-semibold text-purple-700">{{ $user->followerCount }}</div>
            <div class="text-sm text-gray-500">粉丝</div>
        </div>
        <div>
            <div class="text-xl font-semibold text-purple-700">{{ $user->followingCount }}</div>
            <div class="text-sm text-gray-500">关注</div>
        </div>
    </div>
    
    <div class="mt-4">
        <button class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition">
            {{ $user->isFollowing ? '取消关注' : '关注' }}
        </button>
    </div>
</div> 