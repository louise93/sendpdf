<div class="nav-menu">
  <nav class="menu">
    <!-- Menu navigation start -->
    <div class="nav-container">
      <ul class="main-menu">
        <li class="">
          <a href="{{ route('dashboard')}}" data-loader="show"><img src="{{ asset('Nandova/img/content/icons/1.png')}}" alt=""><strong>Dashboard</strong> </a>
        </li>
        <li class="">
          <a href="{{ URL::to('announcement') }}" data-loader="show"><img src="{{ asset('Nandova/img/content/icons/11.png')}}" alt=""><strong>Announcment</strong> </a>
        </li>
        <li>
          <a href="javascript:void(0);"><img src="{{ asset('Nandova/img/content/icons/5.png')}}" alt=""> <strong>Profile</strong> <span class="fa fa-angle-down"></span></a>
          <ul>
            <li><a href="{{ URL::to('/profile/account')}}" data-loader="show">Personal Info</a></li>
            <!-- <li><a href="" data-loader="show">KYC Documents</a></li> -->
            <li><a href="{{URL::to('/profile/bankinfo')}}" data-loader="show">Bank Info</a></li>
            <li><a href="{{URL::to('/profile/wallet')}}" data-loader="show">Wallet Address</a></li>
            <li><a href="{{URL::to('/profile/password')}}" data-loader="show">Password</a></li>
            <li><a href="{{URL::to('/profile/transactionpassword')}}" data-loader="show">Transaction Password</a></li>
          </ul>
        </li>
        <!-- <li class="">
          <a href="{{ URL::to('/myaccounts')}}" data-loader="show"><img src="{{ asset('Nandova/img/content/icons/12.png')}}" alt=""><strong>Accounts</strong> </a>
        </li> -->
        <li class="">
          <a href="{{ URL::to('/packages')}}" data-loader="show"><img src="{{ asset('Nandova/img/content/icons/15.png')}}" alt=""><strong>Xinrox Packages</strong> </a>
        </li>
        <li class="">
          <a href="{{URL::to('/affiliates')}}" data-loader="show"><img src="{{ asset('Nandova/img/content/icons/4.png')}}" alt=""><strong>Affiliate System</strong> </a>
        </li>
        <li>
          <a href="javascript:void(0);" ><img src="{{ asset('Nandova/img/content/icons/15.png')}}" alt=""> <strong>Genealogy</strong> <span class="fa fa-angle-down"></span></a>
          <ul>
            <li><a href="{{ URL::to('/genealogy/directsponsor') }}" data-loader="show">Direct Referrals</a></li>
            <li><a href="{{ URL::to('/genealogy/downlines') }}" data-loader="show">Dowline Members</a></li>
            <li><a href="{{ URL::to('/genealogy/sponsortree') }}" data-loader="show">Sponsor Tree</a></li>
            <li><a href="{{ URL::to('/genealogy/networktree') }}" data-loader="show">Network Tree</a></li>
            <li><a href="{{ URL::to('/genealogy/registration') }}" data-loader="show">Registration</a></li>
          </ul>
        </li>
        <li>
          <a href="javascript:void(0);"><img src="{{ asset('Nandova/img/content/icons/2.png')}}" alt=""> <strong>My Wallet</strong> <span class="fa fa-angle-down"></span></a>
          <ul>
            <li><a href="{{ URL::to('balances') }}" data-loader="show">Wallet Balances</a></li>
            <li><a href="{{ URL::to('internaltransfer') }}" data-loader="show">Internal Wallet Transfer</a></li>
            <li><a href="{{ URL::to('externaltransfer') }}" data-loader="show">External Wallet Transfer</a></li>
          </ul>
        </li>
        <li class="">
          <a href="{{URL::to('withdrawals')}}" data-loader="show"><img src="{{ asset('Nandova/img/content/icons/7.png')}}" alt=""><strong>Withdrawals</strong> </a>
        </li>

        <li>
          <a href="javascript:void(0);"><img src="{{ asset('Nandova/img/content/icons/8.png')}}" alt=""> <strong>Portofolio</strong> <span class="fa fa-angle-down"></span></a>
          <ul>
            <li><a href="{{ URL::to('/portfolio') }}" data-loader="show">My Investment</a></li>
            <li><a href="{{ URL::to('/compounding') }}" data-loader="show">My  Compounding Portofolio</a></li>
          </ul>
        </li>
        <li>
          <a href="#"><img src="{{ asset('Nandova/img/content/icons/4.png')}}" alt=""><strong> Reports</strong> <span class="fa fa-angle-down"></span></a>
          <ul>
            <li><a href="{{URL::to('sponsorincome')}}" data-loader="show">Sponsor Income</a></li>
            <li><a href="{{URL::to('matchingincome')}}" data-loader="show">Matching Income</a></li>
            <li><a href="{{URL::to('leadershipincome')}}" data-loader="show">Leadership Income</a></li>
            <li><a href="{{URL::to('profitshareincome')}}" data-loader="show">Profit Share Income</a></li>
            <li><a href="{{URL::to('promotionalincome')}}" data-loader="show">Top Referrer Bonus</a></li>
            <li><a href="{{URL::to('poolbonus')}}" data-loader="show">Pool Bonus</a></li>
            <li><a href="{{URL::to('rewardpoints')}}" data-loader="show">Reward Points</a></li>
            <li><a href="{{URL::to('matchingpoints')}}" data-loader="show">Matching Points</a></li>
          </ul>
        </li>
        <!-- <li class="">
          <a href="setting.html" data-loader="show"><img src="{{ asset('Nandova/img/content/icons/7.png')}}" alt=""><strong>Transaction History</strong> </a>
        </li> -->
        <!-- <li class="">
          <a href="setting.html" data-loader="show"><img src="{{ asset('Nandova/img/content/icons/10.png')}}" alt=""><strong>Learning Tools</strong> </a>
        </li> -->
        <li class="">
          <a href="{{ route('logout') }}" data-loader="show" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><img src="{{ asset('Nandova/img/content/icons/13.png')}}" alt=""><strong> Logout</strong></a>
        </li>
      </ul>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
  <!-- Menu navigation end -->
  </nav>
</div>
