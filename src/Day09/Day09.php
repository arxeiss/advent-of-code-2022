<?php

declare(strict_types=1);

namespace Aoc2022\Day09;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Utils\Parser;

class Day09 implements Runnable
{
    public function part1(string $input): string
    {
        $lines = Parser::getLineElements($input);
        $hx = $hy = 0;
        $tx = $ty = 0;
        $tPos = [];
        foreach ($lines as [$dir, $steps]) {
            for ($i = 0; $i < $steps; $i += 1) {
                [$hx, $hy] = match ($dir) {
                    'R' => [$hx + 1, $hy],
                    'L' => [$hx - 1, $hy],
                    'D' => [$hx, $hy - 1],
                    'U' => [$hx, $hy + 1],
                };

                [$tx, $ty] = $this->getTailMovement($hx, $hy, $tx, $ty);

                $tPos["$tx:$ty"] = true;
            }
        }

        return (string)\count($tPos);
    }

    public function part2(string $input): string
    {
        $lines = Parser::getLineElements($input);
        $hx = $hy = 0;

        $rope = \array_fill(0, 9, [0, 0]);
        $tPos = [];
        foreach ($lines as [$dir, $steps]) {
            for ($i = 0; $i < $steps; $i += 1) {
                [$hx, $hy] = match ($dir) {
                    'R' => [$hx + 1, $hy],
                    'L' => [$hx - 1, $hy],
                    'D' => [$hx, $hy - 1],
                    'U' => [$hx, $hy + 1],
                };

                $rope[0] = $this->getTailMovement($hx, $hy, $rope[0][0], $rope[0][1]);
                for ($r = 1; $r < 9; $r += 1) {
                    $rope[$r] = $this->getTailMovement($rope[$r - 1][0], $rope[$r - 1][1], $rope[$r][0], $rope[$r][1]);
                }

                [$tx, $ty] = $rope[8];
                $tPos["$tx:$ty"] = true;
            }
        }

        return (string)\count($tPos);
    }

    private function getTailMovement(int $hx, int $hy, int $tx, int $ty): array
    {
        $xDiff = \abs($hx - $tx);
        $yDiff = \abs($hy - $ty);
        [$tx, $ty] = match (true) {
            // Head is moving in X and Y
            $xDiff >= 2 && $yDiff >= 2 => [$hx - ($hx > $tx ? 1 : -1), $hy - ($hy > $ty ? 1 : -1)],
            // Head is moving in X
            $xDiff >= 2 && $hy === $ty => [$hx - ($hx > $tx ? 1 : -1), $ty],
            $xDiff >= 2 => [$hx - ($hx > $tx ? 1 : -1), $hy],
            // Head is moving in Y
            $yDiff >= 2 && $hx === $tx => [$tx, $hy - ($hy > $ty ? 1 : -1)],
            $yDiff >= 2 => [$hx, $hy - ($hy > $ty ? 1 : -1)],

            default => [$tx, $ty],
        };

        return [$tx, $ty];
    }
}
