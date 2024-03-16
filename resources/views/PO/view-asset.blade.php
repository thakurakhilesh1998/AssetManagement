@extends('layouts/po')
@section('main')
<div class="container-fluid">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
           <h3>View Assets</h3> 
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <th>Id</th>
                    <th>Property Name</th>
                    <th>Block Name</th>
                    <th>Type</th>
                    <th>Use of Building</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach ($rddata as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->nameofproperty}}</td>
                            <td>{{$data->blocklist}}</td>
                            <td>{{$data->type}}</td>
                            <td>{{$data->use_of_building}}</td>
                            <td><a href="{{url('po/asset-edit').'/'.$data->id}}" class="btn btn-primary">Edit</a></td> 
                            <td><a href="{{url('po/asset-delete').'/'.$data->id}}" class="btn btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function()
    {
        
    });
</script>

@endsection
