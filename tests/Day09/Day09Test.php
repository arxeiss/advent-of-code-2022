<?php

declare(strict_types=1);

namespace Tests\Day09;

use Aoc2022\Day09\Day09;
use Tests\TestCase;

final class Day09Test extends TestCase
{
    public function testPart1(): void
    {
        $result = (new Day09())->part1($this->getTestInput());
        $this->assertSame($result, '13');
    }

    public function testPart2(): void
    {
        $result = (new Day09())->part2($this->getTestInput());
        $this->assertSame($result, '1');
    }

    public function testPart2Big(): void
    {
        $result = (new Day09())->part2($this->getTestInput('big'));
        $this->assertSame($result, '36');
    }
}
