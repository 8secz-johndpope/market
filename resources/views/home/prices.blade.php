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
                                <input class="form-check-input extra-check" type="checkbox" name="urgent" value="1">
                                <span class="span-{{$extra->slug}}">{{$extra->title}}</span> &nbsp;&nbsp;{{$extra->subtitle}}
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @if($extra->type==='single')
                        <span class="extra-price">{{$extra->price->price}}</span>
                        @else
                            <select class="form-control" name="featured-days">
                                @foreach($extra->prices as $price)
                                <option value="7">{{$price->days}} days (£{{$price->days}})</option>
                                    @endforeach
                            </select>
                        @endif

                    </div>
                </div>

            </li>
            @endforeach
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input extra-check" type="checkbox" name="featured" value="1">
                                        <span class="span-featured">Featured</span>&nbsp;&nbsp;Have your Ad appear at the top of the category listings for 3, 7 or 14 days.
                                    </label>

                                </div>
                            </div>
                            <div class="col-sm-2">

                            </div>
                        </div>
                    </li>


            <li class="list-group-item">

                <div class="row">
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input extra-check" type="checkbox" name="spotlight" value="1">
                                <span class="span-spotlight">Spotlight</span> &nbsp;&nbsp;Have your Ad seen on the Sumra homepage!
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <span class="extra-price">£60</span>
                    </div>
                </div>






            </li>

            <li class="list-group-item">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input extra-check" type="checkbox" name="shipping" value="1">
                                <span class="span-shipping">CanShip</span> &nbsp;&nbsp;Ship to the buyer when order is placed.
                            </label>

                        </div>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" name="shipping-weight">
                            <option value="2">Up to 2kg (£4)</option>
                            <option value="5">Up to 5kg (£7)</option>
                            <option value="10">Up to 10kg (£10)</option>
                        </select>
                    </div>
                </div>

            </li>
        </ul>
    </div>
</div>

<div class="panel panel-success total-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Total</h3>
    </div>
    <div class="panel-body">
        £0.00
    </div>
</div>