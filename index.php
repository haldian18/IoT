<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Refresh</title>
</head>

<body>
    <div class="text"></div>
    
    <script>
        $(document).ready(function() {
            $('.text').load('charts.php');
            refresh();
        });

        function refresh() {
            setTimeout(function() {
                $('.text').fadeOut('slow').load('charts.php').fadeIn('slow');
                refresh();
            }, 200);

        }
    </script>
</body>

</html>