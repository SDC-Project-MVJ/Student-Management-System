<?php
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    header('location: /myclass/login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['AdminLoginId'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        a img {
            width: 25px;
            height: 25px;
        }

        a img:first-of-type {
            margin-right: 8px;
        }

        th,
        td {
            text-align: center;
        }

        .my-5 {
            width: 100%;
        }
    </style>
</head>

<body style="background-color:#082032;">
    <nav class="navbar navbar-inverse" style="padding:10px; background-color:orange">
        <div class="container-fluid">
            <div class="navbar-header">
                <h1><?php echo $_SESSION['AdminLoginId'] ?></h1>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <form method="POST">
                    <button class="btn btn-danger navbar-btn" name="Logout">Logout</button>
                </form>
            </ul>
        </div>
    </nav>

    <?php
    if (isset($_POST['Logout'])) {
        session_destroy();
        header("location: /myclass/login.php");
    }
    ?>

    <div class="container-xxl my-5">
        <div class="card" style="padding: 20px; box-shadow:0 0 10px 0 white; border-radius:25px;">
            <h2>List of Students</h2>
            <a href="/myclass/create.php" class="btn btn-primary" role="button" style="width: 10rem;">New Student</a>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>USN</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Branch</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Overall Percentage</th>
                        <th>Attendance</th>
                        <th>Date of Admission</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "myclass";

                    // Create a connection
                    $connection = new mysqli($servername, $username, $password, $database);

                    // Check connection
                    if ($connection->connect_error) {
                        die("Connection Failed: " . $connection->connect_error);
                    }

                    // read all rows from db table
                    $sql = "SELECT * FROM students";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("invalid query: " . $connection->error);
                    }

                    // Read data from each row
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>$row[usn]</td>
                            <td>$row[name]</td>
                            <td>$row[gender]</td>
                            <td>$row[branch]</td>
                            <td>$row[email]</td>
                            <td>$row[number]</td>
                            <td>$row[percentage]</td>
                            <td>$row[attendance_perc]</td>
                            <td>$row[dateofAdmission]</td>
                            <td>
                                <a href='/myclass/edit.php?id=$row[id]'><img src='./images/edit.png'></a>
                                <a href='/myclass/delete.php?id=$row[id]'><img src='./images/delete.png'></a>
                            </td>
                        </tr>
                        ";
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </div>
</body>

</html>