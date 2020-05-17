<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>配置账号</title>
    <link rel="shortcut icon" href="/shadowrocket/images/favicon.ico">
    <link rel="stylesheet" href="/shadowrocket/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/shadowrocket/css/style.css" />
    <link rel="stylesheet" href="/shadowrocket/css/my.css" />
</head>
<body>
    <div class="wrap">
        <div class="main">
			<div class="topbread" style="margin-bottom: 20px;">
		    	<div class="container">
                  <h1 class="text-center">配置账号</h1>
		    	</div>
			</div>
			<div style="margin-top: 30px; margin-bottom: 20px;">
		        <div style="text-align:center;">
		  			<div class="polaroid">
                        <div class="logo">
                            <img src="/shadowrocket/images/icon.jpg" class="img-circle" width="120" height="120" />
                        </div>
                    </div>
		            <div style="padding-top:20px;">
		                <span id="checkinfo">
							<p style="color:red;">这是您的专属页面</p>
							<p style="color:red;">传播本页面将导致您的账号被封号</p>
							<p style="color:blue; padding-bottom:15px; font-size:14px;">如果弹出提示请点“允许”或“Allow”</p>
                            <br />
                            <br />
		                    <a href="{{$sub}}" class="btn btn-success btn-lg btn-circle">点这里自动配置账号</a>
                            <br />
                            <br />
							{{--<a href="{{$rule}}" class="btn btn-success btn-lg btn-circle">第2步：载入规则</a><br /><br />--}}
		                    {{--<a href="shadowrocket://connect" class="btn btn-success btn-lg btn-circle">第2步：连接</a>--}}
		                    <div class="uatip" id="uaTip">
								<span class="uatip-icon"></span>
								<p class="uatip-txt">点击右上角<br/>选择在Safari中打开</p>
							</div>
		                </span>
		            </div>
		        </div>
                <br/>
			</div>
        </div>
    </div>
	<div class="footer">
        <div class="text-center">
             ©&nbsp;2017 - 2020
        </div>
	</div>
<script type="text/javascript" src="/shadowrocket/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
			var ua = navigator.userAgent;
			var Browser = /Safari/.test(ua) && !/Chrome/.test(ua);
			if  (Browser == 0) {
				window.event? window.event.returnValue = false : e.preventDefault();
				document.getElementById('uaTip').style.display='block';
			}
		}
	);
</script>
</body>
</html>
