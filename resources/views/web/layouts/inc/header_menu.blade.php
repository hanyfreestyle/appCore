<header class="header header--sticky border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="menu d-lg-flex justify-content-lg-between align-items-lg-center">
                    <div class="menu-mobile-nav d-flex align-items-center justify-content-between py-3 py-lg-0 order-lg-2">

                        <ul class="list list-row gap-4 flex-wrap align-items-center order-1">
                            <li class="d-xl-none">
                                <div class="d-flex align-items-center gap-5">
                                    <div class="header_search">
                                        <form action="{{route('Search')}}" method="get">
                                            <input type="text"  name="project_name" value="{{old('project_name',issetArr($_GET,"project_name"))}}" placeholder="{{__('web/layout.header_search')}}">
                                            <button type="submit" aria-label="search" ><i class="fas fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </li>


                            <x-site.contact.call-to-action-button :unit="null" view-type="TopMenu"  :config="$WebConfig" />

                            <li class="lang_menu d-none d-lg-block">
                                <a href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(),$pageView['go_home']) }}"
                                   class="link d-flex align-items-center gap-2 p-2 rounded-pill bg-primary-5p clr-neutral-500">
                                    <i class="fa-solid fa-globe language"></i>
                                </a>
                            </li>
                            @if($WebConfig->fav_view)
                                <li class="fav_menu d-none d-lg-block">
                                    <livewire:site.favorite-menu />
                                </li>
                            @endif

                        </ul>
                    </div>
                    <ul class="list list-lg-row menu-nav order-lg-1">
                        <li class="menu-list {{activeMenu($pageView,'HomePage')}}"><a href="{{route('page_index')}}" class="link menu-link "> {{__('web/menu.main_home')}} </a> </li>
                        <li class="menu-list {{activeMenu($pageView,'Compounds')}} "><a href="{{ LaravelLocalization::localizeUrl(route('page_compounds')) }}" class="link menu-link "> {!! __('web/menu.main_compounds')!!} </a></li>
                        <li class="menu-list {{activeMenu($pageView,'Blog')}} "><a href="{{ LaravelLocalization::localizeUrl(route('page_blog')) }}" class="link menu-link "> {{__('web/menu.main_blog')}} </a> </li>
                        <li class="menu-list {{activeMenu($pageView,'ForSale')}} "><a href="{{ LaravelLocalization::localizeUrl(route('page_for_sale')) }}" class="link menu-link "> {{__('web/menu.main_for_sale')}} </a> </li>
                        <li class="menu-list {{activeMenu($pageView,'Developers')}} "><a href="{{ LaravelLocalization::localizeUrl(route('page_developers')) }}" class="link menu-link ">{{__('web/menu.main_developer')}}  </a> </li>
                        <li class="menu-list {{activeMenu($pageView,'Contact')}} "><a href="{{ LaravelLocalization::localizeUrl(route('page_ContactUs')) }}" class="link menu-link "> {{__('web/menu.main_contatc_us')}} </a> </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
