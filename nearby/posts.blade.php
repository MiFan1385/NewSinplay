@extends('fresns::app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- 顶部导航 -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <div class="flex space-x-4">
                <a href="{{ fs_route(route('fresns.nearby.index')) }}" 
                    class="text-gray-600 hover:text-purple-600">
                    附近的人
                </a>
                <a href="{{ fs_route(route('fresns.nearby.posts')) }}" 
                    class="text-purple-600 font-medium border-b-2 border-purple-600 pb-2">
                    附近的帖子
                </a>
            </div>
        </div>

        <!-- 筛选选项 -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">距离：</span>
                <select class="border border-gray-300 rounded px-2 py-1" onchange="updateDistance(this.value)">
                    <option value="1">1km 内</option>
                    <option value="3">3km 内</option>
                    <option value="5" selected>5km 内</option>
                    <option value="10">10km 内</option>
                </select>
            </div>
        </div>

        <!-- 帖子列表 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($nearbyPosts as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($post->images->isNotEmpty())
                        <img src="{{ $post->images->first()->url }}" class="w-full h-48 object-cover">
                    @endif
                    
                    <div class="p-4">
                        <div class="flex items-center space-x-2 mb-3">
                            <img src="{{ $post->author->avatar }}" class="w-8 h-8 rounded-full">
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $post->author->username }}</h3>
                                <p class="text-xs text-gray-500">{{ $post->distance }}km · {{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 mb-3">{{ Str::limit($post->content, 100) }}</p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-4">
                                <button onclick="handleLike({{ $post->id }})"
                                    class="flex items-center space-x-1 hover:text-purple-600">
                                    <i class="fas fa-heart"></i>
                                    <span>{{ $post->like_count }}</span>
                                </button>
                                <a href="{{ fs_route(route('fresns.post.detail', $post->id)) }}" 
                                    class="flex items-center space-x-1 hover:text-purple-600">
                                    <i class="fas fa-comment"></i>
                                    <span>{{ $post->comment_count }}</span>
                                </a>
                            </div>
                            <span>
                                <i class="fas fa-map-marker-alt text-purple-600"></i>
                                {{ $post->location_text }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 分页 -->
        <div class="mt-6">
            {{ $nearbyPosts->links() }}
        </div>
    </div>

    @push('scripts')
    <script>
        function updateDistance(distance) {
            window.location.href = `{{ fs_route(route('fresns.nearby.posts')) }}?distance=${distance}`;
        }
    </script>
    @endpush
@endsection 