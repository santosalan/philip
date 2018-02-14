@extends('adminlte::master')

@section('body')
{{ Form::open(['url' => $sistema->url_redirect, 'method' => 'POST', 'id' => 'formRedirect']) }}

    <input type="hidden" name="token" value="{{ $response }}" />
{{ Form::close() }}
@endsection

@section('adminlte_js')
<script>
    $(function(){
        $('#formRedirect').submit();
    });
</script>
@endsection
