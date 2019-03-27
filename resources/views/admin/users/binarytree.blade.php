
@extends('admin.layout.app')
@section('title', 'GENEALOGY')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>GENEALOGY</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">GENEALOGY</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>TREE</a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                </div>
      </div>
    <div class="wrapper wrapper-content animated fadeInRight ">

                    <div class="ibox-content table-responsive">

                        <div class="tree " >
                            <ul>
                              <li >


                                @if($user_id == Auth::user()->user_id)
                                <a href="#" data-toggle="popover" data-trigger="hover" title="Account : {{Auth::user()->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                    <tr>
                                      <td class="text-right"><?php echo left_member_count(Auth::user()->user_id); ?></td>
                                      <td>Downline</td>
                                      <td class="text-left"><?php echo right_member_count(Auth::user()->user_id); ?></td>
                                    </tr>
                                    <tr>
                                      <td class="text-right"><?php echo left_bv_count(Auth::user()->user_id); ?></td>
                                      <td>All</td>
                                      <td class="text-left"><?php echo right_bv_count(Auth::user()->user_id); ?></td>
                                    </tr>
                                    <tr>
                                      <td class="text-right"><?php echo left_carry_count(Auth::user()->user_id); ?></td>
                                      <td>PWCF</td>
                                      <td class="text-left"><?php echo right_carry_count(Auth::user()->user_id); ?></td>
                                    </tr>
                                    <tr>
                                      <td class="text-right"><?php echo left_bv_count_week(Auth::user()->user_id); ?></td>
                                      <td>This Week</td>
                                      <td class="text-left"><?php echo right_bv_count_week(Auth::user()->user_id); ?></td>
                                    </tr>
                                    <tr>
                                      <td class="text-right"><?php echo left_bv_count_today(Auth::user()->user_id); ?></td>
                                      <td>Today</td>
                                      <td class="text-left"><?php echo right_bv_count_today(Auth::user()->user_id); ?></td>
                                    </tr>
                                  </table>'>
                                      <table>
                                        <tr valign="center">
                                            <td align="rignt"> <center>
                                              <span class="member-img">

                                                <img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                        </tr>
                                        <tr>
                                            <td>{{ Auth::user()->username }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ date('M d, Y',strtotime(Auth::user()->registration_date)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                              PV - {{DB::table('lifejacket_subscription')->where('user_id',$user_id)->sum('amount')}}
                                            </td>
                                        </tr>
                                      </table>
                                  @else
                                  <a href="#" data-toggle="popover" data-trigger="hover" title="Account : {{$user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                      <tr>
                                        <td class="text-right"><?php echo left_member_count($user_id); ?></td>
                                        <td>Downline</td>
                                        <td class="text-left"><?php echo right_member_count($user_id); ?></td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><?php echo left_bv_count($user_id); ?></td>
                                        <td>All</td>
                                        <td class="text-left"><?php echo right_bv_count($user_id); ?></td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><?php echo left_carry_count($user_id); ?></td>
                                        <td>PWCF</td>
                                        <td class="text-left"><?php echo right_carry_count($user_id); ?></td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><?php echo left_bv_count_week($user_id); ?></td>
                                        <td>This Week</td>
                                        <td class="text-left"><?php echo right_bv_count_week($user_id); ?></td>
                                      </tr>
                                      <tr>
                                        <td class="text-right"><?php echo left_bv_count_today($user_id); ?></td>
                                        <td>Today</td>
                                        <td class="text-left"><?php echo right_bv_count_today($user_id); ?></td>
                                      </tr>
                                    </table>'>
                                      <table>
                                        <tr>
                                            <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                        </tr>
                                        <tr>
                                            <td>{{ DB::table('user_registration')->where('user_id',$user_id)->first(['username'])->username}}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ date('M d, Y',strtotime(DB::table('user_registration')->where('user_id',$user_id)->first(['registration_date'])->registration_date))}}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                              PV - {{DB::table('lifejacket_subscription')->where('user_id',$user_id)->sum('amount')}}
                                            </td>

                                         </tr>
                                      </table>
                                  @endif
                                </a>
                                <ul>
                                    <li>
                                      @if($user1)
                                        <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user1->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user1->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                            <tr>
                                              <td class="text-right"><?php echo left_member_count($user1->user_id); ?></td>
                                              <td>Downline</td>
                                              <td class="text-left"><?php echo right_member_count($user1->user_id); ?></td>
                                            </tr>
                                            <tr>
                                              <td class="text-right"><?php echo left_bv_count($user1->user_id); ?></td>
                                              <td>All</td>
                                              <td class="text-left"><?php echo right_bv_count($user1->user_id); ?></td>
                                            </tr>
                                            <tr>
                                              <td class="text-right"><?php echo left_carry_count($user1->user_id); ?></td>
                                              <td>PWCF</td>
                                              <td class="text-left"><?php echo right_carry_count($user1->user_id); ?></td>
                                            </tr>
                                            <tr>
                                              <td class="text-right"><?php echo left_bv_count_week($user1->user_id); ?></td>
                                              <td>This Week</td>
                                              <td class="text-left"><?php echo right_bv_count_week($user1->user_id); ?></td>
                                            </tr>
                                            <tr>
                                              <td class="text-right"><?php echo left_bv_count_today($user1->user_id); ?></td>
                                              <td>Today</td>
                                              <td class="text-left"><?php echo right_bv_count_today($user1->user_id); ?></td>
                                            </tr>
                                          </table>' >
                                          @else
                                              @if($user_id !=''  && empty($user1))
                                                      <a  href="{{URL::to('/genealogy/register/')}}/{{$user_id}}/{{ Auth::user()->user_id }}/left" >
                                              @else

                                              @endif
                                          @endif

                                          <table>
                                            <tr>
                                                <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                            </tr>
                                            <tr>
                                                <td>@if($user1){{ $user1->username}}
                                                  @else

                                                    <br>

                                                   @endif</td>
                                            </tr>
                                            <tr>
                                                <td>@if($user1){{ date('M d, Y',strtotime($user1->registration_date))}}

                                                  @else

                                                    <br>
                                                   @endif</td>
                                            </tr>
                                            <tr>
                                                <td> @if($user1)
                                                  PV - {{DB::table('lifejacket_subscription')->where('user_id',$user1->user_id)->sum('amount')}}


                                                    @else
                                                      Open
                                                    @endif
                                                </td>

                                                  </tr>
                                          </table>

                                        </a>
                                        <ul >
                                             <li >
                                               @if($user2)
                                                  <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user2->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user2->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                      <tr>
                                                        <td class="text-right"><?php echo left_member_count($user2->user_id); ?></td>
                                                        <td>Downline</td>
                                                        <td class="text-left"><?php echo right_member_count($user2->user_id); ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td class="text-right"><?php echo left_bv_count($user2->user_id); ?></td>
                                                        <td>All</td>
                                                        <td class="text-left"><?php echo right_bv_count($user2->user_id); ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td class="text-right"><?php echo left_carry_count($user2->user_id); ?></td>
                                                        <td>PWCF</td>
                                                        <td class="text-left"><?php echo right_carry_count($user2->user_id); ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td class="text-right"><?php echo left_bv_count_week($user2->user_id); ?></td>
                                                        <td>This Week</td>
                                                        <td class="text-left"><?php echo right_bv_count_week($user2->user_id); ?></td>
                                                      </tr>
                                                      <tr>
                                                        <td class="text-right"><?php echo left_bv_count_today($user2->user_id); ?></td>
                                                        <td>Today</td>
                                                        <td class="text-left"><?php echo right_bv_count_today($user2->user_id); ?></td>
                                                      </tr>
                                                    </table>' >
                                                 @else
                                                  @if($info1 > 0 && empty($user2))
                                                     <a  href="{{URL::to('/genealogy/register/')}}/{{$info1}}/{{Auth::user()->user_id}}/left" >
                                                    @else
                                                        <a  href="#" >
                                                  @endif
                                                 @endif
                                               <table>
                                                 <tr>
                                                     <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                 </tr>
                                                 <tr>
                                                     <td>@if($user2){{ $user2->username}}
                                                       @else

                                                         <br>
                                                       @endif</td>
                                                 </tr>
                                                 <tr>
                                                     <td>@if($user2){{ date('M d, Y',strtotime($user2->registration_date))}}

                                                        @else

                                                          <br>
                                                       @endif


                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td> @if($user2)
                                                       PV - {{DB::table('lifejacket_subscription')->where('user_id',$user2->user_id)->sum('amount')}}


                                                         @else
                                                          Open
                                                         @endif
                                                     </td>

                                                  </tr>
                                               </table>

                                             </a>
                                                <ul>
                                                    <li >
                                                          @if($user3)
                                                             <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user3->user_id}}"  data-toggle="popover" data-trigger="hover" title="Account : {{$user3->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                                 <tr>
                                                                   <td class="text-right"><?php echo left_member_count($user3->user_id); ?></td>
                                                                   <td>Downline</td>
                                                                   <td class="text-left"><?php echo right_member_count($user3->user_id); ?></td>
                                                                 </tr>
                                                                 <tr>
                                                                   <td class="text-right"><?php echo left_bv_count($user3->user_id); ?></td>
                                                                   <td>All</td>
                                                                   <td class="text-left"><?php echo right_bv_count($user3->user_id); ?></td>
                                                                 </tr>
                                                                 <tr>
                                                                   <td class="text-right"><?php echo left_carry_count($user3->user_id); ?></td>
                                                                   <td>PWCF</td>
                                                                   <td class="text-left"><?php echo right_carry_count($user3->user_id); ?></td>
                                                                 </tr>
                                                                 <tr>
                                                                   <td class="text-right"><?php echo left_bv_count_week($user3->user_id); ?></td>
                                                                   <td>This Week</td>
                                                                   <td class="text-left"><?php echo right_bv_count_week($user3->user_id); ?></td>
                                                                 </tr>
                                                                 <tr>
                                                                   <td class="text-right"><?php echo left_bv_count_today($user3->user_id); ?></td>
                                                                   <td>Today</td>
                                                                   <td class="text-left"><?php echo right_bv_count_today($user3->user_id); ?></td>
                                                                 </tr>
                                                               </table>'>
                                                            @else
                                                             @if($info2 > 0 && empty($user3))
                                                                <a  href="{{URL::to('/genealogy/register/')}}/{{$info2}}/{{Auth::user()->user_id}}/left" >
                                                               @else
                                                                   <a  href="#" >
                                                             @endif
                                                            @endif
                                                          <table>
                                                            <tr>
                                                                <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                            </tr>
                                                            <tr>
                                                                <td>@if($user3){{ $user3->username}}
                                                                  @else

                                                                    <br>

                                                                   @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@if($user3){{ date('M d, Y',strtotime($user3->registration_date))}}
                                                                  @else

                                                                    <br>
                                                                  @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td> @if($user3)
                                                                  PV - {{DB::table('lifejacket_subscription')->where('user_id',$user3->user_id)->sum('amount')}}


                                                                    @else
                                                                      Open
                                                                    @endif
                                                                </td>
                                                             </tr>
                                                          </table>
                                                        </a>
                                                    </li>
                                                    <li >
                                                          @if($user4)
                                                             <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user4->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user4->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                                 <tr>
                                                                   <td class="text-right"><?php echo left_member_count($user4->user_id); ?></td>
                                                                   <td>Downline</td>
                                                                   <td class="text-left"><?php echo right_member_count($user4->user_id); ?></td>
                                                                 </tr>
                                                                 <tr>
                                                                   <td class="text-right"><?php echo left_bv_count($user4->user_id); ?></td>
                                                                   <td>All</td>
                                                                   <td class="text-left"><?php echo right_bv_count($user4->user_id); ?></td>
                                                                 </tr>
                                                                 <tr>
                                                                   <td class="text-right"><?php echo left_carry_count($user4->user_id); ?></td>
                                                                   <td>PWCF</td>
                                                                   <td class="text-left"><?php echo right_carry_count($user4->user_id); ?></td>
                                                                 </tr>
                                                                 <tr>
                                                                   <td class="text-right"><?php echo left_bv_count_week($user4->user_id); ?></td>
                                                                   <td>This Week</td>
                                                                   <td class="text-left"><?php echo right_bv_count_week($user4->user_id); ?></td>
                                                                 </tr>
                                                                 <tr>
                                                                   <td class="text-right"><?php echo left_bv_count_today($user4->user_id); ?></td>
                                                                   <td>Today</td>
                                                                   <td class="text-left"><?php echo right_bv_count_today($user4->user_id); ?></td>
                                                                 </tr>
                                                               </table>'>
                                                            @else
                                                             @if($info2 > 0 && empty($user4))
                                                               <a  href="#" >
                                                                <!-- <a  href="{{URL::to('/genealogy/register/')}}/{{$info2}}/{{Auth::user()->user_id}}/right" > -->
                                                               @else
                                                                   <a  href="#" >
                                                             @endif
                                                            @endif
                                                          <table>
                                                            <tr>
                                                                <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                            </tr>
                                                            <tr>
                                                                <td>@if($user4){{ $user4->username}}
                                                                  @else

                                                                    <br>

                                                                   @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@if($user4){{ date('M d, Y',strtotime($user4->registration_date))}}

                                                                  @else

                                                                    <br>
                                                                  @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@if($user4)
                                                                  PV - {{DB::table('lifejacket_subscription')->where('user_id',$user4->user_id)->sum('amount')}}


                                                                    @else
                                                                      Open

                                                                    @endif
                                                                </td>

                                                             </tr>
                                                          </table>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>

                                                  @if($user5)
                                                     <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user5->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user5->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                         <tr>
                                                           <td class="text-right"><?php echo left_member_count($user5->user_id); ?></td>
                                                           <td>Downline</td>
                                                           <td class="text-left"><?php echo right_member_count($user5->user_id); ?></td>
                                                         </tr>
                                                         <tr>
                                                           <td class="text-right"><?php echo left_bv_count($user5->user_id); ?></td>
                                                           <td>All</td>
                                                           <td class="text-left"><?php echo right_bv_count($user5->user_id); ?></td>
                                                         </tr>
                                                         <tr>
                                                           <td class="text-right"><?php echo left_carry_count($user5->user_id); ?></td>
                                                           <td>PWCF</td>
                                                           <td class="text-left"><?php echo right_carry_count($user5->user_id); ?></td>
                                                         </tr>
                                                         <tr>
                                                           <td class="text-right"><?php echo left_bv_count_week($user5->user_id); ?></td>
                                                           <td>This Week</td>
                                                           <td class="text-left"><?php echo right_bv_count_week($user5->user_id); ?></td>
                                                         </tr>
                                                         <tr>
                                                           <td class="text-right"><?php echo left_bv_count_today($user5->user_id); ?></td>
                                                           <td>Today</td>
                                                           <td class="text-left"><?php echo right_bv_count_today($user5->user_id); ?></td>
                                                         </tr>
                                                       </table>'>
                                                    @else
                                                     @if($info1 > 0 && empty($user5))
                                                         <a  href="#" >
                                                        <!-- <a  href="{{URL::to('/genealogy/register/')}}/{{$info1}}/{{Auth::user()->user_id}}/right" > -->
                                                       @else
                                                           <a  href="#" >
                                                     @endif
                                                    @endif

                                              <table>
                                                <tr>
                                                    <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                </tr>
                                                <tr>
                                                    <td>@if($user5){{ $user5->username}}
                                                      @else

                                                        <br>
                                                       @endif</td>
                                                </tr>
                                                <tr>
                                                    <td>@if($user5){{ date('M d, Y',strtotime($user5->registration_date))}}
                                                      @else

                                                        <br>
                                                      @endif</td>
                                                </tr>
                                                <tr>
                                                    <td> @if($user5)
                                                      PV - {{DB::table('lifejacket_subscription')->where('user_id',$user5->user_id)->sum('amount')}}


                                                        @else
                                                          Open
                                                        @endif
                                                    </td>

                                                 </tr>
                                              </table>

                                             </a>
                                                <ul>
                                                    <li >
                                                            @if($user6)
                                                               <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user6->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user6->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                                   <tr>
                                                                     <td class="text-right"><?php echo left_member_count($user6->user_id); ?></td>
                                                                     <td>Downline</td>
                                                                     <td class="text-left"><?php echo right_member_count($user6->user_id); ?></td>
                                                                   </tr>
                                                                   <tr>
                                                                     <td class="text-right"><?php echo left_bv_count($user6->user_id); ?></td>
                                                                     <td>All</td>
                                                                     <td class="text-left"><?php echo right_bv_count($user6->user_id); ?></td>
                                                                   </tr>
                                                                   <tr>
                                                                     <td class="text-right"><?php echo left_carry_count($user6->user_id); ?></td>
                                                                     <td>PWCF</td>
                                                                     <td class="text-left"><?php echo right_carry_count($user6->user_id); ?></td>
                                                                   </tr>
                                                                   <tr>
                                                                     <td class="text-right"><?php echo left_bv_count_week($user6->user_id); ?></td>
                                                                     <td>This Week</td>
                                                                     <td class="text-left"><?php echo right_bv_count_week($user6->user_id); ?></td>
                                                                   </tr>
                                                                   <tr>
                                                                     <td class="text-right"><?php echo left_bv_count_today($user6->user_id); ?></td>
                                                                     <td>Today</td>
                                                                     <td class="text-left"><?php echo right_bv_count_today($user6->user_id); ?></td>
                                                                   </tr>
                                                                 </table>' >
                                                              @else
                                                               @if($info5 > 0 && empty($user6))
                                                                  <!-- <a  href="{{URL::to('/genealogy/register/')}}/{{$info5}}/{{Auth::user()->user_id}}/left" > -->
                                                                   <a  href="#" >
                                                                 @else
                                                                     <a  href="#" >
                                                               @endif
                                                              @endif
                                                          <table>
                                                            <tr>
                                                                <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                            </tr>
                                                            <tr>
                                                                <td>@if($user6){{ $user6->username}}
                                                                  @else
                                                                    <br>
                                                                   @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@if($user6){{ date('M d, Y',strtotime($user6->registration_date))}}
                                                                  @else

                                                                    <br>
                                                                  @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td> @if($user6)
                                                                  PV - {{DB::table('lifejacket_subscription')->where('user_id',$user6->user_id)->sum('amount')}}


                                                                    @else
                                                                      Open
                                                                    @endif
                                                                </td>

                                                             </tr>
                                                          </table>
                                                        </a>
                                                    </li>
                                                    <li >
                                                        @if($user7)
                                                           <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user7->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user7->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_member_count($user7->user_id); ?></td>
                                                                 <td>Downline</td>
                                                                 <td class="text-left"><?php echo right_member_count($user7->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count($user7->user_id); ?></td>
                                                                 <td>All</td>
                                                                 <td class="text-left"><?php echo right_bv_count($user7->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_carry_count($user7->user_id); ?></td>
                                                                 <td>PWCF</td>
                                                                 <td class="text-left"><?php echo right_carry_count($user7->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count_week($user7->user_id); ?></td>
                                                                 <td>This Week</td>
                                                                 <td class="text-left"><?php echo right_bv_count_week($user7->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count_today($user7->user_id); ?></td>
                                                                 <td>Today</td>
                                                                 <td class="text-left"><?php echo right_bv_count_today($user7->user_id); ?></td>
                                                               </tr>
                                                             </table>'>
                                                          @else
                                                           @if($info5 > 0 && empty($user7))
                                                              <!-- <a  href="{{URL::to('/genealogy/register/')}}/{{$info5}}/{{Auth::user()->user_id}}/right" > -->
                                                               <a  href="#" >
                                                             @else
                                                                 <a  href="#" >
                                                           @endif
                                                          @endif

                                                          <table>
                                                            <tr>
                                                                <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                            </tr>

                                                            <tr>
                                                                <td>@if($user7){{ $user7->username}}
                                                                  @else

                                                                    <br>
                                                                   @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@if($user7){{ date('M d, Y',strtotime($user7->registration_date))}}
                                                                  @else

                                                                    <br>
                                                                  @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td> @if($user7)
                                                                  PV - {{DB::table('lifejacket_subscription')->where('user_id',$user7->user_id)->sum('amount')}}


                                                                    @else
                                                                      Open
                                                                    @endif
                                                                </td>

                                                             </tr>
                                                          </table>
                                                        </a>
                                                    </li>
                                                 </ul>
                                            </li>
                                          </ul>
                                      </li>
                                      <li>
                                          @if($user8)
                                               <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user8->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user8->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                   <tr>
                                                     <td class="text-right"><?php echo left_member_count($user8->user_id); ?></td>
                                                     <td>Downline</td>
                                                     <td class="text-left"><?php echo right_member_count($user8->user_id); ?></td>
                                                   </tr>
                                                   <tr>
                                                     <td class="text-right"><?php echo left_bv_count($user8->user_id); ?></td>
                                                     <td>All</td>
                                                     <td class="text-left"><?php echo right_bv_count($user8->user_id); ?></td>
                                                   </tr>
                                                   <tr>
                                                     <td class="text-right"><?php echo left_carry_count($user8->user_id); ?></td>
                                                     <td>PWCF</td>
                                                     <td class="text-left"><?php echo right_carry_count($user8->user_id); ?></td>
                                                   </tr>
                                                   <tr>
                                                     <td class="text-right"><?php echo left_bv_count_week($user8->user_id); ?></td>
                                                     <td>This Week</td>
                                                     <td class="text-left"><?php echo right_bv_count_week($user8->user_id); ?></td>
                                                   </tr>
                                                   <tr>
                                                     <td class="text-right"><?php echo left_bv_count_today($user8->user_id); ?></td>
                                                     <td>Today</td>
                                                     <td class="text-left"><?php echo right_bv_count_today($user8->user_id); ?></td>
                                                   </tr>
                                                 </table>'>
                                              @else
                                               @if($user_id > 0 && empty($user8))
                                                  <a  href="{{URL::to('/genealogy/register/')}}/{{$user_id}}/{{Auth::user()->user_id}}/right" >
                                                 @else
                                                     <a  href="#" >
                                               @endif
                                              @endif
                                            <table>
                                              <tr>
                                                  <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                              </tr>
                                              <tr>
                                                  <td>@if($user8){{ $user8->username}}
                                                    @else

                                                      <br>
                                                     @endif</td>
                                              </tr>
                                              <tr>
                                                  <td>@if($user8){{ date('M d, Y',strtotime($user8->registration_date))}}
                                                    @else

                                                      <br>
                                                    @endif</td>
                                              </tr>
                                              <tr>
                                                  <td> @if($user8)
                                                    PV - {{DB::table('lifejacket_subscription')->where('user_id',$user8->user_id)->sum('amount')}}

                                                      @else
                                                        Open
                                                      @endif
                                                  </td>

                                               </tr>
                                            </table>

                                          </a>
                                          <ul >
                                              <li >

                                                @if($user9)
                                                   <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user9->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user9->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                       <tr>
                                                         <td class="text-right"><?php echo left_member_count($user9->user_id); ?></td>
                                                         <td>Downline</td>
                                                         <td class="text-left"><?php echo right_member_count($user9->user_id); ?></td>
                                                       </tr>
                                                       <tr>
                                                         <td class="text-right"><?php echo left_bv_count($user9->user_id); ?></td>
                                                         <td>All</td>
                                                         <td class="text-left"><?php echo right_bv_count($user9->user_id); ?></td>
                                                       </tr>
                                                       <tr>
                                                         <td class="text-right"><?php echo left_carry_count($user9->user_id); ?></td>
                                                         <td>PWCF</td>
                                                         <td class="text-left"><?php echo right_carry_count($user9->user_id); ?></td>
                                                       </tr>
                                                       <tr>
                                                         <td class="text-right"><?php echo left_bv_count_week($user9->user_id); ?></td>
                                                         <td>This Week</td>
                                                         <td class="text-left"><?php echo right_bv_count_week($user9->user_id); ?></td>
                                                       </tr>
                                                       <tr>
                                                         <td class="text-right"><?php echo left_bv_count_today($user9->user_id); ?></td>
                                                         <td>Today</td>
                                                         <td class="text-left"><?php echo right_bv_count_today($user9->user_id); ?></td>
                                                       </tr>
                                                     </table>'>
                                                  @else
                                                   @if($info8 > 0 && empty($user9))
                                                      <!-- <a  href="{{URL::to('/genealogy/register/')}}/{{$info8}}/{{Auth::user()->user_id}}/left" > -->
                                                      <a  href="#" >
                                                     @else
                                                         <a  href="#" >
                                                   @endif
                                                  @endif

                                                    <table>
                                                      <tr>
                                                          <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                      </tr>
                                                      <tr>
                                                          <td>@if($user9){{ $user9->username}}
                                                            @else
                                                              <br>
                                                          @endif</td>
                                                      </tr>
                                                      <tr>
                                                          <td>@if($user9){{ date('M d, Y',strtotime($user9->registration_date))}}
                                                            @else

                                                              <br>
                                                            @endif</td>
                                                      </tr>
                                                      <tr>
                                                          <td> @if($user9)
                                                            PV - {{DB::table('lifejacket_subscription')->where('user_id',$user9->user_id)->sum('amount')}}


                                                              @else
                                                                Open
                                                              @endif
                                                          </td>

                                                       </tr>
                                                    </table>
                                                  </a>
                                                  <ul>
                                                      <li  >
                                                        @if($user10)
                                                           <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user10->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user10->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_member_count($user10->user_id); ?></td>
                                                                 <td>Downline</td>
                                                                 <td class="text-left"><?php echo right_member_count($user10->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count($user10->user_id); ?></td>
                                                                 <td>All</td>
                                                                 <td class="text-left"><?php echo right_bv_count($user10->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_carry_count($user10->user_id); ?></td>
                                                                 <td>PWCF</td>
                                                                 <td class="text-left"><?php echo right_carry_count($user10->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count_week($user10->user_id); ?></td>
                                                                 <td>This Week</td>
                                                                 <td class="text-left"><?php echo right_bv_count_week($user10->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count_today($user10->user_id); ?></td>
                                                                 <td>Today</td>
                                                                 <td class="text-left"><?php echo right_bv_count_today($user10->user_id); ?></td>
                                                               </tr>
                                                             </table>' >
                                                          @else
                                                           @if($info9 > 0 && empty($user10))
                                                              <!-- <a  href="{{URL::to('/genealogy/register/')}}/{{$info9}}/{{Auth::user()->user_id}}/left" > -->
                                                                <a  href="#" >
                                                             @else
                                                                 <a  href="#" >
                                                           @endif
                                                          @endif
                                                          <table>
                                                            <tr>
                                                                <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                            </tr>
                                                            <tr>
                                                                <td>@if($user10){{ $user10->username}}
                                                                  @else

                                                                    <br>
                                                                   @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@if($user10){{ date('M d, Y',strtotime($user10->registration_date))}}
                                                                  @else

                                                                    <br>
                                                                  @endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td> @if($user10)
                                                                  PV - {{DB::table('lifejacket_subscription')->where('user_id',$user10->user_id)->sum('amount')}}


                                                                    @else
                                                                      Open
                                                                    @endif
                                                                </td>

                                                             </tr>
                                                          </table>
                                                        </a>
                                                      </li>
                                                      <li class="mb">
                                                        @if($user11)
                                                           <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user11->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user11->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_member_count($user11->user_id); ?></td>
                                                                 <td>Downline</td>
                                                                 <td class="text-left"><?php echo right_member_count($user11->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count($user11->user_id); ?></td>
                                                                 <td>All</td>
                                                                 <td class="text-left"><?php echo right_bv_count($user11->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_carry_count($user11->user_id); ?></td>
                                                                 <td>PWCF</td>
                                                                 <td class="text-left"><?php echo right_carry_count($user11->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count_week($user11->user_id); ?></td>
                                                                 <td>This Week</td>
                                                                 <td class="text-left"><?php echo right_bv_count_week($user11->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count_today($user11->user_id); ?></td>
                                                                 <td>Today</td>
                                                                 <td class="text-left"><?php echo right_bv_count_today($user11->user_id); ?></td>
                                                               </tr>
                                                             </table>'>
                                                          @else
                                                           @if($info9 > 0 && empty($user11))
                                                            <a  href="#" >
                                                              <!-- <a  href="{{URL::to('/genealogy/register/')}}/{{$info9}}/{{Auth::user()->user_id}}/right" > -->
                                                             @else
                                                                 <a  href="#" >
                                                           @endif
                                                          @endif
                                                            <table>
                                                              <tr>
                                                                  <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                              </tr>
                                                              <tr>
                                                                  <td>@if($user11){{ $user11->username}}
                                                                    @else

                                                                      <br>
                                                                     @endif</td>
                                                              </tr>
                                                              <tr>
                                                                  <td>@if($user11){{ date('M d, Y',strtotime($user11->registration_date))}}
                                                                    @else

                                                                      <br>
                                                                    @endif</td>
                                                              </tr>
                                                              <tr>
                                                                  <td> @if($user11)
                                                                    PV - {{DB::table('lifejacket_subscription')->where('user_id',$user11->user_id)->sum('amount')}}


                                                                      @else
                                                                        Open
                                                                      @endif
                                                                  </td>

                                                               </tr>
                                                            </table>

                                                          </a>
                                                      </li>
                                                  </ul>
                                              </li>
                                              <li>
                                                @if($user12)
                                                   <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user12->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user12->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                       <tr>
                                                         <td class="text-right"><?php echo left_member_count($user12->user_id); ?></td>
                                                         <td>Downline</td>
                                                         <td class="text-left"><?php echo right_member_count($user12->user_id); ?></td>
                                                       </tr>
                                                       <tr>
                                                         <td class="text-right"><?php echo left_bv_count($user12->user_id); ?></td>
                                                         <td>All</td>
                                                         <td class="text-left"><?php echo right_bv_count($user12->user_id); ?></td>
                                                       </tr>
                                                       <tr>
                                                         <td class="text-right"><?php echo left_carry_count($user12->user_id); ?></td>
                                                         <td>PWCF</td>
                                                         <td class="text-left"><?php echo right_carry_count($user12->user_id); ?></td>
                                                       </tr>
                                                       <tr>
                                                         <td class="text-right"><?php echo left_bv_count_week($user12->user_id); ?></td>
                                                         <td>This Week</td>
                                                         <td class="text-left"><?php echo right_bv_count_week($user12->user_id); ?></td>
                                                       </tr>
                                                       <tr>
                                                         <td class="text-right"><?php echo left_bv_count_today($user12->user_id); ?></td>
                                                         <td>Today</td>
                                                         <td class="text-left"><?php echo right_bv_count_today($user12->user_id); ?></td>
                                                       </tr>
                                                     </table>'>
                                                  @else
                                                   @if($info8 > 0 && empty($user12))
                                                      <a  href="{{URL::to('/genealogy/register/')}}/{{$info8}}/{{Auth::user()->user_id}}/right" >
                                                     @else
                                                        <a  href="#" >
                                                   @endif
                                                  @endif

                                                    <table>
                                                      <tr>
                                                          <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                      </tr>
                                                      <tr>
                                                          <td>@if($user12){{ $user12->username}}
                                                            @else

                                                              <br>
                                                             @endif</td>
                                                      </tr>
                                                      <tr>
                                                          <td>@if($user12){{ date('M d, Y',strtotime($user12->registration_date))}}
                                                            @else

                                                              <br>
                                                            @endif</td>
                                                      </tr>
                                                      <tr>
                                                          <td> @if($user12)
                                                            PV - {{DB::table('lifejacket_subscription')->where('user_id',$user12->user_id)->sum('amount')}}


                                                              @else
                                                                Open
                                                              @endif
                                                          </td>

                                                       </tr>
                                                    </table>


                                                   </a>
                                                  <ul>
                                                      <li class="mb">
                                                        @if($user13)
                                                           <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user13->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user13->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_member_count($user13->user_id); ?></td>
                                                                 <td>Downline</td>
                                                                 <td class="text-left"><?php echo right_member_count($user13->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count($user13->user_id); ?></td>
                                                                 <td>All</td>
                                                                 <td class="text-left"><?php echo right_bv_count($user13->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_carry_count($user13->user_id); ?></td>
                                                                 <td>PWCF</td>
                                                                 <td class="text-left"><?php echo right_carry_count($user13->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count_week($user13->user_id); ?></td>
                                                                 <td>This Week</td>
                                                                 <td class="text-left"><?php echo right_bv_count_week($user13->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count_today($user13->user_id); ?></td>
                                                                 <td>Today</td>
                                                                 <td class="text-left"><?php echo right_bv_count_today($user13->user_id); ?></td>
                                                               </tr>
                                                             </table>'>
                                                          @else
                                                           @if($info12 > 0 && empty($user13))
                                                              <a  href="#" >
                                                              <!-- <a  href="{{URL::to('/genealogy/register/')}}/{{$info12}}/{{Auth::user()->user_id}}/left" > -->
                                                             @else
                                                                 <a  href="#" >
                                                           @endif
                                                          @endif
                                                            <table>
                                                              <tr>
                                                                  <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                              </tr>

                                                              <tr>
                                                                  <td>@if($user13){{ $user13->username}}
                                                                    @else

                                                                      <br>
                                                                     @endif</td>
                                                              </tr>
                                                              <tr>
                                                                  <td>@if($user13){{ date('M d, Y',strtotime($user13->registration_date))}}
                                                                    @else

                                                                      <br>
                                                                    @endif</td>
                                                              </tr>
                                                              <tr>
                                                                  <td> @if($user13)
                                                                    PV - {{DB::table('lifejacket_subscription')->where('user_id',$user13->user_id)->sum('amount')}}


                                                                      @else
                                                                        Open
                                                                      @endif
                                                                  </td>

                                                               </tr>
                                                            </table>

                                                          </a>
                                                      </li>
                                                      <li class="mb">
                                                        @if($user14)
                                                           <a  href="{{URL::to('admin/members/genealogy/')}}/{{$user14->user_id}}" data-toggle="popover" data-trigger="hover" title="Account : {{$user14->user_id}}"  data-html="true"   data-content='<table class="table table-bordered" style="margin: 10px -10px -6px -10px;">
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_member_count($user14->user_id); ?></td>
                                                                 <td>Downline</td>
                                                                 <td class="text-left"><?php echo right_member_count($user14->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count($user14->user_id); ?></td>
                                                                 <td>All</td>
                                                                 <td class="text-left"><?php echo right_bv_count($user14->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_carry_count($user14->user_id); ?></td>
                                                                 <td>PWCF</td>
                                                                 <td class="text-left"><?php echo right_carry_count($user14->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count_week($user14->user_id); ?></td>
                                                                 <td>This Week</td>
                                                                 <td class="text-left"><?php echo right_bv_count_week($user14->user_id); ?></td>
                                                               </tr>
                                                               <tr>
                                                                 <td class="text-right"><?php echo left_bv_count_today($user14->user_id); ?></td>
                                                                 <td>Today</td>
                                                                 <td class="text-left"><?php echo right_bv_count_today($user14->user_id); ?></td>
                                                               </tr>
                                                             </table>' >
                                                          @else
                                                           @if($info12 > 0 && empty($user14))
                                                              <a  href="{{URL::to('/genealogy/register/')}}/{{$info12}}/{{Auth::user()->user_id}}/right" >
                                                             @else
                                                                 <a  href="#" >
                                                           @endif
                                                          @endif
                                                            <table>
                                                              <tr>
                                                                  <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-4.png')}}" alt=""></span></center></td>
                                                              </tr>

                                                              <tr>
                                                                  <td>@if($user14){{ $user14->username}}
                                                                    @else

                                                                      <br>
                                                                     @endif</td>
                                                              </tr>
                                                              <tr>
                                                                  <td>@if($user14){{ date('M d, Y',strtotime($user14->registration_date))}}
                                                                    @else

                                                                      <br>
                                                                    @endif</td>
                                                              </tr>
                                                              <tr>
                                                                  <td> @if($user14)
                                                                        PV - {{DB::table('lifejacket_subscription')->where('user_id',$user14->user_id)->sum('amount')}}
                                                                      @else
                                                                        Open
                                                                      @endif
                                                                  </td>
                                                               </tr>
                                                            </table>
                                                           </a>
                                                      </li>
                                                  </ul>
                                              </li>
                                          </ul>
                                        </li>
                                      </ul>
                                    </li>
                                </ul>

                            </div>
                </div>

    </div>
@endsection

@section('scripts')
 <script src="https://affiliate.xinrox.com/app/dashboard/userpanel/js/popper.min.js"></script>


<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>
@endsection
