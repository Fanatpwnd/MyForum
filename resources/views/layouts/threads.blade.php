            <h1 align="center" class="text-info">Threads</h1><br>
<script>
function hideEdit(id) {
    var x = document.getElementById("thread"+id);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
} 
</script>

@if( count($content) >= 1)
    @foreach ($content as $item)
            <div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
            <h3><a href='\Messages\{{$item->id}}'>{{ $item->title }}</a></h3><p class='text-info'>Author: <a href='/user/{{$item->user['id']}}'> {{ $item->user->userInfo['nickname'] }}</a></p>
                <p>Messages count: {{$item->messages->where('is_delete', false)->count()}}</p>
                @can('delete', $item)
                <form action="/DeleteThread" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}">
                <!-- <input type="hidden" name="section_id" value="{{$item->section_id}}"> -->
                <input type="submit" value="Delete">
                </form>
                @endcan
                @can('update', $item)
                <input type="button" value="Edit" onclick="hideEdit({{$item->id}})">
                <div class="container" id='thread{{$item->id}}' style='display: none;'>
                <form action="\EditThread" method="post" >
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    Message body: <input type="text" name="title" id="title" value="{{$item->title}}" required>
                    <input type="submit" value="Edit message">
                </form>
                </div>
                @endcan
            </div> 
    @endforeach 
@endif

@can('create', new \App\Thread) <!-- fuck -->
<div class='container' style='margin-top : 10px;'>
<form action="\AddThread" method="post">
    @csrf
    Thread title: <input type="text" name="thread_name" id="thread_name" required>
    Message body: <input type="text" name="msg_body" id="msg_body" required>
    <input type="hidden" name="section_id" value="{{$section_id}}">
    <input type="submit" value="Add topic">
</form>
</div>
@endcan
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
            