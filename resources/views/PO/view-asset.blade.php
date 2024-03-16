@extends('layouts/po')
@section('main')
<div class="container-fluid">

    {{$rddata}}

    {{$session['message']}}
    <h3>View Sanctions</h3>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function()
    {
        
    });
</script>

@endsection
