<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Steven Hau" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Chatcito PHP</title>
</head>

<body>

    <div class="container">

        <div class="row ">

            <div class="offset-md-3 col-md-6">
                <h2 class="text-center">Chat En Vivo</h2>
                <div class="form-group">
                    <input class="form-control mt-5" id="nombre" type="text" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="mensaje" id="mensaje" cols="30" rows="10"></textarea>
                </div>
                <button id="btn" type="button" class="btn btn-outline-success">Enviar</button>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6" id="mensaje-div">
                <!-- div donde van los mensajes -->

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(e) {
            var conn = new WebSocket('ws://localhost:8080'); //conectara con el websocket

            conn.onopen = function(e) { //si la conexion es existossa
                console.log("Conexion exitosa");
            };

            conn.onmessage = function(e) {
                var respuesta = JSON.parse(e.data); //recibimos la respuesta y como es json la parseamos

                console.log("nombre: " + respuesta.nombre + " mensaje: " + respuesta.mensaje); //imprimimos en consola

                $('#mensaje-div').append("<p><h3>" + respuesta.nombre + "</h3> " + respuesta.mensaje + "</p>"); //imprimimos en el div

            };

            $('#btn').click(function(e) { //si clickea el boton enviar
                var nombre = $('#nombre').val(); //recibimos el input nombre
                var mensaje = $('#mensaje').val(); //recibimos el textarea mensaje

                var enviar = {
                    'nombre': nombre,
                    'mensaje': mensaje
                }; //lo guardamos en un array

                conn.send(JSON.stringify(enviar)); //enviamos el array atraves de json

                $('#mensaje-div').append("<p><h3>Tu:</h3> " + mensaje + "</p>"); //imprimimos en el div para mi


            });



            //conn.send('Hello World!');
        });
    </script>
</body>

</html>