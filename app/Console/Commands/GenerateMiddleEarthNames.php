<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateMiddleEarthNames extends Command
{
    protected $signature = 'generate:names';
    protected $description = 'Generate Middle-earth style names and save to XML';

    public function handle()
    {
        $this->info("Generating Middle-earth names...");

        $roots = include base_path('data/middle_earth_name_roots.php');
        $ethnicities = [
            "Elven" => 11,
            "Dwarven" => 12,
            "Human" => 0,
            "Orc" => 13,
            "Hobbit" => 14,
        ];


        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;

        $root = $doc->createElement('NAME_FILE');
        $root->setAttribute('fileversion', 'OOTP Developments 2025-04-22 13:57:40');
        $doc->appendChild($root);

        $firstNamesElem = $doc->createElement('FIRST_NAMES');
        $lastNamesElem = $doc->createElement('LAST_NAMES');
        $nicknamesElem = $doc->createElement('NICK_NAMES');
        $namesElem = $doc->createElement('NAMES'); // <- for coaches/personnel

        $root->appendChild($firstNamesElem);
        $root->appendChild($lastNamesElem);
        $root->appendChild($nicknamesElem);
        $root->appendChild($namesElem);

        $nid = 1;

        foreach ($ethnicities as $group => $lid) {
            $this->info("Processing: $group");
            $firstRoots = $roots[$group]['first'];
            $lastRoots = $roots[$group]['last'];
            $generatedFirst = [];
            $generatedLast = [];

            $max = 5000;
            $tries = 0;

            while (count($generatedFirst) < $max && $tries < $max * 10) {
                $tries++;
                if (empty($firstRoots) || empty($lastRoots)) break;

                $firstName = $firstRoots[array_rand($firstRoots)] . $lastRoots[array_rand($lastRoots)];
                $lastName = ucfirst($lastRoots[array_rand($lastRoots)]) . $lastRoots[array_rand($lastRoots)];

                if (!isset($generatedFirst[$firstName])) {
                    $generatedFirst[$firstName] = true;
                    $this->appendNameNode($doc, $firstNamesElem, $firstName, $nid++, $lid, 1);
                }

                if (!isset($generatedLast[$lastName])) {
                    $generatedLast[$lastName] = true;
                    $this->appendNameNode($doc, $lastNamesElem, $lastName, $nid++, $lid, 1);
                }
            }

            foreach ($roots[$group]['firstFull'] as $first) {
                $this->appendNameNode($doc, $firstNamesElem, $first, $nid++, $lid, 4500);
            }

            foreach ($roots[$group]['lastFull'] as $last) {
                $this->appendNameNode($doc, $lastNamesElem, $last, $nid++, $lid, 100);
            }

            // Coach/personnel name entries
            foreach ($roots[$group]['firstFull'] as $first) {
                foreach ($roots[$group]['lastFull'] as $last) {
                    $nameNode = $doc->createElement('NAME');
                    $nameNode->setAttribute('gender', '0'); // All male, or mix with 1 if needed
                    $nameNode->setAttribute('ethnicity', $lid);
                    $nameNode->setAttribute('first', $first);
                    $nameNode->setAttribute('last', $last);
                    $namesElem->appendChild($nameNode);
                }
            }
        }

        // Nicknames
        $nicknames = [
            "The Brave", "Stormborn", "Shadow", "Ironhand", "The Flame", "Stoneface", "Wolf", "The Wise", "The Silent", "Thunder",
            "Oakshield", "Fireheart", "Icefang", "Stormcloak", "Redblade", "The Stout", "Frostborn", "The Hound", "The Cunning", "The Grim",
            "Steelbane", "Windwalker", "Oathkeeper", "The Wretched", "The Pale", "The Fell", "Ghostblade", "Deepvoice", "One-Eye", "The Just",
            "Ironhide", "Ravenhair", "The Bold", "Ashborn", "Goldtooth", "Stonehand", "The Tall", "Darkbane", "Farseer", "The Broken",
            "The Swift", "Bearclaw", "Bloodfang", "The Red", "The Black", "Grayshadow", "Mooncaller", "The Watcher", "Farspear", "The Warden",
            "The Forgotten", "The Flamebearer", "The Whisper", "The Hunter", "Wolfborn", "The Raven"
        ];

        foreach ($nicknames as $name) {
            $this->appendNameNode($doc, $nicknamesElem, $name, $nid++, -1, -1);
        }

        $path = public_path('names_middle_earth_5000.xml');
        $doc->save($path);

        $this->info("✅ Names generated and saved to: $path");

        return 0;
    }

    private function appendNameNode($doc, $parent, $name, $nid, $lid, $dist)
    {
        $node = $doc->createElement('N');
        $node->setAttribute('nid', $nid);

        $en = $doc->createElement('EN', $name);
        $nl = $doc->createElement('NL');
        $l = $doc->createElement('L');
        $l->setAttribute('lid', $lid);
        $l->setAttribute('dist', $dist);

        $nl->appendChild($l);
        $node->appendChild($en);
        $node->appendChild($nl);
        $parent->appendChild($node);
    }
}
