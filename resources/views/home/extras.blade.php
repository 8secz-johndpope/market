@if($hasprice)
<div class="panel panel-default price-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Price</h3>
    </div>
    <div class="panel-body">
        <div class="row"> <div class="col-sm-6">  <span class="input-group-addon"><i class="glyphicon glyphicon-gbp"></i></span>
                <input type="text" name="price" class="form-control  mb-2 mr-sm-2 mb-sm-0" placeholder="Price" required></div>
            <div class="col-sm-6"><p>100 characters remaining</p></div></div>
    </div>
</div>
@endif
@if(count($fields)>1)
<div class="panel panel-default extra-options-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Select Options</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    @foreach($fields as $field)
                        @if($field->slug!=='price')
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
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif