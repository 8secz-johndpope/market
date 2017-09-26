<div class="panel panel-default featured-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Make your ad stand out!</h3>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            @foreach($extras as $extra)

            <li class="list-group-item">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input extra-change" type="checkbox" name="{{$extra->slug}}" value="1" id="{{$extra->slug}}">
                                <span class="span-{{$extra->slug}}">{{$extra->title}}</span> &nbsp;&nbsp;{{$extra->subtitle}}
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @if($extra->type==='single')
                        <span class="extra-price">£{{$extra->price->price/100}}</span>
                            <input type="hidden" id="{{$extra->slug}}-price" value="{{$extra->price->price/100}}" name="{{$extra->slug}}-price">
                        @else
                            <select class="form-control extra-change" name="{{$extra->key}}" id="{{$extra->key}}-price">
                                @foreach($extra->prices as $price)
                                <option value="{{$price->key}}">{{$price->title}}  (£{{$price->price/100}})</option>
                                    @endforeach
                            </select>
                        @endif

                    </div>
                </div>

            </li>
            @endforeach

        </ul>
    </div>
</div>

