<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Transactions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = fopen(Storage::get('imports/all_accounts.csv'),"r");

        while (($data = fgetcsv($file)) !== FALSE)
        {
            $data = [
              'created_at' => $data[0],
                'created_at' => $data[0],
                'created_at' => $data[0],
                'created_at' => $data[0],
                'created_at' => $data[0],

            ];
            echo "email address " . $data[0];
        }

        return 0;
    }
}
