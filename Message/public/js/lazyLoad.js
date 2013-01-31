/*
@°æ±¾ÈÕÆÚ: °æ±¾ÈÕÆÚ: 2012Äê4ÔÂ11ÈÕ
@Öø×÷È¨ËùÓÐ: 1024 intelligence ( http://www.1024i.com )

»ñµÃÊ¹ÓÃ±¾Àà¿âµÄÐí¿É, Äú±ØÐë±£ÁôÖø×÷È¨ÉùÃ÷ÐÅÏ¢.
±¨¸æÂ©¶´£¬Òâ¼û»ò½¨Òé, ÇëÁªÏµ Lou Barnes(iua1024@gmail.com)
*/
$(document).ready(function(){

	
	pageUrl=""; 
	pageUrl = window.location;
	pageUrl = pageUrl.toString() ;
	n=pageUrl.indexOf('index.php');
	pageUrl=pageUrl.substring(0, n);
	
	$step=0;
	
	loadMore();
});	

$(window).scroll(function(){
	// µ±¹ö¶¯µ½×îµ×²¿ÒÔÉÏ100ÏñËØÊ±£¬ ¼ÓÔØÐÂÄÚÈÝ
	if ($(document).height() - $(this).scrollTop() - $(this).height()<10) {$step=$step+1;loadMore();} 

});


function loadMore()
{
	
	
	//pageUrl=pageUrl+'index.php/index/ajaxData/'+$step;
	//alert(pageUrl)
	
	$.ajax({
		url :pageUrl+'index.php/index/ajaxData/'+$step,
		//url : './index/ajaxData/'+$step,
		dataType : 'json',
		success : function(json)
		{
			if(typeof json == 'object')
			{
				var oMessage;
				for(var i=0, l=json.length; i<l; i++)
				{
					oMessage = json[i];
					
					$reply=oMessage.reply;
					if($reply.length!=0){
						$reply = '<div class="reply">'+oMessage.reply+'<s class="rpy"><i></i></s><p class="time">'+oMessage.replyTime+'</p></div><div class="replyer">'+oMessage.replyer+'</div><div style="clear:both;"></div>';
					}
					else{
						$reply = '';
					}
					
					$item = $('<div class="messageBox"><div class="guest">'+oMessage.nickName+'</div> <div class="message">'+oMessage.content+'<s class="msg"><i></i></s><p class="time">'+oMessage.createTime+'</p></div><div style="clear:both;"></div>' + $reply+'</div>').hide();
					
					$('#main').append($item);
					$item.fadeIn();
				}
			}
		}
	});
	
	//alert($step)

}