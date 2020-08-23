<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <img class="img-fluid" src="/front/images/knowledge.png" width="50px" height="50px" alt="" />
        </a>
        <a class="nav-link js-scroll-trigger " href="#"> کاربر:{{ auth()->user()->name }}</a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            منو
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto" >
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger " href="{{route('index')}}">خانه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger " href="{{route('profile.index')}}">پروفایل</a>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link js-scroll-trigger" href="#about"> درباره ما</a>--}}
{{--                </li>--}}



            </ul>
        </div>
    </div>
</nav>
