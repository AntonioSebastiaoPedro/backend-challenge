<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\PlaceService;
use App\Http\Requests\Place\{StorePlaceRequest, UpdatePlaceRequest};
use App\Http\Resources\PlaceResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PlaceController extends Controller
{
    public function __construct(
        protected PlaceService $placeService
    ) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $resource = $this->placeService->getPaginated($request);

        return PlaceResource::collection($resource);
    }

    public function store(StorePlaceRequest $request): PlaceResource
    {
        $place = $this->placeService->create($request);

        return new PlaceResource($place);
    }

    public function show(string $id): JsonResponse|PlaceResource
    {
        if (!$place = $this->placeService->getById($id)) {
            return response()
                ->json(
                    [
                        'error' => [
                            'message' => 'Place not found'
                        ],
                    ],
                    404
                );
        }
        return new PlaceResource($place);
    }

    public function update(UpdatePlaceRequest $request, string $id): JsonResponse|PlaceResource
    {
        if (! $place = $this->placeService->update($request, $id)) {
            return response()
                ->json(
                    [
                        'error' => [
                            'message' => 'Place not found'
                        ],
                    ],
                    404
                );
        }
        return response()
            ->json(
                [
                    'message' => 'Place updated successfully',
                    'data' => new PlaceResource($place)
                ],
                200
            );
    }

    public function destroy(string $id): JsonResponse
    {
        if (!$this->placeService->delete($id)) {
            return response()
                ->json(
                    [
                        'error' => [
                            'code' => 404,
                            'message' => 'Place not found'
                        ],
                    ],
                    404
                );
        }
        return response()->json([], 204);
    }
}
