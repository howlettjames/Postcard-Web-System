$(document).ready(function()
{
    $("#formLogin").validetta(
    {
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid: function(evnt)
        {
            evnt.preventDefault();
            let correo = document.getElementById("correo").value;
            let contrasena = document.getElementById("contrasena").value;
            let admin = "false";
            if(document.getElementById("admin").checked)
                admin = "true";
            
            console.log(correo);
            console.log(contrasena);
            console.log(admin);

            $.ajax({
                method: "POST",
                url: "./pages/index_ajax.php",
                data: {correo: correo, contrasena: contrasena, admin: admin},
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
                                window.location.href = "./pages/main.php";
                        }
                    });
                }    
            });
        }
    });
});