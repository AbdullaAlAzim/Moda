<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form'); ?>
<section class="moda-user-account-section moda-section moda-bg"
         data-background="<?php echo get_template_directory_uri(); ?>/assets/img/background.png">
    <div class="container">
        <div class="moda-user-account-wraper">
            <div class="user-header-area">
                <?php moda_logo(); ?>
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
                    <?php if (!is_user_logged_in()) { ?>
                        <form class="woocommerce-form woocommerce-form-login login" method="post">

                            <?php do_action('woocommerce_login_form_start'); ?>

                            <p class="woocommerce-form-row moda-input-group woocommerce-form-row--wide form-row form-row-wide">
                                <label for="username"><?php esc_html_e('Username or email address', 'moda'); ?>
                                    &nbsp;<span class="required">*</span></label>
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                                       name="username" id="username" autocomplete="username"
                                       value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                            </p>
                            <p class="woocommerce-form-row woocommerce-form-row--wide moda-input-group form-row form-row-wide">
                                <label for="password"><?php esc_html_e('Password', 'moda'); ?>&nbsp;<span
                                            class="required">*</span></label>
                                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password"
                                       name="password" id="password" autocomplete="current-password"/>
                            </p>

                            <?php do_action('woocommerce_login_form'); ?>

                            <p class="form-row">
                                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                                    <input class="woocommerce-form__input woocommerce-form__input-checkbox"
                                           name="rememberme" type="checkbox" id="rememberme" value="forever"/>
                                    <span><?php esc_html_e('Remember me', 'moda'); ?></span>
                                </label>
                                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                                <button type="submit"
                                        class="woocommerce-button moda-primary-btn moda-btn button woocommerce-form-login__submit"
                                        name="login"
                                        value="<?php esc_attr_e('Log in', 'moda'); ?>"><?php esc_html_e('Log in', 'moda'); ?></button>
                            </p>
                            <p class="woocommerce-LostPassword lost_password">
                                <span class="forget-pass m-0">Don't have an account ? <a
                                            href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'moda'); ?></a></span>
                            </p>

                            <?php do_action('woocommerce_login_form_end'); ?>

                        </form>

                    <?php } else {
                        echo '<h2 class="py-4">You are already logged in!</h2>';
                    } ?>
                </div>
                <div class="tab-pane fade" id="registration" role="tabpanel" aria-labelledby="registration-tab">
                    <?php if (!is_user_logged_in()) { ?>
                        <form method="post"
                              class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?> >

                            <?php do_action('woocommerce_register_form_start'); ?>

                            <p class="woocommerce-form-row moda-input-group woocommerce-form-row--wide form-row form-row-wide">
                                <label for="reg_username"><?php esc_html_e('Username', 'moda'); ?>&nbsp;<span
                                            class="required">*</span></label>
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                                       name="username" id="reg_username" autocomplete="username"
                                       value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                            </p>


                            <p class="woocommerce-form-row moda-input-group woocommerce-form-row--wide form-row form-row-wide">
                                <label for="reg_email"><?php esc_html_e('Email address', 'moda'); ?>&nbsp;<span
                                            class="required">*</span></label>
                                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text"
                                       name="email" id="reg_email" autocomplete="email"
                                       value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                            </p>

                            <p class="woocommerce-form-row moda-input-group woocommerce-form-row--wide form-row form-row-wide">
                                <label for="reg_password"><?php esc_html_e('Password', 'moda'); ?>&nbsp;<span
                                            class="required">*</span></label>
                                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
                                       name="password" id="reg_password" autocomplete="new-password"/>
                            </p>

                            <?php do_action('woocommerce_register_form'); ?>

                            <p class="woocommerce-form-row form-row">
                                <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                                <button type="submit"
                                        class="woocommerce-Button moda-primary-btn moda-btn woocommerce-button button woocommerce-form-register__submit"
                                        name="register"
                                        value="<?php esc_attr_e('Register', 'moda'); ?>"><?php esc_html_e('Register', 'moda'); ?></button>
                            </p>

                            <?php do_action('woocommerce_register_form_end'); ?>

                        </form>
                    <?php } else {
                        echo '<h2 class="py-4">You are already logged in!</h2>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php do_action('woocommerce_after_customer_login_form'); ?>
