<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                </div>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="System lang: {{ app()->getLocale() }}">
                            <img src="{{ asset('assets/images/' . app()->getLocale() . '.png') }}" style="width: 25px">
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('lang', ['lang' => 'fa']) }}">
                                    <img src="{{asset('assets/images/fa.png')}}" style="width: 25px" alt="logo icon"> FA
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('lang', ['lang' => 'pa']) }}">
                                    <img src="{{asset('assets/images/fa.png')}}" style="width: 25px" alt="logo icon"> PA
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('lang', ['lang' => 'en']) }}">
                                    <img src="{{asset('assets/images/en.png')}}" style="width: 25px" alt="logo icon"> EN
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">	<i class='bx bx-category'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="row row-cols-3 g-3 p-3">
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-cosmic text-white"><i class='bx bx-group'></i>
                                    </div>
                                    <div class="app-title">Teams</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bx-atom'></i>
                                    </div>
                                    <div class="app-title">Projects</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-lush text-white"><i class='bx bx-shield'></i>
                                    </div>
                                    <div class="app-title">Tasks</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-kyoto text-dark"><i class='bx bx-notification'></i>
                                    </div>
                                    <div class="app-title">Feeds</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-file'></i>
                                    </div>
                                    <div class="app-title">Files</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-moonlit text-white"><i class='bx bx-filter-alt'></i>
                                    </div>
                                    <div class="app-title">Alerts</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <span class="alert-count" id="unreadNotificationCount">
                                @if($notifications->count() > 7)
                                    {{ $notifications->count() }} +
                                @else
                                    {{ $notifications->count() }}
                                @endif
                            </span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">
                                        {{ __('global.notifications') }}
                                    </p>
                                    <p class="msg-header-clear ms-auto" id="mark-all-read-all">{{ __('global.mark_as_read_all') }}</p>
                                </div>
                            </a>
                            <div class="header-notifications-list">
                                @foreach($notifications as $notification)
                                @php
                                    $user = null;
                                    if (!empty($notification->data['created_by'])) {
                                        $user = App\Models\User::find($notification->data['created_by']);
                                    }
                                @endphp

                                <a href="{{ route('viewSingleNotification', ['id' => $notification->id]) }}" 
                                    class="text-reset notification-item unreadNotification notification-{{ $notification->id }}" 
                                    target="_blank">
                                    <div class="d-flex">
                                        <div class="avatar-xs text-center" id="notification_{{ $notification->id }}">
                                            <div class="custom d-flex flex-column align-items-center p-0">
                                                <img src="{{ $user && $user->photo && file_exists(storage_path('app/public/attachment/employee/photo/' . $user->photo)) 
                                                            ? asset('storage/attachment/employee/photo/' . $user->photo) 
                                                            : asset('assets/img/default-img.png') }}" 
                                                    alt="{{ $user?->name ?? 'Unknown User' }}" 
                                                    style="width: 40px; height: 40px;" 
                                                    class="avatar-title bg-primary rounded-circle font-size-16 mb-1">

                                                <h6 class="fs-10 mb-0">{{ $user?->name ?? '' }}</h6>

                                                <span class="text-gray-900 text-hover-primary text-muted fs-7" 
                                                    style="cursor: pointer;" 
                                                    data-id="{{ $notification->id }}">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1" key="t-your-order">{{ $notification->data['title'] ?? '' }}</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1" key="t-grammer">{{ $notification->data['message'] ?? '' }}</p>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-clock-outline"></i>
                                                    <span key="t-min-ago">{{ formatVertaDate($notification->created_at->timestamp) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <!--begin::Separator-->
                                <div class="separator separator-dashed"></div>
                                <!--end::Separator-->
                            @endforeach
                            </div>
                            <a href="{{ route('allNotification')}}" id="active_notification_name" class="btn-link font-size-14 text-center" >
                                <div class="text-center msg-footer">{{ __('global.view_all') }}</div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large d-none">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
                            <i class='bx bx-comment'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Messages</p>
                                    <p class="msg-header-clear ms-auto">Marks all as read</p>
                                </div>
                            </a>
                            <div class="header-message-list">
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{asset('assets/images/system/admin.png')}}" class="msg-avatar" alt="user avatar">avatar
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5 sec
                                        ago</span></h6>
                                            <p class="msg-info">The standard chunk of lorem</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{asset('assets/images/system/admin.png')}}" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
                                        sec ago</span></h6>
                                            <p class="msg-info">Many desktop publishing packages</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{asset('assets/images/system/admin.png')}}" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Oscar Garner <span class="msg-time float-end">8 min
                                        ago</span></h6>
                                            <p class="msg-info">Various versions have evolved over</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{asset('assets/images/system/admin.png')}}" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
                                        min ago</span></h6>
                                            <p class="msg-info">Making this the first true generator</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{asset('assets/images/system/admin.png')}}" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Amelia Doe <span class="msg-time float-end">22 min
                                        ago</span></h6>
                                            <p class="msg-info">Duis aute irure dolor in reprehenderit</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{asset('assets/images/system/admin.png')}}" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Cristina Jhons <span class="msg-time float-end">2 hrs
                                        ago</span></h6>
                                            <p class="msg-info">The passage is attributed to an unknown</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{asset('assets/images/system/admin.png')}}" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">James Caviness <span class="msg-time float-end">4 hrs
                                        ago</span></h6>
                                            <p class="msg-info">The point of using Lorem</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{asset('assets/images/system/admin.png')}}" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs
                                        ago</span></h6>
                                            <p class="msg-info">It was popularised in the 1960s</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{asset('assets/images/system/admin.png')}}" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">David Buckley <span class="msg-time float-end">2 hrs
                                        ago</span></h6>
                                            <p class="msg-info">Various versions have evolved over</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{asset('assets/images/system/admin0.png')}}" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Thomas Wheeler <span class="msg-time float-end">2 days
                                        ago</span></h6>
                                            <p class="msg-info">If you are going to use a passage</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{asset('assets/images/system/admin1.png')}}" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Johnny Seitz <span class="msg-time float-end">5 days
                                        ago</span></h6>
                                            <p class="msg-info">All the Lorem Ipsum generators</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">View All Messages</div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown">
                @php
                    @$userDetail = $user->type == 'driver' ? $user->driver : $user->employee;
                    @$name = $user->type == 'driver' ? $userDetail->first_name : $userDetail->name;
                    @$image = $user->type == 'driver' ? asset('storage/attachment/driver/image/' . $userDetail->image) : asset('storage/attachment/employee/image/' . $userDetail->image)
                @endphp
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ @$userDetail->image ? $image : asset('assets/images/default-img.png')}}" class="user-img" alt="User avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ @$name ? @$name : ''}}</p>
                        <p class="designattion mb-0">{{ @$userDetail->last_name ? @$userDetail->last_name : ''}}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('userprofile')}}"><i class="bx bx-user"></i><span>{{ __('profile.my_profile') }}</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item">
                                <i class='bx bx-log-out-circle'></i><span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>