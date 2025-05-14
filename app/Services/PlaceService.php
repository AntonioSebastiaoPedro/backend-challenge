<?php

namespace App\Services;

use App\DTOs\Place\{CreatePlaceDTO, EditPlaceDTO};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Http\Requests\Place\{StorePlaceRequest, UpdatePlaceRequest};
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Support\Str;

class PlaceService
{
    public function __construct(
        protected PlaceRepository $repository
    ) {}

    public function getPaginated(Request $request): LengthAwarePaginator
    {
        $result = $this->repository->getPaginate(
            $request->perPage ?? 10,
            $request->page ?? 1,
            $request->filter ?? ''
        );
        return $result;
    }

    public function create(StorePlaceRequest $request): Place
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::slug($validatedData['name']);
        $dto = CreatePlaceDTO::fromArray($validatedData);
        $place = $this->repository->create($dto);

        return $place;
    }

    public function getById(string $id): Place|null
    {
        $result = $this->repository->findById($id);

        return $result;
    }

    public function update(UpdatePlaceRequest $request, string $id): bool
    {
        $dto = EditPlaceDTO::fromArray([$id, ...$request->validated()]);
        $updated = $this->repository->update($dto);

        return $updated;
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
