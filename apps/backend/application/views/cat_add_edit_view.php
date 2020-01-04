<?php include 'header.php';?>

<link href="<?php echo ADMIN_THEME1?>css/pages/dashboard.css" rel="stylesheet">
<?php include 'header_sub.php';?>
<?php include 'sub_menu.php';
$row = $cat_row_data;
?>

<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <section id="my-account-security-form" class="page container">
                        <?php 
                       
                              
                            $attributes = array('id' => 'add_edit_category_form', 'name' => 'add_edit_category_form','method' => 'post','class'=>'form-horizontal');
                            echo form_open('', $attributes);?>
                <div class="container">

                    <div class="alert alert-block alert-info">
                        <p>
                             Fields marked with an asterisk are required.
                        </p>
                    </div>
                    <div class="row">
                        <div >
                            <fieldset>
                                <legend>Category Information</legend><br>
                                
                                <div class="control-group ">
                                    <label class="control-label">Category Name  <span class="required">*</span></label>
                                    <div class="controls <?php echo !empty($errors['name']) ? 'has-error' : ''; ?>">
                                        <input type="text" placeholder="Enter Category Name" name="name" id="name" class="form-control input-inline input-xxlarge" value="<?php echo set_value('name', (isset($row['name']) ? $row['name'] : ''));?>">
											<?php if (!empty($errors['name'])) {
                                ?><span class="help-block"><?php echo $errors['name']; ?></span><?php 
                            }?>

                                    </div>
                                </div>
                                
                                 
								  	<div class="form-actions fluid">
									<div class="col-md-offset-3 col-md-4">
										<?php echo((isset($row['id']) && $row['id']>0)? '<input type="hidden" name="cat_id" id="cat_id" value="'.$row['id'].'">' : '') ;?>
										<button type="submit" class="btn green">Submit</button>
										<button type="button" class="btn default" onclick="window.location='<?php echo DOMAIN_PATH . $this->router->class; ?>'">Cancel</button>
									</div>
					              </div>
                            </fieldset>
                        </div>
                     
                    </div>
              
							
                </div>
           <?php echo form_close();?>
        </section>
      </div>
      <!-- /row --> 
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