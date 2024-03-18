<?php

include('database.php');

$limit = 5;

if (isset($_GET["page"])) {
    $page_number  = $_GET["page"];
} else {
    $page_number = 1;
};

$initial_page = ($page_number - 1) * $limit;

$sql = "SELECT * FROM post LIMIT $initial_page, $limit";

$result = mysqli_query($conn, $sql);

?>

<table class="table table-bordered table-striped">

    <thead>

        <tr>

            <th>ID</th>

            <th>Title</th>

            <th>Sypnosis</th>

            <th>Status</th>

        </tr>

    </thead>

    <tbody>

        <?php

        while ($row = mysqli_fetch_array($result)) {

        ?>

            <tr>

                <td><?php echo $row["id"]; ?></td>

                <td><?php echo $row["title"]; ?></td>

                <td><?php echo $row["sypnosis"]; ?></td>

                <td><?php echo $row["status"]; ?></td>

            </tr>

        <?php

        };

        ?>

    </tbody>

</table>