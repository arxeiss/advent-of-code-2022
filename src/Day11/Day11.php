<?php

declare(strict_types=1);

namespace Aoc2022\Day11;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Utils\Collection;
use Aoc2022\Utils\Parser;

class Day11 implements Runnable
{
    public function part1(string $input): string
    {
        $monkeys = $this->parseInput($input);

        // phpcs:disable Squiz.PHP.Eval.Discouraged
        return $this->solveRounds(
            $monkeys,
            20,
            static fn ($worryLvl, $op) => (int)\floor((int)eval($op) / 3),
        );
    }

    public function part2(string $input): string
    {
        $monkeys = $this->parseInput($input);

        // phpcs:disable Squiz.PHP.Eval.Discouraged
        return $this->solveRounds(
            $monkeys,
            10000,
            static fn ($worryLvl, $op) => eval($op) % (2 * 3 * 5 * 7 * 11 * 13 * 17 * 19 * 23),
        );
    }

    private function parseInput(string $input): array
    {
        return Parser::getElements($input, "\n\n")->map(static function ($monkey) {
            $match = Parser::getRegexElements(
                $monkey,
                '/items: ([0-9, ]+).*new = ([a-z0-9+\-*\/ ]+).*by ([0-9]+).*monkey ([0-9]+).*monkey ([0-9]+)/s',
            );

            return [
                'items' => Parser::getIntElements($match[1], ', '),
                'operation' => 'return ' . \str_replace('old', '$worryLvl', $match[2]) . ';',
                'divisibleTest' => (int)$match[3],
                'throwOnTrue' => (int)$match[4],
                'throwOnFalse' => (int)$match[5],
                'inspected' => 0,
            ];
        })->toArray();
    }

    private function solveRounds(array $monkeys, int $rounds, callable $handleWorryLevel): string
    {
        $monkeysCnt = \count($monkeys);
        for ($r = 0; $r < $rounds; $r += 1) {
            for ($m = 0; $m < $monkeysCnt; $m += 1) {
                $itemsCnt = $monkeys[$m]['items']->count();
                for ($i = 0; $i < $itemsCnt; $i += 1) {
                    $worryLvl = $monkeys[$m]['items'][$i];
                    $worryLvl = $handleWorryLevel($worryLvl, $monkeys[$m]['operation']);

                    $target = $worryLvl % $monkeys[$m]['divisibleTest'] === 0 ? 'throwOnTrue' : 'throwOnFalse';
                    $monkeys[$monkeys[$m][$target]]['items']->add($worryLvl);
                }
                $monkeys[$m]['items'] = new Collection();
                $monkeys[$m]['inspected'] += $itemsCnt;
            }
        }

        $monkeys = (new Collection($monkeys))->sortBy('inspected', \SORT_REGULAR, true)->values();

        return (string)($monkeys[0]['inspected'] * $monkeys[1]['inspected']);
    }
}
