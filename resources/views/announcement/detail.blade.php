@extends('layouts.app')
@section('header')
<header> <!-- extra class no-background -->
  <a class="go-back-link" href="javascript:history.back();"><i class="fa fa-arrow-left"></i></a>
  <h1 class="page-title">Official Announcement</h1>
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
    <h3 class="w-text">{{ $detail->news_name }}</h3>
    <div class="notification">

    </div>
  </div>
</div>
	<section class="container">
<div class="search-result-container">

<div class="news-list-item no-image">
  <div class="list-content">
    <h2 class="list-title"><a href="#">{{ $detail->news_name }}</a></h2>
    <br>
    {!! html_entity_decode($detail->description) !!}<br> - <span class="list-time">3 hours ago</span>
  </div>
</div>

@if(empty($detail->news_name))
<div class="news-list-item no-image">
  <div class="list-content">
    <h2 class="list-title"><a href="#">NO ANNOUNCEMENT YET !</a></h2>
    <br>

  </div>
</div>

@endif
</div>

</section>
@endsection
