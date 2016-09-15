@extends('app')

@section('content')
<div class="jumbotron">
        <h3>List of Classes</h3>
</div>
<div hidden>{{$patterns = '/[^a-zA-Z0-9]/'}}</div>
@if ( !$classes->count() )
                You have no classes
@else
        <script type='text/javascript'>alert({{$topicsList}});</script>
                <ul class = "list-group">
                    @foreach ($classes as $class)
                     <div class="collapse-group">
                        <li class="list-group-item"  >
                            <h3 data-toggle="collapse" data-target="#details-{{preg_replace($patterns,'',$class['class'])}}">{{$class['class']}} &raquo;</h3>
                                <div id="details-{{preg_replace($patterns,'',$class['class'])}}" class="collapse">
                                    <ul class = "list-group">
                                      @foreach ($menuList as $item)
                                          @if(($item['class'] == $class['class']) && ($item['topic'] == "None"))
                                          <div class="collapse-group">
                                          <li class="list-group-item">
                                             <div class="row">
                                               <div class="col-xs-4 video-wrapper">
                                                <a href="{{ URL::route('videos.show', $item['slug']) }}">
                                                <video width="320" height="240" preload="metadata"  >
                                                  <source src="{{video_base_path}}/{{$item['vid_url']}}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                </a>

                                              </div>
                                               <div class="cols-xs-8" style="position:relative; overflow:auto;">
                                                <a href="{{ URL::route('videos.show', $item['slug']) }}"><h4 >{{ucwords($item['title'])}}</h4></a>
                                                <strong><p> Topic: {{$item['topic']}} <br/>
                                                  Instructor: {{ $item['instructor'] }} <br/>
                                                  @if ( !$item['updated_at'] )
                                                        Created Date: {{ $item['created_at'] }}
                                                  @else
                                                        Updated Last: {{ $item['updated_at'] }}
                                                  @endif
                                                </p></strong>
                                                <div class="well well-sm"><p class="text-primary"><strong>{{video_absolute_path}}/{{$item['vid_url']}}<strong></p></div>
                                              </div>
                                            </div>
                                          <li>
                                          </div>
                                          @endif
                                      @endforeach
                                        @foreach ($topicsList as $item)
                                            @if ($class['class']==$item['class'])
                                            <div class="collapse-group">
                                                <li class="list-group-item"  >
                                                    <h4 data-toggle="collapse" data-target="#details-{{preg_replace($patterns,'',$class['class'])}}-{{preg_replace($patterns,'',$item['topic'])}}"> {{$item['topic']}} &raquo;</h4>
                                                        <div id="details-{{preg_replace($patterns,'',$class['class'])}}-{{preg_replace($patterns,'',$item['topic'])}}" class="collapse">
                                                        <ul class = "list-group">
                                                            @foreach ($menuList as $itemTopic)
                                                                @if (($itemTopic['class']== $class['class'])&&($itemTopic['topic']== $item['topic']))
                                                                    <div class="collapse-group">
                                                                    <li class="list-group-item">
                      	                                               <div class="row">
                                                                         <div class="col-xs-4 video-wrapper">

                                                                           <a href="{{ URL::route('videos.show', $itemTopic['slug']) }}">
                                                                          <video width="320" height="240" preload="metadata"  >
                                                                          <source src="{{video_base_path}}/{{$itemTopic['vid_url']}}" type="video/mp4">
                                                                           Your browser does not support the video tag.
                                                                         </video>
                                                                          </a>

                                                                        </div>
                                                                         <div class="cols-xs-8" style="position:relative; overflow:auto;">
                                                                          <a href="{{ URL::route('videos.show', $itemTopic['slug']) }}"><h4 >{{ucwords($itemTopic['title'])}}</h4></a>
                                                                          <strong><p> Topic: {{$itemTopic['topic']}} <br/>
                                                                            Instructor: {{ $itemTopic['instructor'] }} <br/>
                                                                            @if ( !$itemTopic['updated_at'] )
                                                                                  Created Date: {{ $itemTopic['created_at'] }}
                                                                            @else
                                                                                  Updated Last: {{ $itemTopic['updated_at'] }}

                                                                            @endif
                                                                          </p></strong>

                                                                          <div class="well well-sm"><p class="text-primary"><strong>{{video_absolute_path}}/{{$itemTopic['vid_url']}}<strong></p></div>

                                                                        </div>
                                                                      </div>
                                                                    <li>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                            </div>
                                            @endif

                                        @endforeach

                                    </ul>
                                </div>
                        </li>
                     </div>
                    @endforeach
                </ul>
@endif
@endsection
