$(document).ready(function () {
	
	var base = window.location.protocol + "//" + window.location.host + "/";

    $("#uploadTrigger").on('click', function(event) {
        $("#imagen").trigger('click');
    });

	$(":file").change(function()
	{
		//$('#frm-upload-profile').submit();
	    var file = this.files[0];
	    var name = file.name;
	    var size = file.size;
	    var type = file.type;
	    
	    //validación
	    var imageType = new Array("image/png", "image/jpeg", "image/gif", "image/bmp");

	    if(jQuery.inArray(type, imageType )  == -1)
	    {
	        $("#mensaje").html("Imagenes permitidas: jpg, jpeg, png, gif").css('color', '#F00000');
	        return false;
	    }
	    else
	    {
	        $("#mensaje").html("");
	        
	        if ($("#file-id").val() !== '')
	        {
	            var formData = new FormData($('form')[0]);
                
	            $.ajax({
	                url: base + 'perfil/subir-imagen',  //Server script to process data
	                type: 'POST',
	                
	                beforeSend: function(){
	                	$imagenPrevia = $('#profileImg').attr('src');
	                    $('#profileImg').addClass( 'profile-image-loading').removeClass('profile-image').attr('src', base + 'img/loading.gif');
	                },
	                
	                success: function(data){                       
	                	console.log(data)	
	                    if (data.response)
	                    {
	                        var reader = new FileReader();
	                        
	                        reader.onload = function(e){

	                        	$('.profile-image-loading').addClass('profile-image').removeClass('profile-image-loading').attr('src', e.target.result);
	                        	
	                        	return false;
	                        },
	                        
	                        reader.readAsDataURL(file);

	                        $("#mensaje").html(data.message).css('color', '#009900');
	                    }
	                    else
	                    {
	                    	//Recorrer errores
	                        var m = function mostrarMensajes(objeto, nombreObjeto) {
							  var resultado = "";
							  for (var i in objeto) {
							    if (objeto.hasOwnProperty(i)) {
							        resultado += "- " + objeto[i] + "<br/>";
							    }
							  }
							  return resultado;
	                    	};            	
	                    	
	                    	$('#profileImg').addClass( 'profile-image').removeClass('profile-image-loading').attr('src', $imagenPrevia);
	                        $("#mensaje").html(m(data.errores, "message")).css('color', '#F00000');
	                        return false;
	                    }
	                },	                

	                data: formData,
	                dataType:'json',	                
	                cache: false,
	                contentType: false,
	                processData: false
	            });
	        }
	        else
	        {
		        alert("Seleccionar una imagen válida.");
		        return false;
	        }
	    }

	});

});