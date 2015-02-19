$(document).ready(function(){
    $(function () {
    	$('body').prepend('<div id="popup" class="cerrar_an"><div class="popup_content"><div id="loading">Cargando...</div><a href="#" id="cerrar">X</a><div id="display"></div></div></div>');
        $("#cerrar").click(function() {cerrar_popup();});
    });
});
		function popup(arg){
	    	$("#popup").css('display', 'block');
	    	$("#popup").attr('class', 'abrir_an');
	    	get_data(arg);
	    }

	    function cerrar_popup(){
	    	$("#popup").css('display', 'none');
	    	$("#popup").attr('class', 'cerrar_an');
	    }

	    function get_data(arg){
	    		$('#loading').css('display', 'block');
                var mainCat = arg;
 
                // call ajax
                $("#display").empty();
                $(".popup_content").attr('id', 'popupitem' + arg);
                $.ajax({
                    url: admin_url + "admin-ajax.php",
                    type:"POST",
                    data:"action=popup&main_catid=" + mainCat,
 
                    success:function(results){
						//alert(results);
						$('#loading').css('display', 'none');
                		$("#display").append(results);
                    }
                });
	    }
