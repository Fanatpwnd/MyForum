<div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
<img src="{{ $content['avatar_path']}}" alt="{{ $content['nickname'] }}'s @lang('user.avatar')">
<h3 class='text-primary'>{{ $content['nickname'] }} [ {{ $content['policy'] }} ]</h3>
<p class='text-info'><b>@lang('user.bio'): </b> {{ $content['bio'] }} </p>
@can('updateBio', $content)
<p><form action="/EditBio" method="post">
@csrf
<textarea name='bio'>{{ $content['bio'] }}</textarea>
<input type="hidden" name="id" value=" {{$content['id']}} ">
<input type="submit" value="@lang('user.edit')">
</form></p>
@endcan
<p class='text-secondary'>@lang('user.date'): <i>{{ $content['created_at'] }}</i></p>
@can('updateRole', $content)
<form action="/ChangeRole" method="post">
@csrf
<div class="form-group">
  <label for="sel1">@lang('user.role'):</label>
  <select class="form-control" id="sel1" name='role'>
    @foreach (\App\UserInfo::getRoles() as $role)
    <option value='{{$role}}' @if($content['policy'] == $role) selected @endif>{{$role}}</option>
    @endforeach
  </select>
</div> 
<input type="hidden" name="id" value=" {{$content['id']}} ">
<input type="submit" value="@lang('user.change')" class="btn">
</form>
@endcan
</div>
<hr>
<h1>{{ $content['nickname'] }}'s @lang('user.messages')</h1>
@if( count($content->user->messages->where('is_delete', false)) >= 1)
    @foreach ($content->user->messages->where('is_delete', false) as $item)
            <div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
            <h3><a href='\Messages\{{$item->thread->id}}'>@lang('user.thread'): {{ $item->thread->title }}</a></h3><p class='text-info'>@lang('user.author'): <a href='/user/{{$item->thread->user['id']}}'> {{ $item->thread->user->userInfo['nickname'] }}</a></p>
                <p>@lang('user.message'): {{$item['body']}}</p>
            </div> 
    @endforeach 
@endif
