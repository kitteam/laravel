@if (session('success'))
<div class="alert alert--success">
    <i class="alert__icon fa fa-info-circle"></i> {{ session('success') }}
</div>
@endif


@if (session('error'))
<div class="alert alert--danger alert fade show">
    <i class="alert__icon fa fa-times-circle"></i> {{ session('error') }}

    <button class="close" data-dismiss="alert" type="button">&times;</button>
</div>
@endif


@if (session('warning'))
<div class="alert alert--warning alert fade show">
    <i class="alert__icon fa fa-exclamation-circle"></i> {{ session('warning') }}

    <button class="close" data-dismiss="alert" type="button">&times;</button>
</div>
@endif


@if (session('info'))
<div class="alert alert--info">
    <i class="alert__icon fa fa-info-circle"></i> {{ session('info') }}
</div>
@endif


@if ($errors->any())
<div class="alert alert--danger alert fade show">
    <i class="alert__icon fa fa-times-circle"></i> Пожалуйста, проверьте правильность заполения данных формы

    <button class="close" data-dismiss="alert" type="button">&times;</button>
</div>
@endif
