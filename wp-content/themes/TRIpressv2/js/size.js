(function($){
     var IPHONE = 767;
     var CTA;
     var SEARCHFORM;
     var idxDesc;
     var idxClone;
     var notice;
     var buttons;
	 var NavigationBar; 	

	 
     function reAccomodateDown()
     {
           /*idx properties*/ 
           idxDesc = $('#dsidx-primary-data');
           $('#dsidx-primary-data').remove();
           var properties =  $('#idx-properties');
           buttons = $("#idx-buttons");
           $('#idx-properties').parent('td').html(properties);
          // $('#idx-properties').append(buttons);
           $(idxDesc).insertBefore($("#dsidx-description")).css("margin-top","10px");
           $(buttons).insertBefore($(idxDesc));
           $(buttons).css("margin-top","16px");
            
           /*call to action buttons*/ 
            
           CTA  = $('#page-widget'); 
            $('#page-widget').remove(); 
            $(CTA).appendTo($('#buttons-container-small')); 
            
            
            /*search form*/
           SEARCHFORM  = $('#page-widget-search'); 
           $('#page-widget-search').remove(); 
           $(SEARCHFORM).appendTo($('#search-container-small'));  
           $(".shrinkable").addClass("shrinked");
            
		   NavigationBar = $('#navigation-inner').detach(); 
		   NavigationBar.appendTo("#navigation-small");
			
			
			//var emailLink =  $("#email-link").detach();
            
		 	//emailLink.appendTo('#social-media-ul');	
			//  alert(544)
           
     }
     function reAccomodateUp()
     {
        
        /*idx properties */
        if(idxDesc){
          $(idxDesc).appendTo($("#idx-properties")).css("margin-top","0px");;
          $(buttons).insertBefore(idxDesc);
          $(buttons).css("margin-top","0");
          $(idxDesc).css("margin-top","0");
           $("#idx-properties").css("height","200px");
          $("#dsidx-description").css("margin-top","0");
        }
        
        if(CTA){
           $('#home-widget-wrapper-inner').append(CTA);
        }
         if(SEARCHFORM){
           $('#page-widget-search-wrapper').append(SEARCHFORM);
           $('.shrinkable').removeClass('shrinked');
        }
		
		if(NavigationBar){
			 NavigationBar = $('#navigation-inner').detach(); 
		   NavigationBar.appendTo("#navigation-large");
			
			}
        
     }
    $(window).resize(function(){
        
		
			
		
            var width = $(window).width(); 
			console.log("width is"+width);
			
            if (width<=IPHONE)
            {
                reAccomodateDown();
            }
            else
            {
                reAccomodateUp();
            }
        
    });
    $(window).load(function(){
    
      
        var width = $(window).width(); 
       

        if (width<= IPHONE)
        {
            reAccomodateDown();
            
        }
        
       
        
    });
    
    $(document).ready(function(){
        
          $('#dsidx-primary-data').wrap("<div id='idx-properties'></div>");
         
          $('#dsidx_cboxLoadedContent').css('width',"100%");
          $(".shortsale-notice").css("display","block");
        
    });
	
	/*puts the displaimer under the table*/
	$(document).ready(function(){
		$('<div style="clear:both"></div>').insertBefore($("#dsidx-disclaimer"));
		$('<div style="clear:both"></div>').insertAfter($("#dsidx-listings"));
		
			
		
		
	});
	
	
	$(document).ready(function(){
		
		$("#dsidx-listings").addClass("row-fluid span12").css("margin","0 auto");
		$(".dsidx-results #dsidx-listings .dsidx-listing").addClass("span3");
	
		$(".phone-call").click(function(){
		return false;			
		});
	
	
	
	
	});
	
	$(document).ready(function(){
	
		//$("#contact-email-form").trigger('click');
		
	});
	
    
})(jQuery);

(function($){
    
    $(document).ready(documentReadyFunction);
$(window).resize(windowResizeFunction);

function documentReadyFunction() {
    genericStuffFunction()
    // do whatever for document ready
}

function windowResizeFunction() {
    genericStuffFunction()
    // do whatever for window resize
}

function genericStuffFunction() {
    // do whatever for document ready and window resize
   // alert("hello world");
}
    
  
    
})(jQuery);


  
