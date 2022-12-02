$(function(){

    loadChatList();
    setInterval(loadChatList,10000);
    if(postDefault != '-1'){
        loadMessageData(postDefault,userDefault,user,defaultTitle,defaultUserName,defaultImage);
    }
    $('#input_msgbox_button').on('click',sendChat);
    $('#message_input_box_text').keypress(checkValue);
    $('#contact_item_list').on('click',showChatDetail);
    $('#return_back').on('click',function(e){
        e.preventDefault();
        if(xinterval){
            clearInterval(xinterval);
            xinterval = null;
        }
        
        if(mobility == '1'){
            $('#contact_list').css('z-index','100');
            $('#chat').css('height','calc(100% - 64px)');
            $('#bottom_menu').css('bottom','0');
        }
        
    });
});


function sendChat(e){
    if(e!=null){
        e.preventDefault();
    }

    var message = $('#message_input_box_text').val();
    $('#message_input_box_text').val('');
    if(message == ''){
        return;
    }
    var d = new Date();
    var h = d.getHours();
    var m = d.getMinutes();


    $('#message_content').append('<div class="mymessage"><div class="message_blub"><div class="message_content"><p>'+message+'</p></div><div class="message_detail"><i class="icon-check1"></i><span>'+h+':'+m+'</span></div></div></div>');
    $('#message_content').scrollTop($('#message_content')[0].scrollHeight);
    $.ajax({
        type : 'POST',
        data : {
            'm':message,
            'u':userDefault,
            'p':postDefault
        },
        url : main_url+'ajax/send_messages.php',
        dataType:'text',
        success : function(result){
            //alert('OK : ' + result);
        }
        
    });
}

function checkValue(e){
    if(e.keyCode == 13){
        sendChat();
    }
}


function loadChatList(){
    $.ajax({
        type:'GET',
        dataType:'JSON',
        url : main_url+'ajax/get_chats_list.php',
        success : function(result){
            $('#loading_viewer').remove();
            $('#contact_item_list').html('<div class="contact_item" p="0" s="0" b="'+user+'"><div class="image_holder"><img style="opacity:.5;" src="'+main_url+'assets/image/profile/admin.png"></div><div class="chat_title"><h3>پشتیبانی</h3></div><div class="chat_description"><span>پیامهای وب سایت برای شما</span></div></div>');
            if(result != ''){
                $.each(result,function(index,elemnt){
                    var image = '<img src="'+ main_url + elemnt.image + '">';
                    if(elemnt.image == ''){
                        image = '<i class="icon-camera-off"></i>';
                    }
                    var mymessage = '<label class="chat_label">آگهی من</label>';
                    if(elemnt.ismypost != '1'){
                        mymessage = '';
                    }
                    var unread = '';
                    if(elemnt.unread == '0'){
                        unread = '<div class="new_notif"></div>';
                    }
                    $('#contact_item_list').append('<div class="contact_item" p="'+elemnt.post+'" s="'+elemnt.seller+'" b="'+elemnt.buyer+'" t="'+elemnt.title+'"><div class="image_holder">'+image+'</div><div class="chat_title"><h3>'+elemnt.name+'</h3><span class="last_chat_time">'+elemnt.date+'</span></div><div class="chat_description"><span>'+elemnt.last_message+'</span>'+mymessage+'</div>'+unread+'</div>');
                    
                })
            }
        },
        error:function(){
        }
    });
}
var last_id = 999999999;
var xinterval = null;
var sync = false;
function showChatDetail(e){
    
    var selected = null;
    if(e!=null){
        e.preventDefault();
    }
    if(e.target == null){
        return;
    }
    if(e.target.getAttribute('class')=='contact_item'){
        selected = e.target;
    }else if(e.target.parentElement.getAttribute('class')=='contact_item'){
        selected = e.target.parentElement;
    }else if(e.target.parentElement.parentElement.getAttribute('class')=='contact_item'){
        selected = e.target.parentElement.parentElement;
    }else{
        return
    }
    if(selected == null){
        return;
    }
    var p = selected.getAttribute('p');
    var s = selected.getAttribute('s');
    var b = selected.getAttribute('b');
    var t = selected.getAttribute('t');
    postDefault = p;
    if(user == s){
        userDefault = b;
    }else{
        userDefault = s;
    }
    var u = selected.children[1].children[0].innerHTML;
    var i = $(selected.children[0]).clone();
    sync = false;
    
    loadMessageData(p,s,b,t,u,i);
    if(xinterval){
        clearInterval(xinterval);
        xinterval = null;
    }
    xinterval = setInterval(function(){
        loadMessageData(p,s,b,t,u,i);
    },3000);
}

function loadMessageData(p,s,b,t,u,i){
    if(mobility == '1'){
        $('#contact_list').css('z-index','0');
        $('#chat').css('height','calc(100%)');
        $('#bottom_menu').css('bottom','-100%');
    } 
    if(sync == false){
        
        $('#chat_cover').remove();
        $('#loading_box').remove();
        $('#message_box').append('<div id="loading_box"><img src="'+window.localStorage.getItem('loading')+'"></div>');
        $('#message_input_box_text').attr('disabled','');
        $('#main_contact_name').text(u);
        $('#chat_post_image_holder').html(i);
        $('#chat_post_title').text(t);
        $('#chat_post_link').attr('href',main_url+'p/'+p);

    }
    
     $.ajax({
        url : main_url+'ajax/load_user_info.php?p='+p+'&s='+s+'&b='+b,
        dataType : 'text',
        type:'GET',
        success:function(result){
            var chats = JSON.parse(result);
            $('#message_content').html('<div id="alert_message"><p>لطفا نکات زیر را رعایت کنید :</p><ul><li>پیش از مشاهده و اطمینان از کالا هیچ مبلغی نپردازید</li><li>در جاهای عمومی قرار بگذارید و به مکانهای خلوت و پرت نروید</li><li>در صورت مشاهده هر گونه تخلف ، آنرا از طریق ثبت مشکل در آگهی گزارش کنید</li><li>از دادن اطلاعات خصوصی جدا پرهیز کنید</li></ul></div>');
            for(var i=0;i<chats.length;i++){
                var chat = chats[i];
                if(chat['type'] == 'newDay'){
                    $('#message_content').append('<div class="timing_max"><span>'+chat['value']+'</span></div>');
                        console.log(chat);
                }else if(chat['type'] == 'contact_message'){
                    $('#message_content').append('<div class="contact_message"><div class="message_blub"><div class="message_content"><p>'+chat['data']['message']+'</p></div><div class="message_detail"><i class="icon-check1"></i><span>'+chat['time']+'</span></div> </div></div>');
                    last_id = chat['data']['id'];
                       
                }else if(chat['type'] == 'mymessage'){
                    $('#message_content').append('<div class="mymessage"><div class="message_blub"><div class="message_content"><p>'+chat['data']['message']+'</p></div><div class="message_detail"><i class="icon-check1"></i><span>'+chat['time']+'</span></div> </div></div>');
                    last_id = chat['data']['id'];   
                }else if(chat['type'] == 'info'){
                    $('#last_time_seen').text(chat['value']);
                }
                
                
            }
            sync = true;
            
            $('#loading_box').remove();
            $('#message_input_box_text').removeAttr('disabled');
            
        },
        error:function(xhr,error, errorThrown){
            $('#last_time_seen').text('عدم اتصال به شبکه ...');
            
            
        }
    });
}
function syncMessage(){
    $.ajax({
        url:main_url+'ajax/check_chat.php?p='+postDefault+'&u='+userDefault+'&i='+last_id,
        type:'GET',
        dataType:'json',
        success:function(result){

        }
    });
}