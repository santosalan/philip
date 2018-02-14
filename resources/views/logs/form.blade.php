@extends('adminlte::page')

@section('title', env('APP_NAME') . ' - Logs')

@section('css')

    <style>
        .form-control[required=""] {
            border-color: #F00;
        }
    </style>

@endsection

@section('content_header')
    
    <div class="page-header">
        <h1>Logs <small>@if (Request::is('*/create')) {{ trans('laravel-crud::view.create') }} @else {{ trans('laravel-crud::view.edit') }} @endif</small></h1>
        <a href="{{ URL::to('logs') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('laravel-crud::view.btn-list') }}">
            <i class="fa fa-list"></i> <span class="hidden-xs">{{ trans('laravel-crud::view.btn-list') }}</span>
        </a>
    </div>

@endsection


@section('content')

    @if (Session::has('msgSuccess'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('msgSuccess') }}
        </div>
    @elseif (! empty($errors) && count($errors->all()))
        <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @foreach ($errors->all() AS $e)
                <b>{{ $e }}</b><br/>
            @endforeach
        </div>
    @endif


    @if (Request::is('*/create'))
        <div class="box box-success"> 
            {{ Form::open(['action' => 'LogsController@store', 'method' => 'POST']) }}
    @else
        <div class="box box-warning"> 
            {{ Form::model($log, ['action' => ['LogsController@update', $log->id], 'method' => 'PATCH']) }}
    @endif
            

            <div class="box-body">
                <div class="form-group">
                    
                    <div class="col-xs-12"> 
                        {{ Form::label("system_id", "System", ["class" => "control-label"]) }}
                        {{ Form::select("system_id", $systems, @$log->system_id, ["class" => "form-control", "placeholder" => "", "required"]) }}
                    </div>

                    <div class="col-xs-12"> 
                        {{ Form::label("action", "Action", ["class" => "control-label"]) }}
                        {{ Form::text("action", @$log->action, ["class" => "form-control", "placeholder" => "Action", "required"]) }}
                    </div>

                    <div class="col-xs-12"> 
                        {{ Form::label("url", "Url", ["class" => "control-label"]) }}
                        {{ Form::text("url", @$log->url, ["class" => "form-control", "placeholder" => "Url", "required"]) }}
                    </div>

                    <div class="col-xs-12"> 
                        {{ Form::label("table_name", "Table Name", ["class" => "control-label"]) }}
                        {{ Form::text("table_name", @$log->table_name, ["class" => "form-control", "placeholder" => "Table Name", "maxlength" => "50"]) }}
                    </div>

                    <div class="col-xs-12"> 
                        {{ Form::label("username", trans('laravel-crud::view.username'), ["class" => "control-label"]) }}
                        {{ Form::text("username", @$log->username, ["class" => "form-control", "placeholder" => trans('laravel-crud::view.username'), "maxlength" => "255", "required"]) }}
                    </div>

                    <div class="col-xs-12"> 
                        {{ Form::label("json_data", "Json Data", ["class" => "control-label"]) }}
                        {{ Form::text("json_data", @$log->json_data, ["class" => "form-control", "placeholder" => "Json Data", "required"]) }}
                    </div>

                    <div class="col-xs-12"> 
                        {{ Form::label("confirmed", "Confirmed", ["class" => "control-label"]) }}
                        {{ Form::text("confirmed", @$log->confirmed, ["class" => "form-control", "placeholder" => "Confirmed", "maxlength" => "1", "required"]) }}
                    </div>
                    
                </div>
            </div>

            <div class="clearfix"></div>
            
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-xs-12 text-right"> 
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> {{ trans('laravel-crud::view.btn-save') }}
                        </button> 
                    </div>
                </div>
            </div>

        {{ Form::close() }}
    </div>
@endsection    


@section('js')

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>

@endsection