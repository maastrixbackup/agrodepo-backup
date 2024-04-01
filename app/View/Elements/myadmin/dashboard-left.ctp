 <!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="<?php echo $base_url;?>myadmin/img/gravatar31.jpg" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Hello, <?php echo $adminRes['AdminLogin']['full_name'];?></p>

            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <?php /*?><form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form><?php */?>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li<?php if($this->request->params['controller']=='AdminLogins' && $this->request->params['action']=='admin_dashboard'){?> class="active"<?php }?>>
            <a href="<?php echo $base_url;?>admin/AdminLogins/dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <!--<li>
            <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
            </a>
        </li>-->
        <li class="treeview<?php if($this->request->params['controller']=='AdminUsers'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Admin</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/AdminUsers/index"><i class="fa fa-angle-double-right"></i> Manage Admin</a></li>
                <li><a href="<?php echo $base_url;?>admin/AdminUsers/add"><i class="fa fa-angle-double-right"></i> Add Admin</a></li>
            </ul>
        </li>

        <!--<li>
            <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
            </a>
        </li>-->
        <li class="treeview<?php if($this->request->params['controller']=='ManageBrands'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Brands</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/ManageBrands/index"><i class="fa fa-angle-double-right"></i> Manage Brand</a></li>
                <li><a href="<?php echo $base_url;?>admin/ManageBrands/add"><i class="fa fa-angle-double-right"></i> Add Brand</a></li>
            </ul>
        </li>
         <li class="treeview<?php if($this->request->params['controller']=='ManageCategories'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Category</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/ManageCategories/index"><i class="fa fa-angle-double-right"></i> Manage Category</a></li>
                <li><a href="<?php echo $base_url;?>admin/ManageCategories/add"><i class="fa fa-angle-double-right"></i> Add Category</a></li>
            </ul>
        </li>
         <li class="treeview<?php if($this->request->params['controller']=='AdminPages'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Page</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/AdminPages/index"><i class="fa fa-angle-double-right"></i> Manage Page</a></li>
                <li><a href="<?php echo $base_url;?>admin/AdminPages/add"><i class="fa fa-angle-double-right"></i> Add Page</a></li>
            </ul>
        </li>
         <li class="treeview<?php if($this->request->params['controller']=='AdminLangs'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Language</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/AdminLangs/index"><i class="fa fa-angle-double-right"></i> Manage Language</a></li>
                <li><a href="<?php echo $base_url;?>admin/AdminLangs/add"><i class="fa fa-angle-double-right"></i> Add Language</a></li>
            </ul>
        </li>
        <li class="treeview<?php if($this->request->params['controller']=='ManageUsers'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage User</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/ManageUsers/index"><i class="fa fa-angle-double-right"></i> Manage User</a></li>
                <li><a href="<?php echo $base_url;?>admin/ManageUsers/add"><i class="fa fa-angle-double-right"></i> Add User</a></li>
            </ul>
        </li>
        <li class="treeview<?php if($this->request->params['controller']=='Banners'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Banners</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/Banners"><i class="fa fa-angle-double-right"></i> Manage Banners</a></li>
                <li><a href="<?php echo $base_url;?>admin/Banners/add"><i class="fa fa-angle-double-right"></i> Add new Banner</a></li>
            </ul>
        </li>
         <li class="treeview<?php if($this->request->params['controller']=='UserMemberships'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Membership</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/UserMemberships"><i class="fa fa-angle-double-right"></i> Manage Memberships</a></li>
                <li><a href="<?php echo $base_url;?>admin/UserMemberships/add"><i class="fa fa-angle-double-right"></i> Add new Membership</a></li>
            </ul>
        </li>
         <li class="treeview<?php if($this->request->params['controller']=='Advertisements'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Advertisements</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/Advertisements"><i class="fa fa-angle-double-right"></i> Manage Advertisements</a></li>
                <li><a href="<?php echo $base_url;?>admin/Advertisements/add"><i class="fa fa-angle-double-right"></i> Add new Advertisement</a></li>
            </ul>
        </li>
         <li class="treeview<?php if($this->request->params['controller']=='ManageSales'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Sales</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/ManageSales"><i class="fa fa-angle-double-right"></i> Manage Sales</a></li>
                <li><a href="<?php echo $base_url;?>admin/ManageSales/add"><i class="fa fa-angle-double-right"></i> Add new Sale</a></li>
                <li><a href="<?php echo $base_url;?>admin/ManageSales/expirepromote"><i class="fa fa-angle-double-right"></i> Deactivate Expire Promotion</a></li>
            	<li><a href="<?php echo $base_url;?>admin/ManageSales/usercredits"><i class="fa fa-angle-double-right"></i>Manage User Credits</a></li>
            </ul>
        </li>
         <li class="treeview<?php if($this->request->params['controller']=='SocialIcons'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Social Icons</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/SocialIcons"><i class="fa fa-angle-double-right"></i> Manage Social Icons</a></li>
                <li><a href="<?php echo $base_url;?>admin/SocialIcons/add"><i class="fa fa-angle-double-right"></i> Add new Social Icons</a></li>
            </ul>
        </li>
		<li class="treeview<?php if($this->request->params['controller']=='NewsLetters'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage NewsLetter</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/NewsLetters"><i class="fa fa-angle-double-right"></i> View Subscriber</a></li>
               <li><a href="<?php echo $base_url;?>admin/NewsLetters/compose_mail"><i class="fa fa-angle-double-right"></i> Compose Mail</a></li>
               <li><a href="<?php echo $base_url;?>admin/NewsLetters/mail_to_subscriber"><i class="fa fa-angle-double-right"></i> Mail To subscriber</a></li>
                <li><a href="<?php echo $base_url;?>admin/NewsLetters/mail_to_subscriber_list"><i class="fa fa-angle-double-right"></i>Sent Mail</a></li>
                <li><a href="<?php echo $base_url;?>admin/NewsLetters/add"><i class="fa fa-angle-double-right"></i> Add new Subscriber</a></li>
            </ul>
        </li>
        <li class="treeview<?php if($this->request->params['controller']=='Payments'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Payments</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/Payments"><i class="fa fa-angle-double-right"></i>Manage Membership Payments</a></li>
                <li><a href="<?php echo $base_url;?>admin/Payments/credits"><i class="fa fa-angle-double-right"></i> Manage Credits</a></li>
            </ul>
        </li>
		<li class="treeview<?php if($this->request->params['controller']=='Reports'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Reports</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/Reports/ask_question"><i class="fa fa-angle-double-right"></i> Ask Qustion</a></li>
                <li><a href="<?php echo $base_url;?>admin/Reports/ask_seller"><i class="fa fa-angle-double-right"></i> Ask Seller</a></li>
                <li><a href="<?php echo $base_url;?>admin/Reports/login_report"><i class="fa fa-angle-double-right"></i> Login Reports</a></li>
				<li><a href="<?php echo $base_url;?>admin/Reports/request_part"><i class="fa fa-angle-double-right"></i> Request Parts</a></li>
                <li><a href="<?php echo $base_url;?>admin/Reports/bid_offer"><i class="fa fa-angle-double-right"></i> Bid Offer</a></li>
                <li><a href="<?php echo $base_url;?>admin/Reports/sales_order"><i class="fa fa-angle-double-right"></i> Sales Order</a></li>
                <li><a href="<?php echo $base_url;?>admin/Reports/requestorder"><i class="fa fa-angle-double-right"></i> Request Parts Order</a></li>
                <li><a href="<?php echo $base_url;?>admin/Reports/parkquestion"><i class="fa fa-angle-double-right"></i> Park Question</a></li>
            </ul>
        </li>
        
       <?php /*?> <li>
            <a href="<?php echo $base_url;?>admin/Payments">
                <i class="fa fa-bar-chart-o"></i> <span>Manage Payments</span>
            </a>
        </li><?php */?>
        <li class="treeview<?php if($this->request->params['controller']=='News'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage News</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/News"><i class="fa fa-angle-double-right"></i>Manage News</a></li>
				<li><a href="<?php echo $base_url;?>admin/News/add"><i class="fa fa-angle-double-right"></i>Add News</a></li>
            </ul>
        </li>
         <li class="treeview<?php if($this->request->params['controller']=='SuccessStories'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Success Stories</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/SuccessStories"><i class="fa fa-angle-double-right"></i>Manage Success Stories</a></li>
				<li><a href="<?php echo $base_url;?>admin/SuccessStories/add"><i class="fa fa-angle-double-right"></i>Add Success Stories</a></li>
            </ul>
        </li>
        <li class="treeview<?php if($this->request->params['controller']=='Themes'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage Themes</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/Themes"><i class="fa fa-angle-double-right"></i>Manage Themes</a></li>
				<li><a href="<?php echo $base_url;?>admin/Themes/add"><i class="fa fa-angle-double-right"></i>Add Properties</a></li>
            </ul>
        </li>
        <li class="treeview<?php if($this->request->params['controller']=='MasterMessages'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Success Messages</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/MasterMessages"><i class="fa fa-angle-double-right"></i>Manage Success Mesages</a></li>
				<li><a href="<?php echo $base_url;?>admin/MasterMessages/add"><i class="fa fa-angle-double-right"></i>Add success message</a></li>
            </ul>
        </li>
         <li class="treeview<?php if($this->request->params['controller']=='seoFields'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Manage SEO</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/seoFields"><i class="fa fa-angle-double-right"></i>Manage SEO</a></li>
				<li><a href="<?php echo $base_url;?>admin/seoFields/add"><i class="fa fa-angle-double-right"></i>Add SEO</a></li>
            </ul>
        </li>
         <li class="treeview<?php if($this->request->params['controller']=='BackupDbs'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/EmailTemplates"><i class="fa fa-angle-double-right"></i>Manage Email Template</a></li>
                <li><a href="<?php echo $base_url;?>admin/BackupDbs"><i class="fa fa-angle-double-right"></i>Manage Backup Files</a></li>
            </ul>
        </li>
        <li class="treeview<?php if($this->request->params['controller']=='AdminLogins'){?> active<?php }?>">
            <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Site Setting</span>
                <i class="fa fa-angle-left pull-right"></i>
            <ul class="treeview-menu">
                <li><a href="<?php echo $base_url;?>admin/AdminLogins/sitesetting"><i class="fa fa-angle-double-right"></i>Manage Logo</a></li>
                <li><a href="<?php echo $base_url;?>admin/AdminLogins/loclist"><i class="fa fa-angle-double-right"></i>Manage Location</a></li>
                <li><a href="<?php echo $base_url;?>admin/AdminLogins/locsave"><i class="fa fa-angle-double-right"></i>Add Location</a></li>
            </ul>
        </li>
      
    </ul>
</section>
<!-- /.sidebar -->