<?php
session_start();
if (!isset($_SESSION['StudentLoginId'])) {
    header('location: /myclass/student_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo $_SESSION['StudentLoginId'] ?></title>
    <style>
        .bad,
        .average,
        .good {
            display: inline;
            padding: 5px;
            border-radius: 5px;
        }

        .bad {
            color: white;
            background-color: #EB6440;
        }

        .good {
            color: white;
            background-color: #379237
        }

        .average {
            color: unset;
            background-color: #F0FF42;
        }
    </style>
</head>

<body style="background-color:#082032;">
    <nav class="navbar navbar-inverse" style="padding:10px; background-color:orange">
        <div class="container-fluid">
            <div class="navbar-header">
                <h1><?php echo $_SESSION['StudentLoginId'] ?></h1>
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
        header("location: /myclass/student_login.php");
    }
    ?>

    <div class="container my-5" style="background-color:#E8F9FD; border-radius:25px; 
    box-shadow:0 0 10px 0 white; padding: 20px">
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

        $student_usn = $_SESSION['StudentLoginId'];

        // read all rows from db table
        $sql = "SELECT * FROM `students` WHERE `usn`='$student_usn'";
        $result = $connection->query($sql);

        if (!$result) {
            die("invalid query: " . $connection->error);
        }

        // Read data from each row
        while ($row = $result->fetch_assoc()) {
            echo "
                            <div class='row'>
                                <div class='col-md-8'>
                                    <h3 class='my-3'>Name</h3>
                                    <p>$row[name]</p>
                                </div>
                                <div class='col-md-8'>
                                    <h3 class='my-3'>Gender</h3>
                                    <p>$row[gender]</p>
                                </div>
                                <div class='col-md-8'>
                                    <h3 class='my-3'>Branch</h3>
                                    <p>$row[branch]</p>
                                </div>
                                <div class='col-md-8'>
                                    <h3 class='my-3'>Email</h3>
                                    <p>$row[email]</p>
                                </div>
                                <div class='col-md-8'>
                                    <h3 class='my-3'>Phone Number</h3>
                                    <p>$row[number]</p>
                                </div>
                                <div class='col-md-8'>
                                    <h3 class='my-3'>Date of Adimission</h3>
                                    <p>$row[dateofAdmission]</p>
                                </div>
                                <div class='col-md-8'>
                                    <h3 class='my-3'>Overall Percentage</h3>
                                    <p id='percentage' value=`$row[percentage]`>$row[percentage]</p>
                                </div>
                                <div class='col-md-8'>
                                    <h3 class='my-3'>Attendance Percentage</h3>
                                    <p id='attendance'>$row[attendance_perc]</p>
                                </div>
                            </div>
                        ";
        }
        ?>
    </div>

    <script>
        let perc = parseInt(document.getElementById('percentage').textContent);
        let att_perc = parseInt(document.getElementById('attendance').textContent);
        if (perc >= 85 && perc <= 100) {
            document.getElementById('percentage').classList.add("good");
        } else if (perc >= 65 && perc < 85) {
            document.getElementById('percentage').classList.add('average');
        } else {
            document.getElementById('percentage').classList.add('bad');
        }

        if (att_perc >= 85 && att_perc <= 100) {
            document.getElementById('attendance').classList.add("good");
        } else if (att_perc >= 75 && att_perc < 85) {
            document.getElementById('attendance').classList.add('average');
        } else {
            document.getElementById('attendance').classList.add('bad');
        }
    </script>

</body>

</html>