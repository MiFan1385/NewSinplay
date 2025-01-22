@extends('fresns::app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- 顶部导航 -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <div class="flex space-x-4">
                <a href="{{ fs_route(route('fresns.nearby.index')) }}" 
                    class="text-purple-600 font-medium border-b-2 border-purple-600 pb-2">
                    附近的人
                </a>
                <a href="{{ fs_route(route('fresns.nearby.posts')) }}" 
                    class="text-gray-600 hover:text-purple-600">
                    附近的帖子
                </a>
            </div>
        </div>

        <!-- 地图组件 -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <div id="map" class="h-96 rounded-lg"></div>
        </div>

        <!-- 用户列表 -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach($nearbyUsers as $user)
                <div class="bg-white rounded-lg shadow-md p-4 text-center">
                    <img src="{{ $user->avatar }}" class="w-20 h-20 rounded-full mx-auto mb-3">
                    <h3 class="font-semibold text-gray-900">{{ $user->username }}</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $user->distance }}km</p>
                    <button onclick="handleFollow({{ $user->id }})"
                        id="follow-button-{{ $user->id }}"
                        class="w-full py-1 rounded {{ $user->isFollowing ? 'bg-gray-200 text-gray-700' : 'bg-purple-600 text-white' }} text-sm">
                        {{ $user->isFollowing ? '取消关注' : '关注' }}
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    @push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ fs_config('map_api_key') }}"></script>
    <script>
        // 初始化地图
        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: { lat: {{ $centerLat }}, lng: {{ $centerLng }} }
            });

            // 添加用户标记
            @foreach($nearbyUsers as $user)
                new google.maps.Marker({
                    position: { lat: {{ $user->latitude }}, lng: {{ $user->longitude }} },
                    map,
                    title: '{{ $user->username }}'
                });
            @endforeach
        }

        initMap();
    </script>
    @endpush
@endsection 