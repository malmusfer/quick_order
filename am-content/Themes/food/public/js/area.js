



var baseurl= $('#baseurl').val();
var id= $('#location_id').val();
var next_page_url='';
var last_page_url='';
var categories=[];
var resturentdata=[];
var requesturl=baseurl+'/areainfo/'+id;
var catid=[];
$('.cat:checked').each(function(i){
    catid[i] = $(this).val();    
});
var data={cats:catid};
categories=data;


getallresturent();


$('#next_page_url').on('click',function(){
    requesturl=next_page_url;
    getallresturent();
});

$('#last_page_url').on('click',function(){
    requesturl=last_page_url;
    getallresturent();
});


function getallresturent() {

   $.ajax({
    type: 'GET',
    url:  requesturl,
    data: {cats:categories,order:$('#order').val()},
    dataType: 'json',
    beforeSend: function() {
        $('.res').remove();
        $('.loader-main-area').removeClass('d-none');

    },      
    success: function(response){ 
        $('.loader-main-area').addClass('d-none');
        $('.res').remove();
        resturentdata = response.data;
        $('#total_resurent').html(response.total);
        renderResturents();
        basicmap();
        $('.resturant-pagination').show()
        $('#total').html(response.total);
        $('#from').html(response.from);
        $('#to').html(response.to);
        if (response.prev_page_url != null) {
            $('#last_page_url').show();
            last_page_url = response.prev_page_url;
        }
        else{
            $('#last_page_url').hide();
        }
        if (response.next_page_url != null) {
            $('#next_page_url').show();
            next_page_url = response.next_page_url;
        }
        else{
            $('#next_page_url').hide();
        }

    },
    error: function(){
        getallresturent();
    }            

});
}



$('.cat').on('change',function(){
    var catid=[];
    $('.cat:checked').each(function(i){
        catid[i] = $(this).val();    
    });
    var data={cats:catid};
    categories=data;
    getallresturent();

}) 

$('.area').on('change',function(){
   if( $(this).is(":checked") ){ 
    var val = $(this).val(); 
    id = val;

    $.ajax({
        type: 'GET',
        url:  baseurl+'/areadata/'+id,
        data: {cats:categories,order:$('#order').val()},
        dataType: 'json',
        beforeSend: function() {
            $('.res').remove();
            $('.loader-main-area').removeClass('d-none');
        },      
        success: function(response){ 
            $('.loader-main-area').addClass('d-none');
            $('.res').remove();
            resturentdata = response.data.data;
            current_lat=response.lat;
            current_long=response.long;
            current_zoom=response.zoom;
            $('#total_resurent').html(response.data.total)

            renderResturents();
            basicmap();

            $('.resturant-pagination').show()
            $('#total').html(response.data.total);
            $('#from').html(response.data.from);
            $('#to').html(response.data.to);
            if (response.data.prev_page_url != null) {
                $('#last_page_url').show();
                last_page_url = response.data.prev_page_url;
            }
            else{
                $('#last_page_url').hide();
            }
            if (response.next_page_url != null) {
                $('#next_page_url').show();
                next_page_url = response.data.next_page_url;
            }
            else{
                $('#next_page_url').hide();
            }

        },
        error: function(){
            getallresturent();
        }            

    });
} 





})  


$('#order').on('change',function(){
    getallresturent()

})
function renderResturents() {

    console.log(resturentdata);
    
  $.each(resturentdata, function(index, value){


    var usercat=value.users.shopcategory;
    if (value.users.avg_ratting == null) {
        var avg_ratting = 0;
    }
    else{
        var avg_ratting = value.users.avg_ratting.content;
    }

    if (value.users.ratting == null) {
        var total_ratting = 0;
    }
    else{
        var total_ratting = value.users.ratting.content;
    }

    if (value.users.delivery == null) {
        var delivery_time = 60;
    }
    else{
        var delivery_time = value.users.delivery.content;

    }

    if(value.users.preview.content == null){
        var preview = default_image;
    }
    else{
        var preview = resize(value.users.preview.content,'medium');
    }

    if(value.users.coupons != null){
        var offercode = '<span>COUPON: '+value.users.coupons.title+'</span>';
        var offer = '<span>'+value.users.coupons.count+'% OFF</span>';
    }
    else{
     var offer = '';
     var offercode = '';
 }

 var ratting = '';

 for($i = 0; $i < 5; $i++)
 {
     if($i < value.users.avg_ratting)
     {
        ratting += '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z"/>';
     }else{
        ratting += '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928L12 18.26zm0-2.292l4.247 2.377-.949-4.773 3.573-3.305-4.833-.573L12 5.275l-2.038 4.42-4.833.572 3.573 3.305-.949 4.773L12 15.968z"/></svg>'
     }
 }

 


 $('#resturent_area').append('<div class="col-lg-12 mb-30"><div class="single-restaturants"><div class="restaturants-img"> <a href="'+baseurl+'/store/'+value.users.slug+'"><img class="img-fluid" src="'+preview+'" alt=""></a></div><div class="restaturants-content"> <a href="'+baseurl+'/store/'+value.users.slug+'"><h2>'+value.users.name+'</h2></a><p><strong>Location: </strong>'+value.city.title+'</p><div class="restaturants-middle-area"><div class="restaturants-price"><p>'+delivery_time+' Min</p></div><div class="restaturants-icon"><div class="delivery-icon"> <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Delivery Time: '+delivery_time+' Min"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M8.365 10L11.2 8H17v2h-5.144L9 12H2v-2h6.365zm.916 5.06l2.925-1.065.684 1.88-2.925 1.064a4.5 4.5 0 1 1-.684-1.88zM5.5 20a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm13 2a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9zm0-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zM4 11h6l2.6-1.733.28-1.046 1.932.518-1.922 7.131-1.822-.888.118-.44L9 16l-1-2H4v-3zm12.092-5H20v3h-2.816l1.92 5.276-1.88.684L15.056 9H15v-.152L13.6 5H11V3h4l1.092 3z"/></svg></a></div><div class="pickup-icon"> <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Pickup Time: '+delivery_time+' Min"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8h4v2h-6V7h2v5z"/></svg></a></div></div></div><div class="restaturants-bottom-area"><div class="rating-area"> '+ratting+' </div><div class="restaturants-view-menu"> <a href="'+baseurl+'/store/'+value.users.slug+'">View Menu</a></div></div></div></div></div>');

 var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
 var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
     return new bootstrap.Tooltip(tooltipTriggerEl)
 })

 $.each(usercat,function(i,v){
    if (i==4) {
        return false;
    }
    $('#tagar'+index).append("<li class='text-dark'>"+v.name+"</li>");

})

});  
}


if ($('#contact-map').length != 0) {
    google.maps.event.addDomListener(window, 'load', basicmap);

}

function basicmap()
{
        // Map options

        var options = {
            zoom: current_zoom,
            center: { lat: current_lat, lng: current_long },
            styles: [{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"landscape.natural","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"visibility":"on"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]}]
        }

        // New map
        var map = new google.maps.Map(document.getElementById('contact-map'), options);
        // Array of markers
        var markers = [];
        var baseurl = $('#baseurl').val();
        var location_id = $('#location_id').val();
        var baseurl= $('#baseurl').val();

        $.each(resturentdata, function(index, value){
         var usercat=value.users.shopcategory;
         if (value.users.avg_ratting == null) {
            var avg_ratting = 0;
        }
        else{
            var avg_ratting = value.users.avg_ratting.content;
        }

        if (value.users.ratting == null) {
            var total_ratting = 0;
        }
        else{
            var total_ratting = value.users.ratting.content;
        }

        if (value.users.delivery == null) {
            var delivery_time = 60;
        }
        else{
            var delivery_time = value.users.delivery.content;

        }

        if(value.users.preview.content == null){
            var preview = default_image;
        }
        else{
            var preview = resize(value.users.preview.content,'medium');
        }

        if(value.users.coupons != null){
            var offercode = '<span>COUPON: '+value.users.coupons.title+'</span>';
            var offer = '<span>'+value.users.coupons.count+'% OFF</span>';
        }
        else{
         var offer = '';
         var offercode = '';
     }




     let v =  {
        coords: { lat: parseFloat(value.latitude), lng: parseFloat(value.longitude) },
        iconImage: resturent_icon,
        content: '<div class="filter_map_area"><a href="'+baseurl+'/store/'+value.users.slug+'"><div class="single-restaturants"> <img src="'+preview+'" ><div class="badges">'+offercode+offer+'</div><div class="total-min"> <span>'+delivery_time+'</span><span>min</span></div><div class="restaturants-content"><div class="name-rating"><h4>'+value.users.name+'</h4> <span class="ratings-component"><span class="stars"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11"><path fill="#FF3252" d="M9 7.02L9.7 11 6 9.12 2.3 11 3 7.02 0 4.2l4.14-.58L6 0l1.86 3.62L12 4.2z"></path></svg></span> <span class="rating"><b>'+avg_ratting+'</b>/ 5</span><span class="count"> ('+total_ratting+')</span></span></div><div class="category-summery"> <nav> </nav></div></div></div></a></div>'
    }

    markers.push(v);
});


        // Loop through markers
        for (var i = 0; i < markers.length; i++) {
            // Add marker
            addMarker(markers[i]);
        }

        function addMarker(props) {
            var marker = new google.maps.Marker({
                position: props.coords,
                map: map,

            });

            // Check for customicon
            if (props.iconImage) {
                // Set icon image
                marker.setIcon(props.iconImage);
            }

            // Check content
            if (props.content) {
                var infoWindow = new google.maps.InfoWindow({
                    content: '<div class="scrollFix">'+props.content+'</div>',
                });



                marker.addListener('mouseover', function() {
                    infoWindow.open(map, marker);
                });

            }
        }
        

    }
   
