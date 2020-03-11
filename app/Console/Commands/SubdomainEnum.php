<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubdomainEnum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Recon:SubdomainEnum {domains*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs subdomain recon based on the bounty target';

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
        $domains = $this->argument('domains');

        $arrDomains = json_decode($domains, true);

        $filename = sprintf('%s.txt', Str::random(32));

        if(is_array($arrDomains))
        {
            foreach($arrDomains as $dom => $v)
            {
                Storage::put($filename, str_replace('*.','', $dom));
            }
        }
        $currentPath = Storage::disk('local')->path($filename);
        $parts = explode('/', $currentPath);
        array_pop($parts);
        $newPath = implode('/', $parts);

        $outputFilename = escapeshellarg(sprintf('%s/%s.txt', $newPath, Str::random(32)));

        // Unset any timeout
        set_time_limit((3600*24));

        // Look for a better way of doing this:
        return shell_exec(sprintf('/home/mantis/Tools/amass_v3.4.4_linux_amd64/amass enum -df %1$s -o %2$s', escapeshellarg($newPath.'/'.$filename), $outputFilename));
    }
}
