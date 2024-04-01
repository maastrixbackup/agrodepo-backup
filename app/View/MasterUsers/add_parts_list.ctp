<h3>Last call for tenders resolved</h3>
<table>
	<?php foreach($request_list as $req_lst){ ?>
			<tr>
				<td>
					Request Name:- <?php echo $req_lst['SalesAddPart']['name_piece']; ?><br>
					Description:- <?php echo $req_lst['SalesAddPart']['description']; ?><br>
					Brand:- <?php echo $this->Custom->brand_nm($req_lst['SalesAddPart']['brand_id']);  ?><br>
					Model:- <?php echo $this->Custom->brand_nm($req_lst['SalesAddPart']['model_id']); ?><br>
					Region and City:- <?php echo $this->Custom->region_nm($req_lst['SalesAddPart']['country_id'])."(".$this->Custom->location_nm($req_lst['SalesAddPart']['location_id']).')'; ?><br>
					Requested date:- <?php echo $req_lst['SalesAddPart']['created']; ?><br>
				</td>
			</tr>
	<?php } ?>
</table>

