  <?php include 'header.php'; ?> 
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Search Products</h2>
                        <form action="#">
                            <input type="text" placeholder="Search products...">
                            <input type="submit" value="Search">
                        </form>
                    </div>
                    
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Products</h2>
						<?php foreach ($products as $row) {
    ?>
                        <div class="thubmnail-recent">
                            
                            <h2><a href="#"><?php echo $row['title']; ?></a></h2>
                            <div class="product-sidebar-price">
                                 <ins><?php echo $row['price']?></ins> <del><?php echo $row['price']*$this->discount_rate?></del>
                            </div>                             
                        </div>
                       <?php 
}?>
                    </div>
                    
                   
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="<?php echo frontend_base_url?>shopping/checkout">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">Action</th>
                                          
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                          
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
										<?php     foreach ($this->cart->contents() as $key=>$row) {
    ?>
										 <tr class="cart_item remove_product_<?php echo $row['rowid']; ?>">
                                            <td class="product-remove">
                                                <a title="Remove this item" data="<?php echo $row['rowid']; ?>" class="remove" href="javascript:void(0)">×</a> 
                                            </td>
                                            <td class="product-name">
                                                <a href="single-product.html"><?php echo $row['name']; ?></a> 
                                            </td>
                                            <td class="product-price">
                                                <span class="amount"><?php echo $this->currency_code.' '.$row['subtotal']; ?></span> 
                                            </td>
										  </tr>
                                        <?php 
}?>
                                  
                                        
                                        <tr>
                                            <td class="actions" colspan="6">
                                               
                                               
                                                <input type="submit" value="Proceed to Checkout" name="proceed" class="checkout-button button alt wc-forward">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>

                            <div class="cart-collaterals">


                            <div class="cross-sells">
                                <h2>You may be interested in...</h2>
                                <ul class="products">
                                    <li class="product">
                                        
                                    </li>

                                    <li class="product">
                                       
                                    </li>
                                </ul>
                            </div>


                            <div class="cart_totals ">
                                <h2>Cart Totals</h2>

                                <table cellspacing="0">
                                    <tbody>
                                        

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td>Free Shipping</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount cart-amount"><?php echo $this->currency_code.' '.$this->cart_amount?></span></strong> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            </div>
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php';?>