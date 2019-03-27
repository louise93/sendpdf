
@extends('mainlayout.app')

@section('title', 'Educational Materials')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Educational Materials</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#"></a>
                        </li>


                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
      </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row animated fadeInRight">
                <div class="col-md-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Learning Tools</h5>
                        </div>
                            <div class="ibox-content">
                              <object data="{{ asset('learningtools.pdf')}}" type="application/pdf" width="100%" height="800px">
                      <p>It appears you don't have a PDF plugin for this browser.
                       No biggie... you can <a href="{{ asset('learningtools.pdf')}}">click here to
                      download the PDF file.</a></p>
                    </object>
                          </div>
                    </div>
                </div>
          </div>
  </div>


@endsection
