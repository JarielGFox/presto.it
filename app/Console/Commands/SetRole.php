<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SetRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presto:set-role {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assegna ruolo ad utente';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $user = User::where('email', $this->argument('email'))->first();
        if (!$user) {
            $this->error('Utente non trovato');
            return;
        }

        $user->role = 5;
        $user->save();
        $this->info("L'utente {$user->name} è ora un revisore.");
    }
}
