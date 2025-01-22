@extends('fresns::app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- 消息类型切换 -->
            <div class="flex border-b mb-6">
                <a href="{{ fs_route(route('fresns.notification.index')) }}" 
                    class="px-6 py-3 {{ request()->routeIs('fresns.notification.index') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-600' }}">
                    系统通知
                </a>
                <a href="{{ fs_route(route('fresns.conversation.index')) }}" 
                    class="px-6 py-3 {{ request()->routeIs('fresns.conversation.index') ? 'text-purple-600 border-b-2 border-purple-600' : 'text-gray-600' }}">
                    私信对话
                </a>
            </div>

            <!-- 通知列表 -->
            <div class="space-y-4">
                @foreach($notifications as $notification)
                    <div class="bg-white rounded-lg shadow-md p-4 {{ $notification->is_read ? '' : 'border-l-4 border-purple-600' }}">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                @if($notification->type === 'like')
                                    <i class="fas fa-heart text-red-500 text-xl"></i>
                                @elseif($notification->type === 'comment')
                                    <i class="fas fa-comment text-blue-500 text-xl"></i>
                                @elseif($notification->type === 'follow')
                                    <i class="fas fa-user-plus text-green-500 text-xl"></i>
                                @else
                                    <i class="fas fa-bell text-yellow-500 text-xl"></i>
                                @endif
                            </div>
                            
                            <div class="flex-1">
                                <p class="text-gray-900">{{ $notification->content }}</p>
                                <div class="mt-2 text-sm text-gray-500">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>

                            @unless($notification->is_read)
                                <button onclick="markAsRead('{{ $notification->id }}')" 
                                    class="text-sm text-purple-600 hover:text-purple-800">
                                    标记已读
                                </button>
                            @endunless
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- 分页 -->
            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        async function markAsRead(id) {
            try {
                await axios.patch(`{{ fs_route(route('fresns.notification.read')) }}/${id}`);
                window.location.reload();
            } catch (error) {
                console.error('标记已读失败:', error);
            }
        }
    </script>
    @endpush
@endsection 