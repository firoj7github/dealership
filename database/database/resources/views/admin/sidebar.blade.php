
<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item {{ isset($mainMenu) && $mainMenu == 'dashboard' ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">{{__('Dashboard')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ isset($mainMenu) && $mainMenu == 'donorList' ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{ route('admin.donorList') }}">
                    <i class="nav-icon i-Love-User"></i>
                    <span class="nav-text">{{__('Donors')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{ isset($mainMenu) && $mainMenu == 'instituteList' ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{ route('admin.instituteList') }}">
                    <i class="nav-icon i-Home-4"></i>
                    <span class="nav-text">{{__('Institutes')}}</span>
                </a>
                <div class="triangle"></div>
            </li>
            {{--<li class="nav-item  {{ isset($mainMenu) && $mainMenu == 'appointmentList' ? 'active' : '' }}" data-item="appointments">--}}
                {{--<a class="nav-item-hold" href="#">--}}
                    {{--<i class="nav-icon i-Calendar-4"></i>--}}
                    {{--<span class="nav-text">{{ __('Appointments') }}</span>--}}
                    {{--@foreach($appointmentCount['totalAppointment'] as $appointment)--}}
                        {{--@if($appointment->type == APPOINTMENT_PENDING_STATUS)--}}
                            {{--<span class="badge badge-round-warning sm m-1">{{ $appointment->total }}</span>--}}
                        {{--@elseif($appointment->type == APPOINTMENT_PENDING_CANCELLATION_STATUS)--}}
                            {{--<span class="badge badge-round-danger sm m-1">{{ $appointment->total }}</span>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}
                {{--</a>--}}
                {{--<div class="triangle"></div>--}}
            {{--</li>--}}
            {{--<li class="nav-item {{ isset($mainMenu) && $mainMenu == 'userList' ? 'active' : '' }}">--}}
                {{--<a class="nav-item-hold" href="{{ route('admin.userList') }}">--}}
                    {{--<i class="nav-icon i-Add-User"></i>--}}
                    {{--<span class="nav-text">{{ __('Users') }}</span>--}}
                {{--</a>--}}
                {{--<div class="triangle"></div>--}}
            {{--</li>--}}
            {{--<li class="nav-item {{ isset($mainMenu) && $mainMenu == 'newsList' ? 'active' : '' }}">--}}
                {{--<a class="nav-item-hold" href="{{ route('admin.newsList') }}">--}}
                    {{--<i class="nav-icon i-Newspaper-2"></i>--}}
                    {{--<span class="nav-text">{{ __('News Feeds') }}</span>--}}
                {{--</a>--}}
                {{--<div class="triangle"></div>--}}
            {{--</li>--}}
            {{--<li class="nav-item {{ isset($mainMenu) && $mainMenu == 'campaigns' ? 'active' : '' }}" data-item="campaigns">--}}
                {{--<a class="nav-item-hold" href="{{ route('admin.settings') }}">--}}
                    {{--<i class="nav-icon i-Communication-Tower"></i>--}}
                    {{--<span class="nav-text">{{ __('Campaigns') }}</span>--}}
                {{--</a>--}}
                {{--<div class="triangle"></div>--}}
            {{--</li>--}}
            {{--<li class="nav-item {{ isset($mainMenu) && $mainMenu == 'locationList' ? 'active' : '' }}">--}}
                {{--<a class="nav-item-hold" href="{{ route('admin.locationList') }}">--}}
                    {{--<i class="nav-icon i-Shop-3"></i>--}}
                    {{--<span class="nav-text">{{ __('Locations') }}</span>--}}
                {{--</a>--}}
                {{--<div class="triangle"></div>--}}
            {{--</li>--}}

            {{--<li class="nav-item {{ isset($mainMenu) && $mainMenu == 'settings' ? 'active' : '' }}">--}}
                {{--<a class="nav-item-hold" href="{{ route('admin.settings') }}">--}}
                    {{--<i class="nav-icon i-Settings-Window"></i>--}}
                    {{--<span class="nav-text">{{ __('Settings') }}</span>--}}
                {{--</a>--}}
                {{--<div class="triangle"></div>--}}
            {{--</li>--}}
            {{--<li class="nav-item {{ isset($mainMenu) && $mainMenu == 'support' ? 'active' : '' }}">--}}
                {{--<a class="nav-item-hold" href="{{ route('admin.supportMessageList') }}">--}}
                    {{--<i class="nav-icon i-Support"></i>--}}
                    {{--<span class="nav-text">{{ __('Support') }}</span>--}}
                {{--</a>--}}
                {{--<div class="triangle"></div>--}}
            {{--</li>--}}


        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
        {{--<ul class="childNav" data-parent="campaigns">--}}
            {{--<li class="nav-item">--}}
                {{--<a href="{{ route('admin.pushNotification') }}" class="{{ isset($subMenu) && $subMenu == 'pushNotification' ? 'open' : '' }}">--}}
                    {{--<i class="nav-icon i-Bell"></i>--}}
                    {{--<span class="item-name">{{ __('Push Notification') }}</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a href="{{ route('admin.emailNotification') }}" class="{{ isset($subMenu) && $subMenu == 'emailNotification' ? 'open' : '' }}">--}}
                    {{--<i class="nav-icon i-At-Sign"></i>--}}
                    {{--<span class="item-name">{{ __('Email Notification') }}</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a href="{{ route('admin.smsNotification') }}" class="{{ isset($subMenu) && $subMenu == 'smsNotification' ? 'open' : '' }}">--}}
                    {{--<i class="nav-icon i-Envelope"></i>--}}
                    {{--<span class="item-name">{{ __('Sms Notification') }}</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a href="{{ route('admin.campaignHistory') }}" class="{{ isset($subMenu) && $subMenu == 'campaignHistory' ? 'open' : '' }}">--}}
                    {{--<i class="nav-icon i-Line-Chart-3"></i>--}}
                    {{--<span class="item-name">{{ __('Campaign History') }}</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    </div>
    <div class="sidebar-overlay"></div>
</div>
