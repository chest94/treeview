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
            base_url = '<?= site_url() ?>';

            var datos = obtener_unidad();
            createJSTrees(datos);

            function createJSTrees(datos) {
                $("#jstree").jstree({
                    "json_data": {
                        "data": datos
                    },
                    "plugins": ["themes", "json_data", "ui"]
                });

            function obtener_unidad()
            {
                base_url += "/welcome/get_unidades/";

                //alert(base_url);

                var prueba;

                $.post(base_url, function (a) {
                    prueba = a;
                }, "json");

                return prueba;
            }
        </script>
    </head>
    <body>
        <div id="jstree">
        </div>
    </body>
</html>