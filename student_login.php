<?php
require("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
"></script>
    <style>
        a {
            margin: 20px;
        }
    </style>
</head>

<body style="background-color:#E14D2A; padding: 20px">

    <section class="gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Student Login</h2>
                                <p class="text-white-50 mb-5">Please enter Student Email and USN!</p>
                                <form method="POST">
                                    <div class="form-outline form-white mb-4">
                                        <input type="name" class="form-control form-control-lg" name="student_email" />
                                        <label class="form-label" name="student_email">Email</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" class="form-control form-control-lg" name="student_usn" />
                                        <label class="form-label" for="typePasswordX" name="student_usn">USN</label>
                                    </div>

                                    <?php
                                    if (isset($_POST['Signin'])) {
                                        $query = "SELECT * FROM `students` WHERE `email`='$_POST[student_email]' AND `usn`='$_POST[student_usn]'";
                                        $result = mysqli_query($con, $query);
                                        $errorMessage = "";
                                        if (mysqli_num_rows($result) == 1) {
                                            session_start();
                                            $_SESSION['StudentLoginId'] = $_POST['student_usn'];
                                            header("location: student.php");
                                        } else {
                                            $errorMessage = "Incorrect credentials";
                                        }
                                    }


                                    ?>

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
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit" name="Signin">Login</button>
                                    <a href="/myclass/login.php" class="btn btn-primary btn-lg px-5">Login as Admin</a>
                                    <a href="/myclass/index.php" class="btn btn-success btn-lg px-5">Go to Home</a>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>