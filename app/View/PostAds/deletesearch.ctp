<script type="text/javascript">
function searchTxt()
{
	var searchtxt=$("#searchtxt").val();
	var sortby=$("#sortby").val();
	var perpage=$("#onpage").val();
	var category=$("#sales_category").val();
	var subcat=$("#subcat").val();
	var brand=$("#sales_brand").val();
	var subbrand=$("#subbrand").val();
	
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
	if(subcat!='')
	{
		url+="category:"+subcat+"/";
	}
	else
	{
		if(category!='')
		{
			url+="category:"+category+"/";
		}
	}
	if(subbrand!='')
	{
		url+="brand:"+subbrand+"/";
	}
	else if(brand!='')
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
   var subcat=$("#subcat").val();
   var brand=$("#sales_brand").val();
   var subbrand=$("#subbrand").val();
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
	if(subcat!='')
	{
		url+="category:"+subcat+"/";
	}
	else
	{
		if(category!='')
		{
			url+="category:"+category+"/";
		}
	}
	if(subbrand!='')
	{
		url+="brand:"+subbrand+"/";
	}
	else if(brand!='')
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
	var subcat=$("#subcat").val();
	var brand=$("#sales_brand").val();
	var subbrand=$("#subbrand").val();
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
	if(subcat!='')
	{
		url+="category:"+subcat+"/";
	}
	else
	{
		if(category!='')
		{
			url+="category:"+category+"/";
		}
	}
	if(subbrand!='')
	{
		url+="brand:"+subbrand+"/";
	}
	else if(brand!='')
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
	 var subcat=$("#subcat").val();
	  var brand=$("#sales_brand").val();
	  var subbrand=$("#subbrand").val();
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
	if(subcat!='')
	{
		url+="category:"+subcat+"/";
	}
	else
	{
		if(category!='')
		{
			url+="category:"+category+"/";
		}
	}
	if(subbrand!='')
	{
		url+="brand:"+subbrand+"/";
	}
	else if(brand!='')
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
	 var subbrand=$("#subbrand").val();
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
	if(subbrand!='')
	{
		url+="brand:"+subbrand+"/";
	}
	else if(brand!='')
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
	  var subcat=$("#subcat").val();
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
	if(subcat!='')
	{
		url+="category:"+subcat+"/";
	}
	else
	{
		if(category!='')
		{
			url+="category:"+category+"/";
		}
	}
	if(brandval!='')
	{
		url+="brand:"+brandval+"/";
	}
	window.location=url;
}
function subCat(catval)
{
	var searchtxt=$("#searchtxt").val();
	 var sortby=$("#sortby").val();
	 var perpage=$("#onpage").val();
	 var brand=$("#sales_brand").val();
	 var subbrand=$("#subbrand").val();
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
	if(catval!='')
	{
		url+="category:"+catval+"/";
	}
	else
	{
		url+="category:"+category+"/";
	}
	if(subbrand!='')
	{
		url+="brand:"+subbrand+"/";
	}
	else if(brand!='')
	{
		url+="brand:"+brand+"/";
	}
	window.location=url;
}
function model(brandval)
{
	var searchtxt=$("#searchtxt").val();
	 var sortby=$("#sortby").val();
	 var perpage=$("#onpage").val();
	  var category=$("#sales_category").val();
	  var subcat=$("#subcat").val();
	  var brand=$("#sales_brand").val();
	  var subbrand=$("#subbrand").val();
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
	if(subcat!='')
	{
		url+="category:"+subcat+"/";
	}
	else
	{
		if(category!='')
		{
			url+="category:"+category+"/";
		}
	}
	if(brandval!='')
	{
		url+="brand:"+brandval+"/";
	}
	else
	{
		url+="brand:"+brand+"/";
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
                                <label>Keyword</label>
                                <input type="text" placeholder="Keywords" name="searchtxt" id="searchtxt" value="<?php echo $searchtxt;?>" class="form-control input">
                              </div>
                        </div>
                        
                        	<div class="col-lg-4">
                        	<div class="form-group row">
                                <label>Sort By</label>
                                <select name="sortby" id="sortby" class="form-control" onchange="return sortBy(this.value);">
                                  		 <option value="">Select</option>
										<?php if(isset($this->request->params['named']['sort'])){?>
                                        <option value="sort:created/direction:asc"<?php if($this->request->params['named']['sort']=='created' && $this->request->params['named']['direction']=='asc'){?> selected="selected"<?php }?>>Date added ascending</option>
                                        <option value="sort:created/direction:desc"<?php if($this->request->params['named']['sort']=='created' && $this->request->params['named']['direction']=='desc'){?> selected="selected"<?php }?>>Date added descending</option>
                                        <option value="sort:modified/direction:asc"<?php if($this->request->params['named']['sort']=='modified' && $this->request->params['named']['direction']=='asc'){?> selected="selected"<?php }?>>Updated ascending</option>
                                         <option value="sort:modified/direction:desc"<?php if($this->request->params['named']['sort']=='modified' && $this->request->params['named']['direction']=='desc'){?> selected="selected"<?php }?>>Updated descending</option>
                                         <option value="sort:quantity/direction:asc"<?php if($this->request->params['named']['sort']=='quantity' && $this->request->params['named']['direction']=='asc'){?> selected="selected"<?php }?>>Quantity Increasing</option>
                                         <option value="sort:quantity/direction:desc"<?php if($this->request->params['named']['sort']=='quantity' && $this->request->params['named']['direction']=='desc'){?> selected="selected"<?php }?>>Quantity Down</option>
                                         <option value="sort:price/direction:asc"<?php if($this->request->params['named']['sort']=='price' && $this->request->params['named']['direction']=='asc'){?> selected="selected"<?php }?>>Price ascending</option>
                                         <option value="sort:price/direction:desc"<?php if($this->request->params['named']['sort']=='price' && $this->request->params['named']['direction']=='desc'){?> selected="selected"<?php }?>>Price Down</option>
                                         <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <option value="sort:created/direction:asc">Date added ascending</option>
                                        <option value="sort:created/direction:desc">Date added descending</option>
                                        <option value="sort:modified/direction:asc">Updated ascending</option>
                                         <option value="sort:modified/direction:desc">Updated descending</option>
                                         <option value="sort:quantity/direction:asc">Quantity Increasing</option>
                                         <option value="sort:quantity/direction:desc">Quantity Down</option>
                                         <option value="sort:price/direction:asc">Price ascending</option>
                                         <option value="sort:price/direction:asc">Price Down</option>
                                        <?php
                                        }
                                        ?>
                               
                                </select>
                              </div>
                        </div>
                        
                        	<div class="col-lg-4">
                        	<div class="form-group row">
                                <label>On page</label>
                                <select name="onpage" id="onpage" class="form-control" onchange="onPage(this.value);">
                                    <option value="">All</option>
									<?php if(isset($this->request->params['named']['perpage'])){?>
                                    <option value="30"<?php if($this->request->params['named']['perpage']==30){?> selected="selected"<?php }?>>30</option>
                                    <option value="50"<?php if($this->request->params['named']['perpage']==50){?> selected="selected"<?php }?>>50</option>
                                    <option value="100"<?php if($this->request->params['named']['perpage']==100){?> selected="selected"<?php }?>>100</option>
                                    <?php }else{?>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <?php }?>
                                </select>
                              </div>
                        </div>
                        </div>
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                        <div>
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label>Category</label>
                                    <select name="sales_category" id="sales_category" class="form-control" onchange="category(this.value);">
                                       <option value="">All</option>
										<?php if(!empty($catarr))
                                        {
                                            foreach($catarr as $mycat)
                                            {
                                                $catname=$this->Custom->category_name($mycat);
                                                if(isset($this->request->params['named']['category']))
                                                {
                                                    if(!in_array($this->request->params['named']['category'],$catarr))
                                                    {
                                                        $catid=$this->request->params['named']['category'];
                                                        $parentid=$this->requestAction('/PostAds/getcatparent/'.$catid);
                                                    }
                                                    else
                                                    {
                                                        $parentid='';
                                                    }
                                                }
                                                ?>
                                        <option value="<?php echo $mycat;?>"<?php if(isset($this->request->params['named']['category']) && ($this->request->params['named']['category']==$mycat || $parentid==$mycat)){?> selected="selected"<?php }?>><?php echo $catname;?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                  </div>
                            </div>
                        
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label>&nbsp;</label>
                                     <?php
									if(isset($this->request->params['named']['category'])){?>
									<select name="subcat" id="subcat" class="form-control" onchange="subCat(this.value);">
									 <option value="">All</option>
									 <?php if(!empty($subcatarr))
									{
										foreach($subcatarr as $subcatid)
										{
											$subcatname=$this->Custom->category_name($subcatid);
											?>
									<option value="<?php echo $subcatid;?>"<?php if(isset($this->request->params['named']['category']) && $this->request->params['named']['category']==$subcatid){?> selected="selected"<?php }?>><?php echo $subcatname;?></option>
									<?php }
									}
									?>
									</select>
									<?php }else{?>
									<input type="hidden" name="subcat" id="subcat" value="" />
									<?php }?>
                                  </div>
                            </div>
                        </div>
                        
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                        <div>
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label>Brand / Model</label>
                                   <select name="sales_brand" id="sales_brand" class="form-control" onchange="return brand(this.value);">
                                        <option value="">All</option>
										<?php if(!empty($brandarr))
                                        {
                                            foreach($brandarr as $brandid)
                                            {
                                                $brandname=$this->Custom->brand_nm($brandid);
                                                if(isset($this->request->params['named']['brand']))
                                                {
                                                    if(!in_array($this->request->params['named']['brand'],$brandarr))
                                                    {
                                                        $pbrandid=$this->request->params['named']['brand'];
                                                        echo $bparentid=$this->requestAction('/PostAds/getbrandparent/'.$pbrandid);
                                                    }
                                                    else
                                                    {
                                                        $bparentid='';
                                                    }
                                                }
                                                
                                                ?>
                                        <option value="<?php echo $brandid;?>"<?php if(isset($this->request->params['named']['brand']) && ($this->request->params['named']['brand']==$brandid || $bparentid==$brandid)){?> selected="selected"<?php }?>><?php echo $brandname;?></option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                  </div>
                            </div>
                        
                        	<div class="col-lg-4">
                                <div class="form-group row">
                                    <label>&nbsp;</label>
                                     <?php
									if(isset($this->request->params['named']['brand'])){?>
									<select name="subbrand" id="subbrand" class="form-control" onchange="model(this.value);">
									 <option value="">All</option>
										 <?php if(!empty($modelarr))
										{
											foreach($modelarr as $modelid)
											{
												$modelname=$this->Custom->brand_nm($modelid);
												?>
										<option value="<?php echo $modelid;?>"<?php if(isset($this->request->params['named']['brand']) && $this->request->params['named']['brand']==$modelid){?> selected="selected"<?php }?>><?php echo $modelname;?></option>
										<?php }
										}
										?>
                                        </select>
                                        <?php
									}
									else
									{
									?>
									<input type="hidden" name="subbrand" id="subbrand" value="" />
									<?php }?>
                                  </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <button class="btn btn-success pull-right top25" type="button" name="searchbutn" id="searchbutn" onclick="return searchTxt();">Search</button>
                                  </div>
                            </div>
                        </div>
                        
                        
                        <div class="clearfix" style="height:10px;"></div>
                        
                        
                        <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                        	<h4>Delete filters: <span class="addnbr"><?php
	echo $this->Paginator->counter(array(
	'format' => __('{:count}')
	));
	?> ads</span></h4>
                            <?php if(isset($this->request->params['named']['category'])){
								$catid=$this->request->params['named']['category'];
								$catdetail=$this->Custom->dezSingCat($catid);
									if($catdetail['SalesCategory']['flag']==0)
									{
									?>
								<div class="checkbox">
									<label>
										<?php echo $catdetail['SalesCategory']['category_name'];?>  <span class="removetag" onclick="return category('');">X</span> 
									</label>
								</div>
								<?php }
									  else
									  {
										  $catname=$this->Custom->category_name($catdetail['SalesCategory']['flag']);
										  ?>
                                           <div class="checkbox">
                                            <label>
                                                <?php echo $catname;?>  <span class="removetag" onclick="return category('');">X</span> 
                                            </label>
                                        </div>
                                          <div class="checkbox">
                                            <label>
                                                <?php echo $catdetail['SalesCategory']['category_name'];?>  <span class="removetag" onclick="return subCat('');">X</span> 
                                            </label>
                                        </div>
                                          <?php
									  }
								}?>
                            	<?php if(isset($this->request->params['named']['brand'])){
									$brandid=$this->request->params['named']['brand'];
									$branddetail=$this->Custom->dezSingBrand($brandid);
										if($branddetail['SalesBrand']['flag']==0)
										{
										?>
                                        <div class="checkbox">
                                            <label>
                                                <?php echo $branddetail['SalesBrand']['brand_name'];?> <span class="removetag" onclick="return brand('');">X</span> 
                                            </label>
                                        </div>
									 <?php
										}
										else
										{
											$brandname=$this->Custom->brand_nm($branddetail['SalesBrand']['flag']);
										?>
                                         <div class="checkbox">
                                            <label>
                                                <?php echo $brandname;?> <span class="removetag" onclick="return brand('');">X</span> 
                                            </label>
                                        </div>
                                          <div class="checkbox">
                                            <label>
                                                <?php echo $branddetail['SalesBrand']['brand_name'];?> <span class="removetag" onclick="return model('');">X</span> 
                                            </label>
                                        </div>

										<?php
										}
								}
									?>
                            
                            
                        </div>
                        
                      
                    </form>
                    
                    <div class="clearfix" style="height:1px;"></div>
                    
                    <h4><?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?></h4>
                    
                    <div class="clearfix" style="height:10px;"></div>
                    
                    <div id="listing_items">
                        <table cellpadding="0" cellspacing="0" class="tab-content">
                            <tbody>
                                <tr class="listing_header">
                                    <td width="188" class="col_select">
                                        <?php echo $this->Paginator->sort('adv_id','SL#'); ?>
                                  </td>
                                    <td width="438"><font><font><?php echo $this->Paginator->sort('adv_name','Notice'); ?></font></font></td>
                                  <td width="295"><font><font>Forum</font></font></td>
                                  <td align="center" width="226"><font><font>Views</font></font></td>
                                  <td align="center" width="259"><font><font><?php echo $this->Paginator->sort('quantity','Quantity'); ?></font></font></td>
                                  <td align="center" width="92"><font><font><?php echo $this->Paginator->sort('price','Price'); ?></font></font></td>
                                    <td align="center" width="114"><font><font><?php echo __('Options'); ?></font></font></td>
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
                                            <button class="btn btn-success" onclick="location.href='<?php echo $base_url;?>PostAds/productdescription/<?php echo $postAd['PostAd']['adv_id'];?>';" type="button">Edit to relist</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php 
								$postadcount++;
								endforeach;
									}
									else
									{
										?>
                                        <tr class="listing_data">
                                        <td colspan="7" class="bg-warning centertext"><h4>Sorry! no ads found</h4></td>
                                        </tr>
                                        <?php
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