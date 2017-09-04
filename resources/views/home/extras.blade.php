@foreach($fields as $field)
    <div class="col-sm-6">
        <span class="extra-title">{{$field->title}}</span>
        @if($field->type==='integer')
            <input class="form-control" type="text" name="{{$field->slug}}" required>
            @elseif($field->type==='list')
            <select class="form-control" name="{{$field->slug}}">
                @foreach($field->values as $value)
                    <option value="{{$value->slug}}">{{$value->title}}</option>
                    @endforeach
            </select>
            @else
            <input class="form-control" type="text" name="{{$field->slug}}" required>
        @endif
    </div>
@endforeach