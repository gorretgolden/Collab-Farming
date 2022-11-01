<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SystemAccountsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system-updates:accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly activity updates to accounts team and admins';

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
        return 0;
    }
}
