@extends('layouts.app')
@section('header')
<header> <!-- extra class no-background -->
  <a class="go-back-link" href="javascript:history.back();"><i class="fa fa-arrow-left"></i></a>
  <h1 class="page-title">XINROX PACKAGE</h1>
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
						<h3 class="w-text">Activation Packages</h3>
						<div class="notification">
							<a href=""><i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
<section class="bal-section container">

					<div class="resources-card-wrapper">
		    			<div class="wallet-card mr-10 round">
	                        <div class="flex-column flex-md-row">

	                          <h3 class="w-text"> <i class="c-icon fa fa-star text-white"></i></h3>
	                          <p class="g-text mb-0 font-weight-medium">100 USD </p>
                            <p class="g-text mb-0 font-weight-medium">15 Months </p>
                            <p class="g-text mb-0 font-weight-medium">CAPPING : 400 USD /week </p>
	                        </div>
	                    </div>

	                    <div class="wallet-card ml-10 purp">
	                        <div class="flex-column flex-md-row">

	                          <h3 class="w-text"><i class="c-icon fa fa-star text-white"></i><i class="c-icon fa fa-star text-white"></i></h3>
	                          <p class="g-text mb-0 font-weight-medium">200 USD </p>
                            <p class="g-text mb-0 font-weight-medium">15 Months </p>
                            <p class="g-text mb-0 font-weight-medium">CAPPING : 2,000 USD /week </p>
	                        </div>
	                    </div>


					</div>
					<div class="resources-card-wrapper mt-15">
            <div class="wallet-card mr-10 flash">
                        <div class="flex-column flex-md-row">

                          <h3 class="w-text"><i class="c-icon fa fa-star text-white"></i><i class="c-icon fa fa-star text-white"></i><i class="c-icon fa fa-star text-white"></i></h3>
                          <p class="g-text mb-0 font-weight-medium">1,000 USD </p>
                          <p class="g-text mb-0 font-weight-medium">15 Months </p>
                          <p class="g-text mb-0 font-weight-medium">CAPPING : 4,000 USD /week </p>
                        </div>
                    </div>



					</div>
          <div class="resources-card-wrapper mt-15">
            <div class="wallet-card ml-10 app">
                <div class="flex-column flex-md-row">

                  <h3 class="w-text"><i class="c-icon fa fa-star text-white"></i><i class="c-icon fa fa-star text-white"></i><i class="c-icon fa fa-star text-white"></i><i class="c-icon fa fa-star text-white"></i></h3>
                  <p class="g-text mb-0 font-weight-medium">3,000 USD </p>
                  <p class="g-text mb-0 font-weight-medium">15 Months </p>
                  <p class="g-text mb-0 font-weight-medium">CAPPING : 12,000 USD /week </p>
                </div>
            </div>
            <div class="wallet-card mr-10 hot">
                        <div class="flex-column flex-md-row">

                          <h3 class="w-text"><i class="c-icon fa fa-star text-white"></i><i class="c-icon fa fa-star text-white"></i><i class="c-icon fa fa-star text-white"></i><i class="c-icon fa fa-star text-white"></i></h3>
                          <p class="g-text mb-0 font-weight-medium">5,000 USD </p>
                          <p class="g-text mb-0 font-weight-medium">15 Months </p>
                          <p class="g-text mb-0 font-weight-medium">CAPPING : 20,000 USD /week </p>
                        </div>
                    </div>



					</div>
				</section>

@endsection
