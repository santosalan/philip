<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
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
            'name' => 'string|max:255|required',
            'email' => 'string|max:255|email|unique:users|required',
            'password' => 'string|max:255|required',
        ]);
    }

    /**
     * INDEX - list users
     *
     * @return view users.index
     */
    public function index()
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }

    /**
     * CREATE - form user
     *
     * @return view users.form
     */
    public function create()
    {
        

        return view('users.form');
    }

    /**
     * STORE - store user
     *
     * @param  Request $request 
     * @return redirect users.create
     */
    public function store(Request $request)
    {
        User::create($request->all());

        $request->session()->flash(
            'msgSuccess', 
            trans('laravel-crud::alert.stored', ['element' => 'User'])
        );

        return redirect('users/create');
    }

    /**
     * EDIT - edit user
     *
     * @param  integer $id user->id
     * @return view users.form
     */
    public function edit($id, Request $request)
    {
        $user = User::find($id);

        if (!$user) {            
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'User'])
            );

            return redirect('users');
        }

        

        return view('users.form', compact('user'));
    }

    /**
     * UPDATE - update user
     *
     * @param  integer $id      user->id
     * @param  Request $request 
     * @return view             users.form
     */
    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $user->update($request->all());

        $request->session()->flash(
            'msgSuccess', 
            trans('laravel-crud::alert.updated', ['element' => 'User'])
        );

        return redirect('users');
    }

    /**
     * SHOW - show user
     *
     * @param  integer $id  user->id
     * @return view         users.show
     */
    public function show($id, Request $request)
    {
        $user = User::find($id);

        if (!$user) {            
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'User'])
            );

            return redirect('users');
        }

        return view('users.show', compact('user'));
    }

    /**
     * DESTROY - delete user
     *
     * @param  integer $id      user->id
     * @return redirect         users.index
     */
    public function destroy($id, Request $request)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            $request->session()->flash(
                'msgSuccess', 
                trans('laravel-crud::alert.deleted', ['element' => 'User'])
            );
            
        } else {
            $request->session()->flash(
                'msgError', 
                trans('laravel-crud::alert.not-found', ['element' => 'User'])
            );
        }

        return redirect('users');
    }
}
