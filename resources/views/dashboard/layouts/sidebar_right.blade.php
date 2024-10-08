<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard.index')}}"><i class="icon-speedometer"></i> {{ __('words.dashboard') }}
                </a>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>{{ __('words.users') }}</a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        @can('create', Auth::user())
                            <a class="nav-link" href="{{ route('dashboard.users.create') }}"><i
                                class="icon-user-follow"></i>{{ __('words.add users') }}</a>
                        @endcan
                        <a class="nav-link" href="{{ route('dashboard.users.index') }}"><i
                                class="icon-people"></i>
                            {{ __('words.users') }}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>{{ __('words.categories') }}</a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        @can('create', App\Models\Category::class)
                            <a class="nav-link" href="{{ route('dashboard.categories.create') }}"><i
                                    class="icon-user-follow"></i>{{ __('words.add categories') }}</a>
                        @endcan
                        <a class="nav-link" href="{{ route('dashboard.categories.index') }}"><i
                                class="icon-people"></i>
                            {{ __('words.categories') }}</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>
                    {{ __('words.posts') }}</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.posts.create') }}"><i
                                class="icon-user-follow"></i>{{ __('words.add posts') }}</a>
                        <a class="nav-link" href="{{ route('dashboard.posts.index') }}"><i
                                class="icon-people"></i>
                            {{ __('words.posts') }}</a>
                    </li>
                </ul>
            </li>

            @can('view', $settings)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.settings') }}"><i class="icon-people"></i>
                        {{ trans('words.settings') }}</a>
                </li>
            @endcan
        </ul>
    </nav>
</div>
