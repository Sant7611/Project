<?php

include('database.php');

$limit = 4;

$query = "SELECT COUNT(*) FROM post";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_row($result);
$total_rows = $row[0];

$total_pages = ceil($total_rows / $limit);

?>

<!DOCTYPE html>

<html lang="en">
    
    <head>

    <meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP Pagination AJAX</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

    <div class="container">

        <div class="table-wrapper">

            <div class="table-title">

                <div class="row">

                    <div class="col-sm-12">

                        <h2 align="center">Pagination in PHP using AJAX</h2>

                    </div>

                </div>

            </div>

            <div id="target-content">loading...</div>

            <div class="clearfix">

                <ul class="pagination">

                    <?php

                    if (!empty($total_pages)) {

                        for ($i = 1; $i <= $total_pages; $i++) {

                            if ($i == 1) {

                    ?>

                                <li class="pageitem active" id="<?php echo $i; ?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>

                            <?php

                            } else {

                            ?>

                                <li class="pageitem" id="<?php echo $i; ?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i; ?>"><?php echo $i; ?></a></li>

                    <?php

                            }
                        }
                    }

                    ?>

                </ul>



            </div>

        </div>

    </div>

    <script>
        $(document).ready(function() {

            $("#target-content").load("pagination.php?page=1");

            $(".page-link").click(function() {

                var id = $(this).attr("data-id");

                var select_id = $(this).parent().attr("id");

                $.ajax({

                    url: "pagination.php",

                    type: "GET",

                    data: {

                        page: id

                    },

                    cache: false,

                    success: function(dataResult) {

                        $("#target-content").html(dataResult);

                        $(".pageitem").removeClass("active");

                        $("#" + select_id).addClass("active");

                    }

                });

            });

        });
    </script>

</body>

</html>