<?php

use App\Http\Controllers\Controllers\Program;

class ProgramListController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('programs.all');
    }
}