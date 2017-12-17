/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function(){
    $.fn.plugin_epd10_ex1 = function(){
        return this.each(function(){
            $(this).focus(function(){
                $(this).css("background-color","#81BEF7");
            });
            $(this).blur(function(){
                if($(this).val() == ""){
                    $(this).css("background-color","#F5A9A9");
                }else{
                    $(this).css("background-color","white");
                }
            });
        });
    };
    
})(jQuery);


