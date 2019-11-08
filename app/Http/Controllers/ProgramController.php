<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Program;
use App\Resource;
use App\Host;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programs.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programs.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $program = new Program;
        $program->in_scope = $request->in_scope;
        $program->out_of_scope = $request->out_of_scope;
        $program->bounty_name = $request->program_name;
        $program->is_private = intval($request->is_private);
        $program->author_id = (!empty(Auth::id()) ? Auth::id() : 0);
        if($program->save()) 
        {
            // return redirect()->route('programs.view', $program->id);
            return redirect()->route('programs.list');
        }

        // TODO: add what the error was
        // There was an error
        return back()->withInput();
    }

    public function list() 
    {

        $programs = Program::all();
    
        return view('programs.list', ['programs' => $programs]);

        // return view('programs.list', [
        //     // 'id' => $program->id,
        //     'title' => $program->bounty_name,
        //     'bountyName' => $program->bounty_name,
        //     'inScope' => $program->in_scope,
        //     'outOfScope' => $program->out_of_scope,
        //     'private' => $program->is_private,
        //     'author' => User::where('id', '=', $program->author_id)->find(['name'])->first(),
        // ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // May need a limit with pagination
        $hosts = Host::where('bounty_id', '=', $id)->get();
        
        $resources = Resource::where('bounty_id', '=', $id)->get();
        
        return view('programs.show', [
            'resources' => $resources, 
            'hosts' => $hosts,
            'title' => Program::where('id', '=', $id)->get(['bounty_name'])->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
