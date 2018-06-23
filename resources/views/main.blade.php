@extends('layouts.app')

<div class="main container">
@section('content')
@switch($type_page)
    @case('sections')
        @include('layouts.sections')
        @break

    @case('threads')
        @include('layouts.threads')
        @break

    @case('messages')
        @include('layouts.messages')   
        @break

    @default
        Nothing
@endswitch
@endsection
</div>