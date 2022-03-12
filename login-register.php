<?php
/*
Template Name: Login Register
 */

get_header();

?>

    <section class="moda-user-account-section moda-section moda-bg"
             data-background="<?php echo esc_url(get_template_directory_uri() . '/assets/img/background.png'); ?>">
        <div class="container">
            <div class="moda-user-account-wraper">
                <div class="user-header-area">
                    <?php echo moda_get_logo(); ?>
                    <nav>
                        <div class="nav nav-tabs moda-swetch-btn" id="nav-tab" role="tablist">
                            <button class="nav-link active login-btn moda-btn" id="Login-tab" data-bs-toggle="tab"
                                    data-bs-target="#Login" type="button" role="tab">Login
                            </button>
                            <button class="nav-link registration-btn" id="registration-tab" data-bs-toggle="tab"
                                    data-bs-target="#registration" type="button" role="tab">Registration
                            </button>
                        </div>
                    </nav>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="Login" role="tabpanel" aria-labelledby="Login-tab">
                        <form>
                            <div class="moda-input-group">
                                <input type="text" placeholder="company.moda@gmail.com">
                            </div>
                            <div class="moda-input-group">
                                <input type="password" placeholder="* * * * * * * * * * * * *">
                            </div>
                            <span class="forget-pass">Forget Password ? <a
                                        href="change-password.html">Click Here</a></span>
                            <a href="login.html" class="moda-primary-btn moda-btn">Login</a>
                            <span class="forget-pass m-0">Don't have an account ? <a href="">Create Account</a></span>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="registration" role="tabpanel" aria-labelledby="registration-tab">
                        <form>
                            <div class="moda-input-group">
                                <input type="text" placeholder="First Name">
                            </div>
                            <div class="moda-input-group">
                                <input type="text" placeholder="Last Name">
                            </div>
                            <div class="moda-input-group">
                                <input type="text" placeholder="Email">
                            </div>
                            <div class="moda-input-group">
                                <input type="password" placeholder="Password">
                            </div>
                            <a href="" class="moda-primary-btn moda-btn">Login</a>
                            <span class="forget-pass m-0">Don't have an account ? <a
                                        href="register.html">Create Account</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();