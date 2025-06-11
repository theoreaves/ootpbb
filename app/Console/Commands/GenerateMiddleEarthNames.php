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

        // Ethnicity-specific roots based on Tolkien-inspired naming
        $roots = [
            'Elven' => [
                'first' => ['El', 'Gal', 'Fin', 'Ara', 'Celeb', 'Thrand', 'Elen', 'Luth', 'Aear', 'Nim', 'Laeg', 'Thal', 'Glor', 'Taur', 'Amdir', 'Fael', 'Anar', 'Maeg', 'Rú', 'Mith', 'Rin'],
                'last' => ['mir', 'dil', 'ion', 'gorn', 'las', 'wen', 'thel', 'gwaith', 'iel', 'aran', 'rohir', 'lómë', 'anar', 'eär', 'sir', 'sil', 'dor', 'loth', 'gíl', 'rûn'],
                'firstFull' => ['Elrond', 'Galadriel', 'Finrod', 'Aragorn', 'Celeborn', 'Thranduil', 'Elenwë', 'Lúthien', 'Aearon', 'Nimrodel', 'Laegolas', 'Thalion', 'Glorfindel', 'Tauriel', 'Amdirion', 'Faelivrin', 'Anarion', 'Maeglin', 'Rúmil', 'Mithrellas'],
                'lastFull' => ['Mirdain', 'Díriel', 'Iondil', 'Gornion', 'Lasgalen', 'Wenloth', 'Thelindë', 'Gwaithien', 'Ielwen', 'Aranor', 'Rohirrim', 'Lómelindi', 'Anarion', 'Eärendil', 'Siriondil', 'Silmarien', 'Doriathrin', 'Lothlórien', 'Gil-galad', 'Rúmilion']
            ],
            'Dwarven' => [
                'first' => ['Thráin', 'Dáin', 'Gimli', 'Balin', 'Fundin', 'Durin', 'Nori', 'Bifur', 'Bombur', 'Gloin', 'Thorin', 'Dwalin', 'Frerin', 'Gróin', 'Óin', 'Narvi', 'Khîm', 'Ibun', 'Mîm', 'Azaghâl'],
                'last' => ['stone', 'beard', 'forge', 'iron', 'helm', 'delver', 'brow', 'axe', 'pick', 'cleaver', 'rock', 'deep', 'gold', 'gem', 'ore', 'anvil', 'craft', 'burrow', 'mine', 'grit'],
                'firstFull' => ['Thráin', 'Dáin', 'Ironfoot', 'Gimli', 'Balin', 'Fundin', 'Durin', 'Nori', 'Bifur', 'Bombur', 'Glóin', 'Thorin', 'Oakenshield', 'Dwalin', 'Frerin', 'Gróin', 'Óin', 'Narvi', 'Khîm', 'Ibun', 'Mîm', 'Azaghâl'],
                'lastFull' => ['Stonehelm', 'Beardcleaver', 'Forgehammer', 'Ironfoot', 'Helmforge', 'Delverstone', 'Browaxe', 'Axegrip', 'Pickstone', 'Cleaverforge', 'Rockdelver', 'Deepdelver', 'Goldfinder', 'Gemcutter', 'Orefinder', 'Anvilmaster', 'Craftsman', 'Burrower', 'Minesmith', 'Gritstone']
            ],
            'Human' => [
                'first' => ['Arag', 'Bor', 'Isild', 'Deneth', 'Éom', 'Théod', 'Elend', 'Faram', 'Anár', 'Bereg', 'Brand', 'Halm', 'Hir', 'Beorn', 'For', 'Gild', 'Amla', 'Hal', 'Her', 'Wulf'],
                'last' => ['ric', 'helm', 'mund', 'gar', 'wine', 'here', 'son', 'ward', 'brand', 'wyn', 'bert', 'grim', 'beard', 'hold', 'stan', 'wald', 'leof', 'ald', 'bald', 'frith'],
                'firstFull' => ['Aragorn', 'Boromir', 'Isildur', 'Denethor', 'Éomer', 'Théoden', 'Elendil', 'Faramir', 'Anárion', 'Beregond', 'Brand', 'Halmir', 'Hirgon', 'Beorn', 'Forlong', 'Gildor', 'Inglorion', 'Amlach', 'Halbarad', 'Herion', 'Wulfgar'],
                'lastFull' => ['Ríccard', 'Helmhammer', 'Mundburg', 'Garmund', 'Wineson', 'Heremund', 'Sonof', 'Wardensson', 'Brandhelm', 'Wynhelm', 'Berthelm', 'Grimbeorn', 'Beardhelm', 'Holdfast', 'Stanhelm', 'Waldric', 'Leofric', 'Aldhelm', 'Baldric', 'Frithgar']
            ],
            'Orc' => [
                'first' => ['Gor', 'Muzg', 'Snag', 'Grish', 'Ugl', 'Bag', 'Thrakh', 'Durz', 'Bolg', 'Nazg', 'Krag', 'Glob', 'Mork', 'Zug', 'Rag', 'Skur', 'Ghaz', 'Urg', 'Mâsh', 'Lûg'],
                'last' => ['snaga', 'dûmp', 'foul', 'ripper', 'gash', 'blood', 'gûl', 'mangler', 'maw', 'thrak', 'lash', 'spike', 'rot', 'grub', 'biter', 'crush', 'vom', 'grit', 'fang', 'blight'],
                'firstFull' => ['Gorbag', 'Muzgash', 'Snaga', 'Grishnákh', 'Uglúk', 'Bagronk', 'Thrakhûl', 'Durzog', 'Bolgash', 'Nazgûl', 'Kragash', 'Globgrog', 'Morkai', 'Zugzug', 'Ragash', 'Skurgash', 'Ghazgûl', 'Urgash', 'Mâshak', 'Lûgash'],
                'lastFull' => ['Snaga', 'Dûmp', 'Foulgash', 'Ripper', 'Gash', 'Bloodgûl', 'Mangler', 'Mawthrak', 'Lashspike', 'Rotfang', 'Grubgash', 'Bitercrush', 'Vomgrit', 'Fangblight']
            ],
            'Hobbit' => [
                'first' => [],
                'last' => [],
                'firstFull' => [
                    'Bilbo', 'Frodo', 'Sam', 'Merry', 'Pippin', 'Rosie', 'Lobelia', 'Ham', 'Daisy', 'Estella',
                    'Hugo', 'Milo', 'Marigold', 'Primula', 'Drogo', 'Odo', 'Halfred', 'Seredic', 'Ruby', 'Pearl',
                    'Bell', 'Filibert', 'Asphodel', 'Rorimac', 'Tolman', 'Bungo', 'Fredegar', 'Dudo', 'Goldilocks', 'Ilberic'
                ],
                'lastFull' => [
                    'Baggins', 'Brandybuck', 'Took', 'Gamgee', 'Proudfoot', 'Bolger', 'Hornblower', 'Chubb', 'Goodbody', 'Burrows',
                    'Grubb', 'Noakes', 'Cotton', 'Whitfoot', 'Hayward', 'Longhole', 'Sackville', 'Brownlock', 'Twofoot', 'Greenhand',
                    'Gardner', 'Overhill', 'Farthing', 'Underfoot', 'Mugwort', 'Hilldweller', 'Millbanks', 'Woolbutton', 'Boffin', 'Goodenough'
                ]
            ]


        ];

        $ethnicities = [
            "Elven" => 101,
            "Dwarven" => 102,
            "Human" => 103,
            "Orc" => 104,
            "Hobbit" => 105,
        ];
        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;

        $root = $doc->createElement('NAME_FILE');
        $root->setAttribute('fileversion', 'OOTP Developments 2025-04-22 13:57:40');
        $doc->appendChild($root);

        $firstNamesElem = $doc->createElement('FIRST_NAMES');
        $lastNamesElem = $doc->createElement('LAST_NAMES');
        $nicknamesElem = $doc->createElement('NICK_NAMES');

        $root->appendChild($firstNamesElem);
        $root->appendChild($lastNamesElem);
        $root->appendChild($nicknamesElem);

        $nid = 1;

        foreach ($ethnicities as $group => $lid) {
            $firstRoots = $roots[$group]['first'];
            $lastRoots = $roots[$group]['last'];

            for ($i = 0; $i < 25000; $i++) {
                if (empty($firstRoots) || empty($lastRoots)) {
                    $this->error("No roots found for group: $group");
                    continue;
                }
                $firstName = $firstRoots[array_rand($firstRoots)] . $lastRoots[array_rand($lastRoots)];
                $lastName = ucfirst($lastRoots[array_rand($lastRoots)]) . $lastRoots[array_rand($lastRoots)];

                // First Name
                $fn = $doc->createElement('N');
                $fn->setAttribute('nid', $nid++);
                $en = $doc->createElement('EN', $firstName);
                $nl = $doc->createElement('NL');
                $l = $doc->createElement('L');
                $l->setAttribute('lid', $lid);
                $l->setAttribute('dist', '1');
                $nl->appendChild($l);
                $fn->appendChild($en);
                $fn->appendChild($nl);
                $firstNamesElem->appendChild($fn);

                // Last Name
                $ln = $doc->createElement('N');
                $ln->setAttribute('nid', $nid++);
                $en = $doc->createElement('EN', $lastName);
                $nl = $doc->createElement('NL');
                $l = $doc->createElement('L');
                $l->setAttribute('lid', $lid);
                $l->setAttribute('dist', '1');
                $nl->appendChild($l);
                $ln->appendChild($en);
                $ln->appendChild($nl);
                $lastNamesElem->appendChild($ln);
            }
            foreach ($roots[$group]['firstFull'] as $name) {
                // Full First Names
                $fn = $doc->createElement('N');
                $fn->setAttribute('nid', $nid++);
                $en = $doc->createElement('EN', $name);
                $nl = $doc->createElement('NL');
                $l = $doc->createElement('L');
                $l->setAttribute('lid', $lid);
                $l->setAttribute('dist', '100');
                $nl->appendChild($l);
                $fn->appendChild($en);
                $fn->appendChild($nl);
                $firstNamesElem->appendChild($fn);
            }
            foreach ($roots[$group]['lastFull'] as $name) {
                // Full Last Names
                $ln = $doc->createElement('N');
                $ln->setAttribute('nid', $nid++);
                $en = $doc->createElement('EN', $name);
                $nl = $doc->createElement('NL');
                $l = $doc->createElement('L');
                $l->setAttribute('lid', $lid);
                $l->setAttribute('dist', '100');
                $nl->appendChild($l);
                $ln->appendChild($en);
                $ln->appendChild($nl);
                $lastNamesElem->appendChild($ln);
            }
        }

        // Nicknames (same for all groups)
        $nicknames = [
            "The Brave", "Stormborn", "Shadow", "Ironhand", "The Flame", "Stoneface", "Wolf", "The Wise", "The Silent", "Thunder",
            "Oakshield", "Fireheart", "Icefang", "Stormcloak", "Redblade", "The Stout", "Frostborn", "The Hound", "The Cunning", "The Grim",
            "Steelbane", "Windwalker", "Oathkeeper", "The Wretched", "The Pale", "The Fell", "Ghostblade", "Deepvoice", "One-Eye", "The Just",
            "Ironhide", "Ravenhair", "The Bold", "Ashborn", "Goldtooth", "Stonehand", "The Tall", "Darkbane", "Farseer", "The Broken",
            "The Swift", "Bearclaw", "Bloodfang", "The Red", "The Black", "Grayshadow", "Mooncaller", "The Watcher", "Farspear", "The Warden",
            "The Forgotten", "The Flamebearer", "The Whisper", "The Hunter", "Wolfborn", "The Raven"
        ];
        foreach ($nicknames as $name) {
            $nn = $doc->createElement('N');
            $nn->setAttribute('nid', $nid++);
            $en = $doc->createElement('EN', $name);
            $nl = $doc->createElement('NL');
            $l = $doc->createElement('L');
            $l->setAttribute('lid', '-1');
            $l->setAttribute('dist', '-1');
            $nl->appendChild($l);
            $nn->appendChild($en);
            $nn->appendChild($nl);
            $nicknamesElem->appendChild($nn);
        }


//        dump($doc);
        $path = public_path('names_middle_earth_20000.xml');
        $doc->save($path);

        $this->info("✅ Names generated and saved to: $path");

        return 0;
    }
}

