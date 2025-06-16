<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateRandomMiddleEarthName extends Command
{
    protected $signature = 'generate:random-middle-earth-name';
    protected $description = 'Generate a random Middle-earth first and last name';

    public function handle()
    {
        $roots = include base_path('data/middle_earth_name_roots.php');
        $group = 'Hobbit';

        $firstNames = $roots[$group]['firstFull'];
        $lastNames = $roots[$group]['lastFull'];

        $first = $firstNames[array_rand($firstNames)];
        $last = $lastNames[array_rand($lastNames)];

        $this->info("Random Middle-earth name: $first $last");
        return 0;
    }
}
