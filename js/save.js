$(document).ready(function()
{
    $("#formEnviarPostal").validetta(
    {
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid: function(evnt)
        {
            evnt.preventDefault();
            $.ajax({
                method: "POST",
                url: "./../pages/postal_pdf.php",
                data: $("#formEnviarPostal").serialize(),
                cache: false,
                success: function(respAX)
                {
                    let AX = JSON.parse(respAX); 
                    $.alert({
                        title: "<h4>WORM</h4>",
                        content: AX.msj,
                        icon: "fas fa-info fa-2x",
                        type: tipoAlerts[AX.val],
                        onDestroy: function()
                        {
                            if(AX.val == 1)
                            {
                                if(document.getElementById("pdf").checked)
                                {
                                    let nombre_dest = document.getElementById("correo_dest");
                                    let correo_dest = document.getElementById("correo_dest");
                                    let dedicatoria = document.getElementById("dedicatoria");
                                    let postal = document.getElementById("postal");
                                    let caption = document.getElementById("caption");
                                    window.location.href = "./../pages/postal_pdf.php?nombre_dest="+nombre_dest.value+"&correo_dest="+correo_dest.value+"&dedicatoria="+dedicatoria.value+"&postal="+postal.value+"&caption="+caption.value;
                                }
                                window.location.reload(true);
                            }
                        }
                    });
                }    
            });
            $.ajax({
                method: "POST",
                url: "./../pages/mail.php",
                data: $("#formEnviarPostal").serialize(),
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
                            {
                                if(document.getElementById("pdf").checked)
                                {
                                    let nombre_dest = document.getElementById("correo_dest");
                                    let correo_dest = document.getElementById("correo_dest");
                                    let dedicatoria = document.getElementById("dedicatoria");
                                    let postal = document.getElementById("postal");
                                    let caption = document.getElementById("caption");
                                    window.location.href = "./../pages/postal_pdf.php?nombre_dest="+nombre_dest.value+"&correo_dest="+correo_dest.value+"&dedicatoria="+dedicatoria.value+"&postal="+postal.value+"&caption="+caption.value;
                                }
                                window.location.reload(true);
                            }
                        }
                    });
                }    
            });
        }
    });
});