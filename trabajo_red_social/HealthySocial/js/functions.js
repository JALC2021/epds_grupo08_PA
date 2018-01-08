$(document).ready(function(){

	$('#btn-register').on('click',function(){
		$('#login').addClass('animated rotateOutUpLeft');//add the classess for animations
		$('#login').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){ //when animation ends
			$('#login').hide().removeClass('animated rotateOutUpLeft');//remove animations and hide for a new call
			$('#register').show().addClass("animated rotateInDownRight");//show the div and add some animation
			$('#register').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
				$('#register').removeClass("animated rotateInDownRight");
			});
		});
	});

	//the same thing, add animations, hide and show components ;)
	$('#btn-back').on('click',function(){
		$('#register').addClass('animated rotateOutUpRight');
		$('#register').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			$('#register').hide().removeClass('animated rotateOutUpRight');
			$('#login').show().addClass("animated rotateInDownLeft");
			$('#login').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
				$('#login').removeClass('animated rotateInDownLeft');
			});
		});
	});

	/*
		P.D. Sorry for my english :v
	|------------------------------------|	
	|	Noe N. Mercado M. --- GUI-BOX.tk |
	|------------------------------------|
	*/

});