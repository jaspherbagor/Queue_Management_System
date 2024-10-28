@extends('layouts.backend')

@section('content')
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12">
            <h3>Database Backup Files</h3>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-container">

    <div class="panel-body">
        <div class="col-sm-12">
            <table class="datatable table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>Filename</th>
                        <th>Size (KB)</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($files as $file)
                        <tr>
                            <td>{{ $file->getFilename() }}</td>
                            <td>{{ round($file->getSize() / 1024, 2) }}</td>
                            <td>
                                <a href="" class="btn btn-primary">Download</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No backup files available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
