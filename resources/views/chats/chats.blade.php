@extends('layouts.base')

@section('title') Chats @php $css = "chats" @endphp @endsection

@section('content')
    @include('components.NavBar.aside')

    <div class="wrapper-of-chat">
        <header class="header">
            <nav class="basecambio">
                <span class="direct">Direct messages</span>
                <span class="slash">|</span>
                <span class="trans">Transactions</span>
            </nav>
        </header>
        <section class="all-messages">
            <div class="wrapper">
                <span class="name">Chats</span>
                <form action="{{route('chat.time.update')}}" method="POST">
                    @csrf @method('PATCH')
                    <input class="ChatId" type="hidden" name="ChatId" id="ChatId" value="">
                    <button type="submit" class="new TransactionsButton"><i class="bi bi-hourglass-bottom"></i> Extender chat</button>
                </form>
                <form action="{{route('chat.destroy')}}" method="POST">
                    @csrf @method('DELETE')
                    <input class="ChatId" type="hidden" name="ChatId" id="ChatId" value="">
                    <button type="submit" class="new TransactionsButton"><i class="bi bi-bag-x"></i> Cancelar venta</button>
                </form>
                <form action="{{route('chat.accept.update')}}" method="POST">
                    @csrf @method('PATCH')
                    <input class="ChatId" type="hidden" name="ChatId" id="ChatId" value="">
                    <input type="hidden" name="accept" id="accept" value="true">
                    <button type="submit" class="new TransactionsButton"><i class="bi bi-bag-check"></i> Aceptar venta</button>
                </form>
            </div>
            <div class="chatsandpersons">
            <aside class="persons">
                <span class="nameofstatus">Direct messages</span>
                <div id="PeopleChats">
                </div>
            </aside>
            <div class="wrapperchat">
                <div class="chat-container">
                    <div class="messagesz">
                    </div>
                    <form class="typear" style="display: none" id="SendForm">
                        <input id="message" name="message" type="text" placeholder="Message...">
                        <input class="ChatId" type="hidden" name="ChatId" id="ChatId" value="">
                        <div>
                            <button type="submit" class="send"><i class="bi bi-send"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    
    <script src="/resources/js/pusher.min.js"></script>
    <script src="/resources/js/jquery.min.js"></script>
    @php
        $chat = App\Models\Chat::where('id', request()->get('CurrentChat'))->where('status', 1)->first();
        $AcceptFrom = $chat ? $chat->AcceptFrom : '';
        $CurrentChat = $chat ? $chat->id : '';
        $FromId = $chat ? $chat->from : '';
    @endphp
    <script>
        const key = '{{config('broadcasting.connections.pusher.key')}}';
        const cluster = '{{config('broadcasting.connections.pusher.cluster') ?? 'mt1'}}';
        const token  = '{{csrf_token()}}';
        const UserId = '{{auth()->user()->id}}';
    </script>
    <script src="/resources/js/chats.js"></script>
    <script>
        const CurrentChat = '{{$CurrentChat}}';
        const AcceptFrom = '{{$AcceptFrom}}';
        const FromId = '{{$FromId}}';
        if (CurrentChat){
            if (!AcceptFrom){
                LoadDirectMessages();
            } else {
                LoadTransactions();
                ToggleButtons();
            }
            LoadMessages(CurrentChat, FromId);
        } else {
            LoadDirectMessages();
        }
    </script>
@endsection