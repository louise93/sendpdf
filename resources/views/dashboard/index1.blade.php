@extends('mainlayout.app')

@section('title', 'Main page')
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row  border-bottom white-bg ">

          <div class="col-md-3">
              <h2>Welcome {{Auth::user()->username}}</h2>
              <small>Your Downlines</small>
              <ul class="list-group clear-list m-t">
                  <li class="list-group-item fist-item">
                      <span class="float-right">
                          {{ number_format(DB::table('user_registration')
                                                ->where('ref_id', Auth::user()->user_id)
                                                ->count('user_id')) }}
                      </span>
                      <span class="label label-success">1</span>Direct Members
                  </li>
                  <li class="list-group-item">
                      <span class="float-right">
                          {{ number_format(DB::table('level_income_binary')
                                                ->where('income_id', Auth::user()->user_id)
                                                ->where('leg','right')
                                                ->count('down_id')) }}
                          </span>
                      <span class="label label-info">2</span> Right Members
                  </li>
                  <li class="list-group-item">
                      <span class="float-right">
                          {{ number_format( DB::table('level_income_binary')
                                                  ->where('income_id', Auth::user()->user_id)
                                                  ->where('leg','left')
                                                  ->count('down_id')) }}

                      </span>
                      <span class="label label-primary">3</span> Left Members
                  </li>
                  <li class="list-group-item fist-item">
                      <span class="float-right">
                        {{ number_format(DB::table('manage_bv_history')
                                              ->where('income_id', Auth::user()->user_id)
                                              ->where('position','right')
                                              ->where('status','0')
                                              ->sum('pair'))}}
                      </span>
                      <span class="label label-success">4</span>Right Points
                  </li>
                  <li class="list-group-item">
                      <span class="float-right">
                          {{  number_format(DB::table('manage_bv_history')
                                                  ->where('income_id', Auth::user()->user_id)
                                                  ->where('position','left')
                                                  ->where('status','0')
                                                  ->sum('pair'))  }}
                      </span>
                      <span class="label label-info">5</span> Left Points
                  </li>

                  <!-- <li class="list-group-item">
                      <span class="float-right">
                          12:00 am
                      </span>
                      <span class="label label-primary">5</span> Write a letter to Sandra
                  </li> -->
              </ul>
          </div>
          <div class="col-md-9">
              <div class="flot-chart dashboard-chart">
                  <div class="flot-chart-content" id="flot-dashboard-chart"></div>
              </div>
              <div class="row text-left">
                <div class="col">
                    <div class=" m-l-md">
                    <span class="h5 font-bold m-t block">$ {{number_format( DB::table('credit_debit')
                                                ->where('user_id', Auth::user()->user_id)
                                                ->whereIn('ttype',['Binary Income','Leadership Income','Promotional Income','Profit Share Income','Turnover Income','Referral Income'])
                                                ->sum('credit_amt'),2)}}</span>
                    <small class="text-muted m-b block">Total Income</small>
                    </div>
                </div>
                  <div class="col">
                      <div class=" m-l-md">
                      <span class="h5 font-bold m-t block">$ {{ number_format(DB::table('credit_debit')
                                            ->where('user_id', Auth::user()->user_id)
                                            ->where('ttype','Referral Income')
                                            ->sum('credit_amt'),2) }}</span>
                      <small class="text-muted m-b block">Direct Income</small>
                      </div>
                  </div>
                  <div class="col">
                      <span class="h5 font-bold m-t block">$ {{ number_format(DB::table('credit_debit')
                                            ->where('user_id', Auth::user()->user_id)
                                            ->where('ttype','Binary Income')
                                            ->sum('credit_amt'),2) }}</span>
                      <small class="text-muted m-b block">Matching Income</small>
                  </div>
                  <div class="col">
                      <span class="h5 font-bold m-t block">$ {{ number_format(DB::table('credit_debit')
                                             ->where('user_id', Auth::user()->user_id)
                                             ->where('ttype','Profit Share Income')
                                             ->sum('credit_amt'),2) }}</span>
                      <small class="text-muted m-b block">Profit Share Income</small>
                  </div>

              </div>
          </div>
  </div>
  <hr>
      <div class="row">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <!-- <span class="label label-success float-right">Monthly</span> -->
                        <h5>E Wallet   </h5>
                    </div>
                    <div class="ibox-content">

                        <h1 class="no-margins">  $ {{ number_format(DB::table('final_e_wallet')->where('user_id',Auth::user()->user_id)->first(['amount'])->amount,2)}}</h1>
                        <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                        <small>Total views</small> -->

                        <span class="fa fa-money  pull-right"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <!-- <span class="label label-info float-right">Annual</span> -->
                        <h5>R Wallet</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">  $ {{ number_format(DB::table('final_r_wallet')->where('user_id',Auth::user()->user_id)->first(['amount'])->amount,2)}}
            </h1>
                <span class="fa fa-money  pull-right"></span>
                        <!-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                        <small>New orders</small> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">

                        <h5>Forex Wallet</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">  $ {{ number_format(DB::table('final_forex_wallet')->where('user_id',Auth::user()->user_id)->first(['amount'])->amount,2)}}
                  </h1>
                      <span class="fa fa-money  pull-right"></span>
                        <!-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                        <small>New orders</small> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">

                        <h5>Virtual Wallet</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">  $ {{ number_format(DB::table('final_apin_wallet')->where('user_id',Auth::user()->user_id)->first(['amount'])->amount,2)}}
                </h1>
                    <span class="fa fa-money  pull-right"></span>
                        <!-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                        <small>New orders</small> -->
                    </div>
                </div>
            </div>


        </div>

  <hr>

  <div class="row">
            <div class="col-lg-4">
                  <div class="ibox ">
                      <div class="ibox-title">
                                    <h5>Your daily feed</h5>
                                            <span class="label label-warning-light float-right">10 Messages</span>
                                    </div>
                                    <div class="ibox-content">

                                        <div>
                                            <div class="feed-activity-list">

                                                <div class="feed-element">
                                                    <a class="float-left" href="profile.html">
                                                        <img alt="image" class="rounded-circle" src="img/profile.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="float-right">5m ago</small>
                                                        <strong>Monica Smith</strong> posted a new blog. <br>
                                                        <small class="text-muted">Today 5:60 pm - 12.06.2014</small>

                                                    </div>
                                                </div>

                                                <div class="feed-element">
                                                    <a class="float-left" href="profile.html">
                                                        <img alt="image" class="rounded-circle" src="img/a2.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="float-right">2h ago</small>
                                                        <strong>Mark Johnson</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                                        <small class="text-muted">Today 2:10 pm - 12.06.2014</small>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a class="float-left" href="profile.html">
                                                        <img alt="image" class="rounded-circle" src="img/a3.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="float-right">2h ago</small>
                                                        <strong>Janet Rosowski</strong> add 1 photo on <strong>Monica Smith</strong>. <br>
                                                        <small class="text-muted">2 days ago at 8:30am</small>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a class="float-left" href="profile.html">
                                                        <img alt="image" class="rounded-circle" src="img/a4.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="float-right text-navy">5h ago</small>
                                                        <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                                        <div class="actions">
                                                            <a href="" class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                                            <a href="" class="btn btn-xs btn-white"><i class="fa fa-heart"></i> Love</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a class="float-left" href="profile.html">
                                                        <img alt="image" class="rounded-circle" src="img/a5.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="float-right">2h ago</small>
                                                        <strong>Kim Smith</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                                        <small class="text-muted">Yesterday 5:20 pm - 12.06.2014</small>
                                                        <div class="well">
                                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                                            Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                        </div>
                                                        <div class="float-right">
                                                            <a href="" class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a class="float-left" href="profile.html">
                                                        <img alt="image" class="rounded-circle" src="img/profile.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="float-right">23h ago</small>
                                                        <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a class="float-left" href="profile.html">
                                                        <img alt="image" class="rounded-circle" src="img/a7.jpg">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="float-right">46h ago</small>
                                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-primary btn-block m-t"><i class="fa fa-arrow-down"></i> Show More</button>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        <div class="col-lg-8">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Announcement </h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link" href="">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#" class="dropdown-item">Config option 1</a>
                                            </li>
                                            <li><a href="#" class="dropdown-item">Config option 2</a>
                                            </li>
                                        </ul>
                                        <a class="close-link" href="">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content ibox-heading">
                                    <h3>You have meeting today!</h3>
                                    <small><i class="fa fa-map-marker"></i> Meeting is on 6:00am. Check your schedule to see detail.</small>
                                </div>
                                <div class="ibox-content inspinia-timeline">




                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-4 date">
                                                <i class="fa fa-phone"></i>
                                                11:00 am
                                                <br>
                                                <small class="text-navy">21 hour ago</small>
                                            </div>
                                            <div class="col content">
                                                <p class="m-b-xs"><strong>Phone with Jeronimo</strong></p>
                                                <p>
                                                    Lorem Ipsum has been the industry's standard dummy text ever since.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-4 date">
                                                <i class="fa fa-user-md"></i>
                                                09:00 pm
                                                <br>
                                                <small>21 hour ago</small>
                                            </div>
                                            <div class="col content">
                                                <p class="m-b-xs"><strong>Go to the doctor dr Smith</strong></p>
                                                <p>
                                                    Find some issue and go to doctor.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-4 date">
                                                <i class="fa fa-comments"></i>
                                                12:50 pm
                                                <br>
                                                <small class="text-navy">48 hour ago</small>
                                            </div>
                                            <div class="col content">
                                                <p class="m-b-xs"><strong>Chat with Monica and Sandra</strong></p>
                                                <p>
                                                    Web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        </div>
</div>
@endsection
