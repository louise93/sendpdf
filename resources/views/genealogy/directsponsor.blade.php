
@extends('mainlayout.app')

@section('title', 'GENEALOGY')

<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Genealogy</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Direct Sponsor</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Direct Members</a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
      </div>

    <div class="wrapper wrapper-content animated fadeInRight">
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
                  <th>Thumbnail</th>
                  <th>Member ID</th>
                  <th>Member Username</th>
                  <th>Package</th>
                  <th>Level</th>
                  <th>Position</th>
                  <th>Date Registered</th>
              </tr>
              </thead>
              <tbody>
                <?php $count=0;?>
                  @foreach($response as $data)
                  <?php $count++; ?>
                          <tr class="gradeX">
                            <td>{{$count}}</td>
                            <td align="center"><i class="fa fa-user-circle fa-2x"></i></td>
                            <td> {{ $data->user_id }}</td>
                            <td>{{ $data->username }}</td>
                            <td>{{
                              number_format(  DB::table('lifejacket_subscription')
                                    ->where('user_id',$data->user_id)
                                    ->sum('amount')
                                   ,2 )}} USD</td>
                              <td class="center">{{
                                DB::table('level_income_binary')->where('down_id',$data->user_id)
                                      ->where('income_id',$data->ref_id)
                                      ->first(['level'])
                                      ->level
                                  }}</td>
                              <td class="center"> {{ strtoupper(DB::table('level_income_binary')->where('down_id',$data->user_id)->where('income_id',$data->ref_id)->first(['leg'])->leg)}} </small></td>
                              <td>{{ date('F d, Y', strtotime($data->registration_date)) }}</td>
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
