<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jquery First</title>
    <script src="jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('p').css({color:'red'})

            $('#hide').click(function(){
                $('p').hide();
            })
            $('#show').click(function(){
                $('p').show();
            })
        })
    </script>
</head>
<body>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis labore rerum atque fugiat. Mollitia accusantium voluptatem perspiciatis ipsam consequatur vero non modi impedit maxime sapiente cum cupiditate, beatae, ullam repellendus.</p>
    <input type="button" value="show" id='show'>
    <input type="button" value="hide" id='hide'>
</body>
</html>