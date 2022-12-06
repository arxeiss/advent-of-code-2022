<?php

declare(strict_types=1);

namespace Tests\Day06;

use Aoc2022\Day06\Day06;
use Tests\TestCase;

final class Day06Test extends TestCase
{
    public function testPart1(): void
    {
        $result = (new Day06())->part1($this->getTestInput());
        $this->assertSame($result, '7');
    }

    public function testPart2(): void
    {
        $result = (new Day06())->part2('mjqjpqmgbljsphdztnvjfqwrcgsmlb');
        $this->assertSame($result, '19');
    }
}
