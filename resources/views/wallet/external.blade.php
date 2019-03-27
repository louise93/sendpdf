@extends('layouts.app')
@section('header')
<header> <!-- extra class no-background -->
  <a class="go-back-link" href="javascript:history.back();"><i class="fa fa-arrow-left"></i></a>
  <h1 class="page-title">Fund Transfer</h1>
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
    <h3 class="w-text">External Transfer</h3>
    <div class="notification">
      <a href="#" class="search-button" data-search="open"><i class="fa fa-plus "></i></a>
    </div>
  </div>
</div>

<externaltransfer></externaltransfer>
@endsection
