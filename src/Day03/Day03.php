<?php

declare(strict_types=1);

namespace Aoc2022\Day03;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Utils\Parser;

class Day03 implements Runnable
{
    public function part1(string $input): string
    {
        $res = Parser::getLineElements($input, '')->map(static function ($r) {
            $parts = $r->chunk($r->count() / 2);
            $codeEl = \ord($parts[0]->intersect($parts[1])->first());

            return $codeEl - ($codeEl >= 97 ? 97 - 1 : 65 - 27);
        })->sum();

        return (string)$res;
    }

    public function part2(string $input): string
    {
        $res = Parser::getLineElements($input, '')
            ->chunk(3)
            ->map(static function ($elves) {
                $elves = $elves->values();
                $codeGroup = \ord($elves[0]->intersect($elves[1])->intersect($elves[2])->first());

                return $codeGroup - ($codeGroup >= 97 ? 97 - 1 : 65 - 27);
            })->sum();

        return (string)$res;
    }
}
