# Advent Of Code 2022 in PHP

New nostalgic Advent of Code in PHP! I worked in PHP for many years, so this time I want to remind those days to myself.
To see the original tasks for all days and previous years, visit https://adventofcode.com/. All credits to them for this nice work!

- Year 2019 in Elixir: https://github.com/arxeiss/advent-of-code-2019
- Year 2020 in Go: https://github.com/arxeiss/advent-of-code-2020
- Year 2021 in PHP: https://github.com/arxeiss/advent-of-code-2021

See each day for more information. I copied the instructions there as well.

## How to run

1. Install PHP 8.1+ and Composer https://getcomposer.org/download/
1. Clone this repo
1. Install dependencies with `php composer install`
1. Run:
    - `php start.php` to execute runner
    - `php vendor/bin/phpunit` to start tests
    - `php vendor/bin/phpcs` to run linter

### Running with Docker

If you don't want to install PHP locally, I suggest to use `./php` bash script which will execute it in PHP docker.
To download Composer locally use this

```bash
wget https://composer.github.io/installer.sig -O - -q | tr -d '\n' > installer.sig
./php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
./php -r "if (hash_file('SHA384', 'composer-setup.php') === file_get_contents('installer.sig')) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
./php composer-setup.php
./php -r "unlink('composer-setup.php'); unlink('installer.sig');"
```

> If you have problem with `./php composer-setup.php` remove from `./php` temporarily the part `--user "$(id -u):$(id -g)"`

Then it remains the same, just use `./php` instead of `php`

### Days I got stuck and searched for the help

## Days

- [Day 1: Calorie Counting](/src/Day1)
- [Day 2: Rock Paper Scissors](/src/Day2)
- [Day 3: Rucksack Reorganization](/src/Day3)
- [Day 4: Camp Cleanup](/src/Day4)
- [Day 5: Supply Stacks](/src/Day5)
- [Day 6: Tuning Trouble](/src/Day6)
- [Day 7: No Space Left On Device](/src/Day7)
- [Day 8: Treetop Tree House](/src/Day8)
- [Day 9: Rope Bridge](/src/Day9)
- [Day 10: Cathode-Ray Tube](/src/Day10)
- [Day 11: Monkey in the Middle](/src/Day11)
- [Day 12: Hill Climbing Algorithm](/src/Day12)

End of story for this year. Now I have to reserve a time for a baby :baby: too. So no more days.
