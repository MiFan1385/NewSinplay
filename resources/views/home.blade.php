<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- 左侧用户信息 -->
        <div class="md:col-span-1">
            @auth
                <x-user-card :user="auth()->user()" />
            @else
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <h3 class="text-lg font-semibold text-purple-700 mb-4">欢迎来到 Cosplay Hub</h3>
                    <a href="/login" class="block w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 mb-2">登录</a>
                    <a href="/register" class="block w-full border border-purple-600 text-purple-600 py-2 rounded-lg hover:bg-purple-50">注册</a>
                </div>
            @endauth
        </div>

        <!-- 右侧内容区 -->
        <div class="md:col-span-3">
            <!-- 发帖按钮 -->
            <div class="mb-6">
                <button class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition flex items-center justify-center">
                    <i class="fas fa-plus-circle mr-2"></i> 分享你的 Cosplay
                </button>
            </div>

            <!-- 帖子列表 -->
            <x-post-list :posts="$posts" />
        </div>
    </div>
</x-layout> 