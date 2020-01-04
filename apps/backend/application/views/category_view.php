<?php 

include 'header.php';?>
<link href="<?php echo ADMIN_THEME1?>css/pages/dashboard.css" rel="stylesheet">
<?php include 'header_sub.php';?>
<?php include 'sub_menu.php';?>
<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
       <?php include 'change_message.php';?>
      
	  <div class="float-left">
      <h1 ><?php echo ucfirst($this->router->class);?></h1>
       </div>
       <div class="actions float-right">
      
    
                                 
								<a class="btn default yellow-stripe" href="<?php echo DOMAIN_PATH . $this->router->class.'/addCategory';?>">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">
										 New <?php echo ucfirst($this->router->class);?>
									</span>
								</a> 
								
								
								
		</div>
		<div class="clear"></div>
	  
       <hr>
<div class="table-responsive">
    <table class="table table-striped table-bordered ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name </th>
                <th>Action </th>
                <th> Status</th>
            </tr>

        </thead>
        <tbody>
            <?php 
          
            foreach ($result as $row) {
                ?>
            
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo '<br><h4>'.$row['name'].'</h4>'; ?> </td>
                 <td >
			                     <div class="dropdown">
								    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
								    <span class="caret"></span></button>
								    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								      
								      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo DOMAIN_PATH . $callEditurl?>/<?php echo $row['id']?>">EDIT</a></li>
<!--								      <li role="presentation" class="divider"></li>-->
								     
								    </ul>
								  </div>
			                </td>
			<?php 
            if ($row['status'] == '1') {
                $status = ' <a class="unpublish" title="click to unpublish" id="a_tag_'.$row['id'].'" href="javascript:publish('.$row['id'].',0,\''.$callPubUrl.'\',\'a_tag_'.$row['id'].'\')">unpublish '.$loader.'</a> ';
            } elseif ($row['status'] == '0') {
                $status = ' <a class="publish" title="click to publish" id="a_tag_'.$row['id'].'" href="javascript:publish('.$row['id'].',1,\''.$callPubUrl.'\',\'a_tag_'.$row['id'].'\')">publish '.$loader.'</a>';
            } else {
                $status = 'deleted';
            } ?>
                
                <td class="table-status"><?php echo $status; ?></td>
            </tr>
            <?php 
            }?>
        </tbody>

    </table>
   
</div>
      
      </div>
      <!-- /row --> 
        <div class="row row-centered">
        <div class="col-xs-6 col-centered">
<?php echo $this->pagination->create_links();?>
</div>
</div>
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->

<?php 
$footer_html = '1';
include 'footer.php';?>

</body>
</html>