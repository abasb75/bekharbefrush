<?php



function create_price($pr){ if($pr=='0' or $pr == ''){ return 'توافقی'; } $new_pr = ''; $counter = 1; for($i=strlen($pr)-1;$i>=0;$i--){ if($counter==3 and $i!=0){ $new_pr = ','.$pr[$i].$new_pr; $counter = 1; continue; }else{ $new_pr = $pr[$i].$new_pr; $counter++; } } $new_pr = $new_pr .' تومان'; return $new_pr; }








$result = mysqli_query($connect,$sqlList);
                        while($res = mysqli_fetch_assoc($result)){
                            ?><article class="productItem">
                            <a href="<?php echo $_MAIN_URL.'p/'.$res['uniccode']; ?>">
                                <div class="productItemHolder">
                                    <div class="imageHolder">
                                        <div class="no_image">
                                            <?php 
                                            if($res['idr']=='0'){
                                                ?><i class="icon-camera-off"></i><?php
                                            }else{
                                                $main_idr = $res['idr'];
                                                $sql = "SELECT * FROM `posts_image` WHERE id=$main_idr;";
                                                $ret = mysqli_query($connect , $sql);
                                                if($idr = mysqli_fetch_assoc($ret)){
                                                    ?><img src="<?php echo $idr['data'] ?>" alt="<?php echo $res['title'] ?>"><?php
                                                    echo "'".$idr['data']."'";
                                                }else{
                                                    ?><i class="icon-camera-off"></i><?php
                                                }
                                            }
                                            
                                            ?>
                                            
                                        </div>
                                    </div>
                                    <div class="infoHolder">
                                        <h3><?php echo $res['title']; ?></h3><?php
                                        if($res['category']=='1' and $res['type']=='4'){
                                            ?><span>قیمت ودیعه : <?php echo create_price($res['price_1']); ?></span>
                                        <span>قیمت اجاره : <?php echo create_price($res['price_2']); ?></span><?php
                                        }else{
                                            ?><span></span>
                                        <span>قیمت : <?php echo create_price($res['price_1']); ?></span><?php
                                        }
                                        
                                        ?>
                                        
                                        <span><?php
                    $date1 = $res['release_date'];
                    $diff = abs(time() - strtotime($date1));
                    if($diff > 31536000){
                        echo floor($diff/(31536000)).' سال پیش';
                    }elseif($diff > 2592000){
                        echo floor($diff/(2592000)).' ماه پیش';
                    }elseif($diff > 604800){
                        echo floor($diff/(604800)).' هفته پیش';
                    }elseif($diff > 86400){
                        echo floor($diff/(86400)).' روز پیش';
                    }elseif($diff > 3600){
                        echo floor($diff/(3600)).' ساعت پیش';
                    }elseif($diff > 60){
                        echo floor($diff/(60)).' دقیقه پیش';
                    }else{
                        echo 'لحضاتی قبل';
                    }
                    
                    ?> در <?php
                            $post_city_id = $res['city'];
                            $csql = "SELECT * FROM cities WHERE id=$post_city_id;";
                            $rc = mysqli_query($connect,$csql);
                            if($city_array = mysqli_fetch_assoc($rc)){
                                echo $city_array['name'];
                            } 
                            
                                            ?></span>
                                    </div>
                                </div>
                            </a>
                        </article><?php
                        }
                        
                        ?>
                        
                        <!--
                        
                        <article class="productItem">
                            <a href="#">
                                <div class="productItemHolder">
                                    <div class="imageHolder">
                                        <div class="no_image">
                                            <i class="icon-camera-off"></i>
                                        </div>
                                    </div>
                                    <div class="infoHolder">
                                        <h3>لپ تاپ با پردازنده i7 و هارد 8 ترابایت و رم 32 گیگابایت گرافیک 8 از خانواده nvidia</h3>
                                        <span>رهن : 35,000,000,000,000 تومان</span>
                                        <span>اجاره : 2,999,999 تومان</span>
                                        <span>دقایقی قبل در مشهد</span>
                                    </div>
                                </div>
                            </a>
                        </article>
                        <article class="productItem">
                            <a href="#">
                                <div class="productItemHolder">
                                    <div class="imageHolder">
                                        <img src="assets/image/posts/i1.jpg">
                                    </div>
                                    <div class="infoHolder">
                                        <h3>خانه ویلایی با تمامی امکانات</h3>
                                        <span>رهن : 35,000,000,000,000 تومان</span>
                                        <span>اجاره : 2,999,999 تومان</span>
                                        <span>دقایقی قبل در مشهد</span>
                                    </div>
                                </div>
                            </a>
                        </article>-->