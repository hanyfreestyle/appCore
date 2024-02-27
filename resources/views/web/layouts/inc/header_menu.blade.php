    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">

                                <li class="nav-item {{activeMenu($pageView,'HomePage')}}">
                                    <a href="{{route('page_index')}}"> {{__('web/menu.main_home')}} </a>
                                </li>

                                <li class="nav-item {{activeMenu($pageView,'Contact')}} ">
                                    <a href="{{ LaravelLocalization::localizeUrl(route('page_ContactUs')) }}">
                                        {{__('web/menu.main_contatc_us')}}
                                    </a>
                                </li>

                                <li class="lang_menu d-none d-lg-block">
                                    <a href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(),$pageView['go_home']) }}"
                                       class="link d-flex align-items-center gap-2 p-2 rounded-pill bg-primary-5p clr-neutral-500">
                                        <i class="fa-solid fa-globe language"></i>
                                    </a>
                                </li>

                            </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>