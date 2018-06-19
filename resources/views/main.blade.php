@extends('layouts.app')

@section('content')
@switch($type_page)
    @case('sections')
            @foreach ($content as $item)
                <a href='\Threads\{{$item->section_id}}'>{{ $item->section_name }}</a>
                <p>{{$item->count}}</p>
            @endforeach
        @break

    @case('threads')
            <a href="\Sections">Back</a><br>
            @foreach ($content as $item)
                <a href='\Messages\{{$item->thread_id}}'>{{ $item->thread_name }}</a>
                <p>{{$item->count}}</p>
                @auth
                <form action="/DeleteThread" method="get">
                <input type="hidden" name="id" value="{{$item->thread_id}}">
                <input type="hidden" name="section_id" value="{{$item->section_id}}">
                <input type="submit" value="Delete">
                </form>
                @endauth
            @endforeach
            @auth
            <form action="\AddThread" method="get">
                <input type="text" name="thread_name" id="thread_name">
                <input type="hidden" name="section_id" value="{{$content[0]->section_id}}">
                <input type="submit" value="Add topic">
            </form>
            @endauth
        @break

    @case('messages')
            <a href="\Threads\{{$section_id}}">Back</a><br>
            @foreach ($content as $item)
                {{$item->msg_id}} <h3>{{ $item->msg_name }}</h3>
                <p>{{$item->msg_body}}</p>
                @auth
                <form action="/DeleteMessage" method="get">
                <input type="hidden" name="id" value="{{$item->msg_id}}">
                <input type="hidden" name="thread_id" value="{{$item->thread_id}}">
                <input type="submit" value="Delete">
                </form>
                @endauth
            @endforeach
            @auth
            <form action="\AddMessage" method="get">
                <input type="text" name="msg_name" id="msg_name">
                <input type="text" name="msg_body" id="msg_body">
                <input type="hidden" name="thread_id" value="{{$content[0]->thread_id}}">
                <input type="submit" value="Add message">
            </form>
            @endauth
        @break

    @default
        Nothing
@endswitch
@endsection