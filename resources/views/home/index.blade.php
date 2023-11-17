@extends('layouts\app-master')

@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/nav.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/home.css') }}">
    @auth
        <br><br><br><br><br><br>

        <div class='console-container'><span id='text'></span>
            <div class='console-underscore' id='console'>&#95;</div>
            </div>
            <script src="{{url('assets/js/texto.js')}}"></script>
            <div class ="slider-container">
                <div class="slider position">
                </div>
            </div>

        <script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
        <script>
            window.botpressWebChat.init({
                "composerPlaceholder": "Escribe tu mensaje",
                "botConversationDescription": "Bienvenido a Go To Work",
                "botId": "2c2bda51-b2b3-4baa-b6db-5b1993b4e499",
                "hostUrl": "https://cdn.botpress.cloud/webchat/v1",
                "messagingUrl": "https://messaging.botpress.cloud/",
                "clientId": "2c2bda51-b2b3-4baa-b6db-5b1993b4e499",
                "webhookId": "9baf94ed-87d6-4481-b48e-1b7b1f6d7e9b",
                "lazySocket": true,
                "themeName": "prism",
                "botName": "Botwork",
                "avatarUrl": "https://i.postimg.cc/HxY0kwLK/botw.png",
                "emailAddress": "Dyland Rada",
                "website": "Jose Carlos ",
                "stylesheet": "https://webchat-styler-css.botpress.app/prod/d6146946-06a3-4092-a12b-c98452a33dd9/v21038/style.css",
                "frontendVersion": "v1",
                "useSessionStorage": true,
                "showBotInfoPage": true,
                "enableConversationDeletion": true,
                "theme": "prism",
                "themeColor": "#2563eb"
            });
        </script>

        
    @endauth

    @guest
        <br><br><br><br>
        para ver el contenido <a href="/login">Inicia seccion</a>
    @endguest
@endsection
