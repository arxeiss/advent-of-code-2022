<?php

declare(strict_types=1);

namespace Tests\Day12;

use Aoc2022\Day12\Day12;
use Tests\TestCase;

final class Day12Test extends TestCase
{
    public function testPart1(): void
    {
        $result = (new Day12())->part1($this->getTestInput());
        $this->assertSame($result, '31');
    }

    public function testPart2(): void
    {
        $result = (new Day12())->part2($this->getTestInput());
        $this->assertSame($result, '29');
    }
}
