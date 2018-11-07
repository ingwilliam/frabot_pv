/* -------------------------------------------------------------------------------- /
 
 Magentech jQuery
 Created by Magentech
 v1.0 - 20.9.2016
 All rights reserved.
 
 / -------------------------------------------------------------------------------- */
function Moneda(entrada) {
    var num = entrada.replace(/\./g, "");
    if (!isNaN(num)) {
        num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g, "$1.");
        num = num.split("").reverse().join("").replace(/^[\.]/, "");
        entrada = num;
    } else {
        entrada = input.value.replace(/[^\d\.]*/g, "");
    }
    return entrada;
}

// Cart add remove functions
var cart = {
    'add': function (product_id, quantity, src, name, href, redirect, precio) {
        $(".numero_carrito").html((parseInt($(".numero_carrito").html()) + parseInt(1)));

        $("#total_carrito").attr("value", parseInt(precio) + parseInt($("#total_carrito").attr("value")));

        $(".total_carrito").html("$" + Moneda($("#total_carrito").attr("value")));


        $.post("index.php?controlador=Index&accion=agregarcarrito", {
            articulo: product_id,
            redirect: redirect
        }, function (data) {
            $("#tabla_carrito").html(data);
        });
        addProductNotice('Producto agregado al Carrito', '<img src="' + src + '" alt="' + name + '">', '<h3><a href="' + href + '">' + name + '</a> añadido al <a href="index.php?controlador=Index&accion=carrito">carrito de compras</a>!</h3>', 'success');
    },
    'remove': function (carrito, url) {
        $.post("index.php?controlador=Index&accion=eliminarcarrito", {
            carrito: carrito
        }, function (data) {
            location.href = url;
        });
    }
}

var wishlist = {
    'add': function (product_id) {
        addProductNotice('Product added to Wishlist', '<img src="image/demo/shop/product/e11.jpg" alt="">', '<h3>You must <a href="#">login</a>  to save <a href="#">Apple Cinema 30"</a> to your <a href="#">wish list</a>!</h3>', 'success');
    }
}
var compare = {
    'add': function (product_id) {
        addProductNotice('Product added to compare', '<img src="image/demo/shop/product/e11.jpg" alt="">', '<h3>Success: You have added <a href="#">Apple Cinema 30"</a> to your <a href="#">product comparison</a>!</h3>', 'success');
    }
}

/* ---------------------------------------------------
 jGrowl – jQuery alerts and message box
 -------------------------------------------------- */
function addProductNotice(title, thumb, text, type) {
    $.jGrowl.defaults.closer = false;
    //Stop jGrowl
    //$.jGrowl.defaults.sticky = true;
    var tpl = thumb + '<h3>' + text + '</h3>';
    $.jGrowl(tpl, {
        life: 4000,
        header: title,
        speed: 'slow',
        theme: type
    });
}

