@extends('layouts.app')
@section('header')
<header> <!-- extra class no-background -->
  <a class="go-back-link" href="javascript:history.back();"><i class="fa fa-arrow-left"></i></a>
  <h1 class="page-title">Lastest Announcement</h1>
  <div class="navi-menu-button">
    <em></em>
    <em></em>
    <em></em>
  </div>
</header>

@endsection


@section('content')

<div class="dash-balance">
  <div class="dash-content relative">
    <h3 class="w-text">Latest News</h3>
    <div class="notification">
      <!-- <a href="#" class="search-button" data-search="open"><i class="fa fa-plus "></i></a> -->
    </div>
  </div>
</div>
<section class="bal-section container">
  <div class="balance-card mb-15">
    <div class="d-flex align-items-center">
                  <div class="d-flex flex-grow">
                    <div class="mr-auto">
                      <h1 class="b-val"> Official Announcement</h1>
                      <!-- <p class="g-text mb-10">My Referrals</p> -->
                      <!-- <div class="badge badge-pill"> 18.98% <i class="fa fa-arrow-up ml-10"></i></div> -->
                    </div>
                    <div class="ml-auto align-self-end">
                      <div id="sparkline1"></div>
                    </div>
                  </div>
               </div>
  </div>
</section>
 <announcement></announcement>
@endsection
