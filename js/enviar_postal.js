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
                    if(AX.val == 1)
                    {
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
                                        window.location.reload(true);
                                    }
                                });
                            }    
                        });        
                    }
                    else
                    {
                        $.alert({
                            title: "<h4>WORM</h4>",
                            content: "<h5 class='center-align'>No se pudo guardar el PDF.</h5>",
                            icon: "fas fa-info fa-2x",
                            type: "red",
                            onDestroy: function()
                            {
                                window.location.reload(true);
                            }
                        });
                    }
                }    
            });
        }
    });
});