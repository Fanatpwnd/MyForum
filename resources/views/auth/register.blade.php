@extends('layouts.app')

@section('content')

<div class='container'>
    <form action="{{ route('register') }}" method="post" class='card'  style='padding: 10px;'>
    @csrf
    <span>Name:</span><input type="text" name="name" class='form-group' required><br>              
    <span>Nickname:</span><input type="text" name="nickname" class='form-group' required><br>
    <span>Email:</span><input type="email" name="email" class='form-group' required><br>
    <span>Password:</span><input type="password" name="password" class='form-group' required><br>
    <span>Confirm password:</span><input type="password" name="password_confirmation" class='form-group' required><br>
    <hr>
    <input type="submit" value="Register" class='btn btn-secondary'>
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