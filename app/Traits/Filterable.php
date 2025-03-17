<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Filterable
{
    /**
     * Apply filters to a query.
     */
    public function scopeApplyFilters(Builder $query, Request $request, array $sortableColumns): Builder
    {
        $order = $request->input('order', 'desc');
        $order = in_array($order, ['asc', 'desc']) ? $order : 'desc';

        $sort = $request->input('sort', 'id');
        $sort = in_array($sort, $sortableColumns) ? $sort : 'id';

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query->orderBy($sort, $order);
    }
}
