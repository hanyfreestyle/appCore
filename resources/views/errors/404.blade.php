@extends('web.layouts.app')
@section('content')
    <div class="section-space--sm bg-primary-5p">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 order-2 mt-lg-5">
                    <h1 class="mt-10 mb-5 err404_h1 text-center"> {!! printLang(__('web/err404.h1')) !!} </h1>
                    <h2 class="err404_h2 mt-5 mb-5">{!! printLang(__('web/err404.h2')) !!}</h2>
                    <div class="row mb-10 err404_menu">

                        <div class="col-lg-3 col-6 mb-3 text-center">
                            <div class="menu">
                                <a href="#">
                                    <i class="fa-regular fa-building"></i>
                                    <p> {{ __('web/err404.menu_1') }}</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6 mb-3 text-center">
                            <div class="menu">
                                <a href="#">
                                    <i class="fa-solid fa-sitemap"></i>
                                    <p> {{ __('web/err404.menu_2') }}</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6 mb-3 text-center">
                            <div class="menu">
                                <a href="#">
                                    <i class="fa-solid fa-rss"></i>
                                    <p> {{ __('web/err404.menu_3')}}</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6 mb-3 text-center">
                            <div class="menu">
                                <a href="#">
                                    <i class="fa-solid fa-phone-volume"></i>
                                    <p> {{__('web/err404.menu_4')}}</p>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="text-center">
                        <a href="{{route('page_index')}}" class="link d-inline-flex align-items-center gap-2 py-3 px-6 rounded-pill bg-primary-300 clr-neutral-0 :bg-primary-400 :clr-neutral-0">
                            <span class="d-inline-block"> {{__('web/err404.home_but')}} </span>
                        </a>
                    </div>
                </div>
                @if(isset($DefPhotoList))
                    <div class="col-lg-5 order-1 text-center">
                        <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="err_404" def-name="photo" alt="404" class="img-fluid"  />
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
