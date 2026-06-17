@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card card-girly p-4">
            <h3 class="text-center mb-4" style="color: #ff1493;">Welcome Back! ✨</h3>
            @if($errors->any())
                <div class="alert alert-danger rounded-pill">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control rounded-pill" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control rounded-pill" required>
                </div>
                <button type="submit" class="btn btn-pink w-100">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection