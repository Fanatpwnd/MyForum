@extends('layouts.app')

@section('content')

<div class='container'>
    <form action="{{ route('login') }}" method="post" class='card'  style='padding: 10px;'>
    @csrf
    <span>Email:</span><input type="email" name="email" class='form-group' required><br>              
    <span>Password:</span><input type="password" name="password" class='form-group'><br>
    <input type="checkbox" name="remember"> Remember Me
    <hr>
    <input type="submit" value="Login" class='btn btn-secondary'>
    </form>
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


