
@extends('mainlayout.app')

@section('title', 'Educational Materials')

@section('content')
<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

 ?>
 <style>
 img {
   width:100px;
   height: 100px;
 }
 </style>
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

                  @foreach ($items as $item)
                          <?php preg_match_all('/src="([^"]*)"/i',$item->get_description(), $result);   ?>

                      <div class="col-lg-4">
                        <div class="ibox-content">
                            <a href="{{ $item->get_permalink() }}" class="btn-link">
                                <h2>
                                    {{ $item->get_title() }}
                                </h2>

                                <img class="img-responsive" <?php echo $result[0][0];?> width="300" >
                            </a>

                            <?php
                              $start = strpos($item->get_description(), '<p>');
                              $end = strpos($item->get_description(), '</p>', $start);
                              $paragraph = substr($item->get_description(), $start, $end-$start+4);
                              $paragraph = html_entity_decode(strip_tags($paragraph));
                             ?>

                            <p>  {{$paragraph}}</p>
                            <a href="{{ $item->get_permalink() }}" target="_blank" class="btn btn-info pull-right">Read more</a>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="small">
                                        <h5>Posted on:</h5>
                                        <div> <i class="fa fa-comments-o"> </i>  {{ $item->get_date('j F Y | g:i a') }} </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                        @endforeach

                    </div>
                </div>
          </div>
  </div>


@endsection

@section('scripts')
  <script>
  $(function(){
    var zip = 'https://medium.com/feed/xinrox';
    $.ajax({
      url: "https://query.yahooapis.com/v1/public/yql",
      jsonp: "callback",
      dataType: "jsonp",
      data: {
        q: "select * from feednormalizer where url='" +zip + "' ",
        format: "json"
      },
      success: function(response) {
        $('#Content').html('');
        $.each(response.query.results.Result, function(index, element) {
          $('#rss').append('<p><a href="' + element.MapUrl + '" target="_blank">' + element.Title + '</a></p>');
        });
      }
    })
    // $.ajaxSetup({
    //    headers:{
    //          'Access-Control-Allow-Origin': '*'
    //    }
    //  });
    //  var g = {data:""};
    //  var targeturl = "https://medium.com/feed/xinrox";
    // // var url = "http://query.yahooapis.com/v1/public/yql?"+
    // //     "q=select%20*%20from%feednormalizer%20where%20url%3D%22"+
    // //     encodeURIComponent(targeturl)+
    // //     "%22&format=xml'&callback=?";
    //
    //   var url = 'https://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent('select * from feednormalizer where url="' + 'https://medium.com/feed/xinrox' + '"') + '&format=json';
    //
    //  var successfunc = function(data) {
    //     if(data.results[0]){
    //         g.data = data.results[o];
    //     } else {
    //         var errormsg = '<p>Error: could not load the page.</p>';
    //         alert(errormsg);
    //     }
    // }
    //
    // $.ajax({
    //         url: url,
    //         dataType: "json",
    //         contentType: "application/json; charset=utf-8",
    //         success: successfunc
    //   });
    //var query = 'https://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent('select * from feednormalizer where url="' + 'https://medium.com/feed/xinrox' + '"') + '&format=json';
      //  var query =  'https://medium.com/feed/xinrox';
      // console.log(query);
      //   $.get(query, function(data) {
      //     let items = data.query.results.rss.channel.item;
      //     // console.log(data);
      //     for(var x = 0; x < 3 ; x++) {
      //       let item = items[x];
      //       console.log(item);
      //       var img = item.encoded.match(/src=\"(.*?)\"/);
      //       let container =
      //         "<div class='col col-lg-4 col-md-3 col-sm-12 col-12'> " +
      //           "<a href='"+item.link+"' target='_blank'><div class='card'>" +
      //             "<img width='100%' src='"+img[1]+"'>"+
      //             "<div class='blog-title'> <div class='table w-100 h-100'> <div class='table-cell  w-100 h-100'>" + item.title + " </div> </div> </div>" +
      //           "</div></a>" +
      //         "</div>";
      //       $('#rss').append(container);
      //     }
      //   });
  });
  </script>

@endsection
