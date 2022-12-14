<?php

declare(strict_types=1);

namespace Tests\Day07;

use Aoc2022\Day07\Day07;
use Tests\TestCase;

final class Day07Test extends TestCase
{
    public function testPart1(): void
    {
        $result = (new Day07())->part1($this->getTestInput());
        $this->assertSame($result, '95437');
    }

    public function testPart2(): void
    {
        $result = (new Day07())->part2($this->getTestInput());
        $this->assertSame($result, '24933642');
    }
}
