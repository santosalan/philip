@extends('adminlte::page')

@section('title', env('APP_NAME') . ' - Systems')

@section('content_header')
    
    <div class="page-header">
        <h1>Systems <small>{{ trans('laravel-crud::view.show') }}</small></h1>

        <a href="{{ URL::to('systems') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('laravel-crud::view.btn-list') }}">
            <i class="fa fa-list"></i> <span class="hidden-xs">{{ trans('laravel-crud::view.btn-list') }}</span>
        </a>
        <a href="{{ URL::to('systems/create') }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="{{ trans('laravel-crud::view.btn-create') }}">
            <i class="fa fa-plus"></i> <span class="hidden-xs">{{ trans('laravel-crud::view.btn-create') }}</span>
        </a>
        <a href="{{ URL::to('systems/' . $system->id . '/edit') }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="{{ trans('laravel-crud::view.btn-edit') }}">
            <i class="fa fa-pencil"></i> <span class="hidden-xs">{{ trans('laravel-crud::view.btn-edit') }}</span>
        </a>
        
        {{ Form::model($system, 
            ['method' => 'delete', 
             'action' => ['SystemsController@destroy', $system->id], 
             'class' => 'form-inline form-delete',
             'style' => 'display: inline;']) }}
            {{ Form::hidden('id', $system->id) }}
            <button class="btn btn-danger form-delete" data-toggle="tooltip" data-placement="top" title="{{ trans('laravel-crud::view.btn-delete') }}">
                <i class="fa fa-remove"></i> <span class="hidden-xs">{{ trans('laravel-crud::view.btn-delete') }}</span>
            </button>
        {{ Form::close() }}
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
    @elseif (Session::has('msgError'))
        <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('msgError') }}
        </div>
    @endif


    <div class="box box-info"> 
        <div class="box-header">
            <h3>{{ $system->title }}</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover vertical-table" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <th>{{ trans('laravel-crud::view.title') }}</th>
                            <td>{{ $system->title }}</td>
                        </tr>
                        <tr>
                            <th>Token Request</th>
                            <td>{{ $system->token_request }}</td>
                        </tr>
                        <tr>
                            <th>Token Encrypt</th>
                            <td>{{ $system->token_encrypt }}</td>
                        </tr>
                        <tr>
                            <th>Url</th>
                            <td>{{ $system->url }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('laravel-crud::view.created-at') }}</th>
                            <td>{{ @$system->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('laravel-crud::view.updated-at') }}</th>
                            <td>{{ @$system->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="myModalLabel">
                <i class="fa fa-exclamation fa-2x text-red"></i>  
                {{ trans('laravel-crud::alert.you-sure') }}
            </h3>
          </div>
          <div class="modal-body">
            <h4>{{ trans('laravel-crud::alert.once-deleted') }}</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('laravel-crud::view.btn-cancel') }}</button>
            <button type="button" class="btn btn-primary delete-btn">{{ trans('laravel-crud::view.btn-confirm') }}</button>
          </div>
        </div>
      </div>
    </div>
@endsection    


@section('js')

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();

            $('div').on('click', '.form-delete', function(e){
                e.preventDefault();
                var $form=$(this);
                $('#deleteModal').modal({ backdrop: 'static', keyboard: false })
                    .on('click', '.delete-btn', function(){
                        $form.submit();
                    });
            });
        })
    </script>

@endsection