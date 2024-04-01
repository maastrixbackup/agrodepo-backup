<div>
<h3><?php echo COMPANYSETTINGPARCPARTS;?></h3>
</div>
<?php if(isset($comp_nm_lst) && is_array($comp_nm_lst)){ ?>
	<table>
	<tr>
		<th><?php echo NAME;?></th>
		<th><?php echo STATUS;?></th>
		<th><?php echo OPTIONS;?></th>
	</tr>
	<?php foreach($comp_nm_lst as $complst){ //echo "<pre>";print_r($complst);exit; ?>
				<tr>
					<td><?php echo str_replace('_SRL','',str_replace('SC_','',$complst['SalesFleetTruck']['comp_name']));?></td>
					<td><?php if($complst['SalesFleetTruck']['status']==0){
						echo "Inactive";
					}else{
						echo "Active";
					}?>
					</td>
					<td><a href="<?php echo $this->webroot.'MasterUsers/add_fleet_truck/'.$complst['SalesFleetTruck']['fleet_id']?>"><?php echo EDIT;?></a></td>
				</tr>
	<?php } ?>
</table>
<?php
}else{
	echo "You have not added any company or fleet of truck parts. ";
}

?>
<a href="<?php echo $this->webroot.'MasterUsers/add_fleet_truck'?>"><?php echo FLEETOFTRUCK;?>» </a><br/>
or<a href="<?php echo $this->webroot.'MasterUsers/firm_parts'?>"> <?php echo ADDCOMPANYCARPARTS;?> » </a>
