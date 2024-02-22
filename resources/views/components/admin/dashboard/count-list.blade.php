<div class="col-lg-3">
    <div class="card">
        <div class="card-header border-0 bg-primary">
            <h3 class="card-title">{{ $name }}</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <tbody>
                @if(isset($cardCount['all']) and intval($cardCount['all']) >0)
                    <tr>
                        <td>{{__('admin/page.checkdata_all')}}</td>
                        <td>{{ $cardCount['all'] ?? 0 }}  {{$lable}} </td>
                        <td></td>
                    </tr>
                @endif

                @if(isset($cardCount['Trashed']) and intval($cardCount['Trashed']) > 0)
                    <tr>
                        <td> {{__('admin/page.checkdata_deleted')}}</td>
                        <td>{{ $cardCount['Trashed'] ?? 0 }}  {{$lable}} </td>
                        <td></td>
                    </tr>
                @endif

                @if(isset($cardCount['noPhoto']) and intval($cardCount['noPhoto']) > 0)
                    <tr>
                        <td>{{__('admin/page.checkdata_no_photo')}}</td>
                        <td>{{ $cardCount['noPhoto'] }}  {{$lable}} </td>
                        @if($url)
                            <td><a href="{{route($url.'.noPhoto')}}" class="text-muted"><i class="fas fa-search"></i></a></td>
                        @endif
                    </tr>
                @endif

                @if(isset($cardCount['slugErr']) and intval($cardCount['slugErr']) >0)
                    <tr>
                        <td>{{__('admin/page.checkdata_slug_err')}}</td>
                        <td>{{ $cardCount['slugErr'] }} {{$lable}} </td>
                        @if($url)
                            <td><a href="{{route($url.'.slugErr')}}" class="text-muted"><i class="fas fa-search"></i></a></td>
                        @endif
                    </tr>
                @endif

                @if(isset($cardCount['noAr']) and intval($cardCount['noAr']) >0)
                    <tr>
                        <td>{{__('admin/page.checkdata_no_ar')}}</td>
                        <td>{{ $cardCount['noAr'] }} {{$lable}} </td>
                        @if($url)
                            <td><a href="{{route($url.'.noAr')}}" class="text-muted"><i class="fas fa-search"></i></a></td>
                        @endif

                    </tr>
                @endif

                @if(isset($cardCount['noEn']) and intval($cardCount['noEn']) >0)
                    <tr>
                        <td>{{__('admin/page.checkdata_no_en')}}</td>
                        <td>{{ $cardCount['noEn'] }}  {{$lable}} </td>
                        @if($url)
                            <td><a href="{{route($url.'.noEn')}}" class="text-muted"><i class="fas fa-search"></i></a></td>
                        @endif
                    </tr>
                @endif

                @if(isset($cardCount['unActive']) and intval($cardCount['unActive']) >0)
                    <tr>
                        <td>{{__('admin/page.checkdata_un_active')}}</td>
                        <td>{{ $cardCount['unActive'] }} {{$lable}}  </td>
                        @if($url)
                            <td><a href="{{route($url.'.unActive')}}" class="text-muted"><i class="fas fa-search"></i></a></td>
                        @endif
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
