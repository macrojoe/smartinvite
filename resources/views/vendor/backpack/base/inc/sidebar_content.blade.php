<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Autentificación</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('event') }}'><i class='nav-icon la la-question'></i> Events</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('guest') }}'><i class='nav-icon la la-question'></i> Guests</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('guest-status') }}'><i class='nav-icon la la-question'></i> Guest Statuses</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('event-status') }}'><i class='nav-icon la la-question'></i> Event Statuses</a></li>