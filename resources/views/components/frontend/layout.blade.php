<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Arty - Business 1</title>
    <!-- Favicon -->
    <link href="{{asset('assets/images/favicon.png')}}" rel="shortcut icon">
    <!-- CSS -->
    <link href="{{asset('assets/plugins/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/owl-carousel/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/owl-carousel/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/justified-gallery/justified-gallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/sal/sal.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
    <!-- Fonts/Icons -->
    <link href="{{asset('assets/plugins/font-awesome/css/all.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/themify/themify-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
</head>
<body data-preloader="4">

<div class="wrapper">

    <!-- Scroll to Top -->
    <div class="scrolltotop">
        <a class="button-circle button-circle-sm button-circle-black" href="#"><i class="ti-arrow-up"></i></a>
    </div>
    <!-- end Scroll to Top -->


    <div class="header absolute-light fixed">
        <div class="container">
            <div class="logo">
                <h4 class="uppercase letter-spacing-2"><a href="#">Arty</a></h4>
                <!--
                <img class="logo-dark" src="../assets/images/your-logo-dark.jpg" alt="">
                <img class="logo-light" src="../assets/images/your-logo-light.jpg" alt="">
                -->
            </div>
            <div class="header-menu-wrapper">
                <!-- Menu -->
                <ul class="header-menu">
                    <form action="{{route('locale')}}" id="locale" class="d-inline">
                        <select name="lang" id="" onchange="document.querySelector('#locale').submit()">
                            @foreach($languages as $language)
                                <option @selected(app()->getLocale() === $language->code) value="{{$language->id}}">{{$language->name}}</option>
                            @endforeach
                        </select>
                    </form>
                    @foreach($menus as $menu)
                        <x-dynamic-component
                            component="{{'frontend.menus.' . $menu['template']}}"
                            :$menu
                        />
                    @endforeach
                </ul>
                <!-- Extra -->
                <div class="header-menu-extra">
                    <ul class="list-inline">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
                <!-- Close Button -->
                <button class="close-button">
                    <span></span>
                </button>
            </div><!-- end header-menu-wrapper -->
            <!-- Menu Toggle on Mobile -->
            <button class="m-toggle">
                <span></span>
            </button>
        </div><!-- end container -->
    </div>

    {{$slot}}

    <!-- Footer -->
    <div class="section-xs bg-dark">
        <div class="container">
            <div class="row col-spacing-20">
                <div class="col-6 col-lg-3">
                    <h6 class="font-weight-normal margin-lg-bottom-20">About us</h6>
                    <ul class="list-dash font-lg-small">
                        <li><a href="#">Clients</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Our Team</a></li>
                        <li><a href="#">Services</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h6 class="font-weight-normal margin-lg-bottom-20">Useful links</h6>
                    <ul class="list-dash font-lg-small">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Prices</a></li>
                        <li><a href="#">Process</a></li>
                        <li><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h6 class="font-weight-normal margin-lg-bottom-20">Additional links</h6>
                    <ul class="list-dash font-lg-small">
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Community</a></li>
                        <li><a href="#">Prices</a></li>
                        <li><a href="#">Testimonial</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3 text-lg-right">
                    <p class="font-lg-small">121 King St, Melbourne VIC 3000<br>contact@example.com</p>
                    <ul class="list-inline-sm margin-top-10 margin-lg-top-20">
                        <li><a class="button-circle button-circle-xs button-circle-white" href="#"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a class="button-circle button-circle-xs button-circle-white" href="#"><i
                                    class="fab fa-twitter"></i></a></li>
                        <li><a class="button-circle button-circle-xs button-circle-white" href="#"><i
                                    class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div><!-- end row -->
            <div class="border-top margin-top-30 padding-y-20 padding-bottom-0">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h4 class="uppercase letter-spacing-2 margin-0">Arty</h4>
                    </div>
                    <div class="col-6 text-right">
                        <p>© 2020 FlaTheme</p>
                    </div>
                </div><!-- end row -->
            </div>
        </div><!-- end container -->
    </div>
    <!-- end Footer -->

</div><!-- end wrapper -->

<!-- ***** JAVASCRIPTS ***** -->
<script src="{{asset('assets/plugins/jquery.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=IntersectionObserver"></script>
<script src="{{asset('assets/plugins/plugins.js')}}"></script>
<script src="{{asset('assets/js/functions.js')}}"></script>
</body>
</html>
