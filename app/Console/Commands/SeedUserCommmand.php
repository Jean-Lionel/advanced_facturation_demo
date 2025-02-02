<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SeedUserCommmand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:lion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Creating user lion');
        // Checking if the user with Gmail nijeanlionel@gmail.com exists
        $user = User::where('email', '=', 'nijeanlionel@gmail.com')->first();

        if ($user === null) {
            $user = new User();
            $user->name = 'Lionel';
            $user->email = 'nijeanlionel@gmail.com';
            $user->password = bcrypt('Advanced@2025');
            $user->save();
            $this->info('User lion created successfully');
        } else {
            $this->info('User lion already exists');
            // update the user password
            $user->password = bcrypt('Advanced@2025');
            $user->save();
            $this->info('User lion password updated successfully');
        }

        return 0;
    }
}
