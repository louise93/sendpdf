@extends('layouts.app')
@section('header')
<header> <!-- extra class no-background -->
  <a class="go-back-link" href="javascript:history.back();"><i class="fa fa-arrow-left"></i></a>
  <h1 class="page-title">NETWORK TREE</h1>
  <div class="navi-menu-button">
    <em></em>
    <em></em>
    <em></em>
  </div>
</header>

<link rel="stylesheet" type="text/css" href="{{ asset('css/core.css')}}">
<style>
table {
  font-size: 8px;

}
#mb2 {
      visibility:hidden;
      position: center;
  }
@media (max-width: 40em) {
#mb {
    visibility:hidden;
      position: center;
  }
#mb2 {
      visibility:visible;
        position: center;
  }
}


</style>
@endsection
@section('content')
<div class="dash-balance">
  <div class="dash-content relative">
    <h3 class="w-text">GENEALOGY</h3>
    <div class="notification">

    </div>
  </div>
</div>
<section class="bal-section container">
  <div class="balance-card mb-15">
    <div class="d-flex align-items-center">
                  <div class="d-flex flex-grow">
                    <div class="mr-auto">
                      <h1 class="b-val"> MY NETWORK TREE</h1>
                      <p class="g-text mb-10">My Network</p>
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
  <center>
					<h4 class="title-main mt-5"> Network List</h4>

          <div class="tree">
            <ul>
              <li>

                <a href="">
                  @if($user_id == Auth::user()->user_id)
                      <table>
                        <tr valign="center">
                            <td align="rignt"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
                        </tr>
                        <tr>
                            <td>{{ Auth::user()->username }}</td>
                        </tr>
                        <tr>
                            <td>{{ date('M d, Y',strtotime(Auth::user()->registration_date)) }}</td>
                        </tr>
                        <tr>
                            <td>
                              <?php for($i = 0 ;$i< Auth::user()->user_plan;$i++) { ?>
                              <i class="fa fa-star text-warning"></i>
                                <?php } ?>
                            </td>

                        </tr>
                      </table>
                  @else
                      <table>
                        <tr>
                            <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                              <?php for($i = 0 ;$i< DB::table('user_registration')->where('user_id',$user_id)->first(['user_plan'])->user_plan;$i++) { ?>
                              <i class="fa fa-star text-warning"></i>
                                <?php } ?>


                            </td>

                         </tr>
                      </table>
                  @endif
                </a>
                <ul>
                    <li>
                      @if($user1)
                        <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user1->user_id}}" >
                          @else
                              @if($user_id !=''  && empty($user1))
                                      <a  href="{{URL::to('/genealogy/register/')}}/{{$user_id}}/{{ Auth::user()->user_id }}/left" >
                              @endif

                          @endif
                        <table>
                          <tr>
                              <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                <?php for($i = 0 ;$i< $user1->user_plan;$i++) { ?>
                                <i class="fa fa-star text-warning"></i>
                                  <?php } ?>
                                  @else
                                    Open
                                  @endif
                              </td>
                                </tr>
                        </table>
                      </a>
                    </li>
                    <li>
                      @if($user8)
                        <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user8->user_id}}" >
                          @else
                              @if($user_id !=''  && empty($user8))
                                      <a  href="{{URL::to('/genealogy/register/')}}/{{$user_id}}/{{ Auth::user()->user_id }}/left" >
                              @else


                              @endif

                          @endif
                        <table>
                          <tr>
                              <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                <?php for($i = 0 ;$i< $user8->user_plan;$i++) { ?>
                                <i class="fa fa-star text-warning"></i>
                                  <?php } ?>

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
          </div>



<div class="tree" >

<ul>
  <li>

    <a href="">
      @if($user_id == Auth::user()->user_id)
          <table>
            <tr valign="center">
                <td align="rignt"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
            </tr>
            <tr>
                <td>{{ Auth::user()->username }}</td>
            </tr>
            <tr>
                <td>{{ date('M d, Y',strtotime(Auth::user()->registration_date)) }}</td>
            </tr>
            <tr>
                <td>
                  <?php for($i = 0 ;$i< Auth::user()->user_plan;$i++) { ?>
                  <i class="fa fa-star text-warning"></i>
                    <?php } ?>
                </td>

            </tr>
          </table>
      @else
          <table>
            <tr>
                <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                  <?php for($i = 0 ;$i< DB::table('user_registration')->where('user_id',$user_id)->first(['user_plan'])->user_plan;$i++) { ?>
                  <i class="fa fa-star text-warning"></i>
                    <?php } ?>


                </td>

             </tr>
          </table>
      @endif
    </a>
    <ul>
        <li>
          @if($user1)
            <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user1->user_id}}" >
              @else
                  @if($user_id !=''  && empty($user1))
                          <a  href="{{URL::to('/genealogy/register/')}}/{{$user_id}}/{{ Auth::user()->user_id }}/left" >
                  @else


                  @endif

              @endif

              <table>
                <tr>
                    <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                      <?php for($i = 0 ;$i< $user1->user_plan;$i++) { ?>
                      <i class="fa fa-star text-warning"></i>
                        <?php } ?>

                        @else
                          Open
                        @endif
                    </td>

                      </tr>
              </table>

            </a>
            <ul class="mb">
                 <li class="mb">
                   @if($user2)
                      <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user2->user_id}}" >
                     @else
                      @if($info1 > 0 && empty($user2))
                         <a  href="{{URL::to('/genealogy/register/')}}/{{$info1}}/{{Auth::user()->user_id}}/left" >
                        @else
                            <a  href="#" >
                      @endif
                     @endif
                   <table>
                     <tr>
                         <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                           <?php for($i = 0 ;$i< $user2->user_plan;$i++) { ?>
                           <i class="fa fa-star text-warning"></i>
                             <?php } ?>

                             @else
                              Open
                             @endif
                         </td>

                      </tr>
                   </table>

                 </a>
                    <ul>
                        <li class="mb">
                              @if($user3)
                                 <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user3->user_id}}" >
                                @else
                                 @if($info2 > 0 && empty($user3))
                                    <a  href="{{URL::to('/genealogy/register/')}}/{{$info2}}/{{Auth::user()->user_id}}/left" >
                                   @else
                                       <a  href="#" >
                                 @endif
                                @endif
                              <table>
                                <tr>
                                    <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                      <?php for($i = 0 ;$i< $user3->user_plan;$i++) { ?>
                                      <i class="fa fa-star text-warning"></i>
                                      <?php } ?>

                                        @else
                                          Open
                                        @endif
                                    </td>
                                 </tr>
                              </table>
                            </a>
                        </li>
                        <li class="mb">
                              @if($user4)
                                 <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user4->user_id}}" >
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
                                    <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                      <?php for($i = 0 ;$i< $user4->user_plan;$i++) { ?>
                                      <i class="fa fa-star text-warning"></i>
                                        <?php } ?>

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
                <li class="mb">

                      @if($user5)
                         <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user5->user_id}}" >
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
                        <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                          <?php for($i = 0 ;$i< $user5->user_plan;$i++) { ?>
                          <i class="fa fa-star text-warning"></i>
                            <?php } ?>

                            @else
                              Open
                            @endif
                        </td>

                     </tr>
                  </table>

                 </a>
                    <ul>
                        <li class="mb">
                                @if($user6)
                                   <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user6->user_id}}" >
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
                                    <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                      <?php for($i = 0 ;$i< $user5->user_plan;$i++) { ?>
                                      <i class="fa fa-star text-warning"></i>
                                        <?php } ?>

                                        @else
                                          Open
                                        @endif
                                    </td>

                                 </tr>
                              </table>
                            </a>
                        </li>
                        <li class="mb">
                            @if($user7)
                               <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user7->user_id}}" >
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
                                    <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                      <?php for($i = 0 ;$i< $user7->user_plan;$i++) { ?>
                                      <i class="fa fa-star text-warning"></i>
                                        <?php } ?>

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
                   <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user8->user_id}}" >
                  @else
                   @if($user_id > 0 && empty($user8))
                      <a  href="{{URL::to('/genealogy/register/')}}/{{$user_id}}/{{Auth::user()->user_id}}/right" >
                     @else
                         <a  href="#" >
                   @endif
                  @endif
                <table>
                  <tr>
                      <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                        <?php for($i = 0 ;$i< $user8->user_plan;$i++) { ?>
                        <i class="fa fa-star text-warning"></i>
                          <?php } ?>

                          @else
                            Open
                          @endif
                      </td>

                   </tr>
                </table>

              </a>
              <ul class="mb">
                  <li >

                    @if($user9)
                       <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user9->user_id}}" >
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
                              <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                <?php for($i = 0 ;$i< $user9->user_plan;$i++) { ?>
                                <i class="fa fa-star text-warning"></i>
                                  <?php } ?>

                                  @else
                                    Open
                                  @endif
                              </td>

                           </tr>
                        </table>
                      </a>
                      <ul>
                          <li class="mb" >
                            @if($user10)
                               <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user10->user_id}}" >
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
                                    <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                      <?php for($i = 0 ;$i< $user10->user_plan;$i++) { ?>
                                      <i class="fa fa-star text-warning"></i>
                                        <?php } ?>

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
                               <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user11->user_id}}" >
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
                                      <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                        <?php for($i = 0 ;$i< $user11->user_plan;$i++) { ?>
                                        <i class="fa fa-star text-warning"></i>
                                          <?php } ?>

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
                       <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user12->user_id}}" >
                      @else
                       @if($info8 > 0 && empty($user12))
                          <a  href="{{URL::to('/genealogy/register/')}}/{{$info8}}/{{Auth::user()->user_id}}/right" >
                         @else
                            <a  href="#" >
                       @endif
                      @endif

                        <table>
                          <tr>
                              <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                <?php for($i = 0 ;$i< $user12->user_plan;$i++) { ?>
                                <i class="fa fa-star text-warning"></i>
                                  <?php } ?>

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
                               <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user13->user_id}}" >
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
                                      <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                        <?php for($i = 0 ;$i< $user13->user_plan;$i++) { ?>
                                        <i class="fa fa-star text-warning"></i>
                                          <?php } ?>

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
                               <a  href="{{URL::to('/genealogy/networktree/')}}/{{$user14->user_id}}" >
                              @else
                               @if($info12 > 0 && empty($user14))
                                  <a  href="{{URL::to('/genealogy/register/')}}/{{$info12}}/{{Auth::user()->user_id}}/right" >
                                 @else
                                     <a  href="#" >
                               @endif
                              @endif
                                <table>
                                  <tr>
                                      <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
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
                                        <?php for($i = 0 ;$i< $user14->user_plan;$i++) { ?>
                                        <i class="fa fa-star text-warning"></i>
                                          <?php } ?>
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
</center>
				</section>
        <div class="form-divider"></div>
@endsection
