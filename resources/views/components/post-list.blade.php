@props(['posts'])

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($posts as $post)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            @if($post->images)
                <img src="{{ $post->images[0]->url }}" alt="封面图" class="w-full h-48 object-cover">
            @endif
            
            <div class="p-4">
                <h3 class="text-lg font-semibold text-purple-700 mb-2">{{ $post->title }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 100) }}</p>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img src="{{ $post->author->avatar }}" class="w-8 h-8 rounded-full">
                        <span class="text-sm text-gray-700">{{ $post->author->username }}</span>
                    </div>
                    
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <span>{{ $post->likeCount }} 点赞</span>
                        <span>{{ $post->commentCount }} 评论</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div> 