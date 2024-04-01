 <!-- Main content -->
 <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Success Stories</h3>
                                    <div class="box-tools">
                                        <div class="box-tools pull-right">
                                  <button class="btn btn-primary btn-flat" onclick="location.href='<?php echo $base_url;?>admin/SuccessStories/add'">Add News</button>
                                       
                                </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                       <tr>
                                            <th><?php echo $this->Paginator->sort('success_id', 'SL#'); ?></th>
                                            <th><?php echo $this->Paginator->sort('user_id', 'User Name'); ?></th>
                                            <th><?php echo $this->Paginator->sort('submit_from', 'Submit By'); ?></th>
                                            <th><?php echo $this->Paginator->sort('created', 'Post Date'); ?></th>
                                            <th class="actions"><?php echo __('Actions'); ?></th>
                                    </tr>
                                        <?php 
										$pageno=$this->request->params['paging']['SuccessStory']['page'];
									$perpage=$this->request->params['paging']['SuccessStory']['limit'];
									if(!empty($successStories))
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
										foreach ($successStories as $successStory): ?>
                                       <tr>
                                            <td><?php echo $usercount; ?>&nbsp;</td>
                                            <td><?php 
											$user_details=$this->Custom->user_details($successStory['SuccessStory']['user_id']);
											echo $user_details['first_name'].' '.$user_details['last_name'];
											 ?>&nbsp;</td>
                                            <td><?php 
											$submitarr=array(0 => 'Admin', 1 => 'User');
											echo $submitarr[$successStory['SuccessStory']['submit_from']]; ?>&nbsp;</td>
                                            <td><?php echo date("d-m-Y", strtotime($successStory['SuccessStory']['created'])); ?>&nbsp;</td>
                                            <td class="actions">
                                                <?php echo $this->Html->link(__('View'), array('action' => 'view', $successStory['SuccessStory']['success_id'])); ?>
                                                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $successStory['SuccessStory']['success_id'])); ?>
                                                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $successStory['SuccessStory']['success_id']), null, __('Are you sure you want to delete # %s?', $successStory['SuccessStory']['success_id'])); ?>
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

