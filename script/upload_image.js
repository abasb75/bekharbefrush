
var imgCounts =0;
var idrCounts =0;
var imgArrays = [];
var idrArray = [];
var mainIdr = null;
var items = document.getElementById('image_items');
var finput = document.getElementById('finput');



if(document.getElementById('image_file_input')!=null){
    document.getElementById('image_file_input').onchange = function(){
        for(var i=0;i < this.files.length; i++){
            //upload_file(this.files[i],idrCounts);
            var file = new FileReader();
            file.readAsDataURL(this.files[i]);
            file.idr = idrCounts++;
            file.fl = this.files[i];

            file.onload = function(e){
                if(this.fl.size > 10000 * 1024){
                    return;
                }
                if(imgArrays.length > 9){
                    return;
                }
                if(mainIdr==null){
                    mainIdr = this.idr;
                }
                imgArrays.push({
                    idr:this.idr,
                    data:this.result,
                    status:0,
                    file:this.fl
                });
                
            
                upload_file(this.fl,this.idr);
                items.innerHTML = '';
                for(var j=0;j<imgArrays.length;j++){

                    if(imgArrays.length > 10){
                        break;
                    }
                    
                    


                    var item = document.createElement('div');        

                    item.setAttribute('idr',imgArrays[j].idr);

                    item.setAttribute('class','item');

                    if(imgArrays[j].idr+'' == mainIdr){
                        item.setAttribute('class','item main_item');
                    }

                    var loadingStatus = '';
                    if(imgArrays[j].status == 0){
                        loadingStatus = '<div class="loading"><img src="'+window.localStorage.getItem('loading')+'"></div>';
                    }else if(imgArrays[j].status == 2){
                        loadingStatus = '<div class="error_upload"><div class="btnholder"><button onclick="retry_upload(this);"><i class="icon-refresh"></i></button><button class="deletebtn" onclick="removeUnloadedImage(this);"><i class="icon-delete"></i></button></div></div>';
                    }


                    item.innerHTML += '<div class="itemHolder"><div class="imageHolder"><img src="'+imgArrays[j].data+'" /></div><button class="delete" onclick="removeThis(this);"><i class="icon-delete"></i></button>'+loadingStatus+'</div>';
                    item.children[0].children[0].children[0].onclick = setToMainImage;
                    items.append(item);
                    if(imgArrays.length<10){
                        items.append(finput);
                    }
                }
            }
        }
    }

}







function upload_file(file,idr){
    var data = new FormData();
    data.append('file',file);
    data.append('idr',idr);
    data.append('token',tokenId);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState==4){
            if(this.status == 200 && this.responseText == 'OK'){
                set_to_loaded(idr);
            }else{
                loadError(idr);
                console.log(this.responseText);
            }
            
        }
    }
    
    xhttp.open('POST',main_url+'ajax/upload_image.php');
    xhttp.send(data);
}








function set_to_loaded(idr){
    for(var c=0;c<items.children.length;c++){
        var itm = items.children[c];
        if(itm.getAttribute('idr')==(idr+'') && imgArrays[c].idr == idr){
            itm.children[0].removeChild(itm.children[0].children[2]);
            imgArrays[c].status = 1;
        }
    }
}



function loadError(idr){
    for(var c=0;c<items.children.length;c++){
        var itm = items.children[c];
        if(itm.getAttribute('idr')==(idr+'') && imgArrays[c].idr == idr){
            imgArrays[c].status = 2;
            itm.children[0].removeChild(itm.children[0].children[2]);
            itm.children[0].innerHTML += '<div class="error_upload"><div class="btnholder"><button onclick="retry_upload(this);"><i class="icon-refresh"></i></button><button class="deletebtn" onclick="removeUnloadedImage(this);"><i class="icon-delete"></i></button></div></div>';
        }
    }
}

function retry_upload(el){
    var item = el.parentElement.parentElement.parentElement.parentElement;
    if(item== null){
        return;
    }
    var idr = parseInt(item.getAttribute('idr'));
    for(var i=0;i<imgArrays.length;i++){
        if(idr == imgArrays[i].idr){
            imgArrays[i].status = 0;
            item.children[0].removeChild(item.children[0].children[2]);
            item.children[0].innerHTML += '<div class="loading"><img src="'+window.localStorage.getItem('loading')+'"></div>';
            upload_file(imgArrays[i].file,idr);
        }
    }
}


function setToMainImage(evt){
    var item = evt.target.parentElement.parentElement.parentElement;
    var itemIdr = parseInt(item.getAttribute('idr'));
    //var index = idr.indexOf(itemIdr);
    for(var i=0;i<items.children.length;i++){
        if(item.getAttribute('idr') == items.children[i].getAttribute('idr')){
            items.children[i].setAttribute('class','item main_item');
        }else{
            items.children[i].setAttribute('class','item');
        }
        
    }
    mainIdr = itemIdr+'';
}

function removeUnloadedImage(el){
    
    
    var item = el.parentElement.parentElement.parentElement.parentElement;
    if(item== null){
        return;
    }
    var idr = parseInt(item.getAttribute('idr'));
    for(var i=0;i<imgArrays.length;i++){
        if(idr == imgArrays[i].idr){
            imgArrays.splice(i,1);
            items.removeChild(item);
            items.append(finput);
            return;
        }
    }
    
    
}

function removeOnloaded_image(idr){
    var idr = parseInt(idr);
    for(var i=0;i<imgArrays.length;i++){
        if(idr == imgArrays[i].idr){
            imgArrays.splice(i,1);
        }
    }
    for(var i=0;i<items.children.length;i++){
        var itemIdr = items.children[i].getAttribute('idr');
        if(itemIdr != null && itemIdr == idr+''){
            items.removeChild(items.children[i]);
        }
    }
    items.appendChild(finput);
}

function removeThis(el){
    var item = el.parentElement.parentElement;
    if(item== null){
        return;
    }
    
    
    
    var idr = item.getAttribute('idr');
    item.children[0].innerHTML += '<div class="loading"><img src="'+window.localStorage.getItem('loading')+'"></div>';
    for(i=0;i<imgArrays.length;i++){
        if(imgArrays[i].idr == idr){
            imgArrays[i].status =0;
        }
    }
    
    
    var data = new FormData();
    data.append('idr',idr)
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState==4){
            if(this.status == 200 && this.responseText == 'OK'){
                removeOnloaded_image(idr);
            }else{
                console.log(this.responseText);
                set_to_loaded(idr);
            }
            
        }
    }
    xhttp.open('POST',main_url+'ajax/remove_image.php',true);
    xhttp.send(data);
}







var t=''




























/* upload video */
/*
    document.getElementById('loading_upload').src = window.localStorage.getItem('loading');

var vxhttp = null;
var pb = document.getElementById('progress_bar_status');
function upload_video(){
    pb.setAttribute('class','');
    document.getElementById('text_progress_upload').innerHTML = 'در حال آپلود فایل! لطفا صبر کنیذ ...';
    if(document.getElementById('video_upload_input').files[0]==null){return}
    document.getElementById('upload_button').setAttribute('style','display:none');
    document.getElementById('progressview').setAttribute('class','display');
    
    document.getElementById('reload_upload').setAttribute('class','');
    document.getElementById('loading_upload').setAttribute('class','');
    
    document.getElementById('end_of_upload_video').setAttribute('class','');
    var video = document.getElementById('video_upload_input').files[0];
    document.getElementById('button_cancel_upload').onclick = function(){
        vxhttp.abort();
        document.getElementById('upload_button').setAttribute('style','');
        document.getElementById('progressview').setAttribute('class','');
        document.getElementById('video_upload_input').value = null;
        
    };
    
    
    
    var vdata = new FormData();
    vdata.append('v',video);
    vxhttp = new XMLHttpRequest();
    
    
    
    vxhttp.onreadystatechange = function(){
        if(this.readyState == 4){
            if(this.status == 200){
                console.log(this.responseText);
            }else{
                console.log(this.responseText);
            }
        }
    }
    
    
    vxhttp.upload.onprogress = function(e){
        pb.setAttribute('style','width:'+( (e.loaded / e.total) * 100 ) +'%;')
        console.log((e.loaded / e.total) * 100);
    }
    vxhttp.upload.onerror = function(e){
        pb.setAttribute('class','error');
        document.getElementById('text_progress_upload').innerHTML = 'مشکلی در آپلود فایل بوجود آمد دوباره سعی کنید ...';
        document.getElementById('reload_upload').setAttribute('class','display');
        document.getElementById('reload_upload').onclick = function(){
            upload_video();
        }
        document.getElementById('loading_upload').setAttribute('class','display_none');
    }
    
    vxhttp.upload.onload = function(){
        pb.setAttribute('style','width:100%;background:green;');
        document.getElementById('text_progress_upload').innerHTML = 'اپلود فایل با موفقیت انجام شد';
        document.getElementById('loading_upload').setAttribute('class','display_none');
        document.getElementById('button_cancel_upload').setAttribute('class','display_none');
        document.getElementById('end_of_upload_video').setAttribute('class','display');
        setTimeout(()=>{
            document.getElementById('progressview').setAttribute('class','');
        },5000)
    }
    
    
    
    vxhttp.open('POST',main_url+'php/ajax/upload_video.php',true);
    vxhttp.send(vdata);
    
}













*/