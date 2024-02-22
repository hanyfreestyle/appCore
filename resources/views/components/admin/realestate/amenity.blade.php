<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-dark alert-dismissible">
            {{$lable}}
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group clearfix">
            <div class="icheck-primary d-inline">
                <input   id="checkAll" class="icheck-primaryX d-inline  amenity_checkbox" type="checkbox">
                <label for="checkAll"></label>
                <span class="font-weight-bold" style="color: red">{{__('admin/form.check_all')}}</span>
            </div>
        </div>
    </div>


    @foreach($CashAmenityList as $Amenity)
        <div class="col-lg-2">
            <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                    <input name="amenity[]" id="{{$Amenity->id}}" class="icheck-primaryX d-inline  amenity_checkbox" value="{{$Amenity->id}}"
                           type="checkbox"  {{ in_array($Amenity->id,old('amenity',$sendData)) ? 'checked' : '' }} >
                    <label for="{{ $Amenity->id }}"></label>
                    <span class="font-weight-bold">{{ $Amenity->name }}</span>
                </div>
            </div>
        </div>
    @endforeach

    @error('amenity')
    <div class="col-lg-12">
        <strong class="error_mass">{{ \App\Helpers\AdminHelper::error($message,'amenity',$lable) }}</strong>
    </div>
    @enderror

</div>
<hr>
@push('JsCode')
    <script>
        $("#checkAll").click(function () {
            $('.amenity_checkbox:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endpush
