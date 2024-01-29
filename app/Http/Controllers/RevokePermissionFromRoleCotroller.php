<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RevokePermissionFromRoleCotroller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Role $role, Permission $permission): RedirectResponse
    {
        $role->revokePermissionTo($permission);
        return back();
    }
}
