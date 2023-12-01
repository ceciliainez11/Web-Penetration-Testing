<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pentest";

    // Create Connection
    $con = mysqli_connect($servername, $username, $password, $database);

    // Check Connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST["submit"])) {
        $search = $_POST["search"];

        $sql = "SELECT * FROM `clients` WHERE `name` LIKE '%$search%' OR `id` = '$search'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo '<table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>phone</th>
                            <th>address</th>
                            <th>image url</th>

                        </tr>
                    </thead>
                    <tbody>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['phone'] . '</td>
                        <td>' . $row['address'] . '</td>
                        <td>' . $row['image url'] . '</td>
                    </tr>';
                }

                echo '</tbody></table>';
            } else {
                echo '<h2 class="text-danger">Data not found</h2>';
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }

        // Close connection
        mysqli_close($con);
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Search</title>
</head>

<body>
    <div class="container">
        <form method="post">
            <input type="text" placeholder="Search Clients" name="search">
            <button class="btn btn-dark btn-sm" name="submit">Search</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <p>Searching for: <?php echo htmlspecialchars($search); ?></p>
        <?php echo $search; ?>
        <?php endif; ?>

        <div class="container my-5">
            <?php
            // Result table will be echoed here
            ?>
        </div>
    </div>
  
</body>

</html>