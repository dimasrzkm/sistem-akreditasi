<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('create', User::class);
        return view('users.index', [
            'users' => User::get(),
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::get();
        return view('users.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $request->validate([
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email'],
            'role_id' => ['required', Rule::in([1, 2, 3])],
        ]);
        
        $attributes = $request->toArray();
        $attributes['password'] = bcrypt($request->username);
        $attributes['role_id'] = (int) $request->role_id;

        if($request->department_id && $request->department_id != 'Choose Departments') {
            $attributes['department_id'] = $request->department_id;
        }

        User::create($attributes);
        return to_route('reviewer.users.index')->with('toast_success', 'data berhasil di simpan');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles = Role::get();
        return view('users.edit', [
            'roles' => $roles,
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update(['role_id' => $request->role_id]);
        return to_route('reviewer.users.index')->with('toast_success', 'data berhasil diubah');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return to_route('reviewer.users.index')->with('toast_success', 'data berhasil dihapus');;
    }
}
