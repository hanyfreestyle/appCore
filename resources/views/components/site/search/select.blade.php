@if($labelview)
    <label>{{ $label }}</label>
@endif
<select  name="{{$name}}" class="SearchSelect" aria-label="{{$name}}">
    <option value="">{{$defSelect}}</option>
    @foreach($sendArr as $row)
        <option value="{{$row[$printVal]}}" @if($row[$printVal] == issetArr($_GET,$name) ) selected @endif >{{$row['name']}}</option>
    @endforeach
</select>

@section('AddScript')

@endsection
