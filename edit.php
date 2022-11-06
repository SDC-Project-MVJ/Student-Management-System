<?php error_reporting(0); ?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "myclass";

// Create a connection
$connection = new mysqli($servername, $username, $password, $database);


$id = "";
$usn = "";
$name = "";
$gender = "";
$branch = "";
$email = "";
$number = "";
$subject1 = "";
$subject2 = "";
$subject3 = "";
$subject4 = "";
$subject5 = "";
$subject6 = "";
$subject7 = "";
$subject8 = "";
$attendance = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /myclass/index.php");
        exit;
    }

    $id = $_GET["id"];

    // read row of the selected client from the database table
    $sql = "SELECT * FROM students WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /myclass/index.php");
        exit;
    }

    $usn = $row['usn'];
    $name = $row['name'];
    $gender = $row['gender'];
    $branch = $row['branch'];
    $email = $row['email'];
    $number = $row['number'];
    $average = $row['percentage'];
    $attendance_perc = $row['attendance_perc'];
} else {

    $id = $_POST['id'];
    $usn = $_POST['usn'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $branch = $_POST['branch'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $subject1 = $_POST['subject1'];
    $subject2 = $_POST['subject2'];
    $subject3 = $_POST['subject3'];
    $subject4 = $_POST['subject4'];
    $subject5 = $_POST['subject5'];
    $subject6 = $_POST['subject6'];
    $subject7 = $_POST['subject7'];
    $subject8 = $_POST['subject8'];
    $attendance = $_POST['attendance'];

    do {
        if (empty($usn) || empty($name) || empty($branch) || empty($email) || empty($gender) || empty($number) || empty($subject1)  || empty($subject2)  || empty($subject3)  || empty($subject4)  || empty($subject5)  || empty($subject6)  || empty($subject7) || empty($subject8) || empty($attendance)) {
            $errorMessage = "All the fields are required";
            break;
        } else if (($subject1 > 100 || $subject2 > 100 || $subject3 > 100 || $subject4 > 100 || $subject5 > 100 || $subject6 > 100 || $subject7 > 100 || $subject8 > 100) || ($subject1 < 0 || $subject2 < 0 || $subject3 < 0 || $subject4 < 0 || $subject5 < 0 || $subject6 < 0 || $subject7 < 0 || $subject8 < 0)) {
            $errorMessage = "Marks must be between 0 and 100";
            break;
        } else if (($attendance > 120) || ($attendance < 0)) {
            $errorMessage = "Attendance must be between 0 and 120 days";
            break;
        }

        try {
            $average = ($subject1 + $subject2 + $subject3 + $subject4 + $subject5 + $subject6 + $subject7 + $subject8) / 8;
            $attendance_perc = ($attendance / 120) * 100;
            $sql = "UPDATE students " .
                "SET usn = '$usn', name = '$name', gender = '$gender', branch = '$branch', email = '$email', number = '$number' , percentage = '$average', attendance_perc = '$attendance_perc' " .
                "WHERE id = $id";

            $result = $connection->query($sql);
        } catch (mysqli_sql_exception $e) {
            var_dump($e);
            exit;
        }



        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Student updated successfully";

        header("location: /myclass/index.php");
        exit;
    } while (false);
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
"></script>
</head>

<body style="background-color:rgba(245,125,67,0.77);">
    <div class="container my-5" style="border: 2px solid black; background-color:#E8F9FD; border-radius:25px; 
    box-shadow:5px 7px #444444">
        <h2>New Student</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>        
                ";
        }
        ?>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">USN</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="usn" value="<?php echo $usn; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Gender</label>
                <div class="col-sm-6">
                    <input class="form-check-input" type="radio" name="gender" value="Male">
                    <label class="form-check-label">Male</label>
                    <input class="form-check-input" type="radio" name="gender" value="Female">
                    <label class="form-check-label">Female</label>
                    <input class="form-check-input" type="radio" name="gender" value="Others">
                    <label class="form-check-label">Others</label>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Branch</label>
                <div class="col-sm-6">
                    <select class="form-select" name="branch">
                        <option value="">SELECT</option>
                        <option value="CSE">Computer Science</option>
                        <option value="ISE">Information Science</option>
                        <option value="ECE">Electronics and Communication</option>
                        <option value="AIML">AI & ML</option>
                        <option value="MECH">Mechanical</option>
                        <option value="CSD">Computer Science Design</option>
                        <option value="EEE">Electrical and Electronics</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="number" value="<?php echo $number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Enter marks</label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="subject1" value="<?php echo $subject1; ?>" placeholder="Maths">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="subject2" value="<?php echo $subject2; ?>" placeholder="Chemistry">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="subject3" value="<?php echo $subject3; ?>" placeholder="Physics">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="subject4" value="<?php echo $subject4; ?>" placeholder="Biology">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="subject5" value="<?php echo $subject5; ?>" placeholder="Computer-science">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="subject6" value="<?php echo $subject6; ?>" placeholder="Social-Studies">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="subject7" value="<?php echo $subject7; ?>" placeholder="Geography">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="subject8" value="<?php echo $subject8; ?>" placeholder="English">
                        </div>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Overall Attendance</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="attendance" value="<?php echo $attendance; ?>">
                </div>
                <div class="col-sm-4">
                    <h5> / 120 Days</h5>
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                    </div>
                    ";
            }
            ?>



            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" name="submit_button" value="Submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <button type="button" name="submit_button" value="Cancel" onclick="window.location.href='\index.php'" class="btn btn-outline-primary">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
