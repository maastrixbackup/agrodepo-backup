<?php
echo $this->element('myadmin/header-dashboard');
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
            <?php echo $this->element('myadmin/dashboard-left');?>
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Manage users
                        <small>&nbsp;</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $base_url;?>admin/AdminLogins/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><a href="<?php echo $base_url;?>admin/AdminUsers/">Manage Users</a></li>
                        <!--<li class="active">Simple</li>-->
                    </ol>
                </section>
				<?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content');?>
               
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
<?php
echo $this->element('myadmin/footer-dashboard');
?>