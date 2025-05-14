<?php

namespace App\Repositories;

use App\DTOs\Place\CreatePlaceDTO;
use App\DTOs\Place\EditPlaceDTO;
use App\Models\Place;
use Illuminate\Pagination\LengthAwarePaginator;

class PlaceRepository
{
    public function __construct(protected Place $place) {}

    public function getPaginate(int $totalPerPage = 15, int $page = 1, string $filter = ''): LengthAwarePaginator
    {
        return $this->place->where(function ($query) use ($filter) {
            if ($filter !== '') {
                $query->where('name', 'LIKE', "%{$filter}%");
                $query->orWhere('slug', 'LIKE', "%{$filter}%");
                $query->orWhere('city', 'LIKE', "%{$filter}%");
                $query->orWhere('state', 'LIKE', "%{$filter}%");
            }
        })->paginate($totalPerPage, ['*'], "page", $page);
    }

    public function create(CreatePlaceDTO $placeDto): Place
    {
        return $this->place->create($placeDto->toArray());
    }

    public function findById(string $id): ?Place
    {
        return $this->place->find($id);
    }

    public function update(EditPlaceDTO $placeDto, string $id): bool
    {
        if (!$place = $this->findById($id)) {
            return false;
        }
        return $place->update($placeDto->toArray());

    }

    public function delete(string $id): bool
    {
        if (!$place = $this->findById($id)) {
            return false;
        }
        return $place->delete();
    }
}
