<?php

declare(strict_types=1);

namespace Aoc2022\Day05;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Utils\Collection;
use Aoc2022\Utils\Parser;

class Day05 implements Runnable
{
    private string $operationRegex = '/^move ([0-9]+) from ([0-9]+) to ([0-9]+)$/';

    public function part1(string $input): string
    {
        $lines = Parser::getLines($input, false);
        [$stacks, $ops] = $this->getStacksAndOps($lines);

        foreach ($ops as [$cnt, $src, $dst]) {
            for ($i = 0; $i < $cnt; $i += 1) {
                $stacks[$dst][] = \array_pop($stacks[$src]);
            }
        }

        return $this->getResult($stacks);
    }

    public function part2(string $input): string
    {
        $lines = Parser::getLines($input, false);
        [$stacks, $ops] = $this->getStacksAndOps($lines);

        foreach ($ops as [$cnt, $src, $dst]) {
            \array_push($stacks[$dst], ...\array_splice($stacks[$src], \count($stacks[$src]) - $cnt, $cnt));
        }

        return $this->getResult($stacks);
    }

    private function getStacksAndOps(Collection $lines): array
    {
        $stacks = $ops = [];
        $l = 0;
        for (; true; $l += 1) {
            $ll = \strlen($lines[$l]);
            if ($lines[$l][1] === '1') {
                $l += 2;

                break;
            }
            for ($s = 1, $c = 1; $c < $ll; $s += 1, $c += 4) {
                if ($lines[$l][$c] !== ' ') {
                    if (empty($stacks[$s])) {
                        $stacks[$s] = [];
                    }
                    $stacks[$s][] = $lines[$l][$c];
                }
            }
        }
        foreach ($stacks as $key => $value) {
            $stacks[$key] = \array_reverse($value);
        }
        $lc = $lines->count();
        for (; $l < $lc; $l += 1) {
            $m = [];
            if (\preg_match($this->operationRegex, $lines[$l], $m) > 0) {
                $ops[] = [(int)$m[1], (int)$m[2], (int)$m[3]];
            }
        }

        return [$stacks, $ops];
    }

    private function getResult(array $stacks): string
    {
        $res = '';
        $sl = \count($stacks);
        for ($i = 1; $i <= $sl; $i += 1) {
            $res .= $stacks[$i][\count($stacks[$i]) - 1];
        }

        return $res;
    }
}
