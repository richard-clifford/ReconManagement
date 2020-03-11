<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;
use Artisan;

class CommandController extends Controller
{
    public $reconMethods = [
        'subdomain',
        'javascript',
        'CSP',
        'wayback',
        'GetAllUrls',
    ];

    protected $scope = [

    ];

    protected function subdomainEnum($scope)
    {
        if(is_array($scope) && array_key_exists('in', $scope))
        {
            $wildCards = [];
            foreach($scope['in'] as $dom => $wild)
            {

                if($wild)
                {
                    $wildCards[$dom] = true;
                }
            }
            dd(Artisan::call('Recon:SubdomainEnum', ['domains' => json_encode($wildCards)]));
        }
    }

    public function parseScope($inScope, $outOfScope)
    {
        $inScopeArr = json_decode($inScope, true);
        $ooScopeArr = json_decode($outOfScope, true);

        if(is_array($inScopeArr))
        {
            foreach($inScopeArr as $is)
            {
                $this->scope['in'][$is] = false;
                if(substr($is, 0, 1) === '*')
                {
                    $this->scope['in'][$is] = true;
                }
            }
        }
        if(is_array($ooScopeArr))
        {
            foreach($ooScopeArr as $oos)
            {
                $this->scope['out'][$oos] = false;
                if(substr($oos, 0, 1) === '*')
                {
                    $this->scope['out'][$oos] = true;
                }
            }
        }
        return $this->scope;
    }

    public function executeRecon(Request $request)
    {
        $id = $request->id;
        $methods = $request->methods;

        $target = Program::where('id', '=', $id)->get();
        $reconMethods = [];
        if(!empty($methods) && $methods[0] !== '*')
        {
            foreach($methods as $rc)
            {
                $reconMethods[] = $rc;
            }
        }
        else
        {
            foreach($this->reconMethods as $rc)
            {
                $reconMethods[] = $rc;
            }
        }
        $results = [];
        foreach($reconMethods as $recMeth)
        {
            switch($recMeth)
            {
                case 'subdomain':
                    foreach($target as $t)
                    {
                        $scope = $this->parseScope($t['in_scope'], $t['out_of_scope']);
                        foreach($scope as $sc)
                        {
                            $results['subdomains'] = $this->subdomainEnum($scope);
                        }
                    }
            }
        }
        // dd($results);
    }
}
