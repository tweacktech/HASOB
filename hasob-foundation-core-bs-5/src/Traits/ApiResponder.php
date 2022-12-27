<?php
namespace Hasob\FoundationCore\Traits;


use Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

trait ApiResponder
{


    protected function showAll(Collection $collection, $code = 200)
    {
        if ($collection->isEmpty()) {
            return $collection;
        }

        $collection = $this->filterData($collection);
        $collection = $this->sortData($collection);

        if(request()->per_page > 0){
            $collection = $this->paginate($collection);                     
        }

        //$collection = $this->cacheResponse($collection);
        return $collection;
    }

    protected function filterData(Collection $collection)
    {
        foreach (request()->query as $query => $value) {
            if (isset($query, $value) && !in_array($query,['skip','limit','sort_by','sort_order','per_page'])) {
                $collection = $collection->where($query, $value);
            }
        }
        return $collection;
    }

    protected function sortData(Collection $collection)
    {
        if (request()->has('sort_by') && request()->has('sort_order')) {
            $collection = $collection->sortBy(request()->sort_by, SORT_REGULAR, request()->sort_order);
        } else {
            if (request()->has('sort_by')) {
                $collection = $collection->sortBy(request()->sort_by);
            }
        }
        return $collection;
    }

    protected function paginate(Collection $collection)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();

        $perPage = 15;

        if (request()->has('per_page')) {
            $perPage = (int) request()->per_page;
        }

        $result = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($result, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $paginated->appends(request()->all());

        return $paginated;
    }

}
