<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body style="background-color:rgba(245,125,67,0.77);">
    <div class="container my-5">
        <div class="card" style="padding: 20px; box-shadow:5px 7px #444444; border-radius:25px;">
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
                                <a href='/myclass/edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a><br><br>
                                <a href='/myclass/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
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