
@extends('mainlayout.app')

@section('title', 'GENEALOGY')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Genealogy</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Sponsor Tree</a>
                        </li>
                        <!-- <li class="breadcrumb-item">
                            <a>Downline List</a>
                        </li> -->
                    </ol>
                </div>
              <div class="col-lg-2">

                </div>
      </div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox-content table-responsive">
  <div class="tree">
<ul>
<li>
<a   href="#">
@if($user_id == Auth::user()->user_id)
  <table>
    <tr>
        <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
    </tr>
    <tr>
        <td>{{ Auth::user()->username }}</td>
    </tr>
    <tr>
        <td>PV - {{DB::table('lifejacket_subscription')->where('user_id',Auth::user()->user_id)->sum('amount')}}</td>
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
        <td>PV - {{DB::table('lifejacket_subscription')->where('user_id',$user_id)->sum('amount')}}
</td>
    </tr>
  </table>
@endif

</a>
<ul>

@foreach($user as $user)
<li>
<a href="{{URL::to('genealogy/sponsortree/'.$user->user_id)}}">

  <table>
    <tr>
        <td align="center"> <center> <span class="member-img"><img src="{{ asset('Nandova/img/content/avatar/user-3.png')}}" alt=""></span></center></td>
    </tr>
    <tr>
        <td>{{ substr($user->username,0,6)}}</td>
    </tr>
    <tr>
        <td>PV - {{DB::table('lifejacket_subscription')->where('user_id',$user->user_id)->sum('amount')}}
</td>
    </tr>
  </table>

</a>
</li>

@endforeach
</ul>

</li>
</ul>
</div>
</div>
</div>
</div>

</div>
@endsection
