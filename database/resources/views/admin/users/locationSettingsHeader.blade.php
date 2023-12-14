<ul class="nav nav-tabs" id="myIconTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ isset($subMenu) && $subMenu == 'location' ? 'active' : '' }}" id="home-icon-tab"  href="{{ isset($locationId) ? route('admin.locationEdit', ['id' => encrypt($locationId)]) : route('admin.locationAdd') }}" role="tab" aria-controls="homeIcon" aria-selected="true"><i class="nav-icon i-Clinic mr-1"></i>{{ __('Location') }}</a>
    </li>
    @if(isset($locationId))
        <li class="nav-item">
            <a class="nav-link disabled {{ isset($subMenu) && $subMenu == 'time-schedule' ? 'active' : '' }}" id="home-icon-tab"  href="{{ route('admin.timeScheduleEdit', ['id' => encrypt($locationId)]) }}" role="tab" aria-controls="homeIcon" aria-selected="true"><i class="nav-icon i-Timer1 mr-1"></i>{{ __('Time Schedules') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($subMenu) && $subMenu == 'service' ? 'active' : '' }}" id="home-icon-tab"  href="{{ route('admin.serviceList', ['id' => encrypt($locationId)]) }}" role="tab" aria-controls="homeIcon" aria-selected="true"><i class="nav-icon i-Ambulance mr-1"></i>{{ __('Services') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($subMenu) && $subMenu == 'calendar' ? 'active' : '' }}" id="home-icon-tab"  href="{{ route('admin.calendarList', ['id' => encrypt($locationId)]) }}" role="tab" aria-controls="homeIcon" aria-selected="true"><i class="nav-icon i-Calendar mr-1"></i>{{ __('Calendars') }}</a>
        </li>
    @endif
</ul>