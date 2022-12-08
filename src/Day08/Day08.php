<?php

declare(strict_types=1);

namespace Aoc2022\Day08;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Utils\Parser;

// phpcs:disable SlevomatCodingStandard.Functions.FunctionLength.FunctionLength
class Day08 implements Runnable
{
    public function part1(string $input): string
    {
        $grid = Parser::getLineElements($input, '');
        $cols = $grid->count();
        $rows = $grid[0]->count();
        $visible = 0;

        for ($x = 1; $x < $cols - 1; $x += 1) {
            for ($y = 1; $y < $rows - 1; $y += 1) {
                // top
                $found = true;
                for ($i = $y - 1; $i >= 0; $i -= 1) {
                    if ($grid[$i][$x] >= $grid[$y][$x]) {
                        $found = false;

                        break;
                    }
                }
                if ($found) {
                    $visible += 1;

                    continue;
                }

                // right
                $found = true;
                for ($i = $x + 1; $i < $cols; $i += 1) {
                    if ($grid[$y][$i] >= $grid[$y][$x]) {
                        $found = false;

                        break;
                    }
                }
                if ($found) {
                    $visible += 1;

                    continue;
                }

                // bottom
                $found = true;
                for ($i = $y + 1; $i < $rows; $i += 1) {
                    if ($grid[$i][$x] >= $grid[$y][$x]) {
                        $found = false;

                        break;
                    }
                }
                if ($found) {
                    $visible += 1;

                    continue;
                }

                // left
                $found = true;
                for ($i = $x - 1; $i >= 0; $i -= 1) {
                    if ($grid[$y][$i] >= $grid[$y][$x]) {
                        $found = false;

                        break;
                    }
                }
                if ($found) {
                    $visible += 1;

                    continue;
                }
            }
        }

        $visible += $cols * 2 + $rows * 2 - 4;

        return (string)$visible;
    }

    public function part2(string $input): string
    {
        $grid = Parser::getLineElements($input, '');
        $cols = $grid->count();
        $rows = $grid[0]->count();
        $score = [];

        for ($x = 1; $x < $cols - 1; $x += 1) {
            for ($y = 1; $y < $rows - 1; $y += 1) {
                $top = 0;
                for ($i = $y - 1; $i >= 0; $i -= 1) {
                    $top += 1;
                    if ($grid[$i][$x] >= $grid[$y][$x]) {
                        break;
                    }
                }

                $right = 0;
                for ($i = $x + 1; $i < $cols; $i += 1) {
                    $right += 1;
                    if ($grid[$y][$i] >= $grid[$y][$x]) {
                        break;
                    }
                }

                $bottom = 0;
                for ($i = $y + 1; $i < $rows; $i += 1) {
                    $bottom += 1;
                    if ($grid[$i][$x] >= $grid[$y][$x]) {
                        break;
                    }
                }

                $left = 0;
                for ($i = $x - 1; $i >= 0; $i -= 1) {
                    $left += 1;
                    if ($grid[$y][$i] >= $grid[$y][$x]) {
                        break;
                    }
                }

                $score[] = $top * $right * $bottom * $left;
            }
        }

        return (string)\max($score);
    }
}
