<?php get_header()?>

<main>
    <div id="setPasswordModal" class="modal container">
        <div class="modal-content">
            <div class="modal-logo">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="">
            </div>
            <h2 id="modalTitle" class="modalTitle" data-translate-key="Reset with email">Reset with email</h2>
            <form id="passwordForm" method="POST">
                <div class="modal-form-field">
                    <span class="modal-form-field-icon">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/4546924.png" alt="">
                    </span>
                    <input type="email" id="email" name="email" required>
                </div>
                <button type="submit" id="passwordBtn" class="modal-form-btn">
                    <span class="btn-text" data-translate-key="Send email">Send email</span>
                    <div class="spinner" style="display:none;"></div>
                </button>
                <div id="passwordResult"></div>
                <div class="modal-form-chang-btn">
                    <span class="modal-form-chang-btn1"></span>
                    <a href="<?php echo home_url('') ?>"><span class="modal-form-chang-btn2" data-translate-key="Get help">Get help</span></a>
                </div>                                
            </form>
            <div id="send-emial-message" style="display:none">
                <div class="send-emial-message-img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/5251109.png" alt="">
                </div>
                <h2 class="send-emial-message-title" data-translate-key="Email sent">Email sent</h2>
                <p class="send-emial-message-desc"><span data-translate-key="we sent you an email to">we sent you an email to</span><span id="send-email"></span><br><span data-translate-key="Follow the instructions">Follow the instructions in the email to reset your password.</span></p>
                <p data-translate-key="Can't find the email">Can't find the email? Make sure the email address is correct or check your spam folder.</p>
                <a href="<?php echo home_url('') ?>"><span class="send-emial-message-btn2" data-translate-key="Get help">Get help</span></a>
            </div>
        </div>
    </div>
</main>

<?php get_footer() ?>