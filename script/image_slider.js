


function loadImagesSlider(){
    if(slidermageCount == 0){
    main_image_shower.innerHTML = '<div class="no_image"><i class="icon-camera-off"></i></div>';
}else if(slidermageCount == 1){
    if(img_sources[0].type == 'image'){
        var singleImageViewer = document.createElement('div');
        singleImageViewer.setAttribute('id','singleImageViewer');
        var slide = document.createElement('div');
        slide.setAttribute('class','slide');
        var img = document.createElement('img');
        img.src = img_sources[0].src;
        slide.appendChild(img);
        var hiddenDownload = document.createElement('div');
        hiddenDownload.setAttribute('class','hiddenDownload');
        slide.appendChild(hiddenDownload);
        singleImageViewer.appendChild(slide);
        main_image_shower.appendChild(singleImageViewer);
    }else if(img_sources[0].type == 'frame'){
        var singleImageViewer = document.createElement('div');
        singleImageViewer.setAttribute('id','singleImageViewer');
        var slide = document.createElement('div');
        slide.setAttribute('class','slide');
        var frame = document.createElement('iframe');
        frame.src = img_sources[0].src;
        slide.appendChild(frame);
        var hiddenDownload = document.createElement('div');
        hiddenDownload.setAttribute('class','hiddenDownload');
        slide.appendChild(hiddenDownload);
        singleImageViewer.appendChild(slide);
        main_image_shower.appendChild(singleImageViewer);
    }
    
}else if(slidermageCount > 1){
    var singleImageViewer = document.createElement('div');
    singleImageViewer.setAttribute('id','singleImageViewer');
    singleImageViewer.setAttribute('style','right:0;');
    
    for(var i=0;i<slidermageCount; i++){
        var slide = document.createElement('div');
        slide.setAttribute('class','slide');
        if(img_sources[i].type=='image'){
            var img = document.createElement('img');
            img.src = img_sources[i].src;
            slide.appendChild(img);
            var hiddenDownload = document.createElement('div');
            hiddenDownload.setAttribute('class','hiddenDownload');
            slide.appendChild(hiddenDownload);
        }else if(img_sources[i].type=='frame'){
            var iframe = document.createElement('iframe');
            iframe.src = img_sources[i].src;
            slide.appendChild(iframe);
        }
        
        
       
        singleImageViewer.appendChild(slide);   


        var listItem = document.createElement('div');
        listItem.setAttribute('class','listItem');

        var listItemContent = document.createElement('div');
        listItemContent.setAttribute('class','listItemContent');
        
        var itemImageHolder = document.createElement('div');
        itemImageHolder.setAttribute('class','itemImageHolder');
        itemImageHolder.setAttribute('idg',i);



        if(img_sources[i].type=='image'){
            var img2 = document.createElement('img');
            img2.src = img_sources[i].src;
            itemImageHolder.appendChild(img2);
        }else if(img_sources[i].type=='frame'){
            var button_play = document.createElement('button');
            button_play.setAttribute('class','icon-film2');
            itemImageHolder.appendChild(button_play);
        }

        
        itemImageHolder.onclick = goToImage;

        
        listItemContent.appendChild(itemImageHolder);
        listItem.appendChild(listItemContent);
        image_list_for_slider.appendChild(listItem);
        
                    
    }
    var Slider_controller = document.createElement('div');
    Slider_controller.setAttribute('class','Slider_controller');
    var slider_go_next = document.createElement('button');
    slider_go_next.setAttribute('id','slider_go_next');
    slider_go_next.innerHTML = '<i class="icon-angle-left"></i>';
    slider_go_next.onclick = goNextSlide;

    var slider_go_priv = document.createElement('button');
    slider_go_priv.setAttribute('id','slider_go_priv');
    slider_go_priv.innerHTML = '<i class="icon-angle-right"></i>';
    slider_go_priv.onclick = goPrivSlide;

    var hideScreen = document.createElement('button');
    hideScreen.setAttribute('id','hideScreen');
    hideScreen.innerHTML = '<i class="icon-clear"></i>';
    hideScreen.onclick = hideFullscreen;


    main_image_shower.appendChild(slider_go_next);
    main_image_shower.appendChild(slider_go_priv);
    main_image_shower.appendChild(hideScreen);
    
    singleImageViewer.onclick = showFullscreen;
   // main_image_shower.appendChild(Slider_controller);
    main_image_shower.appendChild(singleImageViewer);


}

}

var slide_right = 0;
function goNextSlide(){
    if(slide_right < slidermageCount - 1){
        slide_right = slide_right + 1;
        document.getElementById('singleImageViewer').setAttribute('style','right:-'+slide_right*100+'%');
    }
}
function goPrivSlide(){
    if(slide_right > 0){
        slide_right = slide_right - 1;
        document.getElementById('singleImageViewer').setAttribute('style','right:-'+slide_right*100+'%');
    }
}


function goToImage(){
    slide_right = parseInt(this.getAttribute('idg'));
    console.log(slide_right);
    if(slide_right >= 0 && slide_right < slidermageCount + 1){
        document.getElementById('singleImageViewer').setAttribute('style','right:-'+slide_right*100+'%');
    }

}


function showFullscreen(){
    main_image_shower.setAttribute('class','fullscreen');
    document.body.setAttribute('class','disableScroll');
}

function hideFullscreen(){
    main_image_shower.setAttribute('class','');
    document.body.setAttribute('class','');
}