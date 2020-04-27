<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CTF Platform</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('/css/app.css') }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        time {
          border-bottom: #333 1px dotted;
        }
    </style>

    <style type="text/css">

        .masthead.segment.inverted {
            background-color: #39424e;
        }
        .masthead.segment {
          min-height: 100vh;
          padding: 1em 0em;
        }
        .masthead .logo.item img {
          margin-right: 1em;
        }
        .masthead .ui.menu .ui.button {
          margin-left: 0.5em;
        }
        .masthead h1.ui.header {
          margin-bottom: 0em;
          font-size: 4em;
          font-weight: normal;
        }
        .masthead h2 {
          font-size: 1.7em;
          font-weight: normal;
        }

        .ui.vertical.stripe {
          padding: 8em 0em;
        }
        .ui.vertical.stripe h3 {
          font-size: 2em;
        }
        .ui.vertical.stripe .button + h3,
        .ui.vertical.stripe p + h3 {
          margin-top: 3em;
        }
        .ui.vertical.stripe .floated.image {
          clear: both;
        }
        .ui.vertical.stripe p {
          font-size: 1.33em;
        }
        .ui.vertical.stripe .horizontal.divider {
          margin: 3em 0em;
        }

        .quote.stripe.segment {
          padding: 0em;
        }
        .quote.stripe.segment .grid .column {
          padding-top: 5em;
          padding-bottom: 5em;
        }

        .footer.segment {
          padding: 5em 0em;
        }

        .secondary.pointing.menu .toc.item {
          display: none;
        }

        .ui.secondary.inverted.pointing.menu {
            border-width: 0px;
        }

        @media only screen and (max-width: 700px) {
          .ui.fixed.menu {
            display: none !important;
          }
          .secondary.pointing.menu .item,
          .secondary.pointing.menu .menu {
            display: none;
          }
          .secondary.pointing.menu .toc.item {
            display: block;
          }
          .masthead.segment {
            min-height: 350px;
          }
          .masthead h1.ui.header {
            font-size: 2em;
            margin-top: 1.5em;
          }
          .masthead h2 {
            margin-top: 0.5em;
            font-size: 1.5em;
          }
        }

        .inverted.custom {
            background-color: #39424e !important;
        }

        footer{
          height: 5%;
          background-color: #333;
          text-align: center;
          color: white;
          padding-top: 1%;
          padding-bottom: 1%;
          margin-top: 3%
        }

    </style>

</head>
<body>
@include('cookieConsent::index')
@if (Auth::check() && Auth::user()->isBanned())
  <script>window.location.href = "{{url('/banned')}}";</script>
@else
  <!-- Following Menu -->
  <div class="ui large top fixed hidden menu">
      <div class="ui container">
          <a class="item" href="{{ url('/') }}">Home</a>
          <a class="item" href="{{ url('/competition') }}">Competition</a>
          <a class="item" href="{{ url('/users') }}">Users</a>

          @if (Auth::check() && Auth::user()->isAdmin())
              <a class="item" href="{{ url('/admin') }}">Admin</a>
          @endif

          <div class="right menu">
              <div class="active item" id="current_time">
                {{Carbon\Carbon::now()}}
              </div>
              <!-- Authentication Links -->
              @if (Auth::guest())
                  <div class="item">
                      <a href="{{ url('/login') }}" class="ui button">Log in</a>
                  </div>
                  <div class="item">
                      <a href="{{ url('/register') }}" class="ui primary button">Sign Up</a>
                  </div>
              @else
                  <div class="ui simple dropdown item">
                      {{ Auth::user()->username }} <i class="dropdown icon"></i>
                      <div class="menu">
                              <a href="{{ url('/user/' . Auth::user()->id) }}" class="item">Profile</a>
                              <a href="{{ url('/logout') }}" class="item">Log out</a>
                      </div>
                  </div>
              @endif

          </div>

      </div>
</div>




  <!-- Page Contents -->
  <div class="pusher">
        @yield('content')
  </div>

      <!-- JavaScripts -->
      <script src="{{url('/js/app.js')}}"></script>
      {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

      <script>
          $(document).ready(function() {
              // create sidebar and attach to menu open
              $('.ui.sidebar').sidebar('attach events', '.toc.item');
              // start clock
              clock();
          });

          function clock() {
            console.log('clock called');
            var now = new Date();
            var h = pad(now.getHours());
            var m = pad(now.getMinutes());
            var s = pad(now.getSeconds());
            $('#current_time').html(h + ":" + m + ":" + s);
            var t = setTimeout(clock, 500);
          }

          function pad(num) {
            if (num < 10)
              num = "0" + num;
            return num;
          }
      </script>

      @yield('tail')
@endif

<footer>2020 Copyright. Diseñado por Gonzalo Cruceira Grosso. <a href="https://www.publico.es/aviso-legal">Aviso legal.</a><a href="https://www.aepd.es/es/politica-de-privacidad-y-aviso-legal">Política de privacidad</a></footer>
</body>
</html>