<?php include('layouts/header.php'); ?>

<div class="dashboard-content-one">
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1"></div>

            <form action="auth/login.php" method="POST" class="new-added-form">
                <div class="row">
                    <div class="col-12">
                        <img src="img/logo.jpg" alt="Logo">
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" required>
                        </div>
                        <div class="form-group mg-t-8">
                            <button type="submit" name="submit"
                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Login</button>
                        </div>
                        <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?php include('layouts/footer.php'); ?>