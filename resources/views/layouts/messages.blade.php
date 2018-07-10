 <h1 align="center" class="text-info">Messages</h1>

<div class="form-group">
    <form action="#" method="get">
  <label for="sel1">Sort by date:</label>
  <select id="sel1" name='order_by'>
    <option value="desc" @if( $params['order_by'] == 'desc' ) selected @endif>DESC</option>
    <option value="asc" @if( $params['order_by'] == 'asc' ) selected @endif>ASC</option>
  </select>
  <label for="sel1">Messages per page:</label>
  <input type="text" name="paginate" value="{{$params['paginate']}}">
  <input type="submit" value="Update">
  </form>
</div>

@can('update', new \App\Message) <!-- fuck -->
<script>
function hideEdit(id) {
    var x = document.getElementById("message"+id);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
} 
</script>
@endcan
<script src="https://www.google.com/recaptcha/api.js" async defer></script>


@if( count($content) >= 1)
    <div style='margin-left: 30px;'> {{ $content->links() }} </div>
    @foreach ($content as $item)
    <div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
        <h4><span class='text-secondary'>ID #{{$item->id}} | </span><span class='text-info'>Author: <a href='/user/{{$item->user['id']}}'> {{ $item->user->userInfo['nickname'] }}</a></span></h4><hr>
        <p>{!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($item->body) !!} @if(\GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($item->body) == '') <span style="color: red;">Message don't show because used HTML-tags</span> @endif</p>
        <img src="{{ $item->user->userInfo['avatar_path']}}" alt="{{ $item->user->userInfo['nickname'] }}'s avatar">
        @can('delete', $item)
        <form action="/DeleteMessage" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$item->id}}">
        <input type="submit" value="Delete">
        </form>
        @endcan
        @can('update', $item)
        <input type="button" value="Edit" onclick="hideEdit({{$item->id}})">
        <div class="container" id='message{{$item->id}}' style='display: none;'>
        <form action="\EditMessage" method="post" >
            @csrf
            <input type="hidden" name="id" value="{{$item->id}}">
            Message body: <input type="text" name="body" id="body" value="{{$item->body}}" required>
            <input type="hidden" name="thread_id" value="{{$params['thread_id']}}">
            <input type="submit" value="Edit message">
        </form>
        </div>
        @endcan
    </div>
    @endforeach
    <div style='margin-left: 30px;'> {{ $content->links() }} </div>
@endif
@can('create', new \App\Message) <!-- fuck -->
<div class='container' style='margin-top : 10px;'>
<form action="\AddMessage" method="post" >
    @csrf
    Message body: <input type="text" name="body" id="body" required>
    <input type="hidden" name="thread_id" value="{{$params['thread_id']}}">
    <div class="g-recaptcha" data-sitekey="6LfwimEUAAAAACubDWt2inFxpjmhFSe3NgjZ44na"></div>

    <input type="submit" value="Add message">
</form>
</div>
@endcan
<h4 align="center"><a href="\Threads\{{$params['section_id']}}">Back</a></h4>
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


