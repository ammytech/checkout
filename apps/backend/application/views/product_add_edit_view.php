<?php include 'header.php';?>
<link href="<?php echo ADMIN_THEME1?>css/pages/dashboard.css" rel="stylesheet">
<?php include 'header_sub.php';?>
<?php include 'sub_menu.php';
$row = $product_row_data;
?>

<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <section id="my-account-security-form" class="page container">
                        <?php 
                       
                               if (!empty($image_error)) {
                                   ?>
						     <div class="alert  alert-error">
						     <a href="#" class="close" data-dismiss="alert">&times;</a>
		                        <p>
		                            <?php echo $image_error; ?>
		                        </p>
		                    </div>	
						   <?php 
                               }
                            $attributes = array('id' => 'add_edit_product_form','enctype'=>'multipart/form-data', 'name' => 'add_edit_product_form','method' => 'post','class'=>'form-horizontal');
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
                                <legend>Product Information</legend><br>
                                
                                <div class="control-group ">
                                    <label class="control-label">Title  <span class="required">*</span></label>
                                    <div class="controls <?php echo !empty($errors['title']) ? 'has-error' : ''; ?>">
                                        <input type="text" placeholder="Enter Title" name="title" id="title" class="form-control input-inline input-xxlarge" value="<?php echo set_value('title', (isset($row['title']) ? $row['title'] : ''));?>">
											<?php if (!empty($errors['title'])) {
                                ?><span class="help-block"><?php echo $errors['title']; ?></span><?php 
                            }?>

                                    </div>
                                </div>
                                
                                 <div class="control-group ">
                                    <label class="control-label">Slug <span class="required">*</span></label>
                                    <div class="controls <?php echo !empty($errors['slug']) ? 'has-error' : ''; ?>">
                                        <input type="text" placeholder="" name="slug" id="slug" class="form-control input-inline input-xxlarge" value="<?php echo set_value('slug', (isset($row['slug']) ? $row['slug'] : ''));?>">
											<?php if (!empty($errors['slug'])) {
                                ?><span class="help-block"><?php echo $errors['slug']; ?></span><?php 
                            }?>
                                        <input type="hidden" name="old_slug" id="old_slug"  value="<?php echo(isset($row['slug']) ? $row['slug'] : '');?>">
										
                                    </div>
                                </div>

                                <div class="control-group ">
                                    <label class="control-label">Summary </label>
                                    <div class="controls <?php echo !empty($errors['summary']) ? 'has-error' : ''; ?>">
										<textarea rows="6" name="summary" id="summary" class="form-control input-inline input-xxlarge"><?php echo set_value('summary', (isset($row['summary']) ? $row['summary'] : ''));?></textarea>	
										
                                       <?php if (!empty($errors['summary'])) {
                                ?><span class="help-block"><?php echo $errors['summary']; ?></span><?php 
                            }?>
                                    </div>
                                </div>
                               
                               
                                <div class="control-group ">
                                    <label class="control-label">Description  </label>
                                    <div class="controls <?php echo !empty($errors['description']) ? 'has-error' : ''; ?>">
										<textarea rows="6" name="description" id="description" ><?php echo set_value('description', (isset($row['description']) ? $row['description'] : ''));?></textarea>	
										
                                        <?php if (!empty($errors['description'])) {
                                ?><span class="help-block"><?php echo $errors['description']; ?></span><?php 
                            }?>
                                    </div>
                                </div>
                               
                                 <div class="control-group ">
                                    <label class="control-label">Category <span class="required">*</span>	</label>
                                    <div class="controls <?php echo !empty($errors['category_term[]']) ? 'has-error' : ''; ?>">
                            <?php 
                                         $i = 0;
                                         $category_term_old = '';
                                         foreach ($category as $row_cat) {
                                             ?>
											<label class="">
											
											<?php $check_con = false;
                                             foreach ($category_attached as $row_att) {
                                                 if ($row_att['categoryId'] == $row_cat['id']) {
                                                     $category_term_old .=$row_att['categoryId'].',';
                                                     $check_con = true;
                                                     break;
                                                 }
                                             } ?>
											<input type="checkbox" class="category_term" name="category_term[]" id="category_term['<?php echo $i; ?>']"  <?php echo set_checkbox('category_term[]', $row_cat['id'], $check_con); ?> value="<?php echo $row_cat['id']; ?>" >
										<?php echo strtoupper($row_cat['name']); ?> 
											</label>
										<?php $i++;
                                         }?>
										<input type="hidden" name="category_term_old" value="<?php echo rtrim($category_term_old, ',');?>">				 
								 <?php if (!empty($errors['category_term[]'])) {
                                             ?><span class="help-block"><?php echo $errors['category_term[]']; ?></span><?php 
                                         }?>
										                       
									</div>
								 </div>
								 <div class="control-group ">
                                    <label class="control-label">Price  <span class="required">*</span></label>
                                    <div class="controls <?php echo !empty($errors['price']) ? 'has-error' : ''; ?>">
                                        <input type="text" placeholder="Enter Price" name="price" id="price" class="form-control input-inline input-large" value="<?php echo set_value('price', (isset($row['price']) ? $row['price'] : ''));?>">
											<?php if (!empty($errors['price'])) {
                                             ?><span class="help-block"><?php echo $errors['price']; ?></span><?php 
                                         }?>

                                    </div>
                                </div>
                               <div class="control-group ">
                                    <label class="control-label">Price Rules</label> <span> example : {"multiItemSelectDiscount":{"quantity":3,"discount":15}} </span>
                                    <div class="controls <?php echo !empty($errors['price_rules']) ? 'has-error' : ''; ?>">
                                        <input type="text" placeholder="Enter Price" name="price_rules" id="price_rules" class="form-control input-inline input-large" value="<?php echo set_value('price_rules', (isset($row['price_rules']) ? $row['price_rules'] : ''));?>">
											<?php if (!empty($errors['price_rules'])) {
                                             ?><span class="help-block"><?php echo $errors['price_rules']; ?></span><?php 
                                         }?>

                                    </div>
                                </div>
                                  <div class="control-group ">
                                    <label class="control-label"> <?php echo((!empty($row['img']) && file_exists(PRODUCT_IMG_ABS_PATH.$row['img']))? 'Edit ' :'');?> Image </label>
                                    <div class="controls <?php echo !empty($errors['p_image']) ? 'has-error' : ''; ?>">
                                        <input type="file" name="p_image" id="p_image" >
											<?php if (!empty($errors['p_image'])) {
                                             ?><span class="help-block"><?php echo $errors['p_image']; ?></span><?php 
                                         }?>
											
											<?php echo((!empty($row['img']) && file_exists(PRODUCT_IMG_ABS_PATH.$row['img']))? '<p><img src="'.PRODUCT_IMG_PATH.str_ireplace('_500x400', '_100x80', $row['img']).'"><input type="hidden" name="p_image_path" id="p_image_path" value="'.$row['img'].'"></p>' : '');?>
										
                                    </div>
                                </div>
                              
								  	<div class="form-actions fluid">
									<div class="col-md-offset-3 col-md-4">
										<?php echo((isset($row['id']) && $row['id']>0)? '<input type="hidden" name="product_id" id="product_id" value="'.$row['id'].'">' : '') ;?>
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
<script src="<?php echo ASSET_PATH?>ckeditor/ckeditor.js" charset="utf-8"></script>
             <script>
             var ck_path = '<?php echo ASSET_PATH?>';
           
                   CKEDITOR.replace( 'description', {
                	   "filebrowserImageUploadUrl": ""+ck_path+"ckeditor/plugins/imgupload.php"
                   } );
                   
              
                
            </script>
<script>
<?php if (!isset($row['id'])) {
    ?>
$( "#title" ).change(function() {
	  slug = convertToSlug($( "#title" ).val());
	  if(slug.length >2){
		  $( "#slug" ).val(slug);
	  }
	});
<?php 
}?>
function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/-/g, ' ')
        .replace(/\s\s+/g, ' ')
        .replace(/^[ ]+|[ ]+$/g,'')
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        .replace(/--/g, '-')
        
        ;
}
</script>
<link href="<?php echo ADMIN_THEME1?>css/autosuggest.css" rel="stylesheet">
<script src="<?php echo ADMIN_THEME1?>js/autosuggest.js"></script>
<script type="text/javascript">
var base_url = '<?php echo DOMAIN_PATH;?>';
$(function() {
    $(".auto-celeb").coolautosuggest({
    	url:base_url+"product?term=",
    	minChars:3,
        appendText:1
        
    });             

});
</script>
</body>
</html>