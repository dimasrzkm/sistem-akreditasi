<?php

namespace App\Http\Controllers\Lpppm;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        // $this->authorize('assignment', User::class);
        $users = User::where('role_id', 1)->get()->filter(function($user) {
            return $user->departments()->where('user_id', $user->id)->exists() == true;
        });
        return view('assignments.index', ['users' => $users]);
    }

    public function create()
    {
        $this->authorize('assignment', User::class);
        $userReviewer = User::where('role_id', 1)->get();
        return view('assignments.create', [
            'reviewers' => $userReviewer,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'assignment_by' => ['required'],
        ]);
        Department::query()
            ->where('id', $request->department_id)
            ->update([
                'assignment_at' => now(),
            ]);
        $user = User::find($request->reviewer_id);
        $college = College::find($request->college_id);
        $user->departments()->attach(
            [$user->id => ['department_id' => $request->department_id, 'college' => $college->name,'assignment_by' => Auth::user()->name]]
        );
        return to_route('lpppm.assignment.index')->with('toast_success', 'data berhasil di simpan');;
    }
    
    public function edit(User $user, $id)
    {
        $this->authorize('assignment', User::class);
        return view('assignments.edit', [
            'user' => $user->departments->where('pivot.id', $id)->first(),
            'reviewers' => User::where('role_id', 1)->get(),
        ]);
    }

    public function update(Request $request)
    {
        // detach old value
        $user = User::find($request->reviewer_before);
        $pivotTable = $user->departments->where('pivot.department_id', $request->department_id)->first();
        $user->departments()->detach($pivotTable);
        // add new 
        $user = User::find($request->reviewer_id);
        $user->departments()->attach(
            [$user->id => ['department_id' => $request->department_id, 'college' => $request->college_department,'assignment_by' => $request->assignment_by]]
        );
        return to_route('lpppm.assignment.index')->with('toast_success', 'data berhasil di ubah');
    }

    public function destroy(User $user, $id)
    {
        $this->authorize('assignment', User::class);
        $pivotTable = $user->departments->where('pivot.id', $id)->first();
        $pivotTable->update([
            'assignment_at' => NULL,
        ]);
        $user->departments()->detach($pivotTable);
        return to_route('lpppm.assignment.index')->with('toast_success', 'data berhasil di hapus');
    }
}
