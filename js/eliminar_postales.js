$(document).ready(function()
{
    let remove_btns = document.getElementsByClassName("btn-floating");
    for(let i in remove_btns)
    {
        remove_btns[i].onclick = function()
        {
            $.confirm({
                title: '<h4>Confirmaci&oacute;n</h4>',
                content: '<h5>¿Est&aacute;s seguro?</h5>',
                icon: "fas fa-info fa-2x",
                type: "orange",
                buttons: {
                    confirm: function () 
                    {
                        $.ajax({
                            method: "POST",
                            url: "./../pages/eliminar_postales_ajax.php",
                            data: {postal: remove_btns[i].hreflang},
                            cache: false,
                            success: function(respAX)
                            {
                                let AX = JSON.parse(respAX);
                                 
                                let tipoAlerts = new Array("red", "blue");
                                $.alert({
                                    title: "<h4>WORM</h4>",
                                    content: AX.msj,
                                    icon: "fas fa-info fa-2x",
                                    type: tipoAlerts[AX.val],
                                    onDestroy: function()
                                    {
                                        if(AX.val == 1)
                                            window.location.reload(true);
                                    }
                                });
                            }    
                        });    
                    },
                    cancel: function () {}
                }
            });    
        };
    }
});