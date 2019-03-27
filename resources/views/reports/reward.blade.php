@extends('layouts.app')
@section('header')
<header class="no-background"> <!-- extra class no-background -->

  <div class="search-button" data-search="open">
    <img src="{{ asset('Nandova/img/content/notification1.png')}}" class="not-icon1" alt="">
    <img src="{{ asset('Nandova/img/content/notification2.png')}}" class="not-icon2" alt="">
  </div>

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
    <h3 class="w-text">Reports</h3>
    <div class="notification">
      <a href=""><i class="fa fa-plus"></i></a>
    </div>
  </div>
</div>
<section class="bal-section container">
  <div class="balance-card mb-15">
    <div class="d-flex align-items-center">
                  <div class="d-flex flex-grow">
                    <div class="mr-auto">
                      <h1 class="b-val"> My Reward Points</h1>
                      <p class="g-text mb-10"></p>
                      <!-- <div class="badge badge-pill"> 18.98% <i class="fa fa-arrow-up ml-10"></i></div> -->
                    </div>
                    <div class="ml-auto align-self-end">
                      <div id="sparkline1"></div>
                    </div>
                  </div>
               </div>
  </div>
</section>
<section class="container">
  <h4 class="title-main"> Income History</h4>
  <ul class="transaction-list list-unstyled">

    @foreach($reward as $data)
    <li>
      <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <!-- <img class="img-xs" src="img/content/coin1.png" alt="coin image"> -->
                      <div class="ml-10">
                        <h4 class="coin-name">Commission : ${{ number_format($data->credit_amt,2)}}</h4>
                        <small class="text-muted">{{ date('F d, Y', strtotime($data->receive_date)) }}</small>
                      </div>
                    </div>
                    <div>
                      <small class="d-block mb-0 txt-green">+ ${{ number_format($data->credit_amt,2)}}</small>
                      <small class="text-muted d-block"> Wallet : {{ $data->ewallet_used_by }}</small>
                    </div>
                  </div>
    </li>
    @endforeach
  </ul>

    {{ $reward->links() }}
</section>

@endsection
