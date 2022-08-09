<!DOCTYPE html>
<html>

@include('layouts.components.head')

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('layouts.components.navigation')
            @include('layouts.components.sidebar')

            <!-- Main Content -->
            <div class="main-content" style="min-height: 480px">
                @yield('main-content')
            </div>
            @include('layouts.components.footer')
        </div>
    </div>
    @include('layouts.components.script')
</body>
</html>


