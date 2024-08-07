@section('info.message')
    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade in shadowed alert-dismissible mt-1 mb-1">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p><i class="fa fa-check"></i> {{ session('message') }}</p>
    </div>
    @endif
    @if(session()->has('exception'))
    <div class="alert alert-success alert-dismissible fade in shadowed alert-dismissible mt-1 mb-1">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p><i class="fa fa-times"></i> {{ session('exception') }}</p>
    </div>
    @endif
@stop

@section('info.language')
    {{ Form::select('lang', [ 'en' => 'English', 'ar' => 'العَرَبِيَّة', 'tr' => 'Türkçe', 'bn' => 'বাংলা', 'es' => 'Español', 'fr'=>'Français', 'pt'=>'Português', 'te'=>'తెలుగు', 'th' => 'ภาษาไทย', 'vi'=> 'Tiếng Việt' ],  \Session::get('locale') , ['id' => 'lang-select', 'class'=>'select2 form-control']) }}
@stop

@section('info.powered-by')
    Powered by <a href="#" target="_blank">QMS FOR PCLU</a>. All rights reserved.
@stop

@section('info.version')
    <span class="label label-primary hidden-xs footer_year">2024</span>
@stop

