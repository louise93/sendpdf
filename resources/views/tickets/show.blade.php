
@extends('mainlayout.app')

@section('title', $ticket->title)

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
            #{{ $ticket->ticket_id }} - {{ $ticket->title }}
          </div>

          <div class="panel-body">
            @include('includes.flash')

            <div class="ticket-info">
              <p>{{ $ticket->message }}</p>
              <p>Categry: {{ $category->name }}</p>
              <p>
              @if ($ticket->status === 'Open')
              Status: <span class="label label-success">{{ $ticket->status }}</span>
            @else
              Status: <span class="label label-danger">{{ $ticket->status }}</span>
            @endif
              </p>
              <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
            </div>

            <hr>
            
            <div class="comments">
              @foreach ($comments as $comment)
                <div class="panel panel-@if($ticket->user->id === $comment->user_id){{"default"}}@else{{"success"}}@endif">
                  <div class="panel panel-heading">
                    {{ $comment->user->name }}
                    <span class="pull-right">{{ $comment->created_at->format('F d , Y h:s A') }}</span>
                  </div>

                  <div class="panel panel-body">
                    {{ $comment->comment }}
                  </div>
                </div>
              @endforeach
            </div>

            <div class="comment-form">
              <form action="{{ url('comment') }}" method="POST" class="form">
                {!! csrf_field() !!}

                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                              <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>

                              @if ($errors->has('comment'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('comment') }}</strong>
                                  </span>
                              @endif
                        </div>

                        <div class="form-group">
                              <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
              </form>
          </div>
        </div>
    </div>
</div>

  </div>
@endsection
