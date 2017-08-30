<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sumra') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <style>
        img.lazyload{
            width: 100%;
        }
    </style>

</head>
<body class="">
<header>
    <div class="top hidden-xs">
        <div class="row">
            <div class="col">
                <img class="icon" src="css/sumra-text.png">
            </div>
        </div>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img class="icon" src="css/ic_launcher1.png"></a>
                <div class="col-2 col-md-8 col-lg-5 pull-right hidden-xs hidden-sm">
                    <div class="center-block">
                        <img class="img-responsive" src="css/googleplayx233.png">
                    </div>
                    <div class="center-block">
                        <img class="img-responsive" src="css/appstorex233.png">
                    </div>
                    <div class="center-block">
                        <img class="img-responsive" src="css/windowsx233.png">
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Store</a></li>
                    @if (Auth::guest())
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Sign Up</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li><a class="btn btn-info bussines" role="button" href="#">Sumra for Business</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
    <div class="row search">
        <div class="col-sm-1 col-md-1 col-lg-2 hidden-xs">
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
            <form class="navbar-form" action="/search/">
                <div class="form-group col-md-12 col-lg-12">
                    <input type="text" class="form-control input-lg" name="keyword" placeholder="SEARCH">
                    <div class="input-group col-sm-4 col-md-3 col-lg-3 col-xl-2 input-group-lg">
                        <input type="text" class="form-control" placeholder="POST CODE" >
                        <span class="input-group-btn">
							     		<button class="btn btn-default" type="submit">Go</button>
							      	</span>
                    </div>
                </div>
            </form>
        </div><!-- /.col-lg-6 -->
    </div>
</header>


<section>
    @yield('content')

</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img id="footer_top_logo" class="img-responsive" title="" alt="" src="css/sumra-text.png">
            </div>

            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-2">
                <div class="col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="/about-us" title="About us">About us</a></li>
                        <li><a href="/history/about" title="Company History">Company History</a></li>
                        <li><a href="/contact-us" title="Contact us">Contact us</a></li>
                        <!--<li></li>-->
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Discover</h4>
                    <ul>
                        <li><a href="/why-us" title="Why Us">Why Us</a></li>
                        <li><a href="/our-programs" title="Our programmes">Our academic programmes</a></li>
                        <li><a href="/our-teaching-methods" title="Our teaching methods">Our teaching methods</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Experience</h4>
                    <ul>
                        <li><a href="/growth" title="Growth">Growth</a></li>
                        <li><a href="/responsibility" title="Responsibility">Responsibility</a></li>
                        <li><a href="/security" title="Security">Security</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="/faq" title="F.A.Q.">F.A.Q.</a></li>
                        <li><a href="/help" title="Help">Help</a></li>
                        <li><a href="/how-it-works" title="How it works">How it works</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-2">
                <div class="col">
                    <h4>Commitment</h4>
                    <ul>
                        <li><a href="/privacy-policy" title="Privacy policy">Privacy policy</a></li>
                        <li><a href="/cookies-policy" title="Cookies policy">Cookies policy</a></li>
                        <li><a href="/terms-of-use" title="Terms of Use">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Partnerships</h4>
                    <ul>
                        <li><a href="/corporate-partners" title="Corporate partners">Corporate partners</a></li>
                        <li><a href="/education-partners" title="Education partners">Education partners</a></li>
                        <li><a href="/brand-partners" title="Brand partners">Brand partners</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <h4>Press & Opportunities</h4>
                    <ul>
                        <li><a href="/careers" title="Careers">Careers</a></li>
                        <li><a href="/press" title="Press">Press</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-xs-5 col-xs-offset-1 col-md-offset-0">
                <div class="col">
                    <img  class="img-responsive  footer_logo" src="/css/ic_launcher1.png" />
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright style-1">
    <div class="container">
        <div class="row">
            <div class="cell col-lg-4 col-md-8 col-xs-12 footer-copy col-md-offset-2 col-lg-offset-4">
                All rights reserved. Copyright &copy; 2017 <span class="company-rights">SUMRA</span>
            </div>
        </div>
    </div>
</div>
</body>
</html>