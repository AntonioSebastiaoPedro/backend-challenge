<?php

namespace App\DTOs\Place;

class CreatePlaceDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $slug,
        public readonly string $city,
        public readonly string $state,
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['slug'],
            $data['city'],
            $data['state'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'city' => $this->city,
            'state' => $this->state,
        ];
    }
}
