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
                    
                    return false;
                });
            });

            function generarArbol() {
                var base_url = '<?= site_url() ?>';
                base_url += "/welcome/get_unidades/";
                $.post(base_url, {}, function (a) {
                    $('#jstree').jstree({
                        "core": {
                            "check_callback": true,
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
                                            
                                            var name = $node.text;
                                            var id   = $node.id;
                                            $('#nombreNodo').html(name);
                                            $('#id_unidad').val(id); // x3 
                                            $('#formularioEditar').css('display', 'block');
                                            // x3
                                            $('#formEditar').on('submit', function () {

                                                var data = {
                                                    "id" : $('#id_unidad').val(),
                                                    "nombre": $('#nombre_unidad').val()
                                                };

                                                var uri = '<?= site_url() ?>';
                                                uri += "/welcome/editar/";

                                                $.post(uri, data, function (resp) {
                                                    
                                                    $('#contenedor').html(""); // para vaciarlo
                                                    var jsdiv = $('<div id="jstree"></div>');
                                                    $('#contenedor').append(jsdiv);
                                                    generarArbol();
                                                    $('#formularioEditar').css('display','none');
                                                }, "json");
                                                
                                                return false;
                                            });
                                        }
                                    },
                                    "Remove": {
                                        "separator_before": false,
                                        "separator_after": false,
                                        "label": "Eliminar",
                                        "action": function (obj) {

                                            var id = $node.id;

                                            var data = {
                                                'id': id
                                            };

                                            var uri = '<?= site_url() ?>';
                                            uri += "/welcome/eliminar/";

                                            $.post(uri, data, function (resp) {
                                                if (resp.estado === "true") {
                                                    alert('Unidad eliminada');
                                                    $('#contenedor').html(""); // para vaciarlo
                                                    var jsdiv = $('<div id="jstree"></div>');
                                                    $('#contenedor').append(jsdiv);
                                                    generarArbol();
                                                }
                                                else {
                                                    alert('No se puede eliminar la unidad mientras tenga otras unidades asociadas');
                                                }
                                            }, "json");
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
        <div id="agregar">
            <form id="agregar">
                <input type="text" name="Nombre" id="txtAgregar" required> <br> 

                <select class="form-control" id="dropuni">
                    <option value="#">Independiente</option>
                    <?php
                    $query = $this->db->query('select id_unidad, nombre_unidad '
                            . 'from unidad');
                    $dropdowns = $query->result();

                    foreach ($dropdowns as $row) {
                        echo '<option value="' . $row->id_unidad . '">' . $row->nombre_unidad . '</option>';
                    }
                    ?>
                </select>
                <br>

                <input type="submit" id="btnAgregar" value="Agregar"> <br>

            </form>
        </div>

        <div id="formularioEditar">
            <form id="formEditar">
                Editando nodo "<span id="nombreNodo"></span>"
                <input type="hidden" id="id_unidad" name="id_unidad"/>
                <input type="text" name="nombre_unidad" id="nombre_unidad"/>
                <input type="submit" id="btnEditar" value="Editar"> <br>
                <form/>
        </div>

        <style type="text/css">
            #formularioEditar{
                display: none;
            }
        </style>

    </body>
</html>