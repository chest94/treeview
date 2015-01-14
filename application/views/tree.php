<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>jsTree test</title>
        <!-- 2 load the theme CSS file -->
        <link rel="stylesheet" href="dist/themes/default/style.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- 5 include the minified jstree source -->
        <script src="dist/jstree.min.js"></script>
        <script>
            $(function () {
                var base_url = '<?= site_url() ?>';
                base_url += "/welcome/get_unidades/";
                $.post(base_url, {}, function (a) {
                    $('#jstree').jstree({

                    "core":{
                    'data': a
                    },
                    
                    "contextmenu":{
                        "items": function ($node) {
                            var tree = $("#tree").jstree(true);
                            return {
                                "Create": {
                                    "separator_before": false,
                                    "separator_after": true,
                                    "label": "Crear",
                                    "action": function (obj) {
                                        $node = tree.create_node($node);
                                        tree.edit($node);
                                    }
                                },
                                "Rename": {
                                    "separator_before": false,
                                    "separator_after": true,
                                    "label": "Renombrar",
                                    "action": function (obj) {
                                        tree.edit($node);
                                    }
                                },
                                "Remove": {
                                    "separator_before": false,
                                    "separator_after": false,
                                    "label": "Eliminar",
                                    "action": function (obj) {
                                        tree.delete_node($node);
                                    }
                                }
                            };
                        }
                    },

                    "plugins":[
                            "contextmenu", "wholerow"
                    ]
                });
            }, "json");
            });
        </script>
    </head>
    <body>
        <div id="jstree">
        </div>
    </body>
</html>