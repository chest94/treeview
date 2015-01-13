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
                $("#jstree").jstree({
                    "core": {
                        "data": [
                            {"id": "ajson1", "parent": "#", "text": "Simple root node"},
                            {"id": "ajson2", "parent": "#", "text": "Root node 2"},
                            {"id": "ajson3", "parent": "ajson2", "text": "Child 1"},
                            {"id": "ajson4", "parent": "ajson2", "text": "Child 2"}
                        ]
                    },
                    "plugins": ["themes", "json_data", "ui"]
                });
            });
        </script>
    </head>
    <body>
        <div id="jstree">
        </div>
    </body>
</html>