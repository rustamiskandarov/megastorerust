<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('storage:link');
        $this->call('migrate');
        $this->call('db:seed');
        $this->call('config:cache');
        //$this->call('passport:install');
        return self::SUCCESS;
    }
}
