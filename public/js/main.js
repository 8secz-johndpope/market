$( document ).ready(function() {
  ellipsis('.text');

  $(".favroite-icon").click(function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        if($(this).hasClass('heart')){
            $(this).addClass('heart-empty');
            $(this).removeClass('heart');
            $(this).next().css('display', 'block');
            axios.post('/user/list/unfavorite', {
                id:id
            })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

        }else{
            $(this).addClass('heart');
            $(this).removeClass('heart-empty');
            $(this).next().css('display', 'none');
            axios.post('/user/list/favorite', {
                id:id
            })
                .then(function (response) {
                    console.log(response);

                })
                .catch(function (error) {
                    console.log(error);
                    document.location ='/login';
                });
        }
    });
});

function ellipsis(selector){
 var nodeList = document.querySelectorAll(selector);
 arrNodes = [].slice.call(nodeList);
 for (var i in arrNodes)
 {
   var n = arrNodes[i]; 
   while(n.scrollHeight-n.offsetHeight>0)
   {
     var text = (n.innerText != undefined) ? n.innerText : n.textContent;
     if(n.innerText != undefined)
     {
         n.innerText=text.replace(/\W*\s(\S)*$/, '...');
     }
     else
     {
       // for Firefox
       n.textContent = text.replace(/\W*\s(\S)*$/, '...');
     }
   }
 }
}
function activeFirstItem(){
  $('#myCarousel-xs .item').first().addClass( "active" );
  $('#myCarousel .item').first().addClass( "active" );
}
