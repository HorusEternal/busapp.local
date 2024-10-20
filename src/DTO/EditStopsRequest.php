<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
final readonly class EditStopsRequest
{
    /**
     * @param int $id
     * @param EditableStops[] $stops
     */
    public function __construct(
        #[Assert\NotBlank]
        public int $id,
        #[Assert\NotBlank]
        #[Assert\Type('array')]
        public array $stops
    )
    {}
}