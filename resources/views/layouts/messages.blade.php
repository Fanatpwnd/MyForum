 <h1 align="center" class="text-info">Messages</h1>
@if( count($content) >= 1)
    @foreach ($content as $item)
    <div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
        <h4><span class='text-secondary'>ID #{{$item->id}} | </span><span class='text-info'>Author: <a href='/user/{{$item->user['id']}}'> {{ $item->user->userInfo['nickname'] }}</a></span></h4><hr>
        <p>{{$item->body}}</p>
        <img src="{{ $item->user->userInfo['avatar_path']}}" alt="{{ $item->user->userInfo['nickname'] }}'s avatar">
        @auth
        <form action="/DeleteMessage" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$item->id}}">
        <input type="submit" value="Delete">
        </form>
        @endauth
    </div>
    @endforeach
@endif
@auth
<div class='container' style='margin-top : 10px;'>
<form action="\AddMessage" method="post" >
    @csrf
    Message body: <input type="text" name="body" id="body" required>
    <input type="hidden" name="thread_id" value="{{$thread_id}}">
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


