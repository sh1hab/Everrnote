<?php

namespace App\Console\Commands;

use App\Models\Contact;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:contacts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Contacts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = json_decode(Storage::get('imports/contacts.json'), true);

        Contact::insert($data);

        return 0;
    }
}
