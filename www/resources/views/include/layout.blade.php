<!DOCTYPE html>
<html>
	<head>
		<title>API Calling Application</title>
		@include('include.css')
	</head>
	<body>
		<div class="container pd-t-50">
			<div class="row">
				<div class="col">	
					@yield('content')
				</div>
			</div>
		</div>	
		@include('include.javascript')
	</body>
</html>