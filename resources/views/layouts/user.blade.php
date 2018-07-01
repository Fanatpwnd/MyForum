<div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
<img src="{{ $content['avatar_path']}}" alt="{{ $content['nickname'] }}'s avatar">
<h3 class='text-primary'>{{ $content['nickname'] }} [ {{ $content['policy'] }} ]</h3>
<p class='text-info'><b>Bio: </b> {{ $content['bio'] }} </p>
<p class='text-secondary'>Date create: <i>{{ $content['created_at'] }}</i></p>
@can('update', $content)
<form action="/ChangeRole" method="post">
@csrf
<div class="form-group">
  <label for="sel1">Role:</label>
  <select class="form-control" id="sel1" name='role'>
    @foreach (\App\UserInfo::getRoles() as $role)
    <option value='{{$role}}' @if($content['policy'] == $role) selected @endif>{{$role}}</option>
    @endforeach
  </select>
</div> 
<input type="hidden" name="id" value=" {{$content['id']}} ">
<input type="submit" value="Change" class="btn">
</form>
@endcan
</div>
{{ $content->user->messages }}
<hr>
{{ $content->user->threads }}