<?php

namespace App\Console\Commands;

use App\Jobs\StoreSystemLogJob;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Request;

class processSoftCRM extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process-softcrm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all missing process to start using SoftCRM';

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
    public function handle(): void
    {
        $this->info('Welcome in SoftCRM!');

        $this->info('===============================================================');
        $this->info('[Let\'s start process all migrations:]');
        $this->call('migrate');

        $this->info('===============================================================');
        $this->info('[Let\'s start process all seeders:]');
        $this->call('db:seed');

        $this->info('===============================================================');
        $this->info('[Let\'s start process generating unique key:]');
        $this->call('key:generate');

        $this->info('===============================================================');
        $this->info('Everything looks perfect! Now you can start use SoftCRM!');
        $this->info('If you have any question please contact with me by email: kamil.grzechulskii@gmail.com');
        $user = \App\Models\Administrator::find(1);
        $this->dispatchSync(new StoreSystemLogJob('First usage of process-softcrm command', 200, $user));
    }
}
