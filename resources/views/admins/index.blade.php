@extends('adminlte::page')

@section('title', env('APP_NAME') . ' - Admins')

@section('content_header')
    
    <div class="page-header">
        <h1>Admins</h1>
        <a href="{{ URL::to('admins/create') }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="{{ trans('laravel-crud::view.btn-create') }}">
            <i class="fa fa-plus"></i> <span class="hidden-xs">{{ trans('laravel-crud::view.btn-create') }}</span>
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
    @elseif (Session::has('msgError'))
        <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('msgError') }}
        </div>
    @endif

    <div class="box box-primary">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('laravel-crud::view.name') }}</th>
                            <th>{{ trans('laravel-crud::view.email') }}</th>
                            <th>Remember Token</th>
                            <th>{{ trans('laravel-crud::view.created-at') }}</th>
                            <th>{{ trans('laravel-crud::view.updated-at') }}</th>
                            <th class="actions">{{ trans('laravel-crud::view.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins AS $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->remember_token }}</td>
                                <td>{{ @$admin->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>{{ @$admin->updated_at->format('d/m/Y H:i:s') }}</td>
                                <td class="actions btn-group-sm">
                                    {{ link_to('admins/' . $admin->id,'', 
                                                ['class' => 'btn btn-info fa fa-eye',
                                                 'data-toggle' => 'tooltip', 
                                                 'data-placement' => 'top', 
                                                 'title' => trans('laravel-crud::view.btn-show')], 
                                                false) }}

                                    {{ link_to('admins/' . $admin->id . '/edit','', 
                                                ['class' => 'btn btn-warning fa fa-pencil',
                                                 'data-toggle' => 'tooltip', 
                                                 'data-placement' => 'top', 
                                                 'title' => trans('laravel-crud::view.btn-edit')], 
                                                false) }}

                                    {{ Form::model($admin, 
                                        ['method' => 'delete', 
                                         'action' => ['AdminsController@destroy', $admin->id], 
                                         'class' => 'form-inline form-delete',
                                         'style' => 'display: inline;']) }}
                                        {{ Form::hidden('id', $admin->id) }}
                                        <button class="btn btn-sm btn-danger form-delete" data-toggle="tooltip" data-placement="top" title="{{ trans('laravel-crud::view.btn-delete') }}"><i class="fa fa-remove"></i></button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box-footer text-center">
            {{ $admins->links() }}
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

            $('td').on('click', '.form-delete', function(e){
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


                
                            
                        
