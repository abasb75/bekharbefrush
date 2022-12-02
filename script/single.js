var show_contact_seller = document.getElementById('show_contact_seller');
show_contact_seller.onclick = show_contact_seller_fun;

function show_contact_seller_fun(){
    document.body.setAttribute('class','no_scroll_blur');
    var seller_contact_layout = document.createElement('div');
    seller_contact_layout.setAttribute('id','seller_contact_layout');
    document.body.appendChild(seller_contact_layout);
    
    var seller_contact_layout_container = document.createElement('div');
    seller_contact_layout_container.setAttribute('id','seller_contact_layout_container');
    seller_contact_layout.appendChild(seller_contact_layout_container);

    var seller_contact_layout_header = document.createElement('div');
    seller_contact_layout_header.setAttribute('id','seller_contact_layout_header');
    
    var buttonExit = document.createElement('button');
    buttonExit.innerHTML = '<i class="icon-arrow-thin-right"></i>';
    buttonExit.onclick = function(){
        document.body.setAttribute('class','');
        document.body.removeChild(document.getElementById('seller_contact_layout'));
    }

    seller_contact_layout_header.innerHTML += '<h2>راه های ارتباطی با آگهی دهنده</h2>';
    
    seller_contact_layout_header.appendChild(buttonExit);
    
    seller_contact_layout_container.appendChild(seller_contact_layout_header);

    var seller_contact_layout_content=document.createElement('div');
    seller_contact_layout_content.setAttribute('id','seller_contact_layout_content');

    seller_contact_layout_container.appendChild(seller_contact_layout_content);
    

    seller_contact_layout_content.innerHTML = '<div class="content"><i class="icon-user icon"></i><span class="title">نام آگهی دهنده : </span><span class="itemcontent">'+seller.name+'</span></div>';
    seller_contact_layout_content.innerHTML += '<div class="content"><i class="icon-phone icon"></i><span class="title">شماره تماس : </span><span class="itemcontent">'+seller.phone+'</span><a href="tel:'+seller.phone+'"><button><i class="icon-share-square-o"></i></button></a><button class="ifo" onclick="copytoclipbord(this)"><i class="icon-copy"></i></button></div>';
    seller_contact_layout_content.innerHTML += '<div class="content"><i class="icon-at icon"></i><span class="title"> پست الکترونیک : </span><span class="itemcontent">'+seller.mail+'</span><a href="mailto:'+seller.mail+'"><button><i class="icon-share-square-o"></i></button></a><button class="ifo" onclick="copytoclipbord(this)"><i class="icon-copy"></i></button></div>';
    seller_contact_layout_content.innerHTML += '<div class="content"><i class="icon-link icon"></i><span class="title">لینک : </span><span class="itemcontent">'+seller.link+'</span><a href="'+seller.link+'"><button><i class="icon-share-square-o"></i></button></a><button class="ifo" onclick="copytoclipbord(this)"><i class="icon-copy" ></i></button></div>';
    seller_contact_layout_content.innerHTML += '<div class="content"><i class="icon-location icon"></i><span class="title">آدرس : </span><span class="itemcontent">'+seller.address+'</span><button class="ifo" onclick="copytoclipbord(this)"><i class="icon-copy"></i></button></div>';




}


function copytoclipbord(el){
    var p = '';
    el.setAttribute('onclick','');
    p = el.parentElement;
    
    
    var p_span = p.children[2];
    var text_copy = p_span.innerHTML;

    if (navigator.clipboard != undefined) {//Chrome
        navigator.clipboard.writeText(text_copy);
        p_span.innerHTML = 'کپی شد';
        setTimeout(
            function() {
                p_span.innerHTML = text_copy;
                el.setAttribute('onclick','copytoclipbord(this)');
                
            }, 3000);
    }
    else if(window.clipboardData) { // Internet Explorer
        window.clipboardData.setData("Text", text_copy);
        p_span.innerHTML = 'کپی شد';
    }


     
 
}



document.getElementById('report_single_division_button').onclick = function(){
    document.body.setAttribute('class','no_scroll_blur');
    var seller_contact_layout = document.createElement('div');
    seller_contact_layout.setAttribute('id','seller_contact_layout');
    document.body.appendChild(seller_contact_layout);
    
    var seller_contact_layout_container = document.createElement('div');
    seller_contact_layout_container.setAttribute('id','seller_contact_layout_container');
    seller_contact_layout.appendChild(seller_contact_layout_container);

    var seller_contact_layout_header = document.createElement('div');
    seller_contact_layout_header.setAttribute('id','seller_contact_layout_header');
    
    var buttonExit = document.createElement('button');
    buttonExit.innerHTML = '<i class="icon-arrow-thin-right"></i>';
    buttonExit.onclick = function(){
        document.body.setAttribute('class','');
        document.body.removeChild(document.getElementById('seller_contact_layout'));
    }

    seller_contact_layout_header.innerHTML += '<h2>ثبت مشکلات و تخلفات آگهی</h2>';
    
    seller_contact_layout_header.appendChild(buttonExit);
    
    seller_contact_layout_container.appendChild(seller_contact_layout_header);

    var seller_contact_layout_content=document.createElement('div');
    seller_contact_layout_content.setAttribute('id','seller_contact_layout_content');

    seller_contact_layout_container.appendChild(seller_contact_layout_content);
    
    seller_contact_layout_content.innerHTML = '<h3 id="reporttitle">بنویسید آگهی از نظر شما چه مشکلی دارد. به پاک و امن شدن وب سایت بخربفروش کمک کنید.</h3>';
    seller_contact_layout_content.innerHTML += '<textarea id="reporttextarea"></textarea>';
    seller_contact_layout_content.innerHTML += '<h3 id="errortitle">عملیات با خطا مواجه شد.</h3>';

    var reportButton = document.createElement('button');
    reportButton.setAttribute('id','reportButton');
    reportButton.innerHTML = 'ارسال گزارش';
    reportButton.onclick = do_report;
    seller_contact_layout_content.appendChild(reportButton);

}


function do_report(){

}


function copy_share_link(el){
    if (navigator.clipboard != undefined) {//Chrome
        navigator.clipboard.writeText(ads.short_link);
    }
    else if(window.clipboardData) { // Internet Explorer
        window.clipboardData.setData("Text", ads.short_link);
    }
    el.children[0].setAttribute('class','tooltip show');
    setTimeout(() => {
        el.children[0].setAttribute('class','tooltip');
    }, 2000);
}



var book_mark_open = true;
function toggle_to_bookmark(el){
    if(book_mark_open  == false){
        return false;
    }
    book_mark_open = false;
    if(el.getAttribute('class')=='icon-bookmark-o'){
        var pid = el.getAttribute('pid');
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4){
                if(this.status==200 && this.responseText == 'OK'){
                    el.children[0].innerHTML = 'آگهی نشان شد';
                    el.children[0].setAttribute('class','tooltip show');
                    el.setAttribute('class','icon-bookmark');
                    setTimeout(() => {
                        el.children[0].setAttribute('class','tooltip');
                        book_mark_open = true;
                    }, 2000);
                    
                }else{
                    console.log(this.responseText);
                    el.children[0].innerHTML = 'عدم اتصال به شبکه';
                    el.children[0].setAttribute('class','tooltip show');
                    
                    setTimeout(() => {
                        el.children[0].setAttribute('class','tooltip');
                        book_mark_open = true;
                    }, 2000);
                }
                
            }
        }
        xhttp.open('GET',main_url+'ajax/do-mark.php?pid='+pid,true);

        xhttp.send();
    }else{
        var pid = el.getAttribute('pid');
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4){
                if(this.status==200 && this.responseText == 'OK'){
                    el.children[0].innerHTML = 'نشانه آگهی برداشته شد';
                    el.children[0].setAttribute('class','tooltip show');
                    el.setAttribute('class','icon-bookmark-o');
                    setTimeout(() => {
                        el.children[0].setAttribute('class','tooltip');
                        book_mark_open = true;
                    }, 2000);
                    
                }else{
                    el.children[0].innerHTML = 'عدم اتصال به شبکه';
                    el.children[0].setAttribute('class','tooltip show');
                    
                    setTimeout(() => {
                        el.children[0].setAttribute('class','tooltip');
                        book_mark_open = true;
                    }, 2000);
                }
                
            }
        }
        xhttp.open('GET',main_url+'ajax/remove-mark.php?pid='+pid,true);

        xhttp.send();
    }
    
}

function showMarkView(el){
    el.children[0].setAttribute('class','tooltip show');
    setTimeout(() => {
        el.children[0].setAttribute('class','tooltip');
        book_mark_open = true;
    }, 2000);
                    
}

function showReportDialog(){
    var pid = this.getAttribute('pid');
    
    document.getElementById('report_post').setAttribute('class','show');
    document.getElementById('send_data_form').setAttribute('class','left disable');
    document.body.setAttribute('class','reportDialog');
    document.getElementById('exit_report_post').onclick = exitReportDialog;
    document.getElementById('exit_report_post_footer').onclick = exitReportDialog;
    
     document.getElementById('send_data_form').pid = pid;
    console.log( document.getElementById('send_data_form').pid)
    document.getElementById('send_data_form').onclick = sendReportData;
    
    document.getElementById('send_data_form').innerHTML = 'ارسال گزارش';
    document.getElementById('exit_report_post_footer').innerHTML = 'انصراف';
    document.getElementById('exit_report_post_footer').setAttribute('style','');
    
    document.getElementById('loading_holder_report').setAttribute('class','');
    document.getElementById('report_text_input').oninput = checkValue;
    document.getElementById('report_text_input').value = '';
    
    
}
function exitReportDialog(){
    document.getElementById('report_post').setAttribute('class','');
    document.body.setAttribute('class','');
    if(xht != null){xht.abort();}
}


function checkValue(){
    if(this.value.length < 20){
        document.getElementById('send_data_form').setAttribute('class','left disable');
    }else{
        document.getElementById('send_data_form').setAttribute('class','left');
    }
}

var xht = null;
function sendReportData(){
    if(this.getAttribute('class')=='right disable'){return null}
    if(document.getElementById('report_text_input').value.length < 20 ){return null}
    document.getElementById('loading_holder_report').setAttribute('class','show');
    document.getElementById('loading_holder_report').innerHTML = '<img src="">';
    document.getElementById('loading_holder_report').children[0].src=window.localStorage.getItem('loading');
    
    document.getElementById('send_data_form').setAttribute('class','left disable');
    xht = new XMLHttpRequest();
    xht.onreadystatechange = function(){
        if(this.readyState == 4){
            if(this.status == 200 && this.responseText == 'OK'){
                document.getElementById('loading_holder_report').innerHTML = '<div class="condition"><i class="icon-check"></i><span>گزارش شما ثبت شد.حتما پیگیری توسط ادمین انجام خواهد شد.</span></div>';
                document.getElementById('send_data_form').innerHTML = 'اتمام و خروج';
                document.getElementById('send_data_form').onclick = exitReportDialog;
                document.getElementById('send_data_form').setAttribute('class','left');
                document.getElementById('exit_report_post_footer').setAttribute('style','display:none;');
            }else{
                console.log(this.responseText)
                document.getElementById('loading_holder_report').innerHTML = '<div class="condition"><i class="icon-signal_cellular_connected_no_internet_4_bar"></i><span>متاسفانه اتصال با موفقیت انجام نشد</span></div>';
                document.getElementById('send_data_form').innerHTML = 'تلاش مجدد';
                document.getElementById('send_data_form').setAttribute('class','left');
               
                document.getElementById('send_data_form').onclick = sendReportData;
                
            }
        }
    }
    xht.open('GET',main_url+'ajax/do-report.php?pid=' +this.pid+ '&bd='+document.getElementById('report_text_input').value,true);
    xht.send();
}














