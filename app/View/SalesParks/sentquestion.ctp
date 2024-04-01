<div id="listing_items">
    <table cellpadding="0" cellspacing="0" class="tab-content">
        <tbody>
            <tr class="listing_header">
            <td width="50px"><font><font><?php echo Sl;?></font></font></td>
              <td align="center" width="226"><font><font>trimis La</font></font></td>
              <td align="center" width="100"><font><font>Park Tipul</font></font></td>
              <td align="center" width="159"><font><font>Numele Park</font></font></td>
              <td align="center" width="130"><font><font>mesaj</font></font></td>
               <td align="center" width="129"><font><font>a răspuns la</font></font></td>

                <td align="center" width="114">data trimis</td>
            </tr>
            <?php 
				if(isset($questionRes) && !empty($questionRes)){
					$questionCount=1;
					//($questionRes);
					foreach($questionRes as $questionResult){
						$qid=$questionResult['ParkQuestion']['qid'];
					
					$parkid=$questionResult['ParkQuestion']['park_id'];
					$parkDetail=$this->Custom->BapCustUniParkDetail($parkid);
					$submitedID=$parkDetail['SalesPark']['user_id'];
					$submitedBY=$this->Custom->user_details($submitedID);
					$parktype=$questionResult['ParkQuestion']['park_type'];
					$question=stripslashes($questionResult['ParkQuestion']['question']);
					$sentDate=date("d-m-Y", strtotime($questionResult['ParkQuestion']['created']));
					$parentID=$questionResult['ParkQuestion']['parent'];
					//echo $parentID;
					$repliedDetail=$this->Custom->BapCustUniParkParent($parentID);
				?>
                
                    <tr class="listing_data">
                    <td align="center"><?php echo $questionCount;?></td>
                    <td align="center"><?php echo stripslashes($submitedBY['first_name'].' '. $submitedBY['last_name']);?></td>
                    <td align="center"><?php if($parktype==1){echo "Parcuri dezmembrări";}else{echo "Firme piese";}?></td>
                        <td valign="top" class="listing_title_thumb col_name">
                            
                            <a href="<?php echo $base_url;?>pages/parks/<?php echo stripslashes($parkDetail['SalesPark']['slug']);?>" title="<?php echo stripslashes($parkDetail['SalesPark']['park_name']);?>" target="_blank"><strong><?php echo stripslashes($parkDetail['SalesPark']['park_name']);?></strong></a>
                          
                        </td>
                        <td align="center"><?php echo $question;?></td>
                        <td align="center"><?php if(count($repliedDetail)>0){echo $repliedDetail['ParkQuestion']['question'];}else{echo "N/A";}?></td>
                        <td align="center"><font><font><?php echo date("F d, Y",strtotime($sentDate));?></font></font></td>
                        
                    </tr>
                    <?php
                    $questionCount++;
                     }	
				}
				else
				{
					?>
                    <tr>
                        <td colspan="8">
                        	Parcuri Nu a fost gasit
                        </td>
                    </tr>
					<?php
				}
				?>
          
        </tbody>
    </table>

</div>
