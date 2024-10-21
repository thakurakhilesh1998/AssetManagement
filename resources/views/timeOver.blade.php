@extends('layouts.app')
@section('main')
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Time Period for Asset Entry on this Portal has been Ended.</h3>
        </div>
        <div class="my-3">
            <a class="dropdown-item text-center" style="color:blue" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form action="{{route('logout')}}" method="POST" id="logout-form" class="d-none">
                @csrf
            </form> 
        </div>
    </div>
@endsection