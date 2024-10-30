@extends('layouts/dpo')
@section('main')
<div class="container mt-4">
    <h3>Enter OTP to verify meeting</h3>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif
    <form action="{{ route('verify', $meeting->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="otp">OTP</label>
            <input type="text" name="otp" id="otp" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Verify</button>
    </form>
</div>
@endsection