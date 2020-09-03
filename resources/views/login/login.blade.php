<!DOCTYPE html>
<html>
<head>
  <title></title>

  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

</head>
<body
@if ($errors->has('username'))
    onload="salah()"
@endif
@if ($errors->has('password'))
    onload="salah()"
@endif
>

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

<div class="background-wrap">
  <div class="background"></div>
</div>

<form id="accesspanel" action="{{ $login_url }}" method="post">
  {{ csrf_field() }}
  <h1 id="litheader">Surat dan Rapat</h1>
  <div class="inset">
    <p>
      <input type="text" name="username" id="email" placeholder="username">
    </p>
    <p>
      <input type="password" name="password" id="password" placeholder="password">
    </p>
    <div style="text-align: center;">
      <div class="checkboxouter">
        <input type="checkbox" name="remember" id="remember" value="Remember">
        <label class="checkbox"></label>
      </div>
      <label for="remember">Remember me</label>
    </div>
    <input class="loginLoginValue" type="hidden" name="service" value="login" />
  </div>
  
  <p class="p-container">
    <input type="submit" name="Login" id="go" value="Authorize">
  </p>
</form>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
  $(document).ready(function() {

    var state = false;

    //$("input:text:visible:first").focus();

    $('#accesspanel').on('submit', function(e) {
            document.getElementById("litheader").className = "poweron";
            document.getElementById("go").className = "";
            document.getElementById("go").value = "Initializing...";
    });
});
</script>
<script>
  function salah() {
            document.getElementById("litheader").className = "";
            document.getElementById("go").className = "denied";
            document.getElementById("go").value = "Access Denied";
    };
</script>
</html>

