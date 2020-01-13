$(document).ready(function(e){


				$("#env").click(function () {	 
					 if( $("#form_d input[name='room']:radio").is(':checked')) {  
							
							
						} else {  
							alert("Selecciona una habitación");
							$(":radio").focus();
							return false;
						}  
					});
});

//	$(":radio").click(function(){

//	alert($(this).val());
