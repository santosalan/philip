@extends('adminlte::page')

@section('title', env('APP_NAME') . ' - Users')

@section('css')

    <style>
        .form-control[required=""] {
            border-color: #F00;
        }
    </style>

@endsection

@section('content_header')
    
    <div class="page-header">
        <h1>Users <small>@if (Request::is('*/create')) {{ trans('laravel-crud::view.create') }} @else {{ trans('laravel-crud::view.edit') }} @endif</small></h1>
        <a href="{{ URL::to('users') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('laravel-crud::view.btn-list') }}">
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
            {{ Form::open(['action' => 'UsersController@store', 'method' => 'POST']) }}
    @else
        <div class="box box-warning"> 
            {{ Form::model($user, ['action' => ['UsersController@update', $user->id], 'method' => 'PATCH']) }}
    @endif
            

            <div class="box-body">
                <div class="form-group">
                    
                    <div class="col-xs-12"> 
                        {{ Form::label("name", trans('laravel-crud::view.name'), ["class" => "control-label"]) }}
                        {{ Form::text("name", @$user->name, ["class" => "form-control", "placeholder" => trans('laravel-crud::view.name'), "maxlength" => "255", "required"]) }}
                    </div>

                    <div class="col-xs-12"> 
                        {{ Form::label("email", trans('laravel-crud::view.email'), ["class" => "control-label"]) }}
                        {{ Form::email("email", @$user->email, ["class" => "form-control", "placeholder" => trans('laravel-crud::view.email'), "maxlength" => "255", "required"]) }}
                    </div>

                    @if (Request::is('*/create'))
                    <div class="col-xs-12"> 
                        {{ Form::label("password", trans('laravel-crud::view.password'), ["class" => "control-label"]) }}
                        {{ Form::password("password", ["class" => "form-control", "placeholder" => trans('laravel-crud::view.password'), "maxlength" => "255", "required"]) }}
                    </div>
                    @endif
                    
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