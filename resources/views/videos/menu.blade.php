@extends('app')

@section('content')
<div class="jumbotron">
        <h3>List of Classes</h3>
</div>
<div hidden>{{$patterns = '/[^a-zA-Z0-9]/'}}</div>
@if ( !$classes->count() )
                You have no classes
@else

                <ul class = "list-group">
                    @foreach ($classes as $class)
                     <div class="collapse-group">
                        <li class="list-group-item"  >
                            <h3 data-toggle="collapse" data-target="#details-{{preg_replace($patterns,'',$class['class'])}}">{{$class['class']}} &raquo;</h3>
                                <div id="details-{{preg_replace($patterns,'',$class['class'])}}" class="collapse">
                                    <ul class = "list-group">
                                      @foreach ($menuList as $item)
                                            @if ($class['class']==$item['course'])
                                            <div class="collapse-group">
                                                <li class="list-group-item"  >
                                                    <h4 data-toggle="collapse" data-target="#details-{{preg_replace($patterns,'',$class['class'])}}-{{preg_replace($patterns,'',$item['unit'])}}"> {{$item['unit']}} &raquo;</h4>
                                                        <div id="details-{{preg_replace($patterns,'',$class['class'])}}-{{preg_replace($patterns,'',$item['unit'])}}" class="collapse">
                                                          <ul class = "list-group">
                                                            @foreach ($data as $itemVideo)
                                                              @if (($itemVideo['class']== $class['class'])&&($itemVideo['unit']== $item['unit']))
                                                                <div class="collapse-group">
                                                                <li class="list-group-item">
                                                                <div class="row">
                                                                 <div class="col-xs-2 video-wrapper">
                                                                  <!-- <a href="{{ URL::route('videos.show', $itemVideo['slug']) }}">
                                                                    <video width="320" height="240" preload="metadata"  >
                                                                      <source src="{{video_base_path}}/{{$itemVideo['vid_url']}}" type="video/mp4">
                                                                        Your browser does not support the video tag.
                                                                      </video>
                                                                    </a> -->
                                                                  </div>
                                                                  <div class="cols-xs-8" style="position:relative; overflow:auto;">
                                                                  <a href="{{ URL::route('videos.show', $itemVideo['slug']) }}"><h4 >{{ucwords($itemVideo['title'])}}</h4></a>
                                                                  <strong><p> Topic: {{$itemVideo['topic']}} <br/>
                                                                    Instructor: {{ $itemVideo['instructor'] }} <br/>
                                                                    @if ( !$itemVideo['updated_at'] )
                                                                      Created Date: {{ $itemVideo['created_at'] }}
                                                                    @else
                                                                      Updated Last: {{ $itemVideo['updated_at'] }}
                                                                    @endif
                                                                  </p></strong>
                                                                  <div class="hidden">{{$userRole = AuthHelper::authenticate()}}</div>
                                                                        @if($userRole == 'admin' || $userRole == 'faculty')
                                                                            <div class="well well-sm"><p class="text-primary"><strong>{{video_absolute_path}}/{{$itemVideo['vid_url']}}<strong></p></div>
                                                                            <style type='text/css'>
                                                                            form{display:inline;}
                                                                            textarea{font-size:10px;vertical-align:middle}
                                                                            button{vertical-align:middle}
                                                                            </style>
                                                                            <textarea class="js-copytextarea" id="clipboard{{$itemVideo['id']}}" rows="1" cols="10">&lt;iframe name=&quot;wistia_embed&quot; width=&quot;645&quot; height=&quot;365&quot; src=&quot;{{video_player}}/{{$itemVideo['vid_url']}}&quot; allowtransparency=&quot;true&quot; frameborder=&quot;0&quot; scrolling=&quot;no&quot; allowfullscreen=&quot;yes&quot;&gt;&lt;/iframe&gt;</textarea><button class="js-textareacopybtn" onclick="copy('clipboard{{$itemVideo['id']}}')">Blackboard embed tag</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                              							<textarea class="js-copytextarea" id="clipboardWeb{{$itemVideo['id']}}" rows="1" cols="10">&lt;video width=&quot;640&quot; height=&quot;360&quot; allowtransparency=&quot;true&quot; frameborder=&quot;0&quot; scrolling=&quot;no&quot; controls&gt;
                                                              								&lt;source src=&quot;{{video_absolute_path}}/{{$itemVideo['vid_url']}}"&quot; type=&quot;video/mp4&quot;&gt;
                                                              								Your browser does not support the video tag.
                                                              								&lt;/video&gt;</textarea><button class="js-textareacopybtn" onclick="copy('clipboardWeb{{$itemVideo['id']}}')">Web embed tag</button>
                                                              							@endif
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
<script type="text/javascript">
function copy(id) {
	var text = document.getElementById(id);
	text.select();
	try{
			document.execCommand('copy');
		}catch(err){
			console.log("error in copying");
		}
}
</script>
@endsection
