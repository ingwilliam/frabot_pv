$(document).ready(function () {                            
                    
    $('.calendario').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
    });

    $(".date").focusout(function () {
        if (!$(this).val().match(/^([0-9]{4}\-[0-9]{2}\-[0-9]{2})$/)) {
            $(this).val("");
        }
    });

    $(".email").focusout(function () {
        if (!$(this).val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) {
            $(this).val("");
        }
    });

    $(".decimal").focusout(function () {
        if (!$(this).val().match(/^[+\-]?(\.\d+|\d+(\.\d+)?)$/)) {
            $(this).val("");
        }
    });

    $('.numeric').keyup(function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });


    $(".form-validar").submit(function (e) {

        var retrunform = true;
        $("#mensajevalida ul").empty();
        var validar = $(this).find(".validar").get();
        for (var i = 0; i < validar.length; i++)
        {
            if ($(validar[i]).val() == "")
            {
                $(validar[i]).css("border", "1px solid red")
                $("#mensajevalida ul").append("<li>Por favor ingrese su " + $(validar[i]).attr("title") + " en el formulario</li>");
                retrunform = false;
            } 
            else
            {
                if($("input[name='"+$(validar[i]).attr("name")+"']:radio").length > 0)
                {
                    if($("input[name='"+$(validar[i]).attr("name")+"']:radio").is(':checked'))
                    {
                        $(validar[i]).css("box-shadow", "none");
                        $(validar[i]).css("-webkit-box-shadow", "none");
                        $(validar[i]).css("-moz-box-shadow", "none");
                        $(validar[i]).css("border", "");
                    }
                    else
                    {
                        $(validar[i]).css("box-shadow", "0px 0px 10px red");
                        $(validar[i]).css("-webkit-box-shadow", "0px 0px 10px red");
                        $(validar[i]).css("-moz-box-shadow", "0px 0px 10px red"); 
                        $("#mensajevalida ul").append("<li>Por favor ingrese su " + $(validar[i]).attr("title") + " en el formulario</li>");
                        retrunform = false;                        
                    }
                }
                else
                {
                    $(validar[i]).css("border", "");
                }
            }
        }

        if (retrunform)
            $("#mensajevalida").css("display", "none");
        else
            $("#mensajevalida").css("display", "block");

        return retrunform;
    });
});

$(document).on('click', '.number-spinner button', function () {    
	var btn = $(this),
		oldValue = btn.closest('.number-spinner').find('input').val().trim(),
		newVal = 0;
	
	if (btn.attr('data-dir') == 'up') {
		newVal = parseInt(oldValue) + 1;
	} else {
		if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
		} else {
			newVal = 1;
		}
	}
        
        $.post("index.php?controlador=Index&accion=cantidadcarrito", {
            carrito: $(btn.closest('.number-spinner').find('input')).attr("alt"),
            cantidad: newVal
        });
        
        var sub_total = parseInt($("#precio_"+$(btn.closest('.number-spinner').find('input')).attr("alt")).val()) * parseInt(newVal);
    
        $(".total_cantidad_carrito_"+$(btn.closest('.number-spinner').find('input')).attr("alt")).html("$"+Moneda(sub_total.toString()));
        
	btn.closest('.number-spinner').find('input').val(newVal);
});
