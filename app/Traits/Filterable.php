<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Filterable
{
    /**
     * Apply filters to a query.
     */
    public function scopeApplyFilters(Builder $query, Request $request, array $sortableColumns, array $with = []): Builder
    {
        $order = $request->input('order', 'desc');
        $order = in_array($order, ['asc', 'desc']) ? $order : 'desc';

        $sort = $request->input('sort', 'id');
        $sort = in_array($sort, $sortableColumns) ? $sort : 'id';

        // Eager load relationships
        if (!empty($with)) {
            $query->with($with);
        }

        // Handle related model sorting
        if (in_array($sort, $with)) {
            $relation = $sort;
            $relatedTable = $query->getModel()->$relation()->getRelated()->getTable();
            $foreignKey = $query->getModel()->$relation()->getForeignKeyName();

            $query->join($relatedTable, "{$query->getModel()->getTable()}.{$foreignKey}", '=', "{$relatedTable}.id")
                ->orderBy("{$relatedTable}.name", $order)
                ->select("{$query->getModel()->getTable()}.*");
        } else {
            $query->orderBy($sort, $order);
        }

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query->orderBy($sort, $order);
    }
}
