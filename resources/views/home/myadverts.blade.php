<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="bd-example bd-example-tabs" role="tabpanel">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="true">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-expanded="false">Profile</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" id="dropdown1-tab" href="#dropdown1" role="tab" data-toggle="tab" aria-controls="dropdown1">@fat</a>
                        <a class="dropdown-item" id="dropdown2-tab" href="#dropdown2" role="tab" data-toggle="tab" aria-controls="dropdown2">@mdo</a>
                    </div>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab" aria-expanded="true">
                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                </div>
                <div class="tab-pane fade" id="dropdown1" role="tabpanel" aria-labelledby="dropdown1-tab">
                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                </div>
                <div class="tab-pane fade" id="dropdown2" role="tabpanel" aria-labelledby="dropdown2-tab">
                    <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">Manage My ads</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Messages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/manage/favorites">Favorites</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">My Details</a>
            </li>
        </ul>
        @foreach($products as $product)
            <div class="item listing">
                <a class="listing-product" href="/p/{{$product['category']}}/{{$product['source_id']}}">
                    <div class="listing-img">
                        <div class="main-img">
                            <img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/{{ count($product['images'])>0?$product['images'][0]:"noimage.png"}}" class="lazyload" alt="">
                            <div class="listing-meta">
                            </div>
                        </div>
                    </div>
                    <div class="items-box-body listing-content">
                        <h4 class="items-box-name font-2">{{$product['title']}}</h4>
                        <div class="listing-location">
                                <span class="truncate-line">
                                    {{$product['location_name']}}
                                </span>
                        </div>
                        <p class="listing-description">
                            {{$product['description']}}
                        </p>
                        <ul class="listing-attributes inline-list">

                        </ul>
                        <div class="items-box-num clearfix">
                            @if($product['meta']['price']>=0)
                                <div class="items-box-price font-5">£ {{$product['meta']['price']/100}}{{isset($product['meta']['price_frequency']) ? $product['meta']['price_frequency']:''}}
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
                <a class="glyphicon glyphicon-remove delete-icon" href="/user/advert/delete/{{$product['source_id']}}"></a>
            </div>

        @endforeach
    </div>
</div>


    @endsection