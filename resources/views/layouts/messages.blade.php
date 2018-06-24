 <h1 align="center" class="text-info">Messages</h1>
@foreach ($content as $item)
<div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
    <h4><span class='text-secondary'>ID #{{$item->id}} | </span><span class='text-info'>Author: <a href='/user/{{$item->user['id']}}'> {{ $item->user->userInfo['nickname'] }}</a></span></h4><hr>
    <p>{{$item->body}}</p>
    @auth
    <form action="/DeleteMessage" method="get">
    <input type="hidden" name="id" value="{{$item->id}}">
    <input type="submit" value="Delete">
    </form>
    @endauth
</div>
@endforeach
@auth
<div class='container' style='margin-top : 10px;'>
<form action="\AddMessage" method="get" >
    Message body: <input type="text" name="body" id="body" required>
    <input type="hidden" name="thread_id" value="{{$content[0]->thread_id}}">
    <input type="submit" value="Add message">
</form>
</div>
@endauth
<h4 align="center"><a href="\Threads\{{$content[0]->thread->section['id']}}">Back</a></h4>
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


