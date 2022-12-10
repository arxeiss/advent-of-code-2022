<?php

declare(strict_types=1);

namespace Tests\Day10;

use Aoc2022\Day10\Day10;
use Tests\TestCase;

final class Day10Test extends TestCase
{
    public function testPart1(): void
    {
        $result = (new Day10())->part1($this->getTestInput());
        $this->assertSame($result, '13140');
    }

    public function testPart2(): void
    {
        $result = (new Day10())->part2($this->getTestInput());
        $drawing = "\n" .
            "##  ##  ##  ##  ##  ##  ##  ##  ##  ##  \n" .
            "###   ###   ###   ###   ###   ###   ### \n" .
            "####    ####    ####    ####    ####    \n" .
            "#####     #####     #####     #####     \n" .
            "######      ######      ######      ####\n" .
            "#######       #######       #######     \n";
        $this->assertSame($result, $drawing);
    }
}
