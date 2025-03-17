<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    /**
     * Display all permissions.
     */
    public function index(Request $request): View
    {
        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sortableColumns = ['id', 'name']; 

        $permissions = Permission::query()
        ->applyFilters($request, $sortableColumns)
        ->paginate(10);

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show form to create a new permission.
     */
    public function create(): View
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all();
        return view('admin.permissions.create', compact('permissions'));
    }

    /**
     * Store a new permission.
     */
    public function store(Request $request): RedirectResponse
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name'],
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Show form to edit a permission.
     */
    public function edit(Permission $permission): View
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the given permission.
     */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name,' . $permission->id],
        ]);

        $permission->update(['name' => $request->name]);

        return back()->with('status', 'permission-updated');
    }

    /**
     * Delete a permission.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
