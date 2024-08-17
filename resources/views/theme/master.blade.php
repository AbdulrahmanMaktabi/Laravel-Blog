<!DOCTYPE html>
<html lang="en">
@include('theme.partials.header')

<body>
    @include('theme.partials.nav')
    {{-- @include('theme.partials.hero') --}}
    @yield('content')
    @include('theme.partials.footer')
</body>
@include('theme.partials.links')

</html>
