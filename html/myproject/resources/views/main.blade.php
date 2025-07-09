<!DOCTYPE html>

<script>
    function find_text()
    {
        form1.action="#";
        form1.submit();
    }
	
</script>

<html lang="kr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Game</title>
    <link href="{{ asset('my/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('my/css/my.css') }}" rel="stylesheet">
    <script src="{{ asset('my/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('my/js/popper.js') }}"></script>
    <script src="{{ asset('my/js/bootstrap.min.js') }}"></script>
	
    <script src="{{ asset('my/js/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('my/js/bootstrap5-datetimepicker.js') }}"></script>
    <link href="{{ asset('my/css/bootstrap5-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('my/css/all.min.css') }}" rel="stylesheet">
	
	

</head>
<body style="background-color:#1E242F">
    <div class="container">
		<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #1E242F;">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Game</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
			data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="{{route('game.index')}}">게임</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{route('picture.index')}}">사진</a>
					</li>


					
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" 
							   role="button" data-bs-toggle="dropdown" aria-expanded="false">  
							기초정보
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="{{route('platform.index')}}">플랫폼</a></li>
							<li><a class="dropdown-item" href="{{route('publisher.index')}}">퍼블리셔</a></li>
							@if (session()->get("rank")==1)
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item" href="">사용자</a></li>
							@endif
						</ul>
					</li>
				
				</ul>

			  </div>
			</nav>
			
			<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
			<div class="carousel-indicators">
				<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" aria-label="Slide 1"
					class="active" aria-current="true" ></button>
				<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
				<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
			</div>
			<div class="carousel-inner">
				<div class="carousel-item active">
				   <img src="{{ asset('/my/img/game3.JPG') }}" height="350" class="d-block w-100">
				</div>
				<div class="carousel-item">
					<img src="{{ asset('/my/img/game2.JPG') }}" height="350" class="d-block w-100">
				</div>
				<div class="carousel-item">
					<img src="{{ asset('/my/img/game1.JPG') }}" height="350" class="d-block w-100">
				 </div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
			</div>

			@yield("content")

    </div>
</body>
</html>
<!-- Login Modal -->
