<script type="text/javascript">
function createBackup()
{
	$("#backupDB").html("Processing...");
	$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url;?>backupdb/backupdb.php',
				data: 'createdb=yes',
				success: function(data) {
					if(data==1)
					{
						$("#backupDB").html("Create Backup");
						alert("Database Backup successfully");
						location.reload();
					}
					else
					{
						$("#backupDB").html("Create Backup");
						alert("Database Backup failed");
					}
				}
			});

}
function restoredb(filename)
{
	$("#showloader").show();
	$("#restore").html("Processing...");
	$.ajax(
			{
				type: 'POST',
				url: '<?php echo $base_url;?>backupdb/restoredb.php',
				data: 'do=restore&filename='+filename,
				success: function(data) {
					if(data==1)
					{
						$("#showloader").hide();
						$("#restore").html("Restore");
						alert("Database imported successfully");
						location.reload();
					}
					else
					{
						$("#showloader").hide();
						$("#restore").html("Restore");
						alert("Database importing failed");
					}
				}
			});

}
</script>
 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Backup Files</h3>
                                    <div class="box-tools">
                                        <div class="box-tools pull-right">
                                  <button class="btn btn-primary btn-flat" onclick="return createBackup();" id="backupDB">Create Backup</button>
                                       
                                </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                      <tr>
                                            <th><?php echo $this->Paginator->sort('backup_id', 'SL#'); ?></th>
                                            <th><?php echo $this->Paginator->sort('backup_file', 'File Name'); ?></th>
                                            <th><?php echo $this->Paginator->sort('created', 'Backup Date'); ?></th>
                                            <th class="actions"><?php echo __('Actions'); ?></th>
                                    </tr>
                                        <?php 
										$pageno=$this->request->params['paging']['BackupDb']['page'];
									$perpage=$this->request->params['paging']['BackupDb']['limit'];
									//pr($backupDbs);
									if(!empty($backupDbs))
									{
										if($pageno!=1)
										{
											
											$usercount=$perpage*$pageno;
											$usercount=($usercount-$perpage)+1;
										}
										else
										{
											$usercount=1;	
										} 
										foreach ($backupDbs as $backupDb): ?>
                                       <tr>
                                            <td><?php echo $usercount; ?>&nbsp;</td>
                                           <td><a href="<?php echo $base_url;?>download.php?filename=<?php echo $backupDb['BackupDb']['backup_file']; ?>&fileprefix=<?php echo $backupDb['BackupDb']['backup_file']; ?>"><?php echo h($backupDb['BackupDb']['backup_file']); ?></a>&nbsp;</td>
                                            <td><?php echo h($backupDb['BackupDb']['created']); ?>&nbsp;</td>
                                            <td class="actions">
                                                <img src="<?php echo $base_url;?>images/ajax-loader.gif" alt="" style="margin-right:5px; width:20px; display:none" id="showloader" />
                                                <a href="javascript:void(0);" id="restore"  onclick="return restoredb('<?php echo $backupDb['BackupDb']['backup_file']; ?>');">Restore</a>
                                                <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $backupDb['BackupDb']['backup_id'])); ?>
                                                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $backupDb['BackupDb']['backup_id']), null, __('Are you sure you want to delete # %s?', $backupDb['BackupDb']['backup_id'])); ?>
                                            </td>
                                        </tr>
                                    <?php
									$usercount++;
									 endforeach;
									}?>
                                    </table>
                                   
                                </div><!-- /.box-body -->
                               
                            </div><!-- /.box -->
                             <div class="clearfix"></div>
                                 
									<div class="float_left"><?php
                                    echo $this->Paginator->counter(array(
                                    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                                    ));
                                    ?></div>
                                    <div class="paging">
								<?php
                                    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                    echo $this->Paginator->numbers(array('separator' => ''));
                                    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                                ?>
                                </div>
                        </div>
                    </div>
                </section><!-- /.content -->

