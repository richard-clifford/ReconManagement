<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Resource;

class SubdomainEnum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Recon:SubdomainEnum {id} {domains*}';

    /**
     * The console command description.
     *
     * @var string
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

        $id = $this->argument('id');

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
        $ofn = Str::random(32) . '.txt';
        $outputFilename = escapeshellarg(sprintf('%s/%s', $newPath, $ofn));

        // Unset any timeout
        set_time_limit((3600*24));

        // Look for a better way of doing this:
        if(!is_null(shell_exec(sprintf('/home/mantis/Tools/amass_v3.4.4_linux_amd64/amass enum -passive -df %1$s -o %2$s', escapeshellarg($newPath.'/'.$filename), $outputFilename))))
        {
            $results = Storage::get($ofn);
            foreach(explode("\n", $results) as $newDomainResource)
            {
                $resource = new Resource;
                $resource->bounty_id = $id;
                $resource->result = $newDomainResource;
                $resource->src = 'subdomains';
                $resource->save();
            }
        }


        // Clear up the data
        Storage::delete($outputFilename, $filename);
    }
}
