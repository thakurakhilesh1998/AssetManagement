@extends('layouts/admin')
@section('main')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="container text-black">
        <h1 class="h3 mb-3 text-gray-800">Edit User</h1>
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        </div>
        @endif
        <form method="POST" action="{{url('admin/user-edit/'.$user->id)}}">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="Username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" aria-describedby="username" name="username" value="{{$user->username}}">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function()
    {
        $('#districts_select').hide();
        $("select#role").change(function()
        {
            let selectedRole=$(this).children("option:selected").val();
            if(selectedRole==='district')
            {
               $("#districts_select").show();
            }
            else
            {
                $("#districts_select").hide();
            }

        })
    })
</script>
@endsection