<?php

$runner = file_get_contents("src/Runner.php");
$endOfArray = strpos($runner, "];");
$startOfLine = strrpos(substr($runner, 0, $endOfArray - 8), "\n");

preg_match('/([0-9]+) =>/', substr($runner, $startOfLine), $m);

$nextDayNum = (int)$m[1] + 1;
$nextDay = str_pad($nextDayNum, 2, '0', STR_PAD_LEFT);

file_put_contents(
    "src/Runner.php",
    substr($runner, 0, $endOfArray) .
        sprintf('%d => \Aoc2022\Day%s\Day%s::class,', $nextDayNum, $nextDay, $nextDay) .
        substr($runner, $endOfArray),
);

mkdir("src/Day{$nextDay}");
mkdir("tests/Day{$nextDay}");

$srcStub = <<<EOL
<?php

declare(strict_types=1);

namespace Aoc2022\Day{$nextDay};

use Aoc2022\Contracts\Runnable;

class Day{$nextDay} implements Runnable
{
    public function part1(string \$input): string
    {
        return '';
    }

    public function part2(string \$input): string
    {
        return '';
    }
}

EOL;

file_put_contents("src/Day{$nextDay}/Day{$nextDay}.php", $srcStub);
file_put_contents("src/Day{$nextDay}/input.txt", "");

$srcTestStub = <<<EOL
<?php

declare(strict_types=1);

namespace Tests\Day{$nextDay};

use Aoc2022\Day{$nextDay}\Day{$nextDay};
use Tests\TestCase;

final class Day{$nextDay}Test extends TestCase
{
    public function testPart1(): void
    {
        \$result = (new Day{$nextDay}())->part1(\$this->getTestInput());
        \$this->assertSame(\$result, '');
    }

    public function testPart2(): void
    {
        \$result = (new Day{$nextDay}())->part2(\$this->getTestInput());
        \$this->assertSame(\$result, '');
    }
}

EOL;

file_put_contents("tests/Day{$nextDay}/Day{$nextDay}Test.php", $srcTestStub);
file_put_contents("tests/Day{$nextDay}/input.txt", "");

include 'vendor/bin/phpcbf';
