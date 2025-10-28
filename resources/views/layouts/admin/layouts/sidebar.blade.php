<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            @php
                $default = asset('assets/images/logo.png');
                $src = @$profile->image ? asset('storage/attachment/profile/image/' . @$profile->image) : $default;
            @endphp
            <img src="{{ @$src }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">
                {{ Str::before(@$profile->name, ' ') }}
            </h4>
        </div>
        <div class="toggle-icon ms-auto">
            <i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        @php
            $menus = config('menu.main', []);
        @endphp

        @foreach ($menus as $menu)
            @if (!isset($menu['permission']) || auth()->user()->can($menu['permission']))
                <li class="{{ isActive($menu['patterns'] ?? []) }}">
                    
                    {{-- Menu with children --}}
                    @if (!empty($menu['children']))
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="{{ $menu['icon'] ?? '' }}"></i></div>
                            <div class="menu-title">{{ __($menu['title']) }}</div>
                        </a>

                        <ul>
                            @foreach ($menu['children'] as $child)
                                @if (!isset($child['permission']) || auth()->user()->can($child['permission']))
                                    <li class="{{ isActive($child['patterns'] ?? [$child['route'] ?? '']) }}">
                                        
                                        {{-- Child has children --}}
                                        @if (!empty($child['children']))
                                            <a href="javascript:;" class="has-arrow">
                                                <i class="{{ $child['icon'] ?? '' }}"></i>
                                                {{ __($child['title']) }}
                                            </a>
                                            <ul>
                                                @foreach ($child['children'] as $subChild)
                                                    @if (!isset($subChild['permission']) || auth()->user()->can($subChild['permission']))
                                                        <li class="{{ isActive($subChild['patterns'] ?? [$subChild['route'] ?? '']) }}">
                                                            @if (isset($subChild['route']))
                                                                <a href="{{ route($subChild['route'], $subChild['params'] ?? []) }}">
                                                                    <i class="{{ $subChild['icon'] ?? '' }}"></i>
                                                                    {{ __($subChild['title']) }}
                                                                </a>
                                                            @else
                                                                <i class="{{ $subChild['icon'] ?? '' }}"></i>
                                                                {{ __($subChild['title']) }}
                                                            @endif
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>

                                        {{-- Child has no children --}}
                                        @else
                                            @if (isset($child['route']))
                                                <a href="{{ route($child['route'], $child['params'] ?? []) }}">
                                                    <i class="{{ $child['icon'] ?? '' }}"></i>
                                                    {{ __($child['title']) }}
                                                </a>
                                            @else
                                                <i class="{{ $child['icon'] ?? '' }}"></i>
                                                {{ __($child['title']) }}
                                            @endif
                                        @endif

                                    </li>
                                @endif
                            @endforeach
                        </ul>

                    {{-- Menu without children --}}
                    @else
                        @if (isset($menu['route']))
                            <a href="{{ route($menu['route'], $menu['params'] ?? []) }}">
                                <div class="parent-icon"><i class="{{ $menu['icon'] ?? '' }}"></i></div>
                                <div class="menu-title">{{ __($menu['title']) }}</div>
                            </a>
                        @else
                            <div class="parent-icon"><i class="{{ $menu['icon'] ?? '' }}"></i></div>
                            <div class="menu-title">{{ __($menu['title']) }}</div>
                        @endif
                    @endif

                </li>
            @endif
        @endforeach

    </ul>
    <!--end navigation-->
</div>