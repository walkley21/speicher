(function($) {

	//alert(898)
	$(document).ready(function (){
	
        
        $("#mainNavigation").find("li").each(function (){
            var ul= $(this).find("ul");
            var obj = $(this);
            if (ul.length>0){
                $(obj).addClass('children');
            }
            
        });
        
	//$("#menuTeam li ul ul").css({display: "none"}); // Opera Fix
	$("#mainNavigation li ").hover(function(){
		
	$(this).find('ul:first').css({visibility: "visible"}).show();
		
		var ul = $(this).find("ul:first").parent("li").setClass('parent-active');
		$(this).find("ul:first").parent("li").children("a").setClass("active");
			
	 },function(){
	 $(this).find('ul:first').css({visibility: "hidden"});
	 
	 var ul = $(this).find("ul:first").parent("li").removeClass("parent-active");
	 $(this).find("ul:first").parent("li").children("a").setClass("active");
	 });
		
		
	});


//plugin code
})(jQuery);