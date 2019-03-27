
@extends('mainlayout.app')

@section('title', 'Support Tickets')

<link href="{{ asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Support</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Tickets </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a>My Tickets </a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
      </div>

    <div class="wrapper wrapper-content animated fadeInRight">

      <div class="row">
<div class="col-md-12 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">
          <i class="fa fa-ticket"> My Tickets</i>
          <a href="{{ url('new_ticket') }}" class="float-right btn btn-info">Open Ticket</a>
        </div>

        <div class="panel-body">
          @if ($tickets->isEmpty())
        <p>You have not created any tickets.</p>
          @else
            <table class="table">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Last Updated</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($tickets as $ticket)
            <tr>
                  <td>
                  @foreach ($categories as $category)
                    @if ($category->id === $ticket->category_id)
                  {{ $category->name }}
                    @endif
                  @endforeach
                  </td>
                  <td>
                    <a href="{{ url('tickets/'. $ticket->ticket_id) }}">
                      #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                    </a>
                  </td>
                  <td>
                  @if ($ticket->status === 'Open')
                    <span class="label label-success">{{ $ticket->status }}</span>
                  @else
                    <span class="label label-danger">{{ $ticket->status }}</span>
                  @endif
                  </td>
                  <td>{{ $ticket->updated_at }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>

            {{ $tickets->render() }}
          @endif
        </div>
      </div>
  </div>
</div>
  </div>
@endsection
