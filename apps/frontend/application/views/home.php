
   <?php include 'header.php';?> 
   
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel">
                        
                        <?php foreach ($products as $row) {
						?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="<?php echo PRODUCT_IMG_PATH.$row['img']; ?>" alt="">
                                    
                                    <div class="product-hover">
                       <?php

                        // Create form and send values in 'shopping/add' function.
                        $attributes = array('id' => 'addCart_'.$row['id'], 'name' => 'addCart_'.$row['id'],'method' => 'post','class'=>'');
						echo form_open('', $attributes);
						echo form_hidden('id', $row['id']);
						echo form_hidden('name', $row['title']);
						echo form_hidden('price', $row['price']); ?>
                          <a href="javascript:void(0)" class="add-to-cart-link" data="<?php echo $row['id']?>">
                          <i class="fa fa-shopping-cart"></i> Add to cart</a>
                       <?php
                        $btn = array(
                            'class' => 'addCart_btn_ hide',
                        );
                        
                        // Submit Button.
                        echo form_submit($btn);
						echo form_close(); ?>
                        
   
                                    </div>
                                </div>
                                
                                <h2><a href="#"><?php echo $row['title']; ?></a></h2>
                                
                                <div class="product-carousel-price">
                                    <ins><?php echo $row['price']?></ins> <del><?php echo $row['price']*$this->discount_rate?></del>
                                </div> 
                            </div>
                           <?php 
							}?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    

 
    <?php include 'footer.php';?>