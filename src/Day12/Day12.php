<?php

declare(strict_types=1);

namespace Aoc2022\Day12;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Day12\Coordinate;
use Aoc2022\Utils\Parser;

class Day12 implements Runnable
{
    public function part1(string $input): string
    {
        [$grid, $startPos, $endPos] = $this->parseInput($input);

        return $this->solve($grid, $startPos, $endPos);
    }

    public function part2(string $input): string
    {
        [$grid, , $endPos] = $this->parseInput($input);

        $rows = \count($grid);
        $allDists = [];
        for ($i = 0; $i < $rows; $i += 1) {
            $startPos = new Coordinate(0, $i);

            $allDists[] = $this->solve($grid, $startPos, $endPos);
        }

        return (string)\min($allDists);
    }

    private function parseInput(string $input): array
    {
        $grid = Parser::getLines($input)->toArray();
        $startPos = $endPos = null;
        foreach ($grid as $row => $rowVal) {
            //phpcs:ignore SlevomatCodingStandard.ControlStructures.AssignmentInCondition.AssignmentInCondition
            if (($s = \strpos($rowVal, 'S')) !== false) {
                $grid[$row][$s] = 'a'; // replace start with 'a' too, so it is easy to use ord()
                $startPos = new Coordinate($s, $row);
            }
            //phpcs:ignore SlevomatCodingStandard.ControlStructures.AssignmentInCondition.AssignmentInCondition
            if (($s = \strpos($rowVal, 'E')) !== false) {
                $endPos = new Coordinate($s, $row);
                $grid[$row][$s] = '{'; // next char after z, so it is easy to use ord()
            }
        }

        return [$grid, $startPos, $endPos];
    }

    private function solve(array $grid, Coordinate $startPos, Coordinate $endPos): string
    {
        $dists = [$startPos->str() => 0];
        $visitQueue = [$startPos];

        /** @var Coordinate $current */
        while (($current = \array_shift($visitQueue)) !== null) {
            $currentDist = $dists[$current->str()];

            foreach (['up', 'right', 'down', 'left'] as $dir) {
                $next = $current->$dir();
                // can go to next field AND is visiting next element with less steps than before
                if ($this->canGo($grid, $current, $next) && ($dists[$next->str()] ?? \PHP_INT_MAX) > $currentDist + 1) {
                    $dists[$next->str()] = $currentDist + 1;
                    $visitQueue[] = $next;
                }
            }
        }

        return (string)$dists[$endPos->str()];
    }

    private function canGo(array $grid, Coordinate $current, Coordinate $next): bool
    {
        $nextHeight = \ord($grid[$next->y][$next->x] ?? '}');
        $currentHeight = \ord($grid[$current->y][$current->x]);

        return $nextHeight - 1 <= $currentHeight;
    }
}
