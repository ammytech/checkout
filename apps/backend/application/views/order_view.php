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
      
    
                                 
							
								
								
								
		</div>
		<div class="clear"></div>
	  
       <hr>
<div class="table-responsive">
    <table class="table table-striped table-bordered ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name </th>
                <th>Quanity </th>
                 <th>Price </th>
                  <th>Created Datetime </th>
              
            </tr>

        </thead>
        <tbody>
            <?php 
          
            foreach ($result as $row) {
                ?>
            
            <tr>
                <td><?php echo $row['oid']?></td>
                <td><?php echo '<br><h4>'.$row['title'].'</h4>'; ?> </td>
                <td><?php echo $row['quantity']?></td>
                <td><?php echo $row['price']?></td>
                <td><?php echo $row['created_at']?></td>
               
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