<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use App\Traits\Auditable;
use App\Traits\Filterable;

class Role extends SpatieRole
{
    use Auditable, Filterable;

    protected $fillable = ['name', 'guard_name'];
}
