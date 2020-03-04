<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TimeSheet | User Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <style type="text/css">
        .login-form {
            width: 340px;
            margin: 50px auto;
            opacity: 0.7;
        }
        .login-form form {
            margin-bottom: 15px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {        
            font-size: 15px;
            font-weight: bold;
        }
        .background {
            position: absolute;
            top: 0px;
            width: 100%;
            max-height: 900px;
            min-height: 900px;
            z-index: -10;
            overflow: hidden;
            
        }
        @-webkit-keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
        }

        @keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
        }
        .background img {
            width: 100%;
            max-height: 900px;
            min-height: 900px;
            -webkit-animation-name: fade;
            -webkit-animation-duration: 2.5s;
            animation-name: fade;
            animation-duration: 2.5s;
        }
        .text-center {
            color: #00ff08d1;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="login">
    <div class="background">
        @foreach($images as $image)
        <img src="{{ asset('img/'.$image->image) }}" class="mySlides">
        @endforeach
    </div>
    <div class="">
        <img src="{{ asset('img/login/aec-logo-1.png') }}" alt="" width="40%;" style="margin-top: -100px; margin-left: -150px; float:left;" /> </a>
    </div>
    <div class="">
        <h3 style="font-size: 50px; font-family:Lucida Fax; font-weight: bold; color: white;text-align: right;margin-right: 150px;padding-top: 100px;">Welcome to AEC</h3>
    </div>
    <div class="login-form">
        <form action="{{ url('home') }}" method="post">
            {{ csrf_field() }}
            <h2 class="text-center">Login to your account</h2>       
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </div>      
        </form>
    </div>
    
</div>
</body>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script>
var slideIndex = 0;
    $(document).ready(function(){
        
        changeImage();
    })
    function changeImage(){
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        slides[slideIndex-1].style.display = "block";  
        setTimeout(changeImage, 6000);
    }
</script>
</html>                    