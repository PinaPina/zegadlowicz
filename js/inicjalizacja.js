
  $(document).ready(function() {
             $('.fancybox').fancybox();
     });
  $(window).scroll(function() {   
      var scroll = $(window).scrollTop();

       //>=, not <=
      if (scroll >= 25) {
          //clearHeader, not clearheader - caps H
          $("#navigation").addClass("nav-shadow");
      }
      
      if (scroll == 0) {
          //clearHeader, not clearheader - caps H
          $("#navigation").removeClass("nav-shadow");
      }
  }); 
  
  $('a[href^="#"]').on('click', function(event) {
      var target = $( $(this).attr('href') );
      if( target.length ) {
          event.preventDefault();
          $('html, body').animate({
              scrollTop: target.offset().top-174
          }, 1000);
      }

  });    
  
  
  
  
  
  $(function(){
      $("#contact").submit(function(e){
          var loader=$("#loader");
          var info=$("#info");
          var form=$(this);
          var name=$("#contact :input[id=name]").val();
          var email=$("#contact :input[id=email]").val();
          var tresc=$("#contact :input[id=tresc]").val();
          $.ajax({
               url: "mail.php",
               dataType: "JSON",
               data:"name="+name+"&email="+email+"&tresc="+tresc,
               type: "post",

               beforeSend: function(){
                   info.hide();
                   loader.show();
               },
               success: function(obj){
                   if (obj.type=="ok")
                   {
                       info.addClass("ok").removeClass("error").html(obj.text);
                       form.hide();

                       


                   } else
                   {
                      info.addClass("error").removeClass("ok").html(obj.text);

                   }
               },
               error : function(){
                   info.addClass("error").removeClass("ok").html('<p style="color:#CE0B35;margin: 0px;line-height: 17px;">Wystąpił nieoczekiwany problem. Spróbuj później.</p>')
               },
               complete: function(){
                   loader.hide();
                   info.show();
               }
          });
          e.preventDefault();
      })
   });
