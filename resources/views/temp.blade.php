<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>메인페이지 테스트</title>

        <link rel="stylesheet" type="text/css" href={{ URL::asset('css/temp.css'); }} >
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </head>
    <body class="container">
        <div class='title'>
            <div>
                title
            </div>
        </div>
        <div class='message-container'>
            <div class="item message">Message1</div>
            <div class="item message">Message2</div>
            <div class="item message">Message3</div>
            <div class="item message">Message4</div>
            <div class="item message">Message5</div>
            <div class="item message">Message6</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
            <div class="item message">Message</div>
        </div>
        {{-- <div class="flex-fill left">
        </div>
        <div class="flex-fill other">
            <div class="p-2">Test</div>
            <div class="p-2">Test</div>
            <div class="p-2">Test</div>
        </div>
        <div class="flex-fill other">
            <div class="p-2">Test</div>
            <div class="p-2">Test</div>
            <div class="p-2">Test</div>
        </div>
        <div class="flex-fill other">
            <div class="d-flex flex-column bd-highlight">
                <div class="layout">Test</div>
                <div class="layout">Test</div>
                <div class="layout">Test</div>
            </div>
        </div> --}}
    </body>
</html>
