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

$search = "";
$result = null;

if (isset($_POST["submit"])) {
    $search = $_POST["search"];

    $sql = "SELECT * FROM `clients` WHERE `name` LIKE '%$search%' OR `id` = '$search'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "Error: " . mysqli_error($con);
    }

    // Close connection (moved to the end to keep it open during the rendering of the table)
    // mysqli_close($con);
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

<body class="bg-light">
    <div class="container my-5">
        <a class="btn btn-secondary" href="home.php" class="btn btn-secondary mb-3">&#8592; Back</a>
        <h1 class="text-center mb-4">Client Search</h1>

        <form method="post" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Clients" name="search"
                    value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-dark" name="submit">Search</button>
            </div>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="alert alert-info" role="alert">
                Searching for:
                <?php echo htmlspecialchars($search); ?>
            </div>

            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td>
                                        <?php echo $row['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['phone']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['address']; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif ($result): ?>
                <div class="alert alert-danger" role="alert">
                    Data not found
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Close connection
mysqli_close($con);
?>