
    @include('dashboard.partials.header')
    @include('dashboard.layouts.sidebar_right')
    
    <!-- Main content -->
    <main class="main">
        @yield('content')
    </main>

    @include('dashboard.layouts.sidebar_left')

    @include('dashboard.partials.footer')
