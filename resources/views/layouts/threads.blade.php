            <h1 align="center" class="text-info">@lang('threads.threads')</h1><br>
<div class="form-group">
    <form action="#" method="get">
  <label for="sel1">@lang('threads.sort'):</label>
  <select id="sel1" name='order_by'>
    <option value="desc" @if( $params['order_by'] == 'desc' ) selected @endif>DESC</option>
    <option value="asc" @if( $params['order_by'] == 'asc' ) selected @endif>ASC</option>
  </select>
  <label for="sel1">@lang('threads.paginate'):</label>
  <input type="text" name="paginate" value="{{$params['paginate']}}">
  <input type="submit" value="@lang('threads.update')">
  </form>
</div>
@can('update', new \App\Thread)
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
@endcan
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@if( count($content) >= 1)
    <div style='margin-left: 30px;'> {{ $content->links() }} </div>
    @foreach ($content as $item)
            <div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
            <h3><a href='\Messages\{{$item->id}}'>{{ $item->title }}</a></h3><p class='text-info'>@lang('threads.author'): <a href='/user/{{$item->user['id']}}'> {{ $item->user->userInfo['nickname'] }}</a></p>
                <p>@lang('threads.count'): {{$item->messages->where('is_delete', false)->count()}} | {{$item->created_at->diffForHumans()}}</p>
                @can('delete', $item)
                <form action="/DeleteThread" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}">
                <input type="submit" value="@lang('threads.delete')">
                </form>
                @endcan
                @can('update', $item)
                <input type="button" value="@lang('threads.edit')" onclick="hideEdit({{$item->id}})">
                <div class="container" id='thread{{$item->id}}' style='display: none;'>
                <form action="\EditThread" method="post" >
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    @lang('threads.title'): <input type="text" name="title" id="title" value="{{$item->title}}" required>
                    <input type="submit" value="@lang('threads.edit')">
                </form>
                </div>
                @endcan
            </div> 
    @endforeach 
    <div style='margin-left: 30px;'> {{ $content->links() }} </div>
@endif

@can('create', new \App\Thread) <!-- fuck -->
<div class='container' style='margin-top : 10px;'>
<form action="\AddThread" method="post">
    @csrf
    @lang('threads.title'): <input type="text" name="thread_name" id="thread_name" required>
    @lang('messages.body'): <input type="text" name="msg_body" id="msg_body" required>
    <input type="hidden" name="section_id" value="{{$params['section_id']}}">
    <div class="g-recaptcha" data-sitekey="6LfwimEUAAAAACubDWt2inFxpjmhFSe3NgjZ44na"></div>
    <input type="submit" value="@lang('threads.add')">
</form>
</div>
@endcan
            <h4 align="center"><a href="\Sections">@lang('threads.back')</a></h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            