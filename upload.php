<?php

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {

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

    echo "<pre>";
    print_r($_FILES['image_url']);
    echo "</pre>";

    $img_name = $_FILES['image_url']['name'];
    $img_size = $_FILES['image_url']['size'];
    $tmp_name = $_FILES['image_url']['tmp_name'];
    $error = $_FILES['image_url']['error'];

    if ($error === 0) {
        if ($img_size > 300000) {
            $em = "Sorry, your file is too large.";
            header("Location: picture.php?error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database
                $sql = "INSERT INTO images(image_url) 
                        VALUES('$new_img_name')";
                mysqli_query($con, $sql); // Changed $conn to $con
                header("Location: home.php");
            } else {
                $em = "You can't upload files of this type";
                header("Location: clients.php?error=$em");
            }
        }
    } else {
        $em = "unknown error occurred!";
        header("Location: clients.php?error=$em");
    }
} else {
    header("Location: clients.php");
}
?>
