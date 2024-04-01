<?php //pr($bidOfferResult);exit;?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">View Question Image</h3>
        <div class="box-tools pull-right">
          <!-- <button class="btn btn-primary btn-flat" onclick="location.href='<?php echo $base_url;?>admin/Reports/bid_offer'">Manage Bid Offer</button> -->
               
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="row">
          
          <?php 
              if($this->request->params['named']['imageof']=='sales'){
                $res=$this->Custom->BapCustuniSalesQuestImg($this->request->params['named']['qid']);
                      if(!empty($res)){
                            foreach($res as $result){
                                $ImgPath=$base_url."files/salesquestion/".$result['SalesquestionImage']['img_file'];
                                ?>
                                <div class="col-lg-3 blockimg23" style="height: auto;">
                                    <a href="<?=$ImgPath?>" target="_blank"><img src="<?=$ImgPath?>" alt="" style="height: auto; width: 100%; margin-bottom:20px;"></a>
                                </div>
                                <?php 
                            }
                        }
                      }elseif($this->request->params['named']['imageof']=='parks'){
                        $res=$this->Custom->BapCustuniparkQuestImg($this->request->params['named']['qid']);
                         if(!empty($res)){
                              foreach($res as $result){
                                  $ImgPath=$base_url."files/parkquestion/".$result['ParksquestionImage']['img_file'];
                                  ?>
                                 <div class="col-lg-3 blockimg23" style="height: auto;">
                                    <a href="<?=$ImgPath?>" target="_blank"><img src="<?=$ImgPath?>" alt="" style="height: auto; width: 100%; margin-bottom:20px;"></a>
                                </div>
                                  <?php 
                              }
                          }
                      }elseif($this->request->params['named']['imageof']=='requestparts'){
                        $res=$this->Custom->BapCustuniRequestQuestImg($this->request->params['named']['qid']);
                         if(!empty($res)){
                              foreach($res as $result){
                                  $ImgPath=$base_url."files/requestquestion/".$result['RequestquestionImage']['img_file'];
                                  ?>
                                 <div class="col-lg-3 blockimg23" style="height: auto;">
                                    <a href="<?=$ImgPath?>" target="_blank"><img src="<?=$ImgPath?>" alt="" style="height: auto; width: 100%; margin-bottom:20px;"></a>
                                </div>
                                  <?php 
                              }
                          }
                      }elseif($this->request->params['named']['imageof']=='bidoffer'){
                        $res=$this->Custom->BapCustuniBidQuestImg($this->request->params['named']['qid']);
                         if(!empty($res)){
                              foreach($res as $result){
                                  $ImgPath=$base_url."files/bidquestion/".$result['BidquestionImage']['img_file'];
                                  ?>
                                 <div class="col-lg-3 blockimg23" style="height: auto;">
                                    <a href="<?=$ImgPath?>" target="_blank"><img src="<?=$ImgPath?>" alt="" style="height: auto; width: 100%; margin-bottom:20px;"></a>
                                </div>
                                  <?php 
                              }
                          }
                      }
                  ?>
      </div>
    </div><!-- /.box-body -->
    
</div><!-- /.box -->
