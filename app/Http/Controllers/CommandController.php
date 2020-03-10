<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommandController extends Controller
{
    public $reconMethods = [
        'subdomain',
        'javascript',
        'CSP',
        'wayback',
        'GetAllUrls',
    ];

    protected function subdomainEnum() 
    {
    }
    
    public function parseScope($inScope, $outOfScope)
    {
        if($inScope) 
        {

        }
    }

    public function executeRecon($id, array $methods) 
    {
        $target = Program::where('id', '=', $id)->first();
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
                        $scope = $this->parseScope($t);
                        foreach($scope as $sc) 
                        {
                            $results['subdomains'] = $this->subdomainEnum($sc);
                        }
                    }
                
            }
        }
    }
}
