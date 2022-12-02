<div id="login_form">
        <div id="login_form_layout">
            <div class="formHeader">
                <button id="button_exit_cancel" onclick="showLogin()"><i class="icon-arrow-thin-right"></i></button>
                <h3>ورود با شماره تلفن</h3>
            </div>
            <div class="formContent" id="login_form_content_controller">
                <div class="inputHolder">
                    <input type="tel" id="phone_number" class="" onkeypress="return checkInput(event);" oninput="validate_phone(this);" inputmode="numeric" placeholder="شماره تلفن بدون صفر" maxlength="10">
                    <label for="phone_number">+98</label>
                    <span class="status_type" id="status_type_login">مثال : 9123456789</span>
                </div>
                <div class="button_Holder" id="login_button_holder">
                    <h3>برای استفاده از تمامی امکانات بخربفروش باید با شماره تلفن خود وارد شوید. ورود شما به منزله پذیرش تمام قوانین وب سایت می باشد.</h3>
                </div>
            </div><!--
            <div class="formContent" >
                <div class="inputHolder">
                    <input type="tel" id="login_key_number" class="" style="text-align: center;" onkeypress="return chec_varification_key(event);" oninput="validate_key(this);" inputmode="numeric" placeholder="کد تایید" maxlength="5">
                    <span class="status_type" id="status_type_login">کد 5 رقمی دریافت شده را وارد کنید</span>
                </div>
                <div class="button_Holder" id="login_button_holder">
                    <h3 id="login_key_compin">کد ارسال شده برای را وارد کنید</h3>
                    <button class="editPhoneNumber" onclick="editPhoneNumber();">تغییر شماره تلفن</button>
                    <div class="loading"><img src="assets/image/loading/loadingw.gif"></div>
                </div>
            </div>-->
        </div>
    </div>
<script src="<?php echo $_MAIN_URL; ?>script/login.js">

</script>