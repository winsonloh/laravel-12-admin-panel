<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display all users.
     */
    public function index(Request $request): View
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sortableColumns = ['id', 'name', 'username', 'created_at'];

        $users = User::with('roles')
            ->applyFilters($request, $sortableColumns)
            ->where('id', '!=', Auth::id())
            ->when(!Auth::user()->roles->contains('name', 'super_admin'), function ($query) {
                $query->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', '!=', 'super_admin');
                });
            })
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show form to create a new user.
     */
    public function create(): View
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('name', 'id');
        if (!Auth::user()->roles->contains('name', 'super_admin')) {
            $roles = $roles->reject(function ($name) {
                return $name === 'super_admin';
            });
        }
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a new user.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::create($request->validated());

        $roleName = Role::find($request->role)->name;
        $user->assignRole($roleName);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show form to edit a user.
     */
    public function edit(User $user): View
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::user()->roles->contains('name', 'super_admin') && $user->isSuperAdmin()) {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $roles = Role::pluck('name', 'id');
        if (!Auth::user()->roles->contains('name', 'super_admin')) {
            $roles = $roles->reject(function ($name) {
                return $name === 'super_admin';
            });
        }
        $user->load('roles');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the given user.
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::user()->roles->contains('name', 'super_admin') && $user->isSuperAdmin()) {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $user->update($request->validated());

        $roleName = Role::find($request->role)->name;
        $user->syncRoles($roleName);

        return back()->with('status', 'user-updated');
    }

    /**
     * Show the given user.
     */
    public function show(User $user): View
    {
        abort_if(Gate::denies('user_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::user()->roles->contains('name', 'super_admin') && $user->isSuperAdmin()) {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $user->load('roles');
        return view('admin.users.show', compact('user'));
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user): RedirectResponse
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::user()->roles->contains('name', 'super_admin') && $user->isSuperAdmin()) {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
