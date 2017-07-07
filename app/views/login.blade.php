<!doctype html>
<html>
<head>
<title>Schoolender: Belépés</title>
<style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      body {
  background: #222222 url('img/login_bg.jpg') no-repeat top center fixed;
  background-size: cover;
  color: #b5b5b5;
  font-family: sans-serif;
}

h2 {
  color: #a4bc4f;
  font-size: 20px;
  font-weight: 400;
  text-align: left;
  padding: 30px 0px 20px 25px
}

a {
  color: #46485c;
  text-decoration: none;
}

.login {
  width: 300px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -184px 0px 0px -150px;
  background: #FFFFFF;
  box-shadow: 0px 0px 0px 9999px rgba(0,0,0,0.6);
  animation-fill-mode: both;
  animation-duration: 1s;
  animation-name: bounceInDown;
  border-radius: 3px;
}

.user, .pw{
  border-left: 5px solid transparent;
  transition: all 0.3s linear;
}

.user:hover, .pw:hover{
  background: #F0F0F0;
    border-left: 5px solid #8FB252;
    
}

input[type="text"], input[type="password"] {
  width: 290px;
  padding: 20px 0px;
  background: transparent;
  border: 0;
  outline: none;
  color: #222;
  margin: 0 auto;
  text-indent: 20px;
  font-weight: bold;
}

input[type=checkbox] {
  display: none;
}

label {
  display: block;
  position: absolute;
  margin-top: 2px;
  width: 6px;
  height: 6px;
  border-radius: 2px;
  content: "";
  transition: all 0.5s ease-in-out;
  cursor: pointer;
  border: 3px solid white;
  box-shadow: 0px 0px 0px 2px #ccc;
}

#remember:checked ~ label[for=remember] {
  background: #b5cd60;
  border: 3px solid white;
  box-shadow: 0px 0px 0px 2px #b5cd60;
}


input[type="submit"] {
  background: #b5cd60;
  border: 0;
  height: 30px;
  border-radius: 3px;
  color: white;
  font-weight: bold;
  padding: 0px 25px;
  cursor: pointer;
  transition: background 0.3s ease-in-out;
  margin-left: 50px;
}
input[type="submit"]:hover {
  background: #a4bc4f;
}

.forgot {
  margin-top: 25px;
  display: block;
  font-size: 13px;
  text-align: left;
  font-weight: bold;
  color: #b5b5b5;
  padding: 0px 0px 25px 25px;
}


::-webkit-input-placeholder {
  color: #777;
  font-weight: bold;
}

.remlog{
  border-bottom: 1px solid #ddd;
}

.remember {
  padding: 30px 0px;
  font-size: 12px;
  text-indent: 20px;
  line-height: 15px;
  margin-left: 25px;
  display: inline-block;
}

.forgot h3{
  font-size: 16px;
  font-weight: normal;
  margin-bottom: 15px;
}

.forgot a{
  color: #777;
}

.close{
  width: 32px;
  height: 32px;
  display: block;
  border: 0;
  border-radius: 0px 3px 0px 0px;
  position: absolute;
  right: 0px;
  padding: 0px;
  background: #fff;
  cursor: pointer;
  border-left: 1px solid #eee;
  border-bottom: 1px solid #eee;
}

.close:after{
  content:'';
  display: block;
  position: absolute;
  width: 3px;
  height: 16px;
  transform: rotate(45deg);
  background: #ccc;
  margin: -8px 0px 0px 14px
}
.close:before{
  content:'';
  display: block;
  position: absolute;
  width: 3px;
  height: 16px;
  transform: rotate(-45deg);
  background: #ccc;
  margin: -8px 0px 0px 14px
}

.close:hover:before,.close:hover:after{
  background: #777;
  transition: all 0.2s linear;
}

#SignIn{
  border: 2px solid white;
  background: transparent;
  padding: 10px 35px;
  margin: -21px 0px 0px -57px;
  color: white;
  border-radius: 20px;
  cursor: pointer;
  position:absolute;
  top: 50%;
  left: 50%;
  outline: none;
  
}

@keyframes bounceInDown{
0% {opacity: 0;	transform: translateY(-2000px);}
60% {opacity: 1;transform: translateY(30px);}
80% {transform: translateY(-10px);}
100% {transform: translateY(0);}

    </style>
</head>
<body>
{{ Form::open(array('url' => 'login')) }}

<div class='login'>

@if(Session::has('error'))
	<div class="alert-box success">
  		<h2>{{ Session::get('error') }}</h2>
	</div>
@endif
<div class='top'>
	<h2>Belépés</h2>
</div>
<div class="controls user">
{{ Form::text('email','',array('id'=>'','class'=>'form-control span6','placeholder' => 'E-mail cím')) }}
<p class="errors">{{$errors->first('email')}}</p>
</div>
<div class="controls pw ">
{{ Form::password('password',array('class'=>'form-control span6', 'placeholder' => 'Jelszó')) }}
<p class="errors">{{$errors->first('password')}}</p>
</div>
<p>{{ Form::submit('Belépés', array('class'=>'send-btn')) }}</p>
{{ Form::close() }}
</div>

</body>
</html>
