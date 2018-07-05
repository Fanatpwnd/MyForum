@extends('layouts.app')

@section('content')

    <script type="text/javascript" src="https://vk.com/js/api/openapi.js?156"></script>
    <script type="text/javascript">
    VK.init({apiId: 6624668});
    </script>

<div class='container'>
    <form action="{{ route('login') }}" method="post" class='card'  style='padding: 10px;'>
    @csrf
    <span>Email:</span><input type="email" name="email" class='form-group' required><br>              
    <span>Password:</span><input type="password" name="password" class='form-group'><br>
    <input type="checkbox" name="remember"> Remember Me
    <hr>
    <input type="submit" value="Login" class='btn btn-secondary'>
    </form>


    <!-- VK Widget -->
    <div id="vk_auth"></div>
    <script type="text/javascript">
    setTimeout(function() {
    VK.Widgets.Auth("vk_auth", {"authUrl":"/VKLogin"});
    }, 1000);
    </script>
</div>

@if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
@endsection


