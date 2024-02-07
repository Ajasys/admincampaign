<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>

<div class="main-dashbord p-2">
    <form class="needs-validation" name="email_update_form" method="POST" novalidate>
        <div class="bg-white border rounded-2 p-3 general_settings_editsss general_email_settings_outer">
            <div class="row col-10 ps-3 m-0 py-3 border-bottom position-relative general_email_settings_inner">
                <div class="position-absolute" style="left: -5px">
                    <input type="radio" class="email_radio" value="2" id="email_radio_2" name="email_radio">
                </div>
                <div class="col-sm-6 col-12 input-text mt-2">
                    <label for="form-port" class="form-label main-label">SMTP Port </label>
                    <input type="text" name="smtp_port" id="smtp_port" class="form-control main-control" value="<?php if (isset($settings_data['smtp_port']) && $settings_data['smtp_port'] != '') {
                                                                                                                    echo $settings_data['smtp_port'];
                                                                                                                } ?>" placeholder="Enter SMTP Port" />
                </div>
                <div class="col-sm-6 col-12 input-text mt-2">
                    <label for="form-host" class="form-label main-label">SMTP Host </label>
                    <input type="text" name="smtp_host" id="smtp_host" class="form-control main-control" value="<?php if (isset($settings_data['smtp_host']) && $settings_data['smtp_host'] != '') {
                                                                                                                    echo $settings_data['smtp_host'];
                                                                                                                } ?>" placeholder="Enter SMTP Host" />
                </div>
                <div class="col-sm-6 col-12 input-text mt-2">
                    <label for="form-user" class="form-label main-label">SMTP User </label>
                    <input type="text" name="smtp_user" id="smtp_user" class="form-control main-control" value="<?php if (isset($settings_data['smtp_user']) && $settings_data['smtp_user'] != '') {
                                                                                                                    echo $settings_data['smtp_user'];
                                                                                                                } ?>" placeholder="Enter SMTP User" />
                </div>
                <div class="col-sm-6 col-12 input-text mt-2">
                    <label for="form-status password" class="form-label main-label">SMTP Password
                    </label>
                    <input type="password" name="smtp_password" id="smtp_password" class="form-control main-control" value="<?php if (isset($settings_data['smtp_password']) && $settings_data['smtp_password'] != '') {
                                                                                                                                echo $settings_data['smtp_password'];
                                                                                                                            } ?>" placeholder="Enter SMTP Password" />
                </div>
                <div class="col-sm-6 col-12 input-text mt-2">
                    <label for="form-crypto" class="form-label main-label">SMTP Crypto </label>
                    <input type="text" name="smtp_crypto" id="smtp_crypto" class="form-control main-control" value="<?php if (isset($settings_data['smtp_crypto']) && $settings_data['smtp_crypto'] != '') {
                                                                                                                        echo $settings_data['smtp_crypto'];
                                                                                                                    } ?>" placeholder="Enter SMTP Crypto" />
                </div>
            </div>
            <div class="row col-10 ps-3 m-0 py-3 border-bottom position-relative general_email_settings_inner">
                <div class="position-absolute" style="left: -5px">
                    <input type="radio" class="email_radio" id="email_radio_1" value="1" checked name="email_radio">
                </div>
                <div class="col-sm-6 col-12 input-text">
                    <label for="form-port" class="form-label main-label">From Email</label>
                    <input type="email" name="email_from" id="email_from" class="form-control main-control emailsss" value="<?php if (isset($settings_data['email_from']) && $settings_data['email_from'] != '') {
                                                                                                                                echo $settings_data['email_from'];
                                                                                                                            } ?>" required="" placeholder="Enter From Email" />
                    <div class="email-errorsss">
                    </div>
                </div>
            </div>
            <div class="row col-10 ps-3 m-0 py-3">

                <div class="col-sm-6 col-12 input-text">
                    <label for="form-cc" class="form-label main-label">CC</label>
                    <input type="email" name="mail_cc" id="mail_cc" class="form-control main-control email" value="<?php if (isset($settings_data['mail_cc']) && $settings_data['mail_cc'] != '') {
                                                                                                                        echo $settings_data['mail_cc'];
                                                                                                                    } ?>" placeholder="Enter CC" />
                </div>
            </div>
            <div class="general_settings_edit_outer px-2 mx-1">
                <div class="title-side-icons mt-2 align-items-center justify-content-end">
                    <div class="avatar-edit-outer m-0">
                        <div class="btn-primary general_settings_main_email">
                            Edit
                        </div>
                    </div>
                    <button type="button" class="btn-primary email_updatees" data-edit_id="" name="notes" value="notes">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>