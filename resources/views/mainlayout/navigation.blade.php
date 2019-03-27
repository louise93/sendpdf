<nav class="navbar-default navbar-static-side" role="navigation" >
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                  @if(Auth::user()->id_no =='')
                      <img alt="image" class="rounded-circle" src="{{ asset('img/profile_small.jpg')}}"/>
                      @else
                        <img alt="image" class="rounded-circle" width="50" height="50" src="{{ asset('img/')}}/{{Auth::user()->id_no}}"/>
                  @endif
                    <a  class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{Auth::user()->username}}</span>
                        <span class="text-muted text-xs block">Member <b class="caret"></b></span>
                    </a>
                </div>
                <div class="logo-element">
                    XINROX
                </div>
            </li>
            <li class="{{ isActiveRoute('dashboard')  }}">
                <a href="{{URL::to('dashboard')}}"><i class="fa fa-th-large text-info"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="<?php if(Request::segment(1)=='profile'){echo 'active';};?>">
                <a href="#"><i class="fa fa-user  text-info"></i> <span class="nav-label">Profile</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ isActiveRoute('profile/personalinfo')  }}"><a href="{{URL::to('profile/personalinfo')}}">Personal Info</a></li>
                    <li class="{{ isActiveRoute('profile/bankinfo')  }}"><a href="{{URL::to('profile/bankinfo')}}">Bank Info</a></li>
                    <li class="{{ isActiveRoute('profile/kyc')  }}"><a href="{{ URL::to('profile/kyc')}}">KYC Documents</a></li>
                    <li class="{{ isActiveRoute('profile/btcaddress')  }}"><a href="{{URL::to('profile/btcaddress')}}">Bitcoin Address </a></li>
                    <li class="{{ isActiveRoute('profile/password')  }}"><a href="{{URL::to('profile/password')}}">Password</a></li>
                    <li class="{{ isActiveRoute('profile/transactionpassword')  }}"><a href="{{URL::to('profile/transactionpassword')}}">Transaction Password</a></li>
                </ul>
            </li>
            <li class="<?php if(Request::segment(1)=='activation'){echo 'active';};?>">
                <a href="{{ URL::to('/activation') }}"><i class="fa fa-pie-chart  text-info"></i> <span class="nav-label">Package Upgrade</span>  </a>
            </li>
            <li class="<?php if(Request::segment(1)=='genealogy'){echo 'active';};?>">
                <a href="#"><i class="fa fa-sitemap  text-info"></i> <span class="nav-label">Genealogy</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ URL ::to('genealogy/register')}}">Registration</a></li>
                    <li><a href="{{ URL ::to('genealogy/directsponsor')}}">Direct Sponsor</a></li>
                    <li><a href="{{ URL ::to('genealogy/downlines')}}">Downlines</a></li>
                    <li><a href="{{ URL ::to('genealogy/sponsortree')}}">Sponsor Tree</a></li>
                    <li><a href="{{ URL ::to('genealogy/networktree')}}">Genealogy Tree</a></li>

                </ul>
            </li>
            <li class="<?php if(Request::segment(1)=='wallets'){echo 'active';};?>">
                <a href="#"><i class="fa fa-google-wallet  text-info"></i> <span class="nav-label">Wallet</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ URL::to('wallets/list')}}">My Wallets</a></li>
                    <li><a href="{{URL::to('wallets/history')}}">History</a></li>
                </ul>
            </li>
            <li class="<?php if(Request::segment(1)=='withdrawals'){echo 'active';};?>">
                <a href="#"><i class="fa fa-money  text-info"></i> <span class="nav-label">Withdrawals</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{URL::to('wallets/ewallet/withdraw')}}">Withdraw</a></li>
                    <li><a href="{{URL::to('withdrawals/open')}}">Pending Request</a></li>
                    <li><a href="{{URL::to('withdrawals/close')}}">Close Request</a></li>
                </ul>
            </li>
            <li class="<?php if(Request::segment(1)=='portfolio'){echo 'active';};?>">
                <a href="{{URL::to('portfolio')}}"><i class="fa fa-laptop  text-info"></i> <span class="nav-label">Active Portfolio</span></a>
            </li>
            <li class="<?php if(Request::segment(1)=='reports'){echo 'active';};?>">
                <a href="#"><i class="fa fa-list  text-info"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ URL::to('reports/incomes') }}">Income Reports</a></li>
                    <li><a href="{{ URL::to('reports/fundtransfer') }}">Fund Transfers </a></li>
                    <li><a href="{{ URL::to('reports/matchingpoints') }}">Matching Points </a></li>
                </ul>
            </li>
            <li class="<?php if(Request::segment(1)=='contacts'){echo 'active';};?>">
                <a href="{{ URL::to('/contacts') }}"><i class="fa fa-address-book  text-info"></i> <span class="nav-label">Contacts</span>  </a>
            </li>
            <!-- <li class="<?php if(Request::segment(1)=='chatroom'){echo 'active';};?>">
                <a href="{{ URL::to('/chatroom') }}"><i class="fa fa-comments"></i> <span class="nav-label">Chat Room</span>  </a>
            </li> -->
            <li class="<?php if(Request::segment(1)=='my_tickets'){echo 'active';};?>">
                <a href="#"><i class="fa fa-envelope  text-info"></i> <span class="nav-label">Support Ticket</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ URL::to('my_tickets')}}">My Ticket</a></li>
                </ul>
            </li>
            <li class="<?php if(Request::segment(1)=='tools'){echo 'active';};?>">
                <a href="{{ URL::to('/tools') }}"><i class="fa fa-file-pdf-o  text-info"></i> <span class="nav-label">Learning Tools</span>  </a>
            </li>
            <li class="<?php if(Request::segment(1)=='educational'){echo 'active';};?>">
                <a href="{{ URL::to('/educational') }}"><i class="fa fa-medium  text-info"></i> <span class="nav-label">Educational Materials</span>  </a>
            </li>
        </ul>

    </div>
</nav>
