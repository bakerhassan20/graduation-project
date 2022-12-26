<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content=""/>
		@include('layouts.head')
	</head>

	<body class="main-body app sidebar-mini dark-theme ">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include('layouts.main-sidebar')
		<!-- main-content -->
		<div class="main-content app-content">
			@include('layouts.main-header')
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
				@yield('content')
				@include('layouts.sidebar')
				@include('layouts.models')
            	@include('layouts.footer')
				@include('layouts.footer-scripts')
	</body>
</html>

<script>
    setInterval(function() {
        $("#notifications_count").load(window.location.href + " #notifications_count");
        $("#unreadNotifications").load(window.location.href + " #unreadNotifications");
    }, 5000000);

</script>
<script>

  $(function(){

    $(".main-layout .layout-setting").on("click", function(){
        $.ajax({
            type:'get',
            url:"{{ route('theme') }}",

            success: function (data) {
                console.log(data.message);
                if(data.message == 'dark'){
                   $("head").append("<link href='{{URL::asset('assets/css-rtl/style-dark.css')}}' rel='stylesheet'>");
                   $(".light-layout").empty();
                   $(".light-layout").append("<i class='bx bx-sun fa-lg'></i>");
                   $('body').addClass("dark-theme");
                }else{
                    $(".light-layout").empty();
                    $(".light-layout").append("<i class='bx bx-moon fa-lg'></i>");
                    $('body').removeClass("dark-theme");
            }

            },
        error: function(error) {
        console.log(error.responseText);
            }
        });
      });

  });


</script>
