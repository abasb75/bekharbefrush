var phoneSelected = null;
if(document.getElementById('header_add_post_new') != null) {
    document.getElementById('header_add_post_new').onclick = showLogin;
}
function checkInput(evt){
    online_check();
    var phone_number = document.getElementById('phone_number');
    var text = phone_number.value;
    if(text.length==0 && evt.charCode != 57){ return false; }        
    if(text.length==1 && !(evt.charCode == 48 || evt.charCode == 49 || evt.charCode == 50 || evt.charCode == 51 || evt.charCode == 57) ){ return false; }
    if(text.length > 1 && !(evt.charCode>47 && evt.charCode<58)){ return false }
    return true;
}
function validate_phone(el){
    online_check();
    var status_type_login = document.getElementById('status_type_login');
    console.log(el.value.length);
    if(el.value.length < 10){
        status_type_login.innerHTML = 'شماره تلفن به درستی وارد نشده است';
        el.setAttribute('class','alert_input');
        document.getElementById('login_button_holder').innerHTML = '<h3>برای استفاده از تمامی امکانات بخربفروش باید با شماره تلفن خود وارد شوید. ورود شما به منزله پذیرش تمام قوانین وب سایت می باشد.</h3>';
        
    }else{
        status_type_login.innerHTML = 'شماره شما به درستی وارد شده است';
        el.setAttribute('class','alert_sucssus');
        document.getElementById('login_button_holder').innerHTML = '<button onclick="get_validation_key();">دریافت کد تایید</button>';
    }
}
function get_validation_key(){
    
    online_check();
            phoneSelected = document.getElementById('phone_number').value;
           document.getElementById('login_button_holder').innerHTML ='<div class="loading"><img src="'+window.localStorage.getItem('loading')+'"></div>';
            document.getElementById('phone_number').setAttribute('disabled','');       document.getElementById('status_type_login').innerHTML='لطفا منتظر بمانید';
            setTimeout(function(){
                let formData = new FormData();
                formData.append('ph', document.getElementById('phone_number').value);


                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", main_url+"ajax/get_validation_code.php", true); 
                xhttp.onreadystatechange = function() {
                   if (this.readyState == 4 ) {
                       if(this.status == 200 && this.responseText == 'CXE'){
                           show_verification_layout();
                       }else{
                           show_add_number_error();
                       }
                   }
                };

                xhttp.send(formData);
            },500);
    
}
function show_add_number_error(){
    online_check();
    document.getElementById('status_type_login').innerHTML = 'خطا در اتصال به شبکه یا دریافت اطلاعات';
    document.getElementById('phone_number').setAttribute('class','alert_input');
    document.getElementById('login_button_holder').innerHTML = '<button onclick="get_validation_key();">تلاش مجدد</button>';
}
function show_verification_layout(){
    online_check();
    var login_form = document.getElementById('login_form');
    login_form.children[0].children[0].children[1].innerHTML = 'کد تایید را وارد کنید';
    document.getElementById('login_form_content_controller').innerHTML = '<div class="inputHolder"><input type="tel" id="login_key_number" class="" style="text-align: center;" onkeypress="return chec_varification_key(event);" oninput="validate_key(this);" inputmode="numeric" placeholder="کد تایید" maxlength="5"><span class="status_type" id="status_type_login">کد 5 رقمی دریافت شده را وارد کنید</span></div><div class="button_Holder" id="login_button_holder"><h3 id="login_key_compin">کد ارسال شد برای 0'+phoneSelected+' را وارد کنید</h3><button class="editPhoneNumber" onclick="editPhoneNumber();">تغییر شماره تلفن</button></div>';
}

function chec_varification_key(evt){
    if(evt.charCode>47 && evt.charCode<58){
        return true;
    }else{
        return false;
    }
    online_check();
}

function validate_key(el){
    online_check();
    if(el.value.length < 5){
        document.getElementById('login_button_holder').innerHTML = '<h3 id="login_key_compin">کد ارسال شد برای 0'+phoneSelected+' را وارد کنید</h3><button class="editPhoneNumber" onclick="editPhoneNumber();">تغییر شماره تلفن</button>';
        
    }else{
       document.getElementById('login_button_holder').innerHTML = '<button onclick="check_online_validation_key();">چک کردن صحت کد</button>';
    }
}

function editPhoneNumber(){
    var login_form = document.getElementById('login_form');
    login_form.children[0].children[0].children[1].innerHTML = 'وارد کردن شماره تلفن';
    document.getElementById('login_form_content_controller').innerHTML = '<div class="inputHolder"><input type="tel" id="phone_number" class="" onkeypress="return checkInput(event);" oninput="validate_phone(this);" inputmode="numeric" placeholder="شماره تلفن بدون صفر" maxlength="10"><label for="phone_number">+98</label><span class="status_type" id="status_type_login">مثال : 9123456789</span></div><div class="button_Holder" id="login_button_holder"><button onclick="get_validation_key();">دریافت کد تایید</button></div>';
    document.getElementById('phone_number').value = phoneSelected;
    online_check();
}


function check_online_validation_key(){
    var myData = new FormData();
    myData.append('ph',phoneSelected);        
    myData.append('vl',document.getElementById('login_key_number').value);
    document.getElementById('login_button_holder').innerHTML ='<div class="loading"><img src="'+window.localStorage.getItem('loading')+'"></div>';
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 ){
            if(this.status == 200 && this.responseText=='VALID'){
                location.reload();
            }else{
                show_verificaion_code_alert();
            }
            
        }
    }
    xhttp.open("POST", main_url+"ajax/check_validation_code.php", true);
    xhttp.send(myData);
    
}

function show_verificaion_code_alert(){
    document.getElementById('status_type_login').innerHTML = 'اطلاعات به درستی به سرور ارسال نشده است';
    document.getElementById('login_key_number').setAttribute('class','alert_input');
    document.getElementById('login_button_holder').innerHTML = '<button onclick="check_online_validation_key();">تلاش مجدد</button>';
    online_check();
}

function showLogin(e){
if(e!=null){
    e.preventDefault();
}
if(document.body.getAttribute('class') != 'blurExeptLogin'){
    document.body.setAttribute('class','blurExeptLogin');
    online_check();
}else{
    document.body.setAttribute('class','');
}
    

}
function online_check(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState==4){
            if(this.status == 200 && this.responseText != 'VOID'){
                //location.reload();
                console.log(this.responseText);
            }else{
                
            }
        }
    }
    xhttp.open('GET',main_url+'ajax/checkuser.php',true);
    xhttp.send();
}