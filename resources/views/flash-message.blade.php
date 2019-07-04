@if (session('success'))
<div class="c-alert c-alert--success">
    <i class="c-alert__icon fa fa-info-circle"></i> {{ session('success') }}
</div>
@endif


@if (session('error'))
<div class="c-alert c-alert--danger fade show">
    <i class="c-alert__icon fa fa-times-circle"></i> {{ session('error') }}

    <button class="c-close" data-dismiss="alert" type="button">&times;</button>
</div>
@endif


@if (session('warning'))
<div class="alert alert--warning alert fade show">
    <i class="alert__icon fa fa-exclamation-circle"></i> {{ session('warning') }}

    <button class="с-close" data-dismiss="alert" type="button">&times;</button>
</div>
@endif


@if (session('info'))
<div class="с-alert с-alert--info">
    <i class="с-alert__icon fa fa-info-circle"></i> {{ session('info') }}
    
    <button class="c-close" data-dismiss="alert" type="button">&times;</button>
</div>
@endif


@if ($errors->any())
<div class="c-alert c-alert--danger alert fade show">
    <i class="c-alert__icon fa fa-times-circle"></i> Пожалуйста, проверьте правильность заполения данных формы

    <button class="c-close" data-dismiss="alert" type="button">&times;</button>
</div>
@endif
