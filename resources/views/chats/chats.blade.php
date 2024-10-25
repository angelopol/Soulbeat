@extends('layouts.base')

@section('title') Messages @php $css = "chats" @endphp @endsection

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
                <span class="name">Chat with tysarkis</span>
                <button class="new"><i class="bi bi-hourglass-bottom"></i>Extender chat</button>
                <button class="new"><i class="bi bi-bag-x"></i>Cancelar venta</button>
                <button class="new"><i class="bi bi-bag-check"></i>Aceptar venta</button>
            </div>
            <div class="chatsandpersons">
            <aside class="persons">
                <span class="nameofstatus">Direct messages</span>
                @include('components.chats.people', [
                    'name' => 'Enrique Gonzalez', 'photo' => Vite::asset('resources/assets/images/perfil1.jpeg')
                ])
            </aside>
            <div class="wrapperchat">
                <div class="chat-container">
                    <div class="messagesz"> <!-- Contenedor de mensajes -->
                        @include('components.chats.messages.your', [
                            'photo' => Vite::asset('resources/assets/images/perfil1.jpeg'), 'text' => 'hola', 'name' => 'Noah mussiala', 'time' => '10:00 AM'
                        ])
                        @include('components.chats.messages.my', [
                            'text' => 'hola', 'time' => '10:02 AM'
                        ])
                    </div>
                    <div class="typear">
                        <input type="text" placeholder="Message tysarkis">
                        <div>
                            <button class="send"><i class="bi bi-send"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>

    </div>
    
    <script src="{{ Vite::asset('resources/js/chats.js') }}"></script>
@endsection