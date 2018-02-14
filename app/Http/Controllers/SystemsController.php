<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SystemsController extends Controller
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
            'title' => 'string|max:255|required',
            'token_request' => 'string|max:255|required',
            'token_encrypt' => 'string|max:255|required',
            'url' => 'string|required',
        ]);
    }

    /**
     * INDEX - list systems
     *
     * @return view systems.index
     */
    public function index()
    {
        $systems = System::paginate();

        return view('systems.index', compact('systems'));
    }

    /**
     * CREATE - form system
     *
     * @return view systems.form
     */
    public function create()
    {
        

        return view('systems.form');
    }

    /**
     * STORE - store system
     *
     * @param  Request $request 
     * @return redirect systems.create
     */
    public function store(Request $request)
    {
        System::create($request->all());

        $request->session()->flash(
            'msgSuccess', 
            trans('laravel-crud::alert.stored', ['element' => 'System'])
        );

        return redirect('systems/create');
    }

    /**
     * EDIT - edit system
     *
     * @param  integer $id system->id
     * @return view systems.form
     */
    public function edit($id, Request $request)
    {
        $system = System::find($id);

        if (!$system) {            
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'System'])
            );

            return redirect('systems');
        }

        

        return view('systems.form', compact('system'));
    }

    /**
     * UPDATE - update system
     *
     * @param  integer $id      system->id
     * @param  Request $request 
     * @return view             systems.form
     */
    public function update($id, Request $request)
    {
        $system = System::findOrFail($id);

        $system->update($request->all());

        $request->session()->flash(
            'msgSuccess', 
            trans('laravel-crud::alert.updated', ['element' => 'System'])
        );

        return redirect('systems');
    }

    /**
     * SHOW - show system
     *
     * @param  integer $id  system->id
     * @return view         systems.show
     */
    public function show($id, Request $request)
    {
        $system = System::find($id);

        if (!$system) {            
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'System'])
            );

            return redirect('systems');
        }

        return view('systems.show', compact('system'));
    }

    /**
     * DESTROY - delete system
     *
     * @param  integer $id      system->id
     * @return redirect         systems.index
     */
    public function destroy($id, Request $request)
    {
        $system = System::find($id);

        if ($system) {
            $system->delete();

            $request->session()->flash(
                'msgSuccess', 
                trans('laravel-crud::alert.deleted', ['element' => 'System'])
            );
            
        } else {
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'System'])
            );
        }

        return redirect('systems');
    }
}
