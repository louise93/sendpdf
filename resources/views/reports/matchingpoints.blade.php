
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
                      <h1 class="b-val"> MY Matching Points</h1>
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
					<h4 class="title-main mt-5"> Matching Points List</h4>
					<ul class="transaction-list list-unstyled">
            @if(count($matchingpoints) > 0)
            @foreach($matchingpoints as $data)
						<li>
							<div class="d-flex align-items-center justify-content-between">
	                          <div class="d-flex align-items-center">
	                            <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span>
	                            <div class="ml-10">
	                              <h4 class="coin-name">Member ID : {{ $data->downline_id }}</h4>
	                              <small class="text-muted">Username : <span class="txt-turquoise">{{ DB::table('user_registration')->where('user_id',$data->downline_id)->first(['username'])->username}}</span> </small>

                                <small class="text-muted d-block">Level : {{ $data->level }} </small>
	                            </div>
	                          </div>
	                          <div>
	                            <small class="text-muted d-block">Points : {{ $data->pair }}</small>
                               <small class="text-muted d-block">Position : {{ strtoupper($data->position)}} </small>
                                <small class="text-muted d-block">status :

                                    @if($data->status==0)
                                        Unpaid
                                    @else

                                        Paid
                                    @endif

                                 </small>
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
                                <h4 class="coin-name">No Matching points found</h4>
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
          {{ $matchingpoints->links() }}
				</section>
        <div class="form-divider"></div>
@endsection
