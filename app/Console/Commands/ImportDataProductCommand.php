<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;

class ImportDataProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:dataproduct';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from dataproduct.md into the products table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = base_path('dataproduct.md');
        if (!file_exists($filePath)) {
            $this->error("File not found at $filePath");
            return 1;
        }

        $lines = file($filePath);
        $lots = [];
        $currentLot = 0;
        $currentItem = null;

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            if (strpos(strtoupper($line), 'QUALITATIVE ET QUANTITATIVE LOT') !== false) {
                // Determine lot number from string if possible
                preg_match('/LOT\s*(\d+)/i', $line, $matches);
                if (!empty($matches[1])) {
                    $currentLot = (int)$matches[1];
                } else {
                    $currentLot++;
                }
                continue;
            }

            if (strpos($line, '| ---') !== false || strpos($line, '| **N°**') !== false || strpos($line, '| **TOTAL') !== false || strpos($line, '| **TVA') !== false || strpos($line, '| TOTAL') !== false || strpos($line, '| TVA') !== false) {
                if ($currentItem) {
                    $lots[$currentLot][] = $currentItem;
                    $currentItem = null;
                }
                continue;
            }

            if (strpos($line, '|') === 0) {
                $cols = array_map('trim', explode('|', trim($line, '|')));
                if (count($cols) < 2) continue;

                if (preg_match('/^\d+\.?$/', trim($cols[0]))) {
                    if ($currentItem) {
                        $lots[$currentLot][] = $currentItem;
                    }
                    $currentItem = [
                        'name' => trim($cols[1] ?? ''),
                        'forme' => trim($cols[2] ?? ''),
                        'qte' => trim($cols[3] ?? ''),
                        'pu' => trim($cols[4] ?? ''),
                    ];
                } else {
                    if ($currentItem) {
                        $col0 = trim($cols[0] ?? '');
                        if (trim(str_replace('*', '', $col0)) === '000' && empty(trim($cols[1] ?? '')) && empty(trim($cols[2] ?? ''))) {
                            // Ignored continuation of big numbers like '1 500' // '000'
                        } else {
                            if (!empty($col0)) {
                                $currentItem['name'] .= ' ' . $col0;
                            }
                        }

                        if (!empty($cols[1])) {
                            if (empty($currentItem['forme'])) {
                                $currentItem['forme'] = trim($cols[1]);
                            } else {
                                $currentItem['name'] .= ' ' . trim($cols[1]);
                            }
                        }

                        if (!empty($cols[2]) && empty($currentItem['qte'])) {
                            $currentItem['qte'] = trim($cols[2]);
                        }

                        if (!empty($cols[3]) && empty($currentItem['pu'])) {
                            $currentItem['pu'] = trim($cols[3]);
                        }
                    }
                }
            }
        }

        if ($currentItem) {
            $lots[$currentLot][] = $currentItem;
        }

        $this->info("Parsing complete. Lots found: " . count($lots));
        if (count($lots) === 0) {
            $this->error("No data parsed.");
            return 1;
        }

        // Output parsed sample before DB insert to debug
        // $this->info(print_r($lots, true));

        // Now seed the database
        foreach ($lots as $lotNumber => $items) {
            $categoryName = "LOT $lotNumber";
            $category = Category::firstOrCreate(
                ['title' => $categoryName],
                ['stock_id' => 1]
            );

            foreach ($items as $index => $item) {
                $name = str_replace("\n", " ", $item['name']);
                $name = trim(preg_replace('/(?:\*+)(.*?)(?:\*+)/', '$1', $name)); // Remove markdown bold stars
                $name = trim(preg_replace('/\s+/', ' ', $name));
                $forme = trim(preg_replace('/\s+/', ' ', $item['forme']));
                
                $priceStr = str_replace(' ', '', $item['pu']);
                $priceStr = preg_replace('/[^0-9.]/', '', $priceStr); // Extract numeric
                $price = empty($priceStr) ? 0 : (float)$priceStr;

                $qteStr = str_replace([' ', '*'], '', strtolower($item['qte']));
                $qteStr = preg_replace('/[^0-9.]/', '', $qteStr); // Extract numeric
                $qte = empty($qteStr) ? 0 : (float)$qteStr;

                $productCode = "PRD-L{$lotNumber}-" . str_pad($index + 1, 3, '0', STR_PAD_LEFT);

                // Use the controller's validation logic to mimic 'products/create',
                // actually we'll just insert using Eloquent ensuring required fields are set.
                Product::create([
                    'name' => mb_substr($name, 0, 255),
                    'code_product' => $productCode,
                    'category_id' => $category->id,
                    'price' => $price,
                    'price_max' => $price,
                    'price_min' => 0,
                    'unite_mesure' => $forme ?: 'PCE',
                    'taux_tva' => 18,
                    'quantite' => $qte,
                    'quantite_alert' => 10,
                ]);
            }
            $this->info("Imported " . count($items) . " products for LOT $lotNumber.");
        }

        $this->info('Data import complete!');
        return 0;
    }
}
