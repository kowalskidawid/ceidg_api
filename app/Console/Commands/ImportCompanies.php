<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;

class ImportCompanies extends Command
{
    protected $signature = 'import:companies';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $fileName = $this->ask('Nazwa pliku (csv)?', 'test.csv');
        $filePath = storage_path('app/import/' . $fileName);
        if (!file_exists($filePath)) {
            $this->error('Plik ' . $fileName . ' nie istnieje!');
            die;
        }
        $this->info('Start: ' . date('Y-m-d H:i:s'));
        $fileHandle = fopen($filePath, 'r');
        while (($row = fgetcsv($fileHandle, 0, ';')) !== false) {
            if (stripos($row[0], 'nip') !== false) {
                continue;
            }
            $pkdCodes = $row[9];
            if ($row[10] && $row[10] !== 'N/A') {
                $pkdCodes .= ', ' . $row[10];
            }
            $street = $row[6] . ' ' . $row[7];
            if ($row[8]) {
                $street .= $row[8];
            }
            $companyData = [
                'nip' => $row[0],
                'name' => $row[1],
                'zip_code' => $row[2],
                'county' => $row[3],
                'municipality' => $row[4],
                'city' => $row[5],
                'street' => $street,
                'pkd_codes' => $pkdCodes,
                'status' => $row[11],
                'source' => $fileName
            ];
            foreach ($companyData as $column => $value) {
                $value = trim($value);
                if (empty($value)) {
                    $companyData[$column] = null;
                }
            }
            try {
                Company::create($companyData);
            } catch (\Exception $exception) {
                $this->error($exception->getMessage());
            }
        }
        $this->info('Koniec: ' . date('Y-m-d H:i:s'));
    }
}
