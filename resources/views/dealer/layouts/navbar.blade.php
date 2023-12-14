<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded-hasmenu {{ Request::route()->getName() === 'inventory.import' ? 'active pcoded-trigger' : '' }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                        <span class="pcoded-mtext">Inventory</span>
                    </a>
                    <ul class="pcoded-submenu" style="{{ Request::route()->getName() === 'inventory.import' ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ Request::route()->getName() === 'inventory.import' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('inventory.import') }}">
                                <span class="pcoded-mtext">Inventory Import</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="pcoded-hasmenu {{ Request::route()->getName() === 'dealer.lead' ? 'active pcoded-trigger' : '' }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                        <span class="pcoded-mtext">Leads & contacts</span>
                    </a>
                    <ul class="pcoded-submenu" style="{{ Request::route()->getName() === 'dealer.lead' ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ Request::route()->getName() === 'dealer.lead' ? 'active' : '' }}">
                            @php
                                 $leads_new = \App\Models\Lead::where('status',1)->count();

                            @endphp
                            <a class="nav-link" href="{{ route('dealer.lead') }}">
                                <span class="pcoded-mtext">Email Lead</span> <span class="badge badge-danger"><?php echo $leads_new;?></span>
                            </a>
                        </li>


                    </ul>
                </li>





                <li class="pcoded-hasmenu {{ Request::route()->getName() === 'dealer.listing' || Request::route()->getName() === 'dealer.archive.listing' || Request::route()->getName() === 'invoice.show' || Request::route()->getName() === 'dealer.sold.listing' || Request::route()->getName() === 'dealer.ownbanner' ? 'active pcoded-trigger' : '' }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                        <span class="pcoded-mtext">Functions</span>
                    </a>
                    <ul class="pcoded-submenu" style="{{ Request::route()->getName() === 'dealer.listing' || Request::route()->getName() === 'dealer.archive.listing' ||  Request::route()->getName() === 'dealer.sold.listing' || Request::route()->getName() === 'invoice.show' || Request::route()->getName() === 'dealer.ownbanner' ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ Request::route()->getName() === 'dealer.listing' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dealer.listing') }}">
                                <span class="pcoded-mtext">Listings</span>
                            </a>
                        </li>
                        <li class="{{ Request::route()->getName() === 'dealer.sold.listing' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dealer.sold.listing') }}">
                                <span class="pcoded-mtext">Sold Listing</span>
                            </a>
                        </li>
                        <li class="{{ Request::route()->getName() === 'dealer.archive.listing' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dealer.archive.listing') }}">
                                <span class="pcoded-mtext">Archive Listing</span>
                            </a>
                        </li>
                        <li class="{{ Request::route()->getName() === 'invoice.show' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('invoice.show') }}">
                                <span class="pcoded-mtext">Invoice</span>
                            </a>
                        </li>
                        <li class="{{ Request::route()->getName() === 'dealer.ownbanner' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dealer.ownbanner') }}">
                                <span class="pcoded-mtext">Banner</span>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="pcoded-hasmenu {{ Request::route()->getName() === 'dealer.profile' ? 'active pcoded-trigger' : '' }}">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                        <span class="pcoded-mtext">Tools</span>
                    </a>
                    <ul class="pcoded-submenu" style="{{ Request::route()->getName() === 'dealer.profile' ? 'display: block;' : 'display: none;' }}">
                        <li class="{{ Request::route()->getName() === 'dealer.profile' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dealer.profile') }}">
                                <span class="pcoded-mtext">Profile</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="">
                    <a href="{{ route('home') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                        <i class="fa fa-globe"></i>
                        </span>
                        <span class="pcoded-mtext">Website</span>
                    </a>
                </li>

                <li class="">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="feather icon-log-out"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>


            </ul>

        </div>
    </div>
</nav>
