<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Vidman</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="//releases.flowplayer.org/6.0.3/skin/minimalist.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>


	<script src="//releases.flowplayer.org/6.0.3/flowplayer.min.js"></script>
	<!--  Favicon    -->

	<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
	<link rel="manifest" href="/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">


</head>
<body  style="background-color:#EEE; position:;">
	<div name = "body" class = "container" style="height:100%; position:relative; min-height:100%;">
    	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/vidman/index.php/videos"><img src="https://vidman.asu.edu/som_sslogo.png" alt="ASU"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">

		<li class="active"><a href="{{videos_page}}" style="font-style:Symbol; font-weight:bold; color:#903; outline:none;">Vidman - Video Management tool at SoMSS</a></li>
          </ul>

	  {!! Form::open(array('action' => 'VideosController@search', 'class' => 'navbar-form navbar-left', 'role' => 'search')) !!}

            <div class="form-group">
		{!! Form::text('search', null, array('class'=>'form-control', 'placeholder' => 'Search')) !!}
            </div>
		{!! Form::button('<span class="glyphicon glyphicon-search"></span>', array('class'=>'btn btn-default', 'type'=>'submit')) !!}
          </form>

          <ul class="nav navbar-nav navbar-right" >
	<div class="hidden">{{$userRole = AuthHelper::authenticate()}}</div>
          	@if (Cas::user())
			@if($userRole == 'admin' || $userRole == 'faculty')
				<li>{!! link_to_route('videos.create', 'Upload Video', null, array('style'=>'font-weight:bold; color:#2196f3; outline:none;')) !!}</li>
        @if($userRole == 'admin')
          <li>{!! link_to_route('roles.index', 'Admin', null, array('style'=>'font-weight:bold; outline:none;')) !!}</li>
          @endif
			@endif
          <li class="dropdown" style="font-weight:bold;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Cas::user()}} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{action('VideosController@logout')}}" style="font-weight:bold;">logout</a></li>
            </ul>
          </li>
    		@endif
          </ul>
        </div>
      </div>
    </nav>

    <!-- Sucess/Error Messages-->
<div style="padding-top:60px;">
    @if ($errors->any())
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        @foreach ( $errors->all() as $error )
           {{ $error }}<br/>
        @endforeach
      </div>
      @endif

    @if (Session::has('message'))
      <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('message') }}</strong>.
      </div>
    @endif
</div>



      @yield('content')


	<div class="container footer" style="bottom:0; display:block; border:none; background-color:#F9F9F9;">
<div class="well">
	<div class="rows">
		<div class="col-sm-4" style="text-align:left;"><strong><p>An  academic unit of</p><p class="text-primary"><a href="http://clas.asu.edu/"><h5>College of Liberal Arts and Sciences</h5></a></p></strong></div>
		<div class="col-sm-4" style="text-align:left;"><center><img src="https://vidman.asu.edu/asu-logo.png" style="width:100px; height:auto;" /></center></div>
		<div class="col-sm-4" style="text-align:right;"><strong><p class="text-primary"><h6><a href="https://math.asu.edu/">School of Mathematical and Statistical Sciences</a></h6></p>
			<p>Wexlar Hall | P.O. Box 871804, Tempe, AZ 85287-1804<br/>Phone: 480-965-7195 | Fax: 480-965-5569 | <a href="https://math.asu.edu/contact-us/contact-us">Contact Us</a></p></strong>
		</div>
            </div>
  	</div>
            <br/>
            <br/>
	</div>

</div>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	@yield('modals')
</body>
</html>
