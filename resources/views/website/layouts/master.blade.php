<!DOCTYPE html>
<html>
    @include('website.layouts.partial.header')
<body>
    @include('website.layouts.partial.logo')
        <div class="ajax-loader">
            <img src="{{setAsset('website/img/Pinwheel.gif')}}" class="img-responsive" />
        </div>
        @yield('content')

        {{ seo('body')->render() }}

    <script>
        loadStyleSheet('{!! setAsset('website/css/all.min.css') !!}');
        loadStyleSheet('{!! setAsset('website/css/nav.css') !!}');
        {{--loadStyleSheet('{!! setAsset('website/css/bootstrap.min.css') !!}');--}}
        {{--loadStyleSheet('{!! setAsset('website/css/style.css') !!}');--}}
        loadStyleSheet('{!! setAsset('website/css/extra.css') !!}');
        function loadStyleSheet(src){
            if (document.createStyleSheet) document.createStyleSheet(src);
            else {
                var stylesheet = document.createElement('link');
                stylesheet.href = src;
                stylesheet.rel = 'stylesheet';
                stylesheet.type = 'text/css';
                document.getElementsByTagName('head')[0].appendChild(stylesheet);
            }
        }
    </script>
    @include('website.layouts.partial.footer')
@stack('scripts')

</body>

</html>

