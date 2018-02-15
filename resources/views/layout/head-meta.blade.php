<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@if(isset($model->metaLinkPrev) && !is_null($model->metaLinkPrev))
<link rel="prev" href="{{ $model->metaLinkPrev }}">
@endif
@if(isset($model->metaLinkNext) &&!is_null($model->metaLinkNext))
<link rel="next" href="{{ $model->metaLinkNext }}">
@endif
@if(isset($model->setNoIndex) && $model->setNoIndex)
<meta name="robots" content="noindex, follow">
@endif
<meta name="description" content="{{ $model->description }}">
<meta name="keywords" content="{{ $model->keywords }}">
<title>{{ $model->title }}</title>
