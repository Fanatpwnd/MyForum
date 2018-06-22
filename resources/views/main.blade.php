@extends('layouts.app')
<div class="main container">
@section('content')
@switch($type_page)
    @case('sections')
            <h1 align="center" class="text-info">Sections</h1>
            @foreach ($content as $item)
                <div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
                <h3><a href='\Threads\{{$item->section_id}}'>{{ $item->section_name }}</a></h3>
                <p class='text-secondary'>Thread count: {{$item->count}}</p>
                </div>
            @endforeach
        @break

    @case('threads')
            <h1 align="center" class="text-info">Threads</h1><br>
            @foreach ($content as $item)
            <div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
            <h3><a href='\Messages\{{$item->thread_id}}'>{{ $item->thread_name }}</a></h3>
                <p>Messages count: {{$item->count}}</p>
                @auth
                <form action="/DeleteThread" method="get">
                <input type="hidden" name="id" value="{{$item->thread_id}}">
                <input type="hidden" name="section_id" value="{{$item->section_id}}">
                <input type="submit" value="Delete">
                </form>
                @endauth
            </div>
            {{ $item->messages }}
            @endforeach
            @auth
            <div class='container' style='margin-top : 10px;'>
            <form action="\AddThread" method="get">
                Thread title: <input type="text" name="thread_name" id="thread_name" required>
                Message body: <input type="text" name="msg_body" id="msg_body" required>
                <input type="hidden" name="section_id" value="{{$content[0]->section_id}}">
                <input type="submit" value="Add topic">
            </form>
            </div>
            @endauth
            <h4 align="center"><a href="\Sections">Back</a></h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
        @break

    @case('messages')
            <h1 align="center" class="text-info">Messages</h1>
            @foreach ($content as $item)
            <div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
                <h4><span class='text-secondary'>ID #{{$item->msg_id}} | </span>
                <span class='text-info'> {{ $item->msg_name }} <span></h4><hr>
                <p>{{$item->msg_body}}</p>
                @auth
                <form action="/DeleteMessage" method="get">
                <input type="hidden" name="id" value="{{$item->msg_id}}">
                <input type="hidden" name="thread_id" value="{{$item->thread_id}}">
                <input type="submit" value="Delete">
                </form>
                @endauth
            </div>
            @endforeach
            @auth
            <div class='container' style='margin-top : 10px;'>
            <form action="\AddMessage" method="get" >
                Message title: <input type="text" name="msg_name" id="msg_name" required>
                Message body: <input type="text" name="msg_body" id="msg_body" required>
                <input type="hidden" name="thread_id" value="{{$content[0]->thread_id}}">
                <input type="submit" value="Add message">
            </form>
            </div>
            @endauth
            <h4 align="center"><a href="\Threads\{{$section_id}}">Back</a></h4>
            <!--https://laravel.com/docs/5.6/validation#rule-unique -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @break

        @case('trash')
            <a href="\Sections">Back</a><br>
            @foreach ($content as $item)
                <p>{{$item->thread_id}}</p><h2>{{ $item->thread_name }}</h2>
                @auth
                <form action="/RestoreThread" method="get">
                <input type="hidden" name="id" value="{{$item->thread_id}}">
                <input type="submit" value="Restore">
                </form>
                @endauth
            @endforeach
        @break

    @default
        Nothing
@endswitch
@endsection
</div>