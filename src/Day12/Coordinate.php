<?php

declare(strict_types=1);

namespace Aoc2022\Day12;

class Coordinate
{
    public function __construct(public int $x, public int $y)
    {
    }

    public function str(): string
    {
        return "{$this->x}:{$this->y}";
    }

    public function up(): static
    {
        return new static($this->x, $this->y - 1);
    }

    public function down(): static
    {
        return new static($this->x, $this->y + 1);
    }

    public function right(): static
    {
        return new static($this->x + 1, $this->y);
    }

    public function left(): static
    {
        return new static($this->x - 1, $this->y);
    }
}
