<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <ul class="pcoded-item pcoded-left-item">


                <li class="pcoded-hasmenu {{ Request::route()->getName() == 'dealer.management' ? 'active pcoded-trigger' : '' }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                        <span class="pcoded-mtext">User</span>
                    </a>

                    <ul class="pcoded-submenu" style="{{ Request::route()->getName() == 'dealer.management' ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ Request::route()->getName() == 'dealer.management' ? 'active' : '' }}">
                            <a href="{{ route('dealer.management') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                    <i class="feather icon-box"></i>
                                </span>
                                <span class="pcoded-mtext">User Management</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu {{ Request::route()->getName() == 'news.management' ? 'active pcoded-trigger' : '' }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                        <span class="pcoded-mtext">News</span>
                    </a>

                    <ul class="pcoded-submenu" style="{{ Request::route()->getName() == 'news.management' ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ Request::route()->getName() == 'news.management' ? 'active' : '' }}">
                            <a href="{{ route('news.management') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                    <i class="feather icon-box"></i>
                                </span>
                                <span class="pcoded-mtext">News Management</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu {{ Request::route()->getName() === 'admin.slides' || Request::route()->getName() === 'admin.banner' ? 'active pcoded-trigger' : '' }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                        <span class="pcoded-mtext">Content</span>
                    </a>

                    <ul class="pcoded-submenu" style="{{ Request::route()->getName() === 'admin.slides' || Request::route()->getName() === 'admin.banner' ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ Request::route()->getName() === 'admin.slides' ? 'active' : '' }}">
                            <a href="{{ route('admin.slides') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                    <i class="feather icon-box"></i>
                                </span>
                                <span class="pcoded-mtext">Slides</span>
                            </a>
                        </li>
                        <li class="{{ Request::route()->getName() === 'admin.banner' ? 'active' : '' }}">
                            <a href="{{ route('admin.banner') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                    <i class="feather icon-box"></i>
                                </span>
                                <span class="pcoded-mtext">Banner</span>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="pcoded-hasmenu {{ Request::route()->getName() === 'admin.membership' || Request::route()->getName() === 'frontend.send.message.show' || Request::route()->getName() === 'admin.leads' || Request::route()->getName() === 'admin.frontend.contact.message' ? 'active pcoded-trigger' : '' }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                        <span class="pcoded-mtext">Functions</span>
                    </a>

                    <ul class="pcoded-submenu" style="{{ Request::route()->getName() === 'admin.membership'|| Request::route()->getName() === 'frontend.send.message.show'|| Request::route()->getName() === 'admin.leads' || Request::route()->getName() === 'admin.frontend.contact.message' ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ Request::route()->getName() === 'admin.membership' ? 'active' : '' }}">
                            <a href="{{ route('admin.membership') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                    <i class="feather icon-box"></i>
                                </span>
                                <span class="pcoded-mtext">Membership</span>
                            </a>
                        </li>
                        <li class="{{ Request::route()->getName() === 'admin.leads' ? 'active' : '' }}">
                            <a href="{{ route('admin.leads') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                    <i class="feather icon-box"></i>
                                </span>
                                @php
                                $leads_new = \App\Models\Lead::where('is_admin_read',0)->count();
                                @endphp
                                <span class="pcoded-mtext">Leads</span>
                                <span class="badge badge-danger"><?php echo $leads_new;?></span>
                            </a>
                        </li>
                        <li class="{{ Request::route()->getName() === 'admin.frontend.contact.message' ? 'active' : '' }}">
                            <a href="{{ route('admin.frontend.contact.message') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                    <i class="feather icon-box"></i>
                                </span>
                                <span class="pcoded-mtext">Message With Seller</span>
                            </a>
                        </li>

                        <li class="{{ Request::route()->getName() === 'frontend.send.message.show' ? 'active' : '' }}">
                            <a href="{{ route('frontend.send.message.show') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                    <i class="feather icon-box"></i>
                                </span>
                                @php
                                $message_new = \App\Models\ContactMessage::where('status',0)->count();
                                @endphp
                                <span class="pcoded-mtext">Message</span>
                                <span class="badge badge-danger"><?php echo $message_new;?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="pcoded-hasmenu">
                    <a href="#" class="waves-effect waves-dark" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                        <span class="pcoded-mtext">Log out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>

        </div>
    </div>
</nav>
