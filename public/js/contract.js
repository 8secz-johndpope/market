window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};
$('#autocomplete').autocomplete({
    paramName :'q',
    serviceUrl: '/api/suggest',
    onSelect: function (suggestion) {
        window.location.href = "https://sumra.net/"+suggestion.slug+"?q="+suggestion.value
        // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
    }
});
$(".main-category").on("click", function(event){
    $('.select-arrow').removeClass('glyphicon-ok-sign');
    $('.category-level-2').html('');
    $('.category-level-3').html('');
    $('.category-level-4').html('');
    console.log($(this).data('category'));
    $.get("/category/children/"+$(this).data('category'), function(data, status){
        console.log(data);
        $('.category-level-1').html(data);
    });
});
$(".category-level-1").on("click","li", function(event){
    $('.select-arrow').removeClass('glyphicon-ok-sign');
    $('.category-level-3').html('');
    $('.category-level-4').html('');
    var count = $(this).data('children');
    if(count===0){
        $('.category-level-2').html('');
        $("#continue-button").attr('disabled',false);
        $("#continue-button").data('category',$(this).data('category'));
        $(this).find('.select-arrow').addClass('glyphicon-ok-sign');
        return;
    }
    $("#continue-button").attr('disabled',true);

    console.log($(this).data('category'));
    $.get("/category/children/"+$(this).data('category'), function(data, status){
        console.log(data);
        $('.category-level-2').html(data);
    });
});
$(".category-level-2").on("click","li", function(event){
    $('.select-arrow').removeClass('glyphicon-ok-sign');
    $('.category-level-4').html('');
    var count = $(this).data('children');
    if(count===0){
        $('.category-level-3').html('');
        $("#continue-button").attr('disabled',false);
        $("#continue-button").data('category',$(this).data('category'));
        $(this).find('.select-arrow').addClass('glyphicon-ok-sign');
        return;
    }
    $("#continue-button").attr('disabled',true);

    console.log($(this).data('category'));
    $.get("/category/children/"+$(this).data('category'), function(data, status){
        console.log(data);
        $('.category-level-3').html(data);
    });
});
$(".category-level-3").on("click","li", function(event){
    $('.select-arrow').removeClass('glyphicon-ok-sign');
    var count = $(this).data('children');
    if(count===0){
        $('.category-level-4').html('');
        $("#continue-button").attr('disabled',false);
        $("#continue-button").data('category',$(this).data('category'));

        $(this).find('.select-arrow').addClass('glyphicon-ok-sign');
        return;
    }
    $("#continue-button").attr('disabled',true);

    console.log($(this).data('category'));
    $.get("/category/children/"+$(this).data('category'), function(data, status){
        console.log(data);
        $('.category-level-4').html(data);
    });
});

$(".main-location").on("click", function(event){
    $('.select-arrow').removeClass('glyphicon-ok-sign');
    $('.location-level-2').html('');
    $('.location-level-3').html('');
    $('.location-level-4').html('');
    console.log($(this).data('location'));
    $.get("/location/children/"+$(this).data('location'), function(data, status){
        console.log(data);
        $('.location-level-1').html(data);
    });
});
$(".location-level-1").on("click","li", function(event){
    $('.select-arrow').removeClass('glyphicon-ok-sign');
    $('.location-level-3').html('');
    $('.location-level-4').html('');
    var count = $(this).data('children');
    if(count===0){
        $('.location-level-2').html('');
        $("#continue-button").attr('disabled',false);
        $("#continue-button").data('location',$(this).data('location'));
        $(this).find('.select-arrow').addClass('glyphicon-ok-sign');
        return;
    }
    $("#continue-button").attr('disabled',true);

    console.log($(this).data('location'));
    $.get("/location/children/"+$(this).data('location'), function(data, status){
        console.log(data);
        $('.location-level-2').html(data);
    });
});
$(".location-level-2").on("click","li", function(event){
    $('.select-arrow').removeClass('glyphicon-ok-sign');
    $('.location-level-4').html('');
    var count = $(this).data('children');
    if(count===0){
        $('.location-level-3').html('');
        $("#continue-button").attr('disabled',false);
        $("#continue-button").data('category',$(this).data('category'));
        $(this).find('.select-arrow').addClass('glyphicon-ok-sign');
        return;
    }
    $("#continue-button").attr('disabled',true);

    console.log($(this).data('category'));
    $.get("/location/children/"+$(this).data('location'), function(data, status){
        console.log(data);
        $('.location-level-3').html(data);
    });
});
$(".location-level-3").on("click","li", function(event){
    $('.select-arrow').removeClass('glyphicon-ok-sign');
    var count = $(this).data('children');
    if(count===0){
        $('.location-level-4').html('');
        $("#continue-button").attr('disabled',false);
        $("#continue-button").data('category',$(this).data('location'));

        $(this).find('.select-arrow').addClass('glyphicon-ok-sign');
        return;
    }
    $("#continue-button").attr('disabled',true);

    console.log($(this).data('category'));
    $.get("/location/children/"+$(this).data('location'), function(data, status){
        console.log(data);
        $('.location-level-4').html(data);
    });
});

$("#continue-button").click(function () {
    get_extras($(this).data('category'));
});
$(".location-level-4").on("click","li", function(event) {
    $('.select-arrow').removeClass('glyphicon-ok-sign');
    $("#continue-button").attr('disabled',false);
    get_extras($(this).data('category'));
    $(this).find('.select-arrow').addClass('glyphicon-ok-sign');
});
function get_extras(category) {
    $("#category").val(category);

    $.get("/category/string/"+category, function(data, status){
        console.log(data);
        $('.category-sting').html(data);
        $(".manual-category-panel").hide();
        $(".selected-category-panel").show();
    })

}
function get_prices(category) {
    var lat = $("#lat").val();
    var lng = $("#lng").val();
    $.get("/category/prices/"+category+'?lat='+lat+'&lng='+lng, function(data, status){
        $('.extra-prices').html(data);
    });
}
$('input.posting-string').on('input',function(e){
    $.get("/category/suggest?q="+$(this).val(), function(data, status){
        console.log(data);
        $('.category-suggest').html(data);
    });
});
$(".category-suggest").on("click","li", function(event) {
    get_extras($(this).data('category'));
});
$(".browse-category").click(function () {
    $(".manual-category-panel").show();
});
$(".edit-category").click(function () {

    $('.selected-category-panel').hide();
    $('.manual-category-panel').show();
});
$(".edit-location").click(function () {

    $('.selected-location-panel').hide();
    $('.manual-location-panel').show();
});
$(".postcode-submit").click(function () {
    console.log("click works");
    $(".extra-large").html($("#postcode-text").val());
    $(".edit-location").hide();
    $(".location-selected").show();
    $(".all-panels").show();
});
$(".edit-location-button").click(function () {
    $(".edit-location").show();
    $(".location-selected").hide();
});
$(".add-image").click(function () {
    $("#file-chooser").click();
});
$(".add-image-x").click(function () {
    $("#file-chooser-x").click();
});
$("#file-chooser").change(function () {
    console.log("did change");
    upload_file();
});
$("#file-chooser-x").change(function () {
    console.log("did change");
    upload_multi_file();
});
$(".assign-images").click(function () {
    $("#advert_id").val($(this).data('id'));
   $("#myModal1").modal('show');
});
$("#myModal1 img").click(function () {
    if($(this).parent().hasClass('selected-image'))
    {
        $(this).parent().removeClass('selected-image');

    }else{
        $(this).parent().addClass('selected-image');

    }
    $(this).parent().children(":first").prop("checked", !$(this).parent().children(":first").prop("checked"));
});
$(".change-shipping").change( function(){
    
    var id = $(this).id;
    $("#shipping-replace").html($("#"+id+"_extras").html());
    $('#myModal').modal('hide');
});

function get_location(postcode) {
    $.get("https://maps.googleapis.com/maps/api/geocode/json?address="+postcode+"&key=AIzaSyDsy5_jVhfZJ7zpDlSkGYs9xdo2yFJFpQ0",function (data,status) {
        console.log(data.results[0]['formatted_address']);
        console.log(data.results[0]['geometry']['location']['lat']);
        console.log(data.results[0]['geometry']['location']['lng']);
        var address = data.results[0]['formatted_address'];
        var parts =  address.split(',');
        $("#location_name").val(parts[0]);
        $("#lat").val(data.results[0]['geometry']['location']['lat']);
        $("#lng").val(data.results[0]['geometry']['location']['lng']);
        var category =  $("#category").val();
        get_prices(category);


    });
}
$(".postcode-submit").click(function () {
    var postcode = $("#postcode-text").val();
    get_location(postcode);
});
axios.get('/user/list/price')
    .then(function (response) {
        console.log(response);
    })
    .catch(function (error) {
        console.log(error);
    });
$(document).on('change',".extra-change", function(){

    var total = 0;
    if ($('#featured').is(":checked"))
    {
        total += parseInt($("#featured-price").val());
    }
    if ($('#urgent').is(":checked"))
    {
        total += parseInt($("#urgent-price").val());
    }
    if ($('#spotlight').is(":checked"))
    {
        total += parseInt($("#spotlight-price").val());
    }
    if ($('#shipping').is(":checked"))
    {
        total += parseInt($("#shipping-price").val());
    }
    $(".total-price").html(total);
    $("#total-price").val(total);

});
$(document).on('change',".address-select",function () {
    var id = $('input[name=address]:checked', '#addressform').val();
    console.log($('input[name=address]:checked', '#addressform').val());
    axios.get('/user/address/change/'+id)
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
});
$(".update-shipping").click(function () {
    var id = $(this).data('id');
    console.log(id);
    $("#tracking-info").modal('show');
    $(".update-tracking").data('id',id);
});
$(".update-tracking").click(function () {
    var id = $(this).data('id');
    var tracking = $("#tracking_id").val();
    console.log(id);
    axios.get('/user/manage/order/shipping/update/'+id,{ params:{tracking:tracking}})
        .then(function (response) {
            console.log(response);
            location.reload();
        })
        .catch(function (error) {
            console.log(error);
        });
});

$(".manual-category-panel").on('click','.select-category-link',function () {
    var category = $(this).data('category');
    console.log(category);
    get_extras(category);
});
$(".manual-location-panel").on('click','.select-location-link',function () {
    var location = $(this).data('location');
    console.log(location);
    get_location(location);
});
function get_location(category) {
    $("#location").val(category);

    $.get("/location/string/"+category, function(data, status){
        console.log(data);
        $('.location-sting').html(data);
        $(".manual-location-panel").hide();
        $(".selected-location-panel").show();
    })

}
$(".add-pricegroup").click(function () {
    var category = $("#category").val();
    var location = $("#location").val();
    var urgent = $("#urgent").val();
    var standard = $("#standard").val();
    var spotlight = $("#spotlight").val();
    var featured = $("#featured").val();
    var featured_3 = $("#featured_3").val();
    var featured_14 = $("#featured_14").val();
    var bump = $("#bump").val();

    axios.get('/admin/manage/pricegroup/add',{ params:{standard:standard,category:category,location:location,urgent:urgent,spotlight:spotlight,featured:featured,featured_3:featured_3,featured_14:featured_14,bump:bump}})
        .then(function (response) {
            console.log(response);
            document.location.href = "/admin/manage/packs";
        })
        .catch(function (error) {
            console.log(error);
        });
});
$(".stats-click").click(function () {
    var id = $(this).data('id');
    axios.get('/user/p/stats/'+id,{ params:{}})
        .then(function (response) {
             console.log(response);
            $("#modal-content").html(response.data);
            $("#myModal").modal('show');
        })
        .catch(function (error) {
            console.log(error);
        });
});
$('.featured-check').change(function() {
    var id = $(this).data('id');
    if ($(this).is(":checked")) {
        $(".featured-check-"+id).prop('checked', false);
        $(this).prop('checked', true);
    }
});
$(".add-pack").click(function () {
    var category = $("#category").val();
    var location = $("#location").val();
    //var type = [];
    var values = new Array();
    $.each($("input[name='type[]']:checked"), function() {
        values.push($(this).val());
        // or you can do something to the actual checked checkboxes by working directly with  'this'
        // something like $(this).hide() (only something useful, probably) :P
    });
    axios.get('/user/contract/pack/'+category+'/'+location,{ params:{types:values}})
        .then(function (response) {
           // console.log(response);
            $("#pack-list").html(response.data);

        })
        .catch(function (error) {
            console.log(error);
        });
});
function  get_packs() {
    axios.get('/user/contract/packs/',{ params:{}})
        .then(function (response) {
            // console.log(response);
            $("#pack-list").html(response.data);

        })
        .catch(function (error) {
            console.log(error);
        })
}
$("#pack-list").on('click','.delete-pack',function () {
   var id = $(this).data('id');
    $(this).prop('disabled', true);
   console.log(id);
    axios.get('/user/contract/pack/delete/'+id,{ params:{}})
        .then(function (response) {
            // console.log(response);
           get_packs()

        })
        .catch(function (error) {
            console.log(error);
        });

});

$(".go-to-packs").click(function () {
    var name = $('#name').val();
    var line1 = $('#line1').val();
    var city = $('#city').val();
    var phone = $('#phone').val();
    var company = $('#company').val();
    var vat = $('#vat').val();
    var postcode = $("#postcode").val();

    axios.get('/user/contract/cbusiness',{ params:{name:name,line1:line1,city:city,phone:phone,company:company,vat:vat,postcode:postcode}})
        .then(function (response) {
             console.log(response);
            document.location.href = "/user/contract/start";

        })
        .catch(function (error) {
            console.log(error);
        });
});