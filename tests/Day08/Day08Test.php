<?php

declare(strict_types=1);

namespace Tests\Day08;

use Aoc2022\Day08\Day08;
use Tests\TestCase;

final class Day08Test extends TestCase
{
    public function testPart1(): void
    {
        $result = (new Day08())->part1($this->getTestInput());
        $this->assertSame($result, '21');
    }

    public function testPart2(): void
    {
        $result = (new Day08())->part2($this->getTestInput());
        $this->assertSame($result, '8');
    }
}
