@extends('layouts.backend')
@section('title', 'Backup and Restore')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success m-1">{{ Session::get('success') }}</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger m-1">{{ Session::get('error') }}</div>
@endif
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12 ads-list-view">
            <h3>Backup and Restore Database</h3>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-container" id="printMe">

    <div class="panel-body">
        <div class="container mb-1 pb-1">
            <!-- Backup Button -->
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title">Backup Database</h4>
                    <form action="{{ route('backup_database') }}" method="GET">
                        <button type="submit" class="btn btn-primary backup-db-btn">Backup Now</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Restore Database</h4>
                    <form action="{{ route('restore_database') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="backup_file">Select Backup File:</label>
                            <input type="file" class="form-control" id="backup_file" name="backup_file" required>
                        </div>
                        <button type="submit" class="btn btn-danger restore-db-btn">Restore Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

