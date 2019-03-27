
@extends('mainlayout.app')

@section('title', 'Reports')

<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Reports</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Matching </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Points</a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                </div>
      </div>

    <div class="wrapper wrapper-content animated fadeInRight">
      <!-- <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                <form action="{{URL::to('reports/fundtransfer/search')}}" method="post">
                  @csrf
                  <div class="ibox-content">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Receiver</label>
                          <input class="form-control" type="text" name="user_id">
                        </div>
                      </div>
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
      </div> -->
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
                  <th>Downline</th>
                  <th>Points</th>
                  <th>Position </th>
                  <th>Level</th>
                  <th>Remark</th>
                  <th>Date</th>
                  <th>Status</th>
              </tr>
              </thead>
              <tbody>
                  <?php $count= 1; ?>
                  @foreach($matchingpoints as $data)
                    <tr>
                      <td align="center"><?=$count++;?></td>
                      <td align="center">
                        {{$data->downline_id}}
                          -
                          {{
                              DB::table('user_registration')
                                ->where('user_id',$data->downline_id)
                                ->first(['username'])->username
                          }}
                      </td>
                      <td align="right">{{$data->bv}}</td>
                      <td align="center">{{$data->position}}</td>
                      <td align="center">{{$data->level}}</td>
                      <td align="center">{{$data->description}}</td>
                      <td align="center">{{date('F d, Y',strtotime($data->date))}}</td>
                      <td>
                          @if($data->status == 0)
                              <span class="label label-danger">Unpaid</span>
                          @else
                              <span class="label label-success">Paid</span>
                          @endif
                      </td>
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
