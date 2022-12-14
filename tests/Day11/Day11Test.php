<?php

declare(strict_types=1);

namespace Tests\Day11;

use Aoc2022\Day11\Day11;
use Tests\TestCase;

final class Day11Test extends TestCase
{
    public function testPart1(): void
    {
        $result = (new Day11())->part1($this->getTestInput());
        $this->assertSame($result, '10605');
    }

    public function testPart2(): void
    {
        $result = (new Day11())->part2($this->getTestInput());
        $this->assertSame($result, '2713310158');
    }
}
