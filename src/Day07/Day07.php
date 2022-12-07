<?php

declare(strict_types=1);

namespace Aoc2022\Day07;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Utils\Parser;

class Day07 implements Runnable
{
    public function part1(string $input): string
    {
        $dirs = $this->getDirs($input);

        $total = 0;
        foreach ($dirs as ['size' => $size]) {
            if ($size <= 100000) {
                $total += $size;
            }
        }

        return (string)$total;
    }

    public function part2(string $input): string
    {
        $dirs = $this->getDirs($input);

        $space = 70000000;
        $needFree = 30000000;
        $toFree = $needFree - ($space - $dirs['']['size']);

        $sizes = [];
        foreach ($dirs as ['size' => $size]) {
            if ($size >= $toFree) {
                $sizes[] = $size;
            }
        }

        return (string)\min($sizes);
    }

    private function getDirs(string $input): array
    {
        $lines = Parser::getLines($input);
        $dirs = ['' => ['size' => 0]];
        $current = '';

        $ll = $lines->count();
        for ($i = 1; $i < $ll; $i += 1) {
            $l = $lines[$i];
            if (\str_starts_with($l, '$ ls')) {
                continue;
            }
            if ($l === '$ cd ..') {
                $future = \substr($current, 0, \strrpos($current, '/'));
                $dirs[$future]['size'] += $dirs[$current]['size'];
                $current = $future;

                continue;
            }
            if (\str_starts_with($l, '$ cd ')) {
                $current .= '/' . \substr($l, 5);
                $dirs[$current] = ['size' => 0];

                continue;
            }
            if (\str_starts_with($l, 'dir ')) {
                continue;
            }
            $dirs[$current]['size'] += (int)(\explode(' ', $l, 2)[0]);
        }
        while ($current !== '') {
            $future = \substr($current, 0, \strrpos($current, '/'));
            $dirs[$future]['size'] += $dirs[$current]['size'];
            $current = $future;

            continue;
        }

        return $dirs;
    }
}
