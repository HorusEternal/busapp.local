<?php

namespace App\DTO;

final readonly class FindBusResponse
{
    /**
     * @param string $from
     * @param string $to
     * @param array{route: string, next_arrivals: string} $buses
     */
    public function __construct(public string $from, public string $to, public array $buses)
    {}
}