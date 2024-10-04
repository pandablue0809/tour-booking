<?php get_header()?>

<main>
    <div id="loginModal" class="modal container">
        <div class="modal-content">
            <div class="modal-logo">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="">
            </div>
            <div id="signup-content">
                <h2 id="modalTitle" class="modalTitle" data-translate-key="Sign Up">Sign Up</h2>
                <form id="signUpForm" method="POST">
                    <div class="modal-form-field">
                        <span class="modal-form-field-icon">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/1077114.png" alt="">
                        </span>
                        <input type="text" id="userName" name="userName" data-translate-key="your name" placeholder="your name" required>
                    </div>
                    <div class="modal-form-field">
                        <span class="modal-form-field-icon">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/12357671.png" alt="">
                        </span>
                        <input type="text" id="birthday" name="birthday" data-translate-key="your birthday" placeholder="your birthday">
                    </div>
                    <div class="modal-form-field">
                        <span class="modal-form-field-icon">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/4546924.png" alt="">
                        </span>
                        <input type="email" id="email" name="email" data-translate-key="Email" placeholder="Email" required>
                    </div>
                    <div class="modal-form-field">
                        <span class="modal-form-field-icon">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/14562503.png" alt="">
                        </span>
                        <input type="password" id="password" name="password" data-translate-key="PassWord" placeholder="PassWord" required>
                        <span class="modal-form-field-icon toggle-password" data-target="#password">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/8173177.png" alt="" class="hide-eye">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons8-eye-24.png" alt="" class="show-eye">
                        </span>
                    </div>
                    <div class="modal-form-field">
                        <span class="modal-form-field-icon">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/6115959.png" alt="">
                        </span>
                        <input type="password" id="conf_password" name="conf_password" data-translate-key="Confirm password" placeholder="Confirm password" required>
                        <span class="modal-form-field-icon toggle-password" data-target="#conf_password">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/8173177.png" alt="" class="hide-eye">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons8-eye-24.png" alt="" class="show-eye">
                        </span>
                    </div>
                    <button type="submit"  id="signUpBtn" class="modal-form-btn">
                        <span class="btn-text" data-translate-key="Sign Up">Sign Up</span>
                        <div class="spinner" style="display:none;"></div>
                    </button>
                </form> 
                <div id="signupResult"></div>
                <div class="auth-links">
                <p id="signup-link"><span data-translate-key="Already have an account?">Already have an account?</span><a href="<?php echo home_url()?>/log-in" data-translate-key="Log In">Log In</a></p>
                </div>
            </div>
            <div id="verificationModal" style="display: none;" class="verificationModal">
                <form id="verifyCodeForm" action="">
                    <h2 class="modalTitle" data-translate-key="Email Verification">Email Verification</h2>
                    <p>Please enter the verification code sent to your email:</p>
                    <input type="text" id="verification_code" class="verificationModal-input" data-translate-key="Verification Code" placeholder="Verification Code" required>
                    <button id="verifyEmailBtn" type="submit" data-translate-key="Verify Email">Verify Email</button>
                    <button id="ReVerifyEmailBtn" type="submit" data-translate-key="Resend Verify Code">Resend Verify Code</button>
                    <div id="verificationResult"></div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php get_footer() ?>