<?php

declare(strict_types=1);

namespace Aoc2022\Day06;

use Aoc2022\Contracts\Runnable;

class Day06 implements Runnable
{
    public function part1(string $input): string
    {
        $il = \strlen($input);
        $i = 3;
        for (; $i < $il; $i += 1) {
            $set = [$input[$i] => true];
            $set[$input[$i - 3]] = true;
            $set[$input[$i - 2]] = true;
            $set[$input[$i - 1]] = true;

            if (\count($set) === 4) {
                break;
            }
        }

        return (string)($i + 1);
    }

    public function part2(string $input): string
    {
        $il = \strlen($input);
        $i = 13;
        for (; $i < $il; $i += 1) {
            $set = [];
            for ($c = 0; $c < 14; $c += 1) {
                $set[$input[$i - $c]] = true;
            }

            if (\count($set) === 14) {
                break;
            }
        }

        return (string)($i + 1);
    }
}
