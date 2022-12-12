<?php

namespace App\UseCases\Shop\Product;

use App\Entity\Shop\Product\Product;
use App\Http\Requests\Shop\SearchRequest;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Query\Expression;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchService
{
    public function search(SearchRequest $request, int $perPage, int $page): LengthAwarePaginator {
        $query = Product::orderBy('id', 'DESC')
            ->where('status', Product::STATUS_ACTIVE);

        if ($request->get('title') != '') {
            $query->where('title', $request->get('title'));
        }

        if ($request->get('weight') != '') {
            $query->where('weight', $request->get('weight'));
        }

        if ($request->get('availability') != '') {
            $query->where('availability', $request->get('availability'));
        }

        $items = $query->get();

        return new LengthAwarePaginator($items, $query->count(), $perPage, $page);
    }
}
