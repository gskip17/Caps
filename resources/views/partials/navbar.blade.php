
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{action('Home@Index')}}">Caps IM</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="{{action('Home@Index')}}">Home</a></li>
              <li><a href="{{action('Home@About')}}">About</a></li>
              <li><a href="#">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Play Now! <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{action('RegistrationController@Index')}}">Register A League!</a></li>
                  <li><a href="#">Submit Scores/Stats</a></li>
                  <li><a href="{{action('LeagueController@ViewUserLeagues')}}">View Your Leagues</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Stats</li>
                  <li><a href="#">Your Stats</a></li>
                  <li><a href="#">Top Stats</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> User <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  @if(Auth::check())
                  <li><a href="{{action('Auth\AuthController@logout')}}">Logout</a>
                  @else
                  <li><a href="{{action('Auth\AuthController@getLogin')}}">Login</a></li>
                  <li><a href="{{action('Auth\AuthController@getRegister')}}">Register</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Terms</a></li>
                  @endif
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
