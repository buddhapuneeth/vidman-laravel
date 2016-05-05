<html>
	<head>
		<title>Vidman</title>

		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
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
		<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #797979;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			.container {
				display: table-cell;
				text-align: center;
				width: 100%;
				height: 100%;
			}

			.content {
				width:80%;
				display: inline-block;
			}

			.content .title {
				text-align: left;
				font-size: 96px;
				border-bottom: solid;
				border-color: #E0E0E0;
				border-width: thin;
			}

			.content .quote {
				font-size: 24px;
				font-weight: 900;
				text-align: right
			}
			::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color: #000;
			}
			:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   			color: #000;
   			opacity:1;
			}
			::-moz-placeholder { /* Mozilla Firefox 19+ */
   			color:#000;
   			opacity:1;
			}
			:-ms-input-placeholder { /* Internet Explorer 10-11 */
   			color#909;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">Vidman</div>
				<div class="quote">The Video Server at SoMSS</div>
				<div class = "jumbotron">
					<div class = "row">
						<div class = "col-sm-12">
							<center><div class="container" class = "padding:20px"><img src="https://vidman.asu.edu/vidman-homepage.gif" width=320px height="240px"></img></div></center>
							<br/><br/>
							<center><div class ="container">	<a href="https://helios.asu.edu/vidman/index.php/videos" class = "btn btn-primary btn-lg" ><strong>Go To Videos</strong></a></div></center>
						</div>

					<div class = "col-sm-6" style="padding:20px">

							<!--{!! Form::open(array('action' => 'VideosController@search', 'class' => 'navbar-form navbar-left', 'role' => 'search')) !!}

					            <div class="form-group">
							{!! Form::text('search', null, array('class'=>'form-control', 'placeholder' => 'What video are you looking for ??', 'style'=>'width:20em')) !!}
						</div><br/><br/>
							{!! Form::button('<strong>Go To Videos</strong>', array('class'=>'btn btn-primary btn-block', 'type'=>'submit')) !!}
-->
						</div>
					</div>
				</div>
				<!--<div class="container footer" style="bottom:0; display:block; border:none; background-color:#F9F9F9;">
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
				</div>-->
			</div>
		</div>
	</body>
</html>
