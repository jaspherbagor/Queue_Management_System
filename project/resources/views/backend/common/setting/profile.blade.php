@extends('layouts.backend')
@section('title', trans('profile_information'))

@section('content')
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-8 text-left">
            <h3>{{ trans('app.profile_information') }}</h3>
        </div>
        <div class="col-sm-4 text-right">
            <div class="btn-group">
                <a href=" {{ url("common/setting/profile/edit/") }} "  class="btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>
                <button type="button" onclick="printThis('printThis')" class="btn btn-info btn-sm" ><i class="fa fa-print"></i></button>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-container">

    <div class="panel-body" id="printThis">
        <div class="row">
            <div class="col-sm-12" align="center">
                <img alt="Picture" src="{{ asset((!empty($user->photo)?$user->photo:'public/assets/img/icons/no_user.jpg')) }}" class="img-thumbnail img-responsive profile_img">
                <h3 class="user_name">
                    {{ $user->firstname .' '. $user->lastname }}
                </h3>
                <span class="label user_role">
                    <button class="btn btn_user_role">{{ auth()->user()->roles($user->user_type) }}</button>
                </span>

            </div>

            <div class="col-sm-12 profile_user_info">
                <dl class="dl-horizontal">
                    <dt>Service: </dt><dd>{{ ($user->department?$user->department:"N/A") }}</dd>
                    <dt>{{ trans('app.email') }}:  </dt><dd>{{ $user->email }}</dd>
                    <dt>{{ trans('app.mobile') }}: </dt><dd>{{ $user->mobile }}</dd>
                    <dt>Created:</dt><dd>{{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y') }}</dd>
                    {{-- <dt>{{ trans('app.updated_at') }}</dt><dd>{{ $user->updated_at }}</dd> --}}
                    <dt>{{ trans('app.status') }}: </dt>
                    <dd>
                        @if ($user->status==1)
                        <span class="label label-success btn-active">{{ trans('app.active') }}</span>
                        @else
                        <span class="label label-danger">{{ trans('app.deactive') }}</span>
                        @endif
                    </dd>
                </dl>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12 panel-body table-responsive">
                <h4>Number Information</h4>
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="active">
                            <th>{{ trans('app.status') }}</th>
                            <td>My Numbers</td>
                            <td>{{ trans('app.generated_by_me') }}</td>
                            <td>{{ trans('app.assigned_to_me') }}</td>
                            <td>{{ trans('app.total') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="active">{{ trans('app.pending') }}</th>
                            <td class="info">{{ !empty($generatedByMe['0'])?$generatedByMe['0']:0 }}</td>
                            <td class="info">{{ !empty($myToken['1'])?$myToken['1']:0 }}</td>
                            <td class="info">{{ !empty($assignedToMe['0'])?$assignedToMe['0']:0 }}</td>
                            <td class="active">{{ @$generatedByMe['0']+@$myToken['1']+@$assignedToMe['0'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="active">{{ trans('app.complete') }}</th>
                            <td class="success">{{ !empty($myToken['0'])?$myToken['0']:0 }}</td>
                            <td class="success">{{ !empty($generatedByMe['1'])?$generatedByMe['1']:0 }}</td>
                            <td class="success">{{ !empty($assignedToMe['1'])?$assignedToMe['1']:0 }}</td>
                            <td class="active">{{ @$myToken['0']+@$generatedByMe['1']+@$assignedToMe['1'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="active">{{ trans('app.stop') }}</th>
                            <td class="danger">{{ !empty($myToken['2'])?$myToken['2']:0 }}</td>
                            <td class="danger">{{ !empty($generatedByMe['2'])?$generatedByMe['2']:0 }}</td>
                            <td class="danger">{{ !empty($assignedToMe['2'])?$assignedToMe['2']:0 }}</td>
                            <td class="active">{{ @$myToken['2']+@$generatedByMe['2']+@$assignedToMe['2'] }}</td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr class="active">
                            <th>{{ trans('app.total') }}</th>
                            <td>{{ @$myToken['0']+@$generatedByMe['0']+@$myToken['2'] }}</td>
                            <td>{{ @$myToken['1']+@$generatedByMe['1']+@$generatedByMe['2'] }}</td>
                            <td>{{ @$assignedToMe['0']+@$assignedToMe['1']+@$assignedToMe['2'] }}</td>
                            <td>{{ @$myToken['0']+@$myToken['1']+@$myToken['2']+@$generatedByMe['0']+@$generatedByMe['1']+@$generatedByMe['2']+@$assignedToMe['0']+@$assignedToMe['1']+@$assignedToMe['2'] }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



