<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Traits\Auditable;
use App\Traits\Filterable;

class Permission extends SpatiePermission
{
    use Auditable, Filterable;

    protected $fillable = ['name', 'guard_name'];
}
