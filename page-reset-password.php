<?php get_header()?>

<main>
    <div id="setPasswordModal" class="modal container">
        <div class="modal-content">
            <div class="modal-logo">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="">
            </div>
            <h2 id="modalTitle" class="modalTitle" data-translate-key="Reset password">Reset password</h2>
            <form id="resetpasswordForm" method="POST">
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
                <input type="hidden" id="resetKey" name="reset_key" value="<?php echo esc_attr($_GET['key']); ?>">
                <input type="hidden" id="login" name="login" value="<?php echo esc_attr($_GET['login']); ?>">
                <button type="submit" id="passwordBtn" class="modal-form-btn">
                    <span class="btn-text" data-translate-key="Reset and log in">Reset and log in</span>
                    <div class="spinner" style="display:none;"></div>
                </button>
                <div id="passwordResult"></div>                               
            </form>            
        </div>
    </div>
</main>

<?php get_footer() ?>