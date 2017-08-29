<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $heading ?></title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/script.js"></script>
    <script
        src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous">
    </script>
    <script src="js/jquery.wysibb.js"></script>
    <link rel="stylesheet" href="http://cdn.wysibb.com/css/default/wbbtheme.css" />
    <link rel="stylesheet" href="css/wbbtheme.css">
    
    <script>
        $(document).ready(function() {
            var wbbOpt = {
            buttons: "bold,italic,underline,|,link,|"
            }
            $("#editor").wysibb(wbbOpt);
        });
    </script>
</head>
<body>

    
