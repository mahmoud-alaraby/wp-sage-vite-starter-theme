<!doctype html>
<html @php(language_attributes())>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php(do_action('get_header'))
    @php(wp_head())
</head>

<body @php(body_class())>


    @php(wp_body_open())


    @include('sections.header')

    @include('sections.welcome')
    @yield('content')

    @hasSection('sidebar')
        <aside class="sidebar">
            @yield('sidebar')
        </aside>
    @endif

    @include('sections.footer')

    @php(do_action('get_footer'))
    @php(wp_footer())
</body>

</html>
