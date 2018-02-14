<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'string|max:255|required',
            'email' => 'string|max:255|email|unique:admins|required',
            'password' => 'string|max:255|required',
        ]);
    }

    /**
     * INDEX - list admins
     *
     * @return view admins.index
     */
    public function index()
    {
        $admins = Admin::paginate();

        return view('admins.index', compact('admins'));
    }

    /**
     * CREATE - form admin
     *
     * @return view admins.form
     */
    public function create()
    {
        

        return view('admins.form');
    }

    /**
     * STORE - store admin
     *
     * @param  Request $request 
     * @return redirect admins.create
     */
    public function store(Request $request)
    {
        $r = $request->all();
        $r['password'] = bcrypt($r['password']);

        Admin::create($r);

        $request->session()->flash(
            'msgSuccess', 
            trans('laravel-crud::alert.stored', ['element' => 'Admin'])
        );

        return redirect('admin/admins/create');
    }

    /**
     * EDIT - edit admin
     *
     * @param  integer $id admin->id
     * @return view admins.form
     */
    public function edit($id, Request $request)
    {
        $admin = Admin::find($id);

        if (!$admin) {            
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'Admin'])
            );

            return redirect('admin/admins');
        }

        return view('admins.form', compact('admin'));
    }

    /**
     * UPDATE - update admin
     *
     * @param  integer $id      admin->id
     * @param  Request $request 
     * @return view             admins.form
     */
    public function update($id, Request $request)
    {
        $admin = Admin::findOrFail($id);

        $admin->update($request->all());

        $request->session()->flash(
            'msgSuccess', 
            trans('laravel-crud::alert.updated', ['element' => 'Admin'])
        );

        return redirect('admin/admins');
    }

    /**
     * SHOW - show admin
     *
     * @param  integer $id  admin->id
     * @return view         admins.show
     */
    public function show($id, Request $request)
    {
        $admin = Admin::find($id);

        if (!$admin) {            
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'Admin'])
            );

            return redirect('admin/admins');
        }

        return view('admins.show', compact('admin'));
    }

    /**
     * DESTROY - delete admin
     *
     * @param  integer $id      admin->id
     * @return redirect         admins.index
     */
    public function destroy($id, Request $request)
    {
        $admin = Admin::find($id);

        if ($admin) {
            $admin->delete();

            $request->session()->flash(
                'msgSuccess', 
                trans('laravel-crud::alert.deleted', ['element' => 'Admin'])
            );
            
        } else {
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'Admin'])
            );
        }

        return redirect('admin/admins');
    }
}
