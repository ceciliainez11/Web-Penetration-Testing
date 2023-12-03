<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fff;
        }

        .nav {
            background-color: #f9deff;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }

        .logo img {
            width: 40px;
            height: auto;
        }

        .right-links a,
        .right-links button {
            margin-left: 10px;
        }

        .main-box {
            margin: 20px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <title>Home</title>
</head>

<body>

    <div class="nav">
        <div class="logo">
            <a href="home.php"><img src="logoB9.png" alt="Logo"></a>
        </div>

        <div class="logo">
            <a href="users.php" class="btn btn-primary">Users Page</a>
        </div>

        <div class="right-links">
            <?php
            $id = $_SESSION['id'];
            $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

            while ($result = mysqli_fetch_assoc($query)) {
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_id = $result['Id'];
            }

            echo "<a href='edit.php?Id=$res_id' class='btn btn-warning'>Change Profile</a>";
            ?>
            <a href="php/logout.php" class="btn btn-danger">Log Out</a>
        </div>
    </div>
    <main>
        <div class="container-auto main-box">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Hello <b>
                            <?php echo $res_Uname ?>
                        </b>, Welcome</h2>
                    <p>Your email is <b>
                            <?php echo $res_Email ?>
                        </b>.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS and Popper.js (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>