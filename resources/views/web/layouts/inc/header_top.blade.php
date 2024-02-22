<div class="border-bottom header-top">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list list-row flex-wrap gap-3 align-items-center justify-content-between">
                    <li class="d-none d-lg-block">
                        <a href="{{route('page_index')}}" class="link d-inline-block">
                            <img data-src="{{getDefPhotoPath($DefPhotoList,'dark_logo')}}" alt="logo" width="516" height="60" class="lazy top_header_logo d-none d-xl-inline-block">
                        </a>
                    </li>
                    <li class="ShowInDeskX">
                        <ul class="list list-row flex-wrap align-items-center list-dividers list_divider_2 ">

                            <li class="menulogo d-xl-none">
                                <img data-src="{{getDefPhotoPath($DefPhotoList,'dark_logo')}}" alt="logo" width="516" height="60" class="lazy mobile_logo">
                            </li>

                            <li class="lang_menu d-xl-none">
                                <a href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(),$pageView['go_home']) }}"
                                   class="link d-flex align-items-center gap-2 p-2 rounded-pill bg-primary-5p clr-neutral-500">
                                    <i class="fa-solid fa-globe language"></i>
                                </a>
                            </li>



                           <li class="d-none d-lg-block descMenu">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="w-10 h-10 rounded-circle bg-primary-300 d-grid place-content-center flex-shrink-0">
                                        <i class="fa-solid fa-phone-volume phone_in_talk"></i>
                                    </div>
                                    <div class="d-noneX d-lg-block">
                                        <span class="text_span d-block">{{__('web/contact.icon_call')}}</span>
                                        <a href="tel:{{$WebConfig->phone_call}}" class="text_link d-block clr-neutral-700 :clr-primary-300">{{$WebConfig->phone_num}}</a>
                                    </div>
                                </div>
                            </li>
                            <li class="d-none d-lg-block descMenu">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="w-10 h-10 rounded-circle bg-secondary-300 d-grid place-content-center flex-shrink-0">
                                        <span class="material-symbols-outlined mat-icon fs-24 clr-neutral-0 fw-300"> <i class="fa-brands fa-whatsapp whatsapp_icon"></i> </span>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <span class="text_span d-block">{{__('web/contact.icon_whatsapp')}} </span>
                                        <a href="#" class="text_link link d-block clr-neutral-700 :clr-primary-300">{{$WebConfig->whatsapp_num}}</a>
                                    </div>
                                </div>
                            </li>
                            <li class="d-none d-lg-block descMenu">
                                <div class="d-flex d-inline-block align-items-center gap-3">
                                    <div class="w-10 h-10 rounded-circle bg-tertiary-300 d-grid place-content-center flex-shrink-0">
                                        <i class="fa-regular fa-envelope mark_as_unread"></i>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <span class="text_span d-block">{{__('web/contact.icon_email')}}</span>
                                        <span class="d-block text_link">{{$WebConfig->email}}</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
