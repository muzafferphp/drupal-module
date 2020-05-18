(function ($) {
  $(document).ready(function(){
      //alert('aaaaaa');
     /* $("#edit-title-0-value").focusout(function(){
           var title = $('#edit-title-0-value').val();
          // alert(title);
          
        $.ajax({
            type: "POST",
            url: '/ajaxurl',
            dataType: "json",
            data: {title: title},
            success: function(response){
                
               // console.log(response);
                //console.log(response['data']);
                console.log(response[0].data);
             
                 $(".layout-region-node-main").prepend(response[0].data);

           }
        });
           
          
      });*/
      
  });
})(jQuery);