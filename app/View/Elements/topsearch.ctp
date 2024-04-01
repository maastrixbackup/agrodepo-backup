<form class="navbar-form navbar-left" name="searchfrm" id="searchfrm" style="width:100%;">
				<!--<select class="form-control">
					<option selected="selected">Root</option>
					<option></option>
				</select>-->
                <?php
				$catlist=$this->Custom->dez_categories();
				//print_r($catlist);
				if(!empty($catlist)){
				?>
                <select class="tech searchinput" name="category" id="category">
                <option value="">-<?php echo SELECTCATEGORIES;?>-</option>
                <?php
				if(isset($this->request->params['named']['category']))
					{
						$category=$this->request->params['named']['category'];
					}
					else
					{
						$category=''; 
					}
					if(isset($this->request->params['named']['postkeywords']))
					{
						$postkeywords=$this->request->params['named']['postkeywords'];
					}
					else
					{
						$postkeywords='';
					}
				foreach($catlist as $catres)
				{
				$catID=$catres['SalesCategory']['category_id'];
				$catSlug=$catres['SalesCategory']['slug'];
				//echo $selectval=($catSlug!='')? $catSlug : $catID;
				?>
                    <option value="<?php if($catSlug!=''){echo $catSlug;}else{echo $catID;}?>"<?php if($category==$catID){?> selected="selected"<?php }?>><?php echo stripslashes($catres['SalesCategory']['category_name']);?></option>
                    <?php
				}
                    ?>
                    
                </select>
                <?php }?>
                
                    
    
				<div class="form-group" style="width: 62%;float: right;">
				  <input type="text" class="form-control searchinput" name="postkeywords" id="postkeywords" value="<?php if(isset($postkeywords)){echo $postkeywords;}?>" placeholder="<?php echo SEARCH;?>">
				  <div class="keywrd_pop_top" id="topSrc">
									    
					</div>
                  <button type="button" onclick="searchPost();" class="searchbutton1"></button>
				</div>
                
			  </form>