@extends('layouts.app')

@section('title', 'Programs')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Programs
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Bounty Name</th>
                                <th>In Scope</th>
                                <th>Out Of Scope</th>
                                <th>Author</th>
                                <th>Is Private?</th>
                            </tr>
                        </thead>
                    <tbody>
                            @foreach($programs as $program)
                                <tr>
                                    <td>{{ $program->id }}</td>
                                    <td><a href="{{ route('programs.show', $program->id) }}">{{ $program->bounty_name }}</a></td>
                                    <td>{{ implode(", ", (array) json_decode($program->in_scope, true)) }}</td>
                                    <td>{{ implode(", ", (array) json_decode($program->out_of_scope, true)) }}</td>
                                    <td>{{ $program->author_id }}</td>
                                    <td>{{ $program->is_private }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection