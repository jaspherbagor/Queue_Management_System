@extends('layouts.backend')
@section('title', 'User Manual')

@section('content')
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12 ads-list-view">
            <h3>User Manual</h3>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-container" id="printMe">

    <div class="panel-body">
        <div class="container mb-1 pb-1 user-manual-container">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="mb-1 mt-1">
                        <a href="{{ asset('assets/user_manual/usermanual.pdf') }}" target="_blank" class="btn btn-primary backup-db-btn mt-1 mb-1">View File</a>
                    </div>
                    <div class="">
                        <iframe
                            src="{{ asset('assets/user_manual/usermanual.pdf#page=1') }}"
                            width="80%"
                            height="500px"
                            style="border: none;"
                        >
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

