<div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
<img src="{{ $content['avatar_path']}}" alt="{{ $content['nickname'] }}'s avatar">
<h3 class='text-primary'>{{ $content['nickname'] }} [ {{ $content['policy'] }} ]</h3>
<p class='text-info'><b>Bio: </b> {{ $content['bio'] }} </p>
<p class='text-secondary'>Date create: <i>{{ $content['created_at'] }}</i></p>
</div>
{{ $content->user->messages }}
<hr>
{{ $content->user->threads }}