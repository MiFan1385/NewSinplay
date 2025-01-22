@props(['comment'])

<div class="bg-white p-4 rounded-lg shadow mb-4">
    <div class="flex items-start space-x-4">
        <img src="{{ $comment->author->avatar }}" class="w-10 h-10 rounded-full">
        
        <div class="flex-1">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h4 class="font-semibold text-purple-700">{{ $comment->author->username }}</h4>
                    <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                
                @if($comment->canEdit)
                    <div class="flex items-center space-x-2">
                        <button class="text-sm text-purple-600 hover:text-purple-800">编辑</button>
                        <button class="text-sm text-red-600 hover:text-red-800">删除</button>
                    </div>
                @endif
            </div>
            
            <p class="text-gray-700">{{ $comment->content }}</p>
            
            <div class="mt-3 flex items-center space-x-4 text-sm">
                <button class="text-gray-500 hover:text-purple-700">
                    <i class="fas fa-thumbs-up mr-1"></i> {{ $comment->likeCount }}
                </button>
                <button class="text-gray-500 hover:text-purple-700">
                    回复
                </button>
            </div>
        </div>
    </div>
</div> 