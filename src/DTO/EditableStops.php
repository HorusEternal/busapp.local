<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
final readonly class EditableStops
{
    public function __construct(
        #[Assert\NotBlank]
        public int $id,
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public string $name,
    )
    {}
}