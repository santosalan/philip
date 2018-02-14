<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogsController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'system_id' => 'integer|required',
            'action' => 'enum|required',
            'url' => 'string|required',
            'table_name' => 'string|max:50',
            'username' => 'string|max:255|required',
            'json_data' => 'string|required',
            'confirmed' => 'tinyint|required',
        ]);
    }

    /**
     * INDEX - list logs
     *
     * @return view logs.index
     */
    public function index()
    {
        $logs = Log::paginate();

        return view('logs.index', compact('logs'));
    }

    /**
     * CREATE - form log
     *
     * @return view logs.form
     */
    public function create()
    {
        $systems = System::pluck('title', 'id');

        return view('logs.form', compact('systems'));
    }

    /**
     * STORE - store log
     *
     * @param  Request $request 
     * @return redirect logs.create
     */
    public function store(Request $request)
    {
        Log::create($request->all());

        $request->session()->flash(
            'msgSuccess', 
            trans('laravel-crud::alert.stored', ['element' => 'Log'])
        );

        return redirect('logs/create');
    }

    /**
     * EDIT - edit log
     *
     * @param  integer $id log->id
     * @return view logs.form
     */
    public function edit($id, Request $request)
    {
        $log = Log::find($id);

        if (!$log) {            
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'Log'])
            );

            return redirect('logs');
        }

        $systems = System::pluck('title', 'id');

        return view('logs.form', compact('log', 'systems'));
    }

    /**
     * UPDATE - update log
     *
     * @param  integer $id      log->id
     * @param  Request $request 
     * @return view             logs.form
     */
    public function update($id, Request $request)
    {
        $log = Log::findOrFail($id);

        $log->update($request->all());

        $request->session()->flash(
            'msgSuccess', 
            trans('laravel-crud::alert.updated', ['element' => 'Log'])
        );

        return redirect('logs');
    }

    /**
     * SHOW - show log
     *
     * @param  integer $id  log->id
     * @return view         logs.show
     */
    public function show($id, Request $request)
    {
        $log = Log::find($id);

        if (!$log) {            
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'Log'])
            );

            return redirect('logs');
        }

        return view('logs.show', compact('log'));
    }

    /**
     * DESTROY - delete log
     *
     * @param  integer $id      log->id
     * @return redirect         logs.index
     */
    public function destroy($id, Request $request)
    {
        $log = Log::find($id);

        if ($log) {
            $log->delete();

            $request->session()->flash(
                'msgSuccess', 
                trans('laravel-crud::alert.deleted', ['element' => 'Log'])
            );
            
        } else {
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'Log'])
            );
        }

        return redirect('logs');
    }
}
