<head>
    <meta charset="utf-8">
    <title>{{config('app.name')}} | {!!  $title ?? '' !!} </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('website_assets/css/styles_ar.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('website_assets/css/styles_en.css') }}" rel="stylesheet">
    @endif

    <style>
        .active{
            border-bottom: 2px solid var(--colorPrimary);
            color: var(--colorPrimary) !important;
        }
    </style>

</head>
