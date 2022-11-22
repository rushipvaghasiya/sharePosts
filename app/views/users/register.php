<?php require APPROOT . "/app/views/inc/header.php" ?>

<div class="row">
    <div class="col-md-6 auto-mx">
        <div class="card card-body bg-light mt-5">
            <h2>
                Create an account
            </h2>
            <p> fill out the form </p>

            <form actiobn=<?php echo URLROOT . "/users/register" ?> method="post" >
                <div class="form-group">
                    <label for="name">Name: <sup> * </sup> </label>
                    <input type="text" name="name"
                        class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? "is-invalid" : ''; ?>"
                        value="<?php echo $data['name']; ?>">
                    <span class="invalid-feedback">
                        <?php echo $data['name_err']; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup> * </sup> </label>
                    <input type="text" name="email"
                        class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? "is-invalid" : ''; ?>"
                        value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback">
                        <?php echo $data['email_err']; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup> * </sup> </label>
                    <input type="text" name="password"
                        class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? "is-invalid" : ''; ?>"
                        value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback">
                        <?php echo $data['password_err']; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="confirmpassword">Confirm Password: <sup> * </sup> </label>
                    <input type="text" name="confirmpassword"
                        class="form-control form-control-lg <?php echo (!empty($data['confirmpassword_err'])) ? "is-invalid" : ''; ?>"
                        value="<?php echo $data['confirmpassword']; ?>">
                    <span class="invalid-feedback">
                        <?php echo $data['confirmpassword_err']; ?>
                    </span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-success btn-block mt-4" value="Register">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT ?>/users/login" class="btn btn-light btn-block mt-4"> Have an
                            account
                            already?
                            Click here
                        </a>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>



<?php require APPROOT . "/app/views/inc/footer.php" ?>