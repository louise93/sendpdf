@extends('layouts.app')
@section('header')
<header> <!-- extra class no-background -->
  <a class="go-back-link" href="javascript:history.back();"><i class="fa fa-arrow-left"></i></a>
  <h1 class="page-title">PORTFOLIO</h1>
  <div class="navi-menu-button">
    <em></em>
    <em></em>
    <em></em>
  </div>
</header>

@endsection
@section('notification')
<div class="search-form">
  <span class="close-search-form" data-search="close"><i class="fa fa-times"></i> </span>
  <form action="{{URL::to('genealogy/directsponsor')}}" method="POST" id="form">
    @csrf
    <div class="search-input">

      <input type="text" name="user_id" class="form-element" placeholder="Search Username/User ID/Email...">

          <div class="form-divider"></div>
      <button id="btn" type="submit" class="btn btn-info">Search</button>
    </div>

  </form>
</div>
@endsection

@section('content')
<div class="dash-balance">
  <div class="dash-content relative">
    <h3 class="w-text">Portfolio</h3>
    <div class="notification">
      <a href="#" class="btn btn-success btn-sm" data-search="open">Search</a>
    </div>
  </div>
</div>
<section class="bal-section container">
  <div class="balance-card mb-15">
    <div class="d-flex align-items-center">
                  <div class="d-flex flex-grow">
                    <div class="mr-auto">
                      <h1 class="b-val"> MY PORTFOLIO</h1>
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
        					<h4 class="title-main mt-5">Compounding</h4>
        					<ul class="transaction-list list-unstyled">
                    @if(count($compounding) > 0)
                    @foreach($compounding as $data)
        						<li>
        							<div class="d-flex align-items-center justify-content-between">
        	                          <div class="d-flex align-items-center">
        	                            <span class="member-img"><img src="{{ asset('Nandova/img/content/icons/2.png')}}" alt=""></span>
        	                            <div class="ml-10">
        	                              <h4 class="coin-name">Amount : {{ number_format($data->total_amount )}}</h4>
        	                              <small class="text-muted">Start Date : <span class="txt-turquoise"> {{ date('F d, Y',strtotime($data->month_start))}}</span> </small>
                                        <small class="text-muted">Expiry Date : <span class="txt-turquoise"> {{ date('F d, Y',strtotime($data->month_end))}}</span> </small>

                                      </div>
        	                          </div>
        	                          <div>
        	                            <small class="d-block mb-0 txt-yellow">
                                        <!-- <span class="txt-turquoise">
                                              <?php
                                                    for($i=0;$i< $data->package;$i++) {
                                               ?>
                                                <i class="fa fa-star"></i>
                                            <?php }  ?>
                                          </span> -->
                                        </small>
        	                            <small class="text-muted d-block"></small>
                                      </div>
        	                        </div>
        						</li>
                    @endforeach
                    @else
                    <li>
                      <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                      <!-- <span class="member-img"><img src="img/content/avatar/user-3.png" alt=""></span> -->
                                      <div class="ml-10">
                                        <h4 class="coin-name">No Portfolio found</h4>
                                        <!-- <small class="text-muted">Bonus <span class="txt-turquoise">$46,34</span> USD</small> -->
                                      </div>
                                    </div>
                                    <!-- <div>
                                      <small class="d-block mb-0 txt-green">-23.84523 <span class="text-muted">LTC</span></small>
                                      <small class="text-muted d-block">$1,493.03</small>
                                    </div> -->
                                  </div>
                    </li>
                    @endif
        					</ul>

        				</section>

@endsection
