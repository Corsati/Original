<head>
    <meta charset="utf-8"/>
    {{ seo()->render() }}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta property="og:url" content="{{url('website/img/seo.png')}}"/>
    <link rel="shortcut icon" href="{!! setAsset('website/img/c.png') !!}">
    <link href="{!! setAsset('website/css/bootstrap.min.css') !!}" rel="stylesheet"/>
    <link href="{!! setAsset('website/css/style.css') !!}" rel="stylesheet"/>
    @if(session()->get('language') == 'ar')
        <link href="{!! setAsset('website/css/styleRTL.css') !!}" rel="stylesheet"/>
        <link href="{!! setAsset('website/css/extraAr.css') !!}" rel="stylesheet"/>
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />--}}
</head>

