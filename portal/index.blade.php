@extends('fresns::app')

@section('content')
    <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">{{ fs_config('site_name')[current_lang_tag()] ?? 'SinPlay' }}</h1>
            <p class="text-xl mb-8">{{ fs_config('site_description')[current_lang_tag()] }}</p>
            @guest
                <div class="space-x-4">
                    <a href="{{ fs_route(route('fresns.login')) }}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">
                        登录
                    </a>
                    <a href="{{ fs_route(route('fresns.register')) }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600">
                        注册
                    </a>
                </div>
            @endguest
        </div>
    </div>

    <!-- 热门 Cosplay -->
    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">热门 Cosplay</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($hotPosts as $post)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($post->images->isNotEmpty())
                            <img src="{{ $post->images->first()->url }}" alt="封面图" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-purple-700 mb-2">{{ $post->title }}</h3>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <img src="{{ $post->author->avatar }}" class="w-8 h-8 rounded-full">
                                    <span class="text-sm text-gray-700">{{ $post->author->username }}</span>
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $post->likeCount }} 点赞
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- 活跃用户 -->
    <div class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">活跃 Coser</h2>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-6">
                @foreach($activeUsers as $user)
                    <div class="text-center">
                        <img src="{{ $user->avatar }}" class="w-20 h-20 rounded-full mx-auto mb-2">
                        <h3 class="font-semibold text-gray-900">{{ $user->username }}</h3>
                        <p class="text-sm text-gray-500">{{ $user->post_count }} 个作品</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 