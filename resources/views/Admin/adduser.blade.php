@extends('layouts/admin')
@section('main')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="container text-black">
        <h1 class="h3 mb-3 text-gray-800">Add User</h1>
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        </div>
        @endif
        <form method="POST" action="{{url('admin/create-user')}}">
            @csrf
            <div class="mb-3">
              <label for="Username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" aria-describedby="username" name="username">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password" name="password_confirmation">
            </div>
            <div class="mb-3">
                <label for="User Role" class="form-label">Select UserRole</label>
                <select name="role" id="role" class="form-control">
                    <option value="0">--Select Role--</option>
                    <option value="admin">Admin</option>
                    <option value="po">PO</option>
                    <option value="dpo">DPO</option>
                    <option value="bdo">BDO</option>
                </select>
            </div>

            <div class="mb-3" id="districts_select">
                <label for="District Name" class="form-label">Select District</label>
                <select name="district" id="districtlist" class="form-control">
                    <option value="0">--Select District--</option>
                    <option value="Bilaspur">Bilaspur</option>
                    <option value="Chamba">Chamba</option>
                    <option value="Hamirpur">Hamirpur</option>
                    <option value="Kangra">Kangra</option>
                    <option value="Kinnaur">Kinnaur</option>
                    <option value="Kullu">Kullu</option>
                    <option value="Lahul And Spiti">Lahul And Spiti</option>
                    <option value="Mandi">Mandi</option>
                    <option value="Shimla">Shimla</option>
                    <option value="Sirmaur">Sirmaur</option>
                    <option value="Solan">Solan</option>
                    <option value="Una">Una</option>
                </select>
            </div>

            <div class="mb-3">
                <select id="blocklist" style="display: none;" class="form-control" name="bdo">
                    <option value="">Select Block</option>
                    <!-- Blocks will be loaded dynamically -->
                </select>    
            </div>
            
            <button type="submit" class="btn btn-primary">Create User</button>
          </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function()
    {
        let role='';
        $('#role').on('change',function()
        {
            role=$('#role').val();
            if(role==='bdo')
            {
                $('#blocklist').show();
            }
            else
            {
                $('#blocklist').hide();
            }
        });

        $('#districtlist').on('change',function()
        {
            if(role==='bdo')
            {
                let district=$('#districtlist').val();
                $.getJSON("{{ asset('assets/json/districts_and_blocks.json') }}",function(data)
                {
                    let blocks=data[district] || [];
                    let blockOptions='<option value="">--Select Block--</option>';
                    blocks.forEach(function(block){
                        blockOptions+=`<option value="${block}">${block}</option>`;
                    });
                    $('#blocklist').html(blockOptions);
                });
            }
        });
    });
</script>
@endsection
