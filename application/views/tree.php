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
            });
            
            function generarArbol(){
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
                                    "Create": {
                                        "separator_before": false,
                                        "separator_after": true,
                                        "label": "Crear",
                                        "action": function (obj) {
                                        }
                                    },
                                    "Rename": {
                                        "separator_before": false,
                                        "separator_after": true,
                                        "label": "Renombrar",
                                        "action": function (obj) {
                                        }
                                    },
                                    "Remove": {
                                        "separator_before": false,
                                        "separator_after": false,
                                        "label": "Eliminar",
                                        "action": function (obj) {
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

        <script>
            $(function () {
                $('#btnAgregar').click(function(){
                    var nombre = $('#txtAgregar').val();
                    var padre  = $('#dropuni').val();
                    var data   = {
                        "nombre": nombre,
                        "padre" : padre
                    };
                    
                    var uri = "algo";
                    
                    $.post(uri, data, function(resp){
                        // aca regargas el tree que para eso lo podemos meter en una funcion
                        $('#jstree').html(""); // para vaciarlo
                        generarArbol();
                    }, "json");
                });
            });
        </script>

    </head>
    <body>
        <div id="jstree">
        </div>
        <div id="agregar">
            <form id="agregar">
                <input type="text" id="txtAgregar"> <br> 

                <?php
                $query = $this->db->query('select id_unidad, nombre_unidad '
                        . 'from unidad');
                $dropdowns = $query->result();
                foreach ($dropdowns as $dropdown) {
                    $dropDownList[$dropdown->id_unidad] = $dropdown->nombre_unidad;
                }

                $finalDropDown = array_merge(array('#' => 'Indepentiende'), $dropDownList);
                echo form_dropdown('unidad', $finalDropDown, 'id = "dropuni" class="textbox1" style="margin-top:10px;"');
                ?>
                <br>

                <input type="button" id="btnAgregar" value="Agregar"> <br>
            </form>
        </div>
    </body>
</html>