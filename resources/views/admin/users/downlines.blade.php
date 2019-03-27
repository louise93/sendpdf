
@extends('admin.layout.app')

@section('title', 'ADMIN | GENEALOGY | DOWNLINES')

<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Genealogy</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Downlines</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>Downline List</a>
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
            <form action="{{URL::to('admin/members/downlines')}}" method="post">
              @csrf
              <div class="ibox-content">
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>User ID/Username</label>
                      <input class="form-control" name="user_id">
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
                    <th>Thumbnail</th>
                  <th>Member ID</th>
                  <th>Member Username</th>
                  <th>Package</th>
                  <th>Level</th>
                  <th>Position</th>
                  <th>Sponsor</th>
                  <th>Date Registered</th>
              </tr>
              </thead>
              <tbody>


              @if($user_id !="")
              <?php $count=0;?>
                  @foreach($response as $data)

                  <?php $count++; ?>
                          <tr class="gradeX">

                            <td>{{$count}}</td>
                              <td align="center"><i class="fa fa-user-circle fa-2x"></i></td>
                            <td> {{ $data->down_id }}</td>
                            <td>{{ DB::table('user_registration')->where('user_id',$data->down_id)->first(['username'])->username}}</td>
                            <td>
                              @if(DB::table('lifejacket_subscription')->where('user_id',$data->down_id)->count('id') > 0)
                                    {{
                                    number_format(  DB::table('lifejacket_subscription')
                                          ->where('user_id',$data->down_id)
                                          ->sum('amount')
                                         ,2 )}} USD

                                  @else
                                    <a href="{{URL::to('preregister/activationdownline')}}/{{$data->down_id}}" class="btn btn-danger btn-sm">Activate</a>
                              @endif
                              </td>
                              <td class="center">
                                  {{ $data->level }}
                              </td>
                              <td class="center"> {{ strtoupper($data->leg)}} </small></td>
                              <td>{{ DB::table('user_registration')->where('user_id',$data->income_id)->first(['username'])->username}}</td>
                              <td>{{ date('F d, Y', strtotime(DB::table('user_registration')->where('user_id',$data->down_id)->first(['registration_date'])->registration_date)) }}</td>
                          </tr>
              @endforeach

            @endif
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
                {extend: 'excel', title: 'Downlines'},
                {extend: 'pdf', title: 'Downlines'},
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
