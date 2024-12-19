<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/auth/auth.css" rel="stylesheet">
</head>

<body>
    <form action="../src/reg.php" method="POST">
        <div class="auth-container">
            <div class="auth-box">
                <div class="auth-header text-center mb-4">
                    <h2 id="authTitle">Create Account</h2>
                    <p id="authSubtitle" class="text-muted">Please Register To Continue</p>
                </div>

                <form id="authForm" class="needs-validation" novalidate>
                    <!-- Name field -->
                    <div id="nameField" class="form-group mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" placeholder="First name & last name"
                                name="fullname" required>
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>
                            <div class="invalid-feedback">
                                Please Insert Your Name
                            </div>
                        </div>
                    </div>

                    <!-- Email field -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" placeholder="example@email.com"
                                name="email" required>
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <div class="invalid-feedback">
                                Invalid Email
                            </div>
                        </div>
                    </div>

                    <!-- Username field -->
                    <div class="form-group mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <input type="username" class="form-control" id="username" placeholder="John" name="username"
                                required>
                            <span class="input-group-text username" role="button">
                                <i class="bi bi-eye-slash"></i>
                            </span>
                            <div class="invalid-feedback">
                                Invalid username
                            </div>
                        </div>
                    </div>

                    <!-- Password field -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" placeholder="********"
                                name="password" required>
                            <span class="input-group-text password-toggle" role="button">
                                <i class="bi bi-eye-slash"></i>
                            </span>
                            <div class="invalid-feedback">
                                Invalid Password
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password field -->
                    <div class="form-group mb-4">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                placeholder="********" required>
                            <span class="input-group-text password-toggle" role="button">
                                <i class="bi bi-eye-slash"></i>
                            </span>
                            <div class="invalid-feedback">
                                Passwords Do Not Match
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary w-100 mb-3" id="submitButton">
                        <span id="submitText">Register</span>
                        <i class="bi bi-person-plus ms-2"></i>
                    </button>
                </form>

                <!-- Mode toggle -->
                <div class="text-center">
                    <button id="modeToggle" class="btn btn-link text-decoration-none">
                        <span id="toggleText"><a href="../src/auth.php">Already Registered? Login Here</a></span>
                        <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/auth/validator.js"></script>
    <script src="../../js/form-handlers.js"></script>
    <script src="../../js/ui-controllers.js"></script>
    <script src="../../js/main.js"></script>
</body>

</html>