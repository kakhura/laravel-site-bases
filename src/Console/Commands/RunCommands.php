<?php

namespace Kakhura\LaravelSiteBases\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

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
        $this->createUser();
    }

    protected function runCommands()
    {
        $this->migrate();
        $this->ui();
        $this->localization();
        $this->translations();
        $this->lfm();
    }

    protected function migrate()
    {
        $this->call('migrate');
    }

    protected function ui()
    {
        $this->call('ui', [
            'type' => 'bootstrap',
            '--auth' => true,
            '--no-interaction' => true,
        ]);
    }

    protected function localization()
    {
        $this->call('vendor:publish', [
            '--provider' => 'Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider',
        ]);
        $this->info('Localization config published succsesfully');
    }

    protected function translations()
    {
        $this->call('vendor:publish', [
            '--provider' => 'Barryvdh\TranslationManager\ManagerServiceProvider',
            '--tag' => 'migrations',
        ]);
        $this->migrate();
        $this->call('vendor:publish', [
            '--provider' => 'Barryvdh\TranslationManager\ManagerServiceProvider',
            '--tag' => 'config',
        ]);
        $this->info('Translation manager published succsesfully');
    }

    protected function lfm()
    {
        $this->call('vendor:publish', [
            '--tag' => 'lfm_config',
        ]);
        $this->call('vendor:publish', [
            '--tag' => 'lfm_public',
        ]);
        $this->call('storage:link');
        $this->info('File manager published succsesfully');
    }

    protected function createUser()
    {
        User::create(array_merge([
            'name' => 'admin',
            'email' => 'info@unicode.ge',
            'password' => Hash::make('admin123'),
        ], config('kakhura.site-bases.use_two_type_users') ? ['is_admin' => true] : []));
    }
}
