<?php

namespace App\Console\Commands;

use App\Models\Contact;
use App\Models\User;
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
        $user = User::where('email', config('app.admin_email'))->first();

        $data = json_decode(Storage::get('imports/contacts.json'), true);

        foreach ($data as &$dt){
            $dt['user_id'] = $user->id;
        }

        Contact::insert($data);

        return 0;
    }
}
