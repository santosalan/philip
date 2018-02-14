@extends('access.page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Olá {{ $user->name }}</h1>
@stop

@section('content')
    <div class="box box-warning"> 
        <div class="box-header">
            <h3>Selecione um sistema para continuar...</h3>
        </div>
        <div class="box-body">
            @forelse($sistemas as $sistema)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $sistema->title }}</h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-globe"></i>
                        </div>
                        {{ Form::open(['url' => $sistema->url_redirect, 'method' => 'POST', 'id' => 'formRedirect', 'target' => '_blank']) }}

                            <input type="hidden" name="token" value="{{ $response[$sistema->id] }}" />
                            <div class="text-center">
                                <button class="btn btn-flat bg-orange-light col-xs-12 " type="submit">
                                    <span class="text-primary fa">
                                        Entrar <i class="fa fa-sign-in"></i>
                                    </span>
                                </button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            @empty
                <h3>Não há sistema disponibilizados para o seu acesso.</h3>
            @endforelse
        </div>
        <div class="box-footer">
            
        </div>
    </div>
    
@stop