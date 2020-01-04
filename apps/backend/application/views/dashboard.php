<?php include 'header.php'; ?>
<link href="<?php echo ADMIN_THEME1?>css/pages/dashboard.css" rel="stylesheet">
<?php include 'header_sub.php';?>
<?php include 'sub_menu.php';?>
<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
    <?php if (!empty($this->session->flashdata('cache_cleared'))) {
    ?>
                 <div class="alert alert-success">Success! Well done CACHE Cleared.</div>
       <?php 
}?>
      <div class="row">
       
        <div class="span12">
          <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Important Shortcuts</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="shortcuts"> 
              
            
                                            
                                            <a href="<?php echo DOMAIN_PATH.'category/addCategory'?>" class="shortcut"><i class="shortcut-icon icon-list-alt"></i> 
                                            <span class="shortcut-label">Add Category</span> </a>
<!--                                            <a href="javascript:;" class="shortcut"> <i class="shortcut-icon icon-comment"></i>-->
<!--                                            <span class="shortcut-label">Comments</span> </a>-->
<!--                                            <a href="<?php //echo DOMAIN_PATH?>users" class="shortcut"><i class="shortcut-icon icon-user"></i><span-->
<!--                                                class="shortcut-label">Users</span> </a>-->
<!--                                                <a href="javascript:;" class="shortcut"><i-->
<!--                                                    class="shortcut-icon icon-file"></i><span class="shortcut-label">Notes</span> </a>-->
<!--                                                    <a href="javascript:;" class="shortcut"><i class="shortcut-icon icon-picture"></i> -->
<!--                                                    <span class="shortcut-label">Photos</span> </a><a href="javascript:;" class="shortcut"> -->
<!--                                                    <i class="shortcut-icon icon-tag"></i><span class="shortcut-label">Tags</span> </a> -->
               </div>
              <!-- /shortcuts --> 
            </div>
            <!-- /widget-content --> 
          </div>
         
         
         
          <!-- /widget -->
        </div>
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->

<?php include 'footer.php';?>