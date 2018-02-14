@extends('adminlte::page')

@section('title', env('APP_NAME') . ' - Systems')

@section('css')

    <style>
        .form-control[required=""] {
            border-color: #F00;
        }
    </style>

@endsection

@section('content_header')
    
    <div class="page-header">
        <h1>Systems <small>@if (Request::is('*/create')) {{ trans('laravel-crud::view.create') }} @else {{ trans('laravel-crud::view.edit') }} @endif</small></h1>
        <a href="{{ URL::to('systems') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('laravel-crud::view.btn-list') }}">
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
            {{ Form::open(['action' => 'SystemsController@store', 'method' => 'POST']) }}
    @else
        <div class="box box-warning"> 
            {{ Form::model($system, ['action' => ['SystemsController@update', $system->id], 'method' => 'PATCH']) }}
    @endif
            

            <div class="box-body">
                <div class="form-group">
                    
                    <div class="col-xs-12"> 
                        {{ Form::label("title", trans('laravel-crud::view.title'), ["class" => "control-label"]) }}
                        {{ Form::text("title", @$system->title, ["class" => "form-control", "placeholder" => trans('laravel-crud::view.title'), "maxlength" => "255", "required"]) }}
                    </div>

                    <div class="col-xs-12"> 
                        {{ Form::label("token_request", "Token Request", ["class" => "control-label"]) }}
                        {{ Form::text("token_request", @$system->token_request, ["class" => "form-control", "placeholder" => "Token Request", "maxlength" => "255", "required"]) }}
                    </div>

                    <div class="col-xs-12"> 
                        {{ Form::label("token_encrypt", "Token Encrypt", ["class" => "control-label"]) }}
                        {{ Form::text("token_encrypt", @$system->token_encrypt, ["class" => "form-control", "placeholder" => "Token Encrypt", "maxlength" => "255", "required"]) }}
                    </div>

                    <div class="col-xs-12"> 
                        {{ Form::label("url", "Url", ["class" => "control-label"]) }}
                        {{ Form::text("url", @$system->url, ["class" => "form-control", "placeholder" => "Url", "required"]) }}
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