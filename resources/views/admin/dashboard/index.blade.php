@extends('admin.layout.app')
@section('title', 'Dahboard')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
      <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-9">
              <h2>Dashboard</h2>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                      <a href="{{URL::to('/dashboard')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">
                      <strong>Summary</strong>
                  </li>
              </ol>
          </div>
          <div class="col-md-3">
              <!-- <h2>Referral Links</h2>
              <a href=""  data-clipboard-text="right" class="btn btn-success">Right</a>
              <a href="" data-clipboard-text="left" class="btn btn-success">Left</a> -->
          </div>
      </div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
      <div class="col-lg-3">
          <div class="widget style1">
                  <div class="row">
                      <div class="col-4 text-center">
                          <i class="fa fa-money fa-5x"></i>
                      </div>
                      <div class="col-8 text-right">
                          <span>All Packages </span>
                          <h2 class="font-bold">
                                {{number_format( DB::table('lifejacket_subscription')
                                                        ->sum('amount'),2)}}
                          </h2>
                      </div>
                  </div>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="widget style1 navy-bg">
              <div class="row">
                  <div class="col-4">
                      <i class="fa fa-users fa-5x"></i>
                  </div>
                  <div class="col-8 text-right">
                      <span> Number of Users </span>
                      <h2 class="font-bold">
                        {{number_format( DB::table('user_registration')
                                                ->count('id'))}}
                      </h2>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="widget style1 lazur-bg">
              <div class="row">
                  <div class="col-4">
                      <i class="fa fa-user fa-5x"></i>
                  </div>
                  <div class="col-8 text-right">
                      <span> Newly Registered </span>
                      <h2 class="font-bold">
                        {{number_format( DB::table('user_registration')
                                                ->where('registration_date',date('Y-m-d'))
                                                ->count('id'))}}
                      </h2>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-3">
          <div class="widget style1 yellow-bg">
              <div class="row">
                  <div class="col-4">
                      <i class="fa fa-money fa-5x"></i>
                  </div>
                  <div class="col-8 text-right">
                      <span> New Purchase</span>
                      <h2 class="font-bold">  {{number_format( DB::table('lifejacket_subscription')
                                                ->where('date',date('Y-m-d'))
                                                ->count('id'))}}</h2>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-4">
          <div class="widget style1 lazur-bg">
                  <div class="row">
                      <div class="col-4 text-center">
                          <i class="fa fa-credit-card fa-5x"></i>
                      </div>
                      <div class="col-8 text-right">
                          <span> Total Cash Payments </span>
                          <h2 class="font-bold">
                            {{ number_format(DB::table('lifejacket_subscription')->whereIn('pay_type',['E Wallet','R Wallet'])->sum('amount'),2)}}
                          </h2>
                      </div>
                  </div>
          </div>
      </div>
      <div class="col-lg-4">
          <div class="widget style1 navy-bg">
              <div class="row">
                  <div class="col-4">
                      <i class="fa fa-credit-card fa-5x"></i>
                  </div>
                  <div class="col-8 text-right">
                      <span> Virtual Wallet Payment</span>
                      <h2 class="font-bold">
                        {{ number_format(DB::table('lifejacket_subscription')->whereIn('pay_type',['Virtual Wallet','Virtual Wallet Payment'])->sum('amount'),2)}}

                      </h2>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-lg-4">
          <div class="widget style1 navy-bg">
              <div class="row">
                  <div class="col-4">
                      <i class="fa fa-credit-card fa-5x"></i>
                  </div>
                  <div class="col-8 text-right">
                      <span> Virtual Wallet + R Wallet Payment</span>
                      <h2 class="font-bold">
                        {{ number_format(DB::table('lifejacket_subscription')->whereIn('pay_type',['erWallet + virtualWallet'])->sum('amount'),2)}}
                      </h2>
                  </div>
              </div>
          </div>
      </div>
  </div>
      <div class="row">
          <div class="col-lg-2">
              <div class="widget style1 navy-bg">
                  <div class="row vertical-align">
                      <div class="col-3">
                          <i class="fa fa-users fa-3x"></i>
                      </div>
                      <div class="col-9 text-right">
                          <h2 class="font-bold">  {{ number_format(DB::table('user_registration')
                                                  ->where('ref_id', Auth::user()->user_id)
                                                  ->count('user_id')) }}</h2>
                          <small>Direct Members</small>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-2">
              <div class="widget style1 navy-bg">
                  <div class="row vertical-align">
                      <div class="col-3">
                          <i class="fa fa-users fa-3x"></i>
                      </div>
                      <div class="col-9 text-right">
                          <h2 class="font-bold">  {{ number_format( DB::table('level_income_binary')
                                                    ->where('income_id', Auth::user()->user_id)
                                                    ->where('leg','left')
                                                    ->count('down_id')) }}</h2>
                          <small>Left Members</small>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-2">
              <div class="widget style1 navy-bg">
                  <div class="row vertical-align">
                      <div class="col-3">
                          <i class="fa fa-users fa-3x"></i>
                      </div>
                      <div class="col-9 text-right">
                          <h2 class="font-bold">  {{ number_format(DB::table('level_income_binary')
                                                  ->where('income_id', Auth::user()->user_id)
                                                  ->where('leg','right')
                                                  ->count('down_id')) }}</h2>
                          <small>Right Members</small>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3">
              <div class="widget style1 lazur-bg">
                  <div class="row vertical-align">
                      <div class="col-3">
                          <i class="fa fa-trophy fa-3x"></i>
                      </div>
                      <div class="col-9 text-right">
                          <h2 class="font-bold">{{  number_format(DB::table('manage_bv_history')
                                                  ->where('income_id', Auth::user()->user_id)
                                                  ->where('position','left')
                                                  ->where('status','0')
                                                  ->sum('pair'))  }}</h2>
                          <small>Left Points</small>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3">
              <div class="widget style1 lazur-bg">
                  <div class="row vertical-align">
                      <div class="col-3">
                          <i class="fa fa-trophy fa-3x"></i>
                      </div>
                      <div class="col-9 text-right">
                          <h2 class="font-bold">{{ number_format(DB::table('manage_bv_history')
                                                ->where('income_id', Auth::user()->user_id)
                                                ->where('position','right')
                                                ->where('status','0')
                                                ->sum('pair'))}}</h2>
                          <small>Right Points</small>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  <div class="row">
      <div class="col-lg-6">
          <div class="ibox-content">
              <h2>QUICK LINKS</h2>
              <ul class="todo-list m-t">
                  <li>
                      <a href="{{URL::to('activation')}}">Acount Activation</a>
                  </li>
                  <li>
                      <a href="{{URL::to('wallets/ewallet/withdraw')}}">Withdrawal</a>
                  </li>
                  <li>
                      <a href="{{URL::to('wallets/list')}}">Wallets</a>
                  </li>
                  <li>
                      <a href="{{URL::to('genealogy/networktree')}}">Genealogy Tree</a>
                  </li>
                  <li>
                      <a href="{{URL::to('portfolio')}}">Portfolio</a>
                  </li>
                  <li>
                      <a href="{{URL::to('new_ticket')}}">Create Support Ticket</a>
                  </li>
              </ul>
          </div>
      </div>
      <div class="col-lg-6">
          <div class="ibox ">
              <div class="ibox-content">
                  <h2>E WALLET SUMMARY</h2>
                  <small>E Wallet Transaction Summary</small>
                  <ul class="todo-list m-t small-list">
                      <li>
                          <p>Total Commission Earned :</p>
                            <label>$ {{ number_format(DB::table('credit_debit')->where('user_id',Auth::user()->user_id)->where('ewallet_used_by','E Wallet')->sum('credit_amt'),2) }}</label>
                      </li>
                      <li>
                            <p>Total Cashout   :</p>
                            <label>$ {{ number_format(DB::table('withdraw_request')->where('user_id',Auth::user()->user_id)->where('status',1)->sum('total_paid_amount'),2) }}</label>
                      </li>
                      <li>
                            <p>Total Transferred To R Wallet :</p>
                            <label>$ {{ number_format(DB::table('credit_debit')->where('user_id',Auth::user()->user_id)->where('ttype','Fund Transfer')->sum('debit_amt'),2) }}</label>
                      </li>

                  </ul>
              </div>
          </div>
      </div>
  </div>

  </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
        var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

        var data1 = [
            { label: "Data 1", data: d1, color: '#17a084'},
            { label: "Data 2", data: d2, color: '#127e68' }
        ];
        $.plot($("#flot-chart1"), data1, {
            xaxis: {
                tickDecimals: 0
            },
            series: {
                lines: {
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 1
                        }, {
                            opacity: 1
                        }]
                    }
                },
                points: {
                    width: 0.1,
                    show: false
                }
            },
            grid: {
                show: false,
                borderWidth: 0
            },
            legend: {
                show: false
            }
        });

        var data2 = [
            { label: "Data 1", data: d1, color: '#19a0a1'}
        ];
        $.plot($("#flot-chart2"), data2, {
            xaxis: {
                tickDecimals: 0
            },
            series: {
                lines: {
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 1
                        }, {
                            opacity: 1
                        }]
                    }
                },
                points: {
                    width: 0.1,
                    show: false
                }
            },
            grid: {
                show: false,
                borderWidth: 0
            },
            legend: {
                show: false
            }
        });

        var data3 = [
            { label: "Data 1", data: d1, color: '#fbbe7b'},
            { label: "Data 2", data: d2, color: '#f8ac59' }
        ];
        $.plot($("#flot-chart3"), data3, {
            xaxis: {
                tickDecimals: 0
            },
            series: {
                lines: {
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 1
                        }, {
                            opacity: 1
                        }]
                    }
                },
                points: {
                    width: 0.1,
                    show: false
                }
            },
            grid: {
                show: false,
                borderWidth: 0
            },
            legend: {
                show: false
            }
        });

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

        $(".todo-list").sortable({
            placeholder: "sort-highlight",
            handle: ".handle",
            forcePlaceholderSize: true,
            zIndex: 999999
        }).disableSelection();

        var mapData = {
            "US": 498,
            "SA": 200,
            "CA": 1300,
            "DE": 220,
            "FR": 540,
            "CN": 120,
            "AU": 760,
            "BR": 550,
            "IN": 200,
            "GB": 120,
            "RU": 2000
        };

        $('#world-map').vectorMap({
            map: 'world_mill_en',
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: '#e4e4e4',
                    "fill-opacity": 1,
                    stroke: 'none',
                    "stroke-width": 0,
                    "stroke-opacity": 0
                }
            },
            series: {
                regions: [{
                    values: mapData,
                    scale: ["#1ab394", "#22d6b1"],
                    normalizeFunction: 'polynomial'
                }]
            }
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
<script>
$(function() {
  var clipboard = new ClipboardJS('.btn');
                clipboard.on('success', function(e) {
                    console.info('Action:', e.action);
                    console.info('Text:', e.text);
                    alert('Referral Link has been copied !');
                    console.info('Trigger:', e.trigger);
                    e.clearSelection();
                });

                clipboard.on('error', function(e) {
                    console.error('Action:', e.action);
                    console.error('Trigger:', e.trigger);
                });
});
</script>

@endsection
