$('document').ready(function (e) {

	var content_html;

	$.ajax({
		method: "GET",
		url: SERVER_API + "Users/update_user/",
		data: { user_id: encode_b64(getCookie('id_user')) },
		success:function(res){
			var json_response = JSON.parse(res).data;

			$.each(json_response, function(txtorig, txtnew) {
				content_html = $('div.wrapper-content').html();
				
				$('div.wrapper-content').html(content_html.replace('{'+txtorig +'}', txtnew));
			});
			console.log(json_response);
			
		},
		error:function(err){
			//alert('Error sobre la conexión al servidor');
		}
	});
	
});