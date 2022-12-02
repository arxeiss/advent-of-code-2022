<?php

ini_set('memory_limit', '1024M');

use Aoc2022\Runner;

include 'vendor/autoload.php';

echo "           ____   _____   ___   ___ ___ __
     /\   / __ \ / ____| |__ \ / _ |__ /_ |
    /  \ | |  | | |         ) | | | | ) | |
   / /\ \| |  | | |        / /| | | |/ /| |
  / ____ | |__| | |____   / /_| |_| / /_| |
 /_/    \_\____/ \_____| |____|\___|____|_|\n\n";

$r = new Runner();
if (in_array($argv[1] ?? '', ['perf', 'performance'])) {
     echo "  ___ ___ ___ ___ ___  ___ __  __   _   _  _  ___ ___
 | _ \ __| _ \ __/ _ \| _ \  \/  | /_\ | \| |/ __| __|
 |  _/ _||   / _| (_) |   / |\/| |/ _ \| .` | (__| _|
 |_| |___|_|_\_| \___/|_|_\_|  |_/_/ \_\_|\_|\___|___|\n\n";

     $r->runPerformanceTest($argv[2] ?? '');
} else {
     $r->start($argv[1] ?? '', $argv[2] ?? '');
}