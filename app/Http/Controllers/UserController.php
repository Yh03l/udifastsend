<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public static $mSelected = 'Users';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:usuario-listar|usuario-crear|usuario-leer|usuario-editar|usuario-eliminar', ['only' => ['index', 'show', 'store']]);
        $this->middleware('permission:usuario-crear', ['only' => ['create', 'store']]);
        $this->middleware('permission:usuario-leer', ['only' => ['show']]);
        $this->middleware('permission:usuario-editar', ['only' => ['edit', 'update']]);
        $this->middleware('permission:usuario-eliminar', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        $mSelected = self::$mSelected;
        return view('users.index', compact([
            'data',
            'mSelected'
        ]))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id', 'name')->where('id', '<>', 1)->orderBy('name', 'ASC')->pluck('name', 'name');
        $mSelected = self::$mSelected;
        $random_password = Str::random(8);
        return view('users.create', compact(
            'roles',
            'mSelected',
            'random_password'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            //'password' => 'required|same:confirm-password',
            'password' => 'required|string|min:8',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        if (!empty($input['state'])) {
            $input['state'] = 1;
        } else {
            $input['state'] = 0;
        }

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mSelected = self::$mSelected;
        $user = User::find($id);
        return view('users.show', compact(
            'user',
            'mSelected'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mSelected = self::$mSelected;
        $user = User::find($id);
        $roles = Role::select('id', 'name')->where('id', '<>', 1)->orderBy('name', 'ASC')->pluck('name', 'name');
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact(
            'user',
            'roles',
            'userRole',
            'mSelected'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'password' => 'nullable|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['state'])) {
            $input['state'] = 1;
        } else {
            $input['state'] = 0;
        }
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'Usuario dado de baja exitosamente');
    }
}
