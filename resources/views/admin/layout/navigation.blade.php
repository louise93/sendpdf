<nav class="navbar-default navbar-static-side" role="navigation" >
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{ asset('img/profile_small.jpg')}}"/>
                    <a  class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                        <span class="text-muted text-xs block">Admin <b class="caret"></b></span>
                    </a>
                </div>
                <div class="logo-element">
                    XINROX
                </div>
            </li>
            <li class="{{ isActiveRoute('dashboard')  }}">
                <a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="<?php if(Request::segment(2)=='admin/members'){echo 'active';};?>">
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Members</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ isActiveRoute('admin/members/list')  }}"><a href="{{URL::to('admin/members/list')}}">User List</a></li>
                    <li class="{{ isActiveRoute('admin/members/genealogy')  }}"><a href="{{URL::to('admin/members/genealogy')}}">Member's Genealogy Tree</a></li>
                    <li class="{{ isActiveRoute('admin/members/sponsors')  }}"><a href="{{URL::to('admin/members/sponsors')}}">Member's Direct Sponsor</a></li>
                    <li class="{{ isActiveRoute('admin/members/downlines')  }}"><a href="{{URL::to('admin/members/downlines')}}">Member's Downline List</a></li>
                </ul>
            </li>
            <li class="<?php if(Request::segment(1)=='genealogy'){echo 'active';};?>">
                <a href="#"><i class="fa fa-desktop "></i> <span class="nav-label">Genealogy</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ URL ::to('genealogy/directsponsor')}}">Direct Sponsor</a></li>
                    <li><a href="{{ URL ::to('genealogy/downlines')}}">Downlines</a></li>
                    <li><a href="{{ URL ::to('genealogy/sponsortree')}}">Sponsor Tree</a></li>
                    <li><a href="{{ URL ::to('genealogy/networktree')}}">Genealogy Tree</a></li>
                    <li><a href="{{ URL ::to('genealogy/register')}}">Registration</a></li>
                </ul>
            </li>
            <li class="<?php if(Request::segment(1)=='wallets'){echo 'active';};?>">
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Wallet Management</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ URL::to('wallets/list')}}">Wallets</a></li>
                    <li><a href="{{URL::to('wallets/history')}}">History</a></li>
                </ul>
            </li>
            <li class="<?php if(Request::segment(1)=='withdrawals'){echo 'active';};?>">
                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Withdrawals</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{URL::to('wallets/ewallet/withdraw')}}">Withdraw</a></li>
                    <li><a href="{{URL::to('withdrawals/open')}}">Pending Request</a></li>
                    <li><a href="{{URL::to('withdrawals/close')}}">Close Request</a></li>
                </ul>
            </li>
            <li class="<?php if(Request::segment(1)=='portfolio'){echo 'active';};?>">
                <a href="{{URL::to('portfolio')}}"><i class="fa fa-laptop"></i> <span class="nav-label">Active Portfolio</span></a>
            </li>
            <li class="<?php if(Request::segment(1)=='reports'){echo 'active';};?>">
                <a href="#"><i class="fa fa-list"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ URL::to('reports/incomes') }}">Turn Over Income</a></li>
                    <li><a href="{{ URL::to('reports/fundtransfer') }}">Fund Transfers </a></li>
                    <li><a href="{{ URL::to('reports/matchingpoints') }}">Matching Points </a></li>
                </ul>
            </li>
            <li class="<?php if(Request::segment(1)=='contacts'){echo 'active';};?>">
                <a href="{{ URL::to('/contacts') }}"><i class="fa fa-address-book"></i> <span class="nav-label">Contacts</span>  </a>
            </li>
            <li class="<?php if(Request::segment(1)=='my_tickets'){echo 'active';};?>">
                <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Support Ticket</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ URL::to('my_tickets')}}">My Ticket</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
