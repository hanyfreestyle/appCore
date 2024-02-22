@extends('admin.layouts.app')
@section('content')


    <x-admin.hmtl.section>
        <pre>
        @foreach($allCountries as $one )
            @if(count($one) > 3)
                {{print_r($one)}}
            @endif
        @endforeach
        </pre>
    </x-admin.hmtl.section>

@endsection

@push('JsCode')

@endpush
