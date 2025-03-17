<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display all roles.
     */
    public function index(Request $request): View
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sortableColumns = ['id', 'name']; 

        $roles = Role::with('permissions')
            ->applyFilters($request, $sortableColumns)
            ->paginate(10);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show form to create a new role.
     */
    public function create(): View
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::pluck('name', 'id');
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a new role with assigned permissions.
     */
    public function store(Request $request): RedirectResponse
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['array'],
        ], [
            'name.required' => __('validation.required', ['attribute' => __('admin/role.attributes.name')]),
            'name.unique' => __('validation.unique', ['attribute' => __('admin/role.attributes.name')]),
            'permissions.array' => __('validation.array', ['attribute' => __('admin/role.attributes.permissions')]),
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Show form to edit a role.
     */
    public function edit(Role $role): View
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::pluck('name', 'id');
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the given role with new permissions.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'permissions' => ['array'],
        ]);

        $role->update(['name' => $request->name]);
        $role->permissions()->sync($request->permissions ?? []);

        return back()->with('status', 'role-updated');
    }

    /**
     * Delete a role.
     */
    public function destroy(Role $role): RedirectResponse
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
