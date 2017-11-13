<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class GenerateDevConfig
 *
 * @package App\Console\Commands
 */
class GenerateDevConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates development configuration file(s)';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->callSilent('clear-compiled');
        $this->info('clear-compiled... done!');

        $this->callSilent('config:clear');
        $this->info('config:clear... done!');

        $this->callSilent('config:cache');
        $this->info('config:cache... done!');

        $this->callSilent('ide-helper:generate');
        $this->info('ide-helper:generate... done!');

        $this->call('ide-helper:models');
        $this->info('ide-helper:models... done!');

        $this->callSilent('ide-helper:meta');
        $this->info('ide-helper:meta... done!');

        $this->info('completed!');
    }
}
