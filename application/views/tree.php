<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <title>jsTree test</title>

        <link rel="stylesheet" href="dist/themes/default/style.min.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

        <script src="dist/jstree.min.js"></script>

        <script>
            $(function () {
                generarArbol();
                $('#agregar').on('submit', function () {
                    var nombre = $('#txtAgregar').val();
                    var padre = $('#dropuni').val();
                    var data = {
                        "nombre": nombre,
                        "padre": padre
                    };

                    var uri = '<?= site_url() ?>';
                    uri += "/welcome/agregar/";

                    $.post(uri, data, function (resp) {
                        $('#txtAgregar').val("");
                        $('#contenedor').html(""); // para vaciarlo
                        var jsdiv = $('<div id="jstree"></div>');
                        $('#contenedor').append(jsdiv);
                        generarArbol();
                    }, "json");
                });
            });

            function generarArbol() {
                var base_url = '<?= site_url() ?>';
                base_url += "/welcome/get_unidades/";
                $.post(base_url, {}, function (a) {
                    $('#jstree').jstree({
                        "core": {
                            "themes": {
                                "icons": false
                            },
                            "data": a
                        },
                        "contextmenu": {
                            //var tree = $("#jstree").jstree(true);
                            "items": function ($node) {
                                return {
                                    "Rename": {
                                        "separator_before": false,
                                        "separator_after": true,
                                        "label": "Renombrar",
                                        "action": function (obj) {
                                            /*
                                            generarArbol();
                                            
                                            var id = $node.id;
                                            
                                            var nombre = $('#txtAgregar').val();
                                            var padre = $('#dropuni').val();
                                            var data = {
                                                "nombre": nombre,
                                                "padre": padre
                                            }
                                            var uri = '<?= site_url() ?>';
                                            uri += "/welcome/editar/";

                                            $.post(uri, data, function (resp) {
                                                $('#txtAgregar').val("");
                                                $('#contenedor').html(""); // para vaciarlo
                                                var jsdiv = $('<div id="jstree"></div>');
                                                $('#contenedor').append(jsdiv);
                                                generarArbol();
                                            }, "json");
                                        });*/
                                        }
                                    },
                                    "Remove": {
                                        "separator_before": false,
                                        "separator_after": false,
                                        "label": "Eliminar",
                                        "action": function (obj) {
                                            // $node.id
                                            // $node.tex, etc, justo acá
                                            // esta es la de elimiacion
                                            // sacas los datos del nodo y haces la magia con post
                                            //y cómo valido que sea no sea papi de otros? es que en eso
                                            //me perdí también porque yo quería mostrar un mensaje de exito 
                                            //en el anterior y así, y si había un problema un GG xD
                                            // pues en el anterior mandé el msg si te fijaste, solo que no hice nada con el mensaje
                                            // en este caso, lo puedes validar de dos formas, del lado del cliente y del lado del server
                                            /////// LADO DEL CLIENTE
                                            // para esto tienes que ver primero la estructura del tree a ver como se forma, veamos
                                            // bueno, por la estructura que tiene veo esto complicado xq tiene demasiadas cosas anidadas, pero 
                                            // basicamente la idea era contar los elementos anidados con Jquery para saber los hijos, pero se nos va a complicar por la estructura
                                            ////// LADO DEL SERVER
                                            // hacer dos peticiones POST anidadas, es decir que una va a ir adentro del function(rep) de la otra
                                            // la más externa toma el id del nodo y con una consulta en el server ves cuantos hijos tiene, si cero o más
                                            // y so devuelves al cliente, que en base a ese número vos haces lo que quieres, si no quieres
                                            // que elimine si tiene hijos mostras el mensaje, si no tiene hijos ejecutas el post interno que borraria el nodo
                                            //eso va a estar guapo... xD para nada xD en un ratito se saca :p dijo el pro, bueno voy a ver primero lo del edit y después me meto con el 
                                            //eliminar... chivo, y cualquier cosa me avisas :p
                                        }
                                    }
                                };
                            }
                        },
                        "plugins": [
                            "contextmenu", "wholerow"
                        ]
                    });
                }, "json");
            }
        </script>
    </head>
    <body>
        <div id="contenedor">
            <div id="jstree">
            </div>
        </div>
        
        <form id="agregar">
            <input type="text" name="Nombre" id="txtAgregar" required> <br> 

            <select class="form-control" id="dropuni">
                <option value="#">Independiente</option>
                    <?php 
                        $query = $this->db->query('select id_unidad, nombre_unidad '
                                . 'from unidad');
                        $dropdowns = $query->result();

                        foreach($dropdowns as $row)
                        { 
                          echo '<option value="'.$row->id_unidad.'">'.$row->nombre_unidad.'</option>';
                        }
                    ?>
            </select>
            <br>

            <input type="submit" id="btnAgregar" value="Agregar"> <br>
            
        </form>
    </body>
</html>