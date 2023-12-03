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
    // Using prepared statements to prevent SQL injection
    $search = $_POST["search"];
    $sql = "SELECT * FROM `users` WHERE `Username` LIKE ? OR `Id` = ?";

    // Prepare statement
    $stmt = mysqli_prepare($con, $sql);

    // Bind parameters and secure input values
    mysqli_stmt_bind_param($stmt, "ss", $search, $search);

    // Execute query
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        echo "Error: " . mysqli_error($con);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection (moved to the end to stay open during table rendering)
// mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Search</title>
</head>

<body class="bg-light">
    <div class="container my-5">
        <a class="btn btn-secondary" href="users.php" class="btn btn-secondary mb-3">&#8592; Back</a>
        <h1 class="text-center mb-4">User Search</h1>

        <form method="post" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Clients" name="search"
                    value="<?= htmlspecialchars($search); ?>">
                <button class="btn btn-dark" name="submit">Search</button>
            </div>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="alert alert-info" role="alert">
                Searching for:
                <?= htmlspecialchars($search); ?>
            </div>

            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($row['Id']); ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($row['Username']); ?>
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