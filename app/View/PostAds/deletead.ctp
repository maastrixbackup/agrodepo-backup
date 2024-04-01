<script type="text/javascript">
function searchTxt()
{
	var searchtxt=$("#searchtxt").val();
	var sortby=$("#sortby").val();
	var perpage=$("#onpage").val();
	var category=$("#sales_category").val();
	var brand=$("#sales_brand").val();
	
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>PostAds/deletesearch/";
	if(blankchk.test(searchtxt))
	{
		url+="searchtxt:"+searchtxt+"/";
	}
	if(blankchk.test(sortby))
	{
		url+=sortby+"/";
	}
	if(perpage!='')
	{
		url+="perpage:"+perpage+"/";
	}
	if(category!='')
	{
		url+="category:"+category+"/";
	}
	if(brand!='')
	{
		url+="brand:"+brand+"/";
	}
	window.location=url;
}
$( document ).ready(function() {
$('.input').keypress(function (e) {
  if (e.which == 13) {
   var searchtxt=$("#searchtxt").val();
   var sortby=$("#sortby").val();
   var perpage=$("#onpage").val();
   var category=$("#sales_category").val();
   var brand=$("#sales_brand").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>PostAds/deletesearch/";
	if(blankchk.test(searchtxt))
	{
		url+="searchtxt:"+searchtxt+"/";
	}
	if(blankchk.test(sortby))
	{
		url+=sortby+"/";
	}
	if(perpage!='')
	{
		url+="perpage:"+perpage+"/";
	}
	if(category!='')
	{
		url+="category:"+category+"/";
	}
	if(brand!='')
	{
		url+="brand:"+brand+"/";
	}
	window.location=url;
    return false;    //<---- Add this line
  }
});
});
function sortBy(sortval)
{
	var searchtxt=$("#searchtxt").val();
	var perpage=$("#onpage").val();
	var category=$("#sales_category").val();
	var brand=$("#sales_brand").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>PostAds/deletesearch/";
	if(blankchk.test(searchtxt))
	{
		url+="searchtxt:"+searchtxt+"/";
	}
	if(sortval!='')
	{
		url+=sortval+"/";
	}
	if(perpage!='')
	{
		url+="perpage:"+perpage+"/";
	}
	if(category!='')
	{
		url+="category:"+category+"/";
	}
	if(brand!='')
	{
		url+="brand:"+brand+"/";
	}
	window.location=url;
}
function onPage(perpage)
{
	var searchtxt=$("#searchtxt").val();
	 var sortby=$("#sortby").val();
	 var category=$("#sales_category").val();
	  var brand=$("#sales_brand").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>PostAds/deletesearch/";
	if(blankchk.test(searchtxt))
	{
		url+="searchtxt:"+searchtxt+"/";
	}
	if(sortby!='')
	{
		url+=sortby+"/";
	}
	if(perpage!='')
	{
		url+="perpage:"+perpage+"/";
	}
	if(category!='')
	{
		url+="category:"+category+"/";
	}
	if(brand!='')
	{
		url+="brand:"+brand+"/";
	}
	window.location=url;
}
function category(catval)
{
	var searchtxt=$("#searchtxt").val();
	 var sortby=$("#sortby").val();
	 var perpage=$("#onpage").val();
	 var brand=$("#sales_brand").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>PostAds/deletesearch/";
	if(blankchk.test(searchtxt))
	{
		url+="searchtxt:"+searchtxt+"/";
	}
	if(sortby!='')
	{
		url+=sortby+"/";
	}
	if(perpage!='')
	{
		url+="perpage:"+perpage+"/";
	}
	if(catval!='')
	{
		url+="category:"+catval+"/";
	}
	if(brand!='')
	{
		url+="brand:"+brand+"/";
	}
	window.location=url;
}
function brand(brandval)
{
	var searchtxt=$("#searchtxt").val();
	 var sortby=$("#sortby").val();
	 var perpage=$("#onpage").val();
	  var category=$("#sales_category").val();
	var blankchk=/\S/;
	var url="<?php echo $base_url;?>PostAds/deletesearch/";
	if(blankchk.test(searchtxt))
	{
		url+="searchtxt:"+searchtxt+"/";
	}
	if(sortby!='')
	{
		url+=sortby+"/";
	}
	if(perpage!='')
	{
		url+="perpage:"+perpage+"/";
	}
	if(category!='')
	{
		url+="category:"+category+"/";
	}
	if(brandval!='')
	{
		url+="brand:"+brandval+"/";
	}
	window.location=url;
}
</script>
<?php
$catarr=array();
$subcatarr=array();
$brandarr=array();
$modelarr=array();
if(!empty($alladd))
{
	
	foreach($alladd as $singad)
	{
		array_push($catarr,$singad['PostAd']['category_id']);
		array_push($subcatarr,$singad['PostAd']['sub_cat_id']);
		if($singad['PostAd']['adv_brand_id']!='')
		{
			$brdata=explode(",",$singad['PostAd']['adv_brand_id']);
			if(!empty($brdata))
			{
				foreach($brdata as $sibradata)
				{
				array_push($brandarr,$sibradata);
				}
			}
		}
		if($singad['PostAd']['adv_model_id']!='')
		{
			$modeldata=explode(",",$singad['PostAd']['adv_model_id']);
			if(!empty($modeldata))
			{
				foreach($modeldata as $singmodeldata)
				{
				array_push($modelarr,$singmodeldata);
				}
			}
		}
		//array_push($brandarr,$singad['PostAd']['adv_model_id']);
	}
}
if(!empty($catarr))
{
	
	$catarr=array_unique($catarr);
}
if(!empty($subcatarr))
{
	
	$subcatarr=array_unique($subcatarr);
}
if(!empty($brandarr))
{
	
	$brandarr=array_unique($brandarr);
}
if(!empty($modelarr))
{
	
	$modelarr=array_unique($modelarr);
}
?>
<!--My Design -->
<div class="col-lg-12">
            <div class="row">
            	<div class="listtop34">
                	<form class="form-inline">
                    	<div>
                        	<div class="col-lg-4">
                        	<div class="form-group row">
                                <label><?php echo KEYWORD;?></label>
                                <input type="text" placeholder="Keywords" name="searchtxt" id="searchtxt" class="form-control input">
                              </div>
                        </div>
                        
                        	<div class="col-lg-4">
                        	<div class="form-group row">
                                <label><?php echo SORTBY;?></label>
                                <select name="sortby" id="sortby" class="form-control" onchange="return sortBy(this.value);">
                                    <option value=""><?php echo SELECT;?></option>
                                   
                                     <option value="sort:created/direction:asc"><?php echo DATEASSEND;?></option>
                                    <option value="sort:created/direction:desc"><?php echo DATEDESEND;?></option>
                                    <option value="sort:modified/direction:asc"><?php echo UPDATEASC;?></option>
                                     <option value="sort:modified/direction:desc"><?php echo UPDATEDESC;?></option>
                                     <option value="sort:quantity/direction:asc"><?php echo QUANTITYINCREASE;?></option>
                                     <option value="sort:quantity/direction:desc"><?php echo QUANTITYDOWN;?></option>
                                     <option value="sort:price/direction:asc"><?php echo PRICEASCEN;?></option>
                                     <option value="sort:price/direction:desc"><?php echo PRICEDOWN;?></option>
                               
                                </select>
                              </div>
                        </div>
                        
                        	<div class="col-lg-4">
                        	<div class="form-group row">
                                <label><?php echo ONPAGE;?></label>
                                <select name="onpage" id="onpage" class="form-control" onchange="onPage(this.value);">
                                    <option value=""><?php echo ALL;?></option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                              </div>
                        </div>
                        </div>
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                        <div>
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label><?php echo CATEGORY;?></label>
                                    <select name="sales_category" id="sales_category" class="form-control" onchange="category(this.value);">
                                        <option value=""><?php echo ALL;?></option>
                                        <?php if(!empty($catarr))
                                        {
                                            foreach($catarr as $mycat)
                                            {
                                                $catname=$this->Custom->category_name($mycat);
                                                ?>
                                        <option value="<?php echo $mycat;?>"><?php echo $catname;?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                  </div>
                            </div>
                        
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label>&nbsp;</label>
                                    <select name="sub_cat" class="form-control">
                                        <option value=""><?php echo SELECT;?></option>
                                    </select>
                                  </div>
                            </div>
                        </div>
                        
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                        <div>
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label><?php echo BRAND;?> / <?php echo MODEL;?> </label>
                                   <select name="sales_brand" id="sales_brand" class="form-control" onchange="return brand(this.value);">
                                        <option value=""><?php echo ALL;?></option>
                                        <?php if(!empty($brandarr))
                                        {
                                            foreach($brandarr as $brandid)
                                            {
                                                $brandname=$this->Custom->brand_nm($brandid);
                                                ?>
                                        <option value="<?php echo $brandid;?>"><?php echo $brandname;?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                  </div>
                            </div>
                        
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label>&nbsp;</label>
                                    <select name="model" class="form-control">
                                         <option value=""><?php echo SELECT;?></option>
                                    </select>
                                  </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <button class="btn btn-success pull-right top25" type="button" name="searchbutn" id="searchbutn" onclick="return searchTxt();"><?php echo SEARCH;?></button>
                                  </div>
                            </div>
                        </div>
                        
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                        
                        <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                        	<h4><?php echo DELETEFILTERS;?>: <span class="addnbr"><?php
	echo $this->Paginator->counter(array(
	'format' => __('{:count}')
	));
	?> <?php echo ADS;?></span></h4>
                          
                        </div>
                        
                      
                    </form>
                    
                    <div class="clearfix" style="height:1px;"></div>
                    
                    <h4><?php
	echo $this->Paginator->counter(array(
	'format' => __('pagină {:page} de{:pages}, arătând {:current} înregistrări din {:count} in total Record {:start}, se încheie la {:end}')
	));
	?></h4>
                    
                    <div class="clearfix" style="height:10px;"></div>
                    
                    <div id="listing_items">
                        <table cellpadding="0" cellspacing="0" class="tab-content">
                            <tbody>
                                <tr class="listing_header">
                                    <td width="188" class="col_select">
                                        <?php echo $this->Paginator->sort('adv_id',Sl); ?>
                                  </td>
                                    <td width="438"><font><font><?php echo $this->Paginator->sort('adv_name',NOTICE); ?></font></font></td>
                                  <td width="295"><font><font><?php echo FORUM;?></font></font></td>
                                  <td align="center" width="226"><font><font><?php echo VIEW;?></font></font></td>
                                  <td align="center" width="259"><font><font><?php echo $this->Paginator->sort('quantity',QUANTITYS); ?></font></font></td>
                                  <td align="center" width="92"><font><font><?php echo $this->Paginator->sort('price',PRICE); ?></font></font></td>
                                    <td align="center" width="114"><font><font><?php echo __(OPTIONS); ?></font></font></td>
                                </tr>
                                <?php 
								if(!empty($postAds))
								{
									$postadcount=1;
								foreach ($postAds as $postAd): ?>
                                <tr class="listing_data">
                                    <td class="col_select">
                                        <?php echo $postadcount;?>
                                    </td>
                                    <td valign="top" class="listing_title_thumb col_name">
                                     <?php $firstimg=$this->requestAction('PostAds/getfirstimg/'.$postAd['PostAd']['adv_id']);
									if(!empty($firstimg))
									{
										if($firstimg['PostadImg']['img_path']!='')
										{
											?>
                                             <a href="#">
                                            <img src="<?php echo $base_url;?>files/postad/<?php echo $firstimg['PostadImg']['img_path'];?>" alt="<?php echo h($postAd['PostAd']['adv_name']); ?>" style="padding:0;background:#EEEEEE;">
                                        </a> 
											
											<?php
										}
										
									}
									?>
                                        <a href="#" title="<?php echo h($postAd['PostAd']['adv_name']); ?>"><font><font>
                                            <?php echo h($postAd['PostAd']['adv_name']); ?></font></font></a>
                                    </td>
                                    <td align="center"><font><font>-</font></font></td>
                                    <td align="center"><font><font>N/A</font></font></td>
                                    <td align="center"><font><font><?php echo h($postAd['PostAd']['quantity']); ?></font></font></td>
                                    <td align="center"><font><font><?php echo h($postAd['PostAd']['price']).' '.h($postAd['PostAd']['currency']); ?></font></font></td>
                                    <td>
                                        <div class="mycp_listing_option">
                                            <button class="btn btn-success" onclick="location.href='<?php echo $base_url;?>PostAds/productdescription/<?php echo $postAd['PostAd']['adv_id'];?>';" type="button"> <?php echo EDITTOLIST;?></button>
                                        </div>
                                       
                                    </td>
                                </tr>
                                <?php 
								$postadcount++;
								endforeach;
									}
								 ?>
                            </tbody>
                        </table>
                        <div class="clearfix" style="height:10px;"></div>
                        <div class="paging">
						<?php
                            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                            echo $this->Paginator->numbers(array('separator' => ''));
                            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                        ?>
                        </div>
                	</div>
                    
                </div>
            </div>
                
          </div>