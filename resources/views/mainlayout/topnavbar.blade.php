<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" method="post" action="/">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search" />
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
          <li class="dropdown">
                  <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="false">
                        <?php
                            $countNotif = DB::table('credit_debit')->where('user_id',Auth::user()->user_id)->where('receive_date',date('Y-m-d'))->count('id');
                        ?>
                      <i class="fa fa-bell"></i>  <span class="label label-primary">{{$countNotif}}</span>
                  </a>
                  <ul class="dropdown-menu dropdown-alerts">
                    @if($countNotif > 0)
                      <?php  $history = DB::table('credit_debit')->where('user_id',Auth::user()->user_id)->where('receive_date',date('Y-m-d'))->orderBy('id','desc')->take(5)->get(); ?>
                      @foreach($history as $data)
                        <li>
                            <a href="#" class="dropdown-item">
                                <div>
                                  <i class="fa fa-check-circle text-info"></i> {{$data->ttype}} -
                                   $
                                      @if($data->credit_amt > 0)
                                        {{$data->credit_amt}}  credited
                                      @endif
                                      @if($data->debit_amt > 0)
                                         {{$data->debit_amt}}  debited
                                      @endif
                                    <span class="float-right text-muted small">{{date('F d,Y h:s A',strtotime($data->ts))}}</span>
                                </div>
                            </a>
                        </li>
                          <li class="dropdown-divider"></li>
                        @endforeach
                      @else
                          No new Notification
                    @endif
                  </ul>
              </li>
            <li>
                <a  href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out"></i>  {{ __('Logout') }}
                </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
            </li>
        </ul>
    </nav>
</div>
