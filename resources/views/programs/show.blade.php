@extends('layouts.app')

@section('title', 'Programs')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Hostname</th>
                                <th>IP</th>
                                <th>Source</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hosts as $host):
                                <tr>
                                    <td><a href="{{ $host->hostname }}">{{ substr($host->hostname, 0, 64) }}</a></td>
                                    <td>{{ $host->ip }}</td>
                                    {{-- This lookup needs to be done in the controller --}}
                                    <td>{{ $host->src }}</td>
                                    <td>
                                        <button class="btn btn-success">Port Scan</button>
                                    </td>
                                </tr>
                            @endforeach;
                        </tbody>
                    </table>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Resource</th>
                                <th>Source</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resources as $res):
                                <tr>
                                    <td><a href="{{ $res->result }}">{{ substr($res->result, 0, 64) }}</a></td>
                                    {{-- This lookup needs to be done in the controller --}}
                                    <td>{{ $res->src }}</td>
                                    <td>
                                        <button class="btn btn-success">Run Recon</button>
                                    </td>
                                </tr>
                            @endforeach;
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection