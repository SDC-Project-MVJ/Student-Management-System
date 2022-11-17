<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Student Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: 0.4s all;
        }

        .main {
            width: 100%;
            height: 100vh;
            /* background-image: url('./images/bg-img.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center; */
        }

        h1 {
            text-align: center;
            padding: 20px 0;
            /* font-family: sans-serif; */
        }

        .section {
            display: flex;
            width: 100%;
            height: 80%;
        }

        .left,
        .right {
            width: 90%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            /* background-color: red; */
        }

        .left {
            border-right: 2px solid gray;
            background-color: #E14D2A;
        }

        .right {
            background-color: #F6F6C9;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }

        form img {
            width: 200px;
            height: 200px;
        }

        form a:hover {
            transform: scale(1.15);
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="header">
            <h1 class="jumbotron">
                Student Management System
            </h1>
        </div>

        <div class="section">
            <div class="left">
                <form method="POST">
                    <h2>Login as Student</h2>
                    <a href="/myclass/student_login.php" role="button" aria-pressed="true"><img src="./images/student.png" alt="student-img"></a>
                </form>
            </div>
            <div class="right">
                <form method="POST">
                    <h2>Login as Admin</h2>
                    <a href="/myclass/login.php" role="button" aria-pressed="true"><img src="./images/admin.png" alt="admin-img"></a>
                </form>
            </div>
        </div>

    </div>
</body>

</html>