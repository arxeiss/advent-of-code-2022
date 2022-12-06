<?php

declare(strict_types=1);

namespace Aoc2022\Utils;

use Aoc2022\Utils\Collection;

class Parser
{
    public static function getLines(string $input, bool $filterEmpty = true): Collection
    {
        return static::getElements($input, "\n", $filterEmpty);
    }

    public static function getElements(string $input, string $separator, bool $filterEmpty = true): Collection
    {
        $c = (new Collection($separator === '' ? \str_split($input) : \explode($separator, $input)));
        if ($filterEmpty) {
            $c = $c->filter(static fn ($e) => \strlen($e) > 0)->values();
        }

        return $c;
    }

    public static function getLineElements(string $input, string $delimiter = ' '): Collection
    {
        return static::getLines($input)->map(static fn ($e) => static::getElements($e, $delimiter));
    }

    public static function getIntLines(string $input): Collection
    {
        return static::getLines($input)->map(static fn ($i) => (int)$i);
    }

    public static function getIntElements(string $input, string $separator): Collection
    {
        return static::getElements($input, $separator)->map(static fn ($i) => (int)$i);
    }
}
