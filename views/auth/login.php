<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login / Register - VANGUARD</title>
    <link rel="icon" type="image/png" href="../../assets/img/Home/L_Vg.png">

    <!-- TEMPLATE CSS -->
    <link rel="stylesheet" href="../../assets/css/login.css">

    <!-- BOX ICON -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>

    <div class="container <?php echo isset($_SESSION['show_register']) ? 'active' : ''; ?>">

        <!-- ================= LOGIN ================= -->
        <div class="form-box login">
            <form method="POST" action="../../controllers/auth.php">
                <input type="hidden" name="action" value="login">

                <h1>Login</h1>

                <?php
                if (isset($_SESSION['error'])) {
                    echo "<p class='error'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']);
                }

                if (isset($_SESSION['success'])) {
                    echo "<p class='success'>" . $_SESSION['success'] . "</p>";
                    unset($_SESSION['success']);
                }
                ?>

                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class="bx bxs-envelope"></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="bx bxs-lock-alt"></i>
                </div>

                <button type="submit" class="btn">Login</button>
            </form>
        </div>

        <!-- ================= REGISTER ================= -->
        <div class="form-box register">
            <form method="POST" action="../../controllers/auth.php">
                <input type="hidden" name="action" value="register">

                <h1>Register</h1>

                <div class="input-box">
                    <input type="text" name="nama" placeholder="Nama Lengkap" required>
                    <i class="bx bxs-user"></i>
                </div>

                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class="bx bxs-envelope"></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="bx bxs-lock-alt"></i>
                </div>

                <button type="submit" class="btn">Register</button>
            </form>
        </div>

        <!-- ================= TOGGLE ================= -->
        <div class="toggle-box">

            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn">Register</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Login</button>
            </div>

        </div>

    </div>

    <script src="../../assets/js/script.js"></script>
</body>

</html>