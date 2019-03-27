
@extends('mainlayout.app')

@section('title', 'Withdrawals')

<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Account</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Withdrawals</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Close</a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                </div>
      </div>

    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                <form action="{{URL::to('withdrawals/history')}}" method="post">
                  @csrf
                  <div class="ibox-content">
                    <div class="row">

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date From</label>
                            <input class="form-control" type="date" name="date_from">
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Date To</label>
                            <input class="form-control" type="date" name="date_to">
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label><br><br><br></label>
                            <button class="btn btn-info">Search</button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-12">
          <div class="ibox ">
              <div class="ibox-title">
                  <div class="ibox-tools">
                      <a class="collapse-link">
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
                      <a class="close-link">
                          <i class="fa fa-times"></i>
                      </a>
                  </div>
              </div>
              <div class="ibox-content">
                  <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataTables-example" >
              <thead>
              <tr>
                  <th>#</th>
                  <th>Transaction Number</th>
                  <th>Amount </th>
                  <th>Date </th>
                  <th>Paid/Cancelled Date</th>
                  <th>Type</th>
                  <th>Remarks</th>

              </tr>
              </thead>
              <tbody>
                @foreach($result as $data)
                        <tr class="gradeX">
                            <td align="center">1</td>
                            <td align="center">{{$data->transaction_number}}</td>
                            <td align="right">$ {{number_format($data->total_paid_amount,2)}}</td>
                            <td>{{date('F d, Y', strtotime($data->posted_date))}}</td>
                            <td>@if($data->admin_response_date !='NULL')
                                    {{date('F d, Y', strtotime($data->admin_response_date))}}
                            @endif</td>
                            <td>{{$data->type}}</td>
                            <td>{{$data->admin_remark}}</td>
                      </tr>
                @endforeach

              </tbody>
              </table>
                  </div>
              </div>
          </div>
      </div>
      </div>
  </div>
@endsection
@section('scripts')

<script src="{{ asset('js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'Direct Sponsors'},
                {extend: 'pdf', title: 'Direct Sponsors'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });

    });

</script>


@endsection
