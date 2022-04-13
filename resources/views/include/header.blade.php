<div class="nk-header nk-header-fluid is-theme">
    <div class="container-xl wide-xl">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger mr-sm-2 d-lg-none">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand">
                <a href="{{ route('actionMainIndex') }}" class="logo-link">
                    <img class="logo-light logo-img" src="{{ url('assets/images/logo.png') }}" srcset="{{ url('assets/images/logo2x.png') }} 2x" alt="logo">
                    <img class="logo-dark logo-img" src="{{ url('assets/images/logo-dark.png') }}" srcset="{{ url('assets/images/logo-dark2x.png') }} 2x" alt="logo-dark">
                </a>
            </div>
            <div class="nk-header-menu" data-content="headerNav">
                <div class="nk-header-mobile">
                    <div class="nk-header-brand">
                        <a href="{{ route('actionMainIndex') }}" class="logo-link">
                            <img class="logo-light logo-img" src="{{ url('assets/images/logo.png') }}" srcset="{{ url('assets/images/logo2x.png') }} 2x" alt="logo">
                            <img class="logo-dark logo-img" src="{{ url('assets/images/logo-dark.png') }}" srcset="{{ url('assets/images/logo-dark2x.png') }} 2x" alt="logo-dark">
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
                <ul class="nk-menu nk-menu-main ui-s2">
                    <li class="nk-menu-item">
                        <a href="{{ route('actionMainIndex') }}" class="nk-menu-link">
                            <span class="nk-menu-text">მთავარი გვერდი</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-text">მომხმარებლები</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('actionUsersIndex') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">სისტემური მომხმარებლები</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('actionCustomersIndex') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">კლიენტები</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('actionUsersRole') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">წვდომის ჯგუფები</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('actionOrdersIndex') }}" class="nk-menu-link">
                            <span class="nk-menu-text">შეკვეთები</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-text">პროდუქცია</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('actionProductsCategories') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">კატეგორიები</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('actionProductsBrands') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">ბრენდები</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('actionProductsVendors') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">მომწოდებლები</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('actionProductsOptions') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">დამატებითი ველები</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('actionProductsIndex') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">პროდუქციის დამატება</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-text">კონტენტი</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('actionSliderIndex') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">სლაიდერი</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('actionBannerIndex') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">ბანერები</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-text">პარამეტრები</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('actionParametersIndex') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">ზოგადი პარამეტრები</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('actionParametersPayments') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">ონლაინ გადახდები</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('actionParametersTranslate') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">თარგმნები</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('actionDeliveryParameters') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">მიწოდების პარამეტრები</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('actionDeliveryAddress') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">მიწოდების მისამართები</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item">
                        <a href="/filemanager" class="nk-menu-link">
                            <span class="nk-menu-text">ფაილ მენეჯერი</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown notification-dropdown">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                            <div class="icon-status icon-status-info">
                                <em class="icon ni ni-bell"></em>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title font-neue">ნიტიფიკაციები</span>
                                <a href="#" class="font-helvetica-regular">ყველას წაკითხულად მონიშვნა</a>
                            </div>
                            <div class="dropdown-body">
                                <div class="nk-notification">
                                    @if(count($notifications) > 0)
                                    @foreach($notifications as $notification_item)
                                    <div class="nk-notification-item dropdown-inner" style="cursor: pointer;" onclick="ViewNotification({{ $notification_item->id }})">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text font-helvetica-regular q">{{ $notification_item->title }}</div>
                                            <div class="nk-notification-time">{{ \Carbon\Carbon::parse($notification_item->created_at)->format('Y-m-d H:m:s') }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text text-center font-neue">ნოტიფიკაციების სია ცარიელია</div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="font-helvetica-regular dropdown-foot center">
                                <a href="javascript:;" onclick="ViewAllNotification()">სრული ჩამონათვალი</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown user-dropdown order-sm-first">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                <div class="user-info d-none d-xl-block">
                                    <div class="user-name dropdown-indicator">მოგესალმები: {{ Auth::user()->name }} {{ Auth::user()->lastname }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 is-light">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="lead-text">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                                        <span class="sub-text">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list font-helvetica-regular">
                                    <li><a href="{{ route('actionUserLogout') }}"><em class="icon ni ni-signout"></em><span>გასვლა</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>