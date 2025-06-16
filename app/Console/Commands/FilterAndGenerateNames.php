<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DOMDocument;
use DOMXPath;

class FilterAndGenerateNames extends Command
{
    protected $signature = 'generate:names-with-filter';
    protected $description = 'Filter XML for lid=0 names and generate Middle-earth names';

    public function handle()
    {
        $this->info("Filtering names with lid=0 and generating new names...");

        // Step 1: Load and filter original XML
        $sourcePath = storage_path('app/firstnames.xml');
        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->load($sourcePath);
        $xpath = new DOMXPath($doc);

        $nodes = $xpath->query('/FIRST_NAMES/N');

        $filteredFirstNames = [];

        foreach ($nodes as $node) {
            $lids = $xpath->query('.//L[@lid="0"]', $node);
            if ($lids->length > 0) {
                dump($node);
                $filteredFirstNames[] = $node;
            }
        }

        // Step 2: Prepare new XML doc
        $roots = include base_path('data/middle_earth_name_roots.php');
        $ethnicities = [
            "Elven" => 11,
            "Dwarven" => 12,
            "Human" => 0,
            "Orc" => 13,
            "Hobbit" => 14,
        ];

        $newDoc = new DOMDocument('1.0', 'UTF-8');
        $newDoc->formatOutput = true;

        $root = $newDoc->createElement('NAME_FILE');
        $root->setAttribute('fileversion', 'OOTP Developments 2025-04-22 13:57:40');
        $newDoc->appendChild($root);

        $firstNamesElem = $newDoc->createElement('FIRST_NAMES');
        $lastNamesElem = $newDoc->createElement('LAST_NAMES');
        $nicknamesElem = $newDoc->createElement('NICK_NAMES');
        $namesElem = $newDoc->createElement('NAMES');

        $root->appendChild($firstNamesElem);
        $root->appendChild($lastNamesElem);
        $root->appendChild($nicknamesElem);
        $root->appendChild($namesElem);

        // Step 3: Append filtered nodes
        foreach ($filteredFirstNames as $filteredNode) {
            $imported = $newDoc->importNode($filteredNode, true);
            $firstNamesElem->appendChild($imported);
        }

        // Step 4: Generate new names
        $nid = 100000; // offset to prevent collision
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

                //$firstName = $firstRoots[array_rand($firstRoots)] . $lastRoots[array_rand($lastRoots)];
                $lastName = ucfirst($lastRoots[array_rand($lastRoots)]) . $lastRoots[array_rand($lastRoots)];

//                if (!isset($generatedFirst[$firstName])) {
//                    $generatedFirst[$firstName] = true;
//                    $this->appendNameNode($newDoc, $firstNamesElem, $firstName, $nid++, $lid, 1);
//                }

                if (!isset($generatedLast[$lastName])) {
                    $generatedLast[$lastName] = true;
                    $this->appendNameNode($newDoc, $lastNamesElem, $lastName, $nid++, $lid, 1);
                }
            }

            foreach ($roots[$group]['firstFull'] as $first) {
                $this->appendNameNode($newDoc, $firstNamesElem, $first, $nid++, $lid, 500);
            }

            foreach ($roots[$group]['lastFull'] as $last) {
                $this->appendNameNode($newDoc, $lastNamesElem, $last, $nid++, $lid, 100);
            }

            foreach ($roots[$group]['firstFull'] as $first) {
                foreach ($roots[$group]['lastFull'] as $last) {
                    $nameNode = $newDoc->createElement('NAME');
                    $nameNode->setAttribute('gender', '0');
                    $nameNode->setAttribute('ethnicity', $lid);
                    $nameNode->setAttribute('first', $first);
                    $nameNode->setAttribute('last', $last);
                    $namesElem->appendChild($nameNode);
                }
            }
        }

        $nicknames = [
            "The Brave", "Stormborn", "Shadow", "Ironhand", "The Flame", "Stoneface", "Wolf", "The Wise", "The Silent", "Thunder",
            'The Swift', "Nightfall", "The Seeker", "Frost", "The Guardian", "The Wanderer", "The Hunter", "The Scholar",
            // ... add the rest here
        ];

        foreach ($nicknames as $name) {
            $this->appendNameNode($newDoc, $nicknamesElem, $name, $nid++, -1, -1);
        }

        $path = public_path('names_middle_earth_merged.xml');
        $newDoc->save($path);

        $this->info("✅ Combined name file saved to: $path");

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
