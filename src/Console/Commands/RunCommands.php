<?php

namespace Kakhura\LaravelSiteBases\Console\Commands;

use Illuminate\Console\Command;

class RunCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kakhura:run-commands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is for run some necessary commands.';

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
     * @return mixed
     */
    public function handle()
    {
        $this->runCommands();
    }

    protected function runCommands()
    {
        $this->call('migrate');

        $this->call('ui', [
            'type' => 'bootstrap',
            '--auth' => true,
            '--no-interaction' => true,
        ]);

        $this->info('Auth created succsesfully');

        $this->call('vendor:publish', [
            '--provider' => 'Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider',
        ]);

        $this->info('Translation config published succsesfully');
    }
}
