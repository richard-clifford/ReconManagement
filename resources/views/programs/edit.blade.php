@extends('layouts.app')

@section('title', 'Programs')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Edit Bounty Program - {{ $progData->bounty_name }}
                </div>
                <div class="card-body">
                    <form class="form form-action" method="post" action="{{ route('programs.update', ['id' => $progData->id]) }}"> 
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group">
                                <label for="program_name">Program Name</label>
                                <input type="text" class="form-control" name="program_name" id="program_name" value="{{ $progData->bounty_name }}">
                                <small id="progHelp" class="form-text text-muted">This must be unique.</small>
                            </div>
                            <div class="form-group">
                                <label for="is_private">Is Private?</label>
                                {{-- dafuq --}}
                                <input type="checkbox" class="form-control" id="is_private" value="{{ intval($progData->is_private) }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-check-label" for="in_scope">In-Scope</label>
                                <textarea class="form-control" name="in_scope" id="in_scope">{{ implode(", ", (array) json_decode($progData->in_scope, true)) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-check-label" for="out_of_scope">Out-of-Scope</label>
                                <textarea class="form-control" name="out_of_scope" id="out_of_scope">{{ implode(", ", (array) json_decode($progData->out_of_scope, true)) }}</textarea>
                            </div>
                        </div>
                        <input type="submit" name="submit" value="Submit" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection