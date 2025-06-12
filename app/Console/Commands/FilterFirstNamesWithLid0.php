<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use DOMDocument;
use DOMXPath;

class FilterFirstNamesWithLid0 extends Command
{
    protected $signature = 'xml:filter-lid0 {source=firstnames.xml} {output=filtered_firstnames.xml}';
    protected $description = 'Filter firstnames XML to only include records with <L lid="0">';

    public function handle()
    {
        $sourcePath = storage_path('app/' . $this->argument('source'));
        $outputPath = storage_path('app/' . $this->argument('output'));

        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;

        if (!file_exists($sourcePath)) {
            $this->error("File not found: $sourcePath");
            return 1;
        }

        $doc->load($sourcePath);

        $xpath = new DOMXPath($doc);
        $nodes = $xpath->query('/FIRST_NAMES/N');

        $newDoc = new DOMDocument();
        $newDoc->preserveWhiteSpace = false;
        $newDoc->formatOutput = true;

        $root = $newDoc->createElement('FIRST_NAMES');
        $newDoc->appendChild($root);

        foreach ($nodes as $node) {
            $lids = $xpath->query('.//L[@lid="0"]', $node);
            if ($lids->length > 0) {
                $imported = $newDoc->importNode($node, true);
                $root->appendChild($imported);
            }
        }

        $newDoc->save($outputPath);
        $this->info("Filtered XML saved to: $outputPath");

        return 0;
    }
}
