function login(){
     $.ajax({
        type: "POST",
        url: "../controller/Controller.php",
        data: $("#frmLogin").serialize(),
        datatype: "text/html",
        success: function (response) {
             if (parseInt(response) !== 0) {
                var datosJSON = JSON.parse(response);
                alert( datosJSON[0]['usuario'] );
             }else{
                 alert('No macht user and password');
             }
        }
    });  
}