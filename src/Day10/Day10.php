<?php

declare(strict_types=1);

namespace Aoc2022\Day10;

use Aoc2022\Contracts\Runnable;
use Aoc2022\Utils\Parser;

class Day10 implements Runnable
{
    public function part1(string $input): string
    {
        $signal = 0;
        $regX = 1;
        $op = 0;
        $lines = Parser::getLineElements($input);

        $count = static function ($op, $regX) use (&$signal): void {
            if (($op + 1) % 40 === 20) {
                $signal += ($op + 1) * $regX;
            }
        };

        foreach ($lines as $line) {
            $count($op, $regX);
            $op += 1;
            if ($line[0] === 'noop') {
                continue;
            }
            if ($line[0] === 'addx') {
                $count($op, $regX);
                $regX += (int)$line[1];
                $op += 1;
            }
        }

        return (string)$signal;
    }

    public function part2(string $input): string
    {
        // regX
        $spritePos = 1;
        $pixelPos = 0;
        $crt = "\n";
        $lines = Parser::getLineElements($input);

        $draw = static function ($pixelPos, $spritePos) use (&$crt): void {
            $pxToSprite = $pixelPos % 40;
            $crt .= ($pxToSprite >= ($spritePos - 1) && $pxToSprite <= $spritePos + 1) ? '#' : ' ';
            if (($pixelPos + 1) % 40 === 0) {
                $crt .= "\n";
            }
        };

        foreach ($lines as $line) {
            $draw($pixelPos, $spritePos);

            $pixelPos += 1;
            if ($line[0] === 'noop') {
                continue;
            }

            if ($line[0] === 'addx') {
                $draw($pixelPos, $spritePos);
                $spritePos += (int)$line[1];
                $pixelPos += 1;
            }
        }

        return $crt;
    }
}
