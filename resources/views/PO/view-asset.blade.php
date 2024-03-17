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
            @if(count($rddata)>0)
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
                            <td><button class="btn btn-danger" data-id="{{$data->id}}" id="delbtn">Delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-primary">No Asset Added Yet!</div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function()
    {
        $('#delbtn').on('click',function(e)
        {
            e.preventDefault();
            let button=$(this);
            let dataid=button.data('id');
            if(confirm("Are you sure want to delete this asset?Once delted this asset can not be restore!"))
            {
                $.ajax(
                    {
                        url:'{{ url("po/delete-asset") }}',
                        type:'POST',
                        data:{
                            id:dataid,
                            _token: '{{ csrf_token() }}',
                        },
                        success:function(response)
                        {
                            if(response.success)
                            {
                                location.reload();
                            }
                            else
                            {
                                alert(response.message)
                            }
                        },
                        error:function(xhr, status, error)
                        {
                            if (xhr.status === 404) {
                            alert("Progress not found: " + xhr.responseJSON.error);
                         }
                          else 
                         {
                            alert("Error Updating Freezing: " + xhr.responseJSON.message);
                         }
                        }

                    }
                );
            }
        });
    });
</script>

@endsection
