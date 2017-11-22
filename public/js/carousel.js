var timer = null;

function stopAnimationGallery(element){
    clearInterval(timer);
    timer = null;
    $(element).removeClass('active-sld');
    $(element).text('Start slideshow');
    console.log('stop animation');
}
function changeImageGallery(cycle = true){
    var index = parseInt($('#image-active').attr('data-index'));
    var children = $('.carousel-inner .item').children();
    var numImg = children.length
    console.log("is actived timer");
    if( cycle || index < numImg ){
        $('.selected').removeClass('selected');
        index = index %  (numImg);
        console.log("current: " + index);
        var child = children.eq(index);
        child.addClass('selected');
        var nextImage = child.find('img').attr('src');
        index = index + 1;
        if(cycle && index == 1){
            $("#myCarousel").carousel("next");
        }
        console.log("next: " + index);
        $('#image-active').attr('data-index', index);
        $('#image-active').attr('src', nextImage);
        $('.index').text(index);
        var indexCarousel = $('.carousel-inner .item.active').index();
        var firsElementCarousel = indexCarousel * 5; 
        var lastElementCarousel = firsElementCarousel + 5;
        if(lastElementCarousel < (index)){
            $("#myCarousel").carousel("next");
        }
    }
}

$(function () {
    var viewer = ImageViewer();
    $('.small-image').first().addClass('selected');
    $('.images-current a').click(function (e) {
    	console.log('click enlarge');
        e.preventDefault();
        if(timer != null){
            var element = $('.icon-before');
            stopAnimationGallery(element);
        }
        var imgSrc = $('#image-active').attr('src'),
            highResolutionImage = $('image-active').data('high-res-img');
        viewer.show(imgSrc, highResolutionImage);
    });
    $('.carousel').carousel({
      interval: false
	})
	$('.small-image>a').click(function () {
	    if(timer != null){
	        var element = $('.icon-before');
	        stopAnimationGallery(element);
	    }
	    var src = $(this).children().first().attr('src');
	    $('.selected').removeClass('selected');
	    $(this).parent().addClass('selected');
	    $('#image-active').attr('src', src);
	    var index = $(this).attr('data-index');
	    $('#image-active').attr('data-index', index);
	    $('.index').text(index);
	    var indexCarousel = $('.carousel-inner .item.active').index();
	    var firsElementCarousel = indexCarousel * 5; 
	    var lastElementCarousel = firsElementCarousel + 5;

	    if(lastElementCarousel < (index-1)){
	        $("#myCarousel").carousel("next");
	    }else if(firsElementCarousel > (index-1)){
	        $("#myCarousel").carousel("prev");
	    }
	});
	$('.prev>a').click(function () {
	    if(timer != null){
	        var element = $('.icon-before');
	        stopAnimationGallery(element);
	    }
	    var index = $('#image-active').attr('data-index');
	    if(index > 1){
	        var children = $('.carousel-inner .item').children();
	        $('.selected').removeClass('selected');
	        var child = children.eq(index - 2);
	        child.addClass('selected');
	        var prevImage = child.find('img').attr('src');
	        index -= 1
	        $('#image-active').attr('data-index', index);
	        $('#image-active').attr('src', prevImage);
	        $('.index').text(index);
	        var indexCarousel = $('.carousel-inner .item.active').index();
	        var firsElementCarousel = indexCarousel * 5; 
	        var lastElementCarousel = firsElementCarousel + 5;
	        if(firsElementCarousel > (index-1)){
	            $("#myCarousel").carousel("prev");
	        }
	    }
	});
	$('.next>a').click(function () {
	    if(timer != null){
	        var element = $('.icon-before');
	        stopAnimationGallery(element);
	    }
	    changeImageGallery(false);
	});
	$('.images-info .icon-before').click(function(e){
        e.preventDefault();
        if($(this).hasClass('active-sld')){
            stopAnimationGallery(this);
        }
        else{
            $(this).addClass('active-sld');
            $(this).text('Stop slideshow');
            timer = setInterval(changeImageGallery, 2000);
        }
    })
});

