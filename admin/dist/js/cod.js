$(document).ready(function () {
        
    $(".botonExcel").click(function () {
        $("#datos_a_enviar").val($("<div>").append($(".tabla_exportar").eq(0).clone()).html());
        $("#FormularioExportacion").submit();
    });    
        
    $('.btn_estado').click(function(){
        $("#idEstado").val($(this).attr('title'));
    });
    
    $('.mod_pension').click(function(){
        $("#matricula").val($(this).attr('title'));
        $("#mes").val($(this).attr('dir'));
        if($(".estado"+$(this).attr('dir')+$(this).attr('title')).val()!="")
        {
            $('input[name=estado][value='+$(".estado"+$(this).attr('dir')+$(this).attr('title')).val()+']').prop('checked', 'checked');
        }
        else
        {
            $('input[name=estado][value=Pendiente').prop('checked', 'checked');
        }
        $("#nota_observaciones").html($(".observaciones"+$(this).attr('dir')+$(this).attr('title')).val());
        
    });
    
    $('#cargar_acudiente').click(function(){
        if($("#edit_parentesco").val()=="")
        {
            $("#edit_parentesco").css("border", "1px solid red");
        }
        else
        {
            $("#edit_parentesco").css("border", "");
            location.href="index.php?controlador=Matricula&accion=asignarAcudiente&id="+$("#idm").val()+"&ida="+$("#idu").val()+"&p="+$("#edit_parentesco").val();
        }                
    });
    
    
    
    $('#btn_buscar_acudiente').click(function(){

        //Añadimos la imagen de carga en el contenedor
        $('#content_acudientes').html('<br/><center><img width="80px" src="dist/img/ajax-loader.gif"/></center><br/>');

        var page = $(this).attr('data');        
        var dataString = 'page='+page;
        

        $.ajax({
            type: "GET",
            url: "index.php?controlador=Matricula&accion=buscarAcudiente",
            data: "id="+$("#id").val()+"&numero_documento="+$("#numero_documento_buscador").val()+"&primer_nombre="+$("#primer_nombre_buscador").val()+"&primer_apellido="+$("#primer_apellido_buscador").val(),
            success: function(data) {
                //Cargamos finalmente el contenido deseado
                $('#content_acudientes').fadeIn(1000).html(data);
                
                $('.btn_acudiente').click(function(){
                    $("#idm").val($(this).attr('dir'));
                    $("#idu").val($(this).attr('title'));
                });
            }
        });
    }); 
    
    
    $("#buscar_acudiente").click(function () {
        $("#form_buscar_acudiente").css("display","block");
        $("#form_nuevo_acudiente").css("display","none");
        $("#form_mis_acudiente").css("display","none");
    });
    
    $("#nuevo_acudiente").click(function () {
        $("#form_nuevo_acudiente").css("display","block");
        $("#form_buscar_acudiente").css("display","none");
        $("#form_mis_acudiente").css("display","none");
    });
    
    $("#cerrar").click(function () {
        $("#form_nuevo_acudiente").css("display","none");
        $("#form_buscar_acudiente").css("display","none");
        $("#form_mis_acudiente").css("display","block");
    });
    
    $("#textCheckBuscadorperfil").keyup(function () {
        var usu = $("#id").attr('value');
        $.post("index.php?controlador=" + $("#controladorCheckBuscador").val() + "&accion=" + $("#accionCheckBuscador").val() + "", {
            cadena: $(this).val(),
            usuario: usu
        }, function (data) {

            $("#divCheckBuscadorperfil").html(data);

        });
    });

    $("#textCheckBuscadorperfil").keyup(function () {
        var usu = $("#id").attr('value');
        $.post("index.php?controlador=" + $("#controladorCheckBuscador").val() + "&accion=" + $("#accionCheckBuscador").val() + "", {
            valor: $(this).val(),
            usuario: usu
        }, function (data) {

            $("#divCheckBuscadortiposervicio").html(data);

        });
    });
    
    $("#textCheckBuscadorcurso").keyup(function () {
        var usu = $("#id").attr('value');
        $.post("index.php?controlador=" + $("#controladorCheckBuscador").val() + "&accion=" + $("#accionCheckBuscador").val() + "", {
            cadena: $(this).val(),
            usuario: usu
        }, function (data) {

            $("#divCheckBuscadorcurso").html(data);

        });
    });

    $("#textCheckBuscadorcurso").keyup(function () {
        var usu = $("#id").attr('value');
        $.post("index.php?controlador=" + $("#controladorCheckBuscador").val() + "&accion=" + $("#accionCheckBuscador").val() + "", {
            valor: $(this).val(),
            usuario: usu
        }, function (data) {

            $("#divCheckBuscadorcurso").html(data);

        });
    });
                
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

function GeneraPermiso( idPermiso , idModulo , idPerfil ){
    $.post("index.php?controlador=Seguridad&accion=genPermiso",  {
        permiso: idPermiso ,
        modulo: idModulo ,
        perfil: idPerfil
    });
}