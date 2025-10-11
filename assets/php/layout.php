<!DOCTYPE html>
<html lang="de" class="hidden">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <title>
            <?= htmlspecialchars($title ?? 'Maetzig\'s Pilzkarte') ?>
        </title>

        <meta name="color-scheme" content="light dark">
        <meta name="theme-color" content="#10B981" media="(prefers-color-scheme: light)">
        <meta name="theme-color" content="#000000" media="(prefers-color-scheme: dark)">

        <link rel="icon" type="image/png" href="assets/img/favicon.png">
        <link rel="stylesheet" href="assets/css/style.css?v=5"/>
        <link rel="stylesheet" href="assets/css/leaflet.css"/>
        <script src="assets/js/tailwindcss.js"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
            }
        </script>
    </head>

    <?php
        if (function_exists('renderBody')) { renderBody(); }
    ?>

    <script defer src="assets/js/leaflet.js"></script>
    <script defer src="assets/js/script.js?v=5"></script>
</html>
