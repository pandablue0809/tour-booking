<?php get_header()?>

<main>
    <div id="loginModal" class="modal container">
        <div class="modal-content">
            <div class="modal-logo">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="">
            </div>
            <h2 id="modalTitle" class="modalTitle" data-translate-key="Login">Login</h2>
            <form id="loginForm" method="POST">
                <div class="modal-form-field">
                    <span class="modal-form-field-icon">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/4546924.png" alt="">
                    </span>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="modal-form-field">
                    <span class="modal-form-field-icon">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/14562503.png" alt="">
                    </span>
                    <input type="password" id="password" name="password" required>
                    <span class="modal-form-field-icon toggle-password" data-target="#password">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/8173177.png" alt="" class="hide-eye">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/icons8-eye-24.png" alt="" class="show-eye">
                    </span>
                </div>
                <button type="submit" id="loginBtn" class="modal-form-btn">
                    <span class="btn-text" data-translate-key="Log In">Log In</span>
                    <div class="spinner" style="display:none;"></div>
                </button>
                <div id="loginResult"></div>
                <div class="modal-form-chang-btn">
                    <span class="modal-form-chang-btn1"></span>
                    <a href="<?php echo home_url('/forgot-password') ?>"><span class="modal-form-chang-btn2" data-translate-key="Forgot password">Forgot password</span></a>
                </div>                
            </form>
            <div class="login-with-google">
                <p class="login-with-google-br"><span data-translate-key="Or log in with">Or log in with</span></p>
                <button class="googole-btn" onclick="googleLogin()">
                    <span>
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/13170545.png" alt="">
                    </span>
                    <span data-translate-key="Log in with Google">Log in with Google</span>
                </button>
            </div>
            <div class="login-privacy" data-translate-key="By signing up or logging in">
                By signing up or logging in, you acknowledge and agree to our's General Terms of Use and Privacy Policy
            </div>

            <!-- <div id="verificationModal" style="display: none;" class="verificationModal">
                <form id="verifyCodeForm" action="">
                    <h2 class="modalTitle">Email Verification</h2>
                    <p>Please enter the verification code sent to your email:</p>
                    <input type="text" id="verification_code" class="verificationModal-input" placeholder="Verification Code" required>
                    <button id="verifyEmailBtn" type="submit">Verify Email</button>
                    <button id="ReVerifyEmailBtn" type="submit">Resend Verify Code</button>
                    <div id="verificationResult"></div>
                </form>
            </div>   -->
            <div class="auth-links">
            <p id="signup-link"><span data-translate-key="Don't have an account?">Don't have an account?</span><a href="<?php echo home_url()?>/sign-up" data-translate-key="Sign Up">Sign Up</a></p>
            </div>
        </div>
    </div>
</main>

<?php get_footer() ?>