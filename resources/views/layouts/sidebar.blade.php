<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard.index')}}"> {{__('word.dashboard')}} </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.users.index')}}"> {{trans('word.users')}}</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.order.index')}}"> {{trans('word.orders')}}</a>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    {{ __('word.categories') }}</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        @can('view', $setting)
                            <a class="nav-link" href="{{ route('dashboard.category.create') }}">{{ __('word.add category') }}</a>
                        @endcan
                        <a class="nav-link" href="{{ route('dashboard.category.index') }}">
                            {{ __('word.categories') }}</a>
                            <a class="nav-link" href="{{ route('dashboard.category.create') }}">{{ __('word.add category') }}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    {{ __('word.products') }}</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.product.create') }}">
                            {{ __('word.add product') }}
                        </a>
                        <a class="nav-link" href="{{ route('dashboard.product.index') }}">
                            {{ __('word.products') }}
                        </a>
                    </li>
                </ul>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.settings')}}"> {{trans('word.settings')}}</a>
            </li>

        </ul>
    </nav>
</div>