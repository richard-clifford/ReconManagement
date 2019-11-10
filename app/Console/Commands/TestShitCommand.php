<?php

namespace App\Console\Commands;

use App\Domain\Model\URLCollection;
use App\Jobs\FetchWayBackURLsProcess;
use Illuminate\Console\Command;

class TestShitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:dispatch';

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
     * @return mixed
     */
    public function handle()
    {
        $urls = URLCollection::make([
            'google.com',
            'cybershade.org',
            'ifconfig.se',
        ]);
        
        FetchWaybackURLsProcess::dispatch($urls);
    }
}
