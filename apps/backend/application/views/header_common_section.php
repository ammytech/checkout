  <div class="float-left">
       <h1 ><?php echo ucfirst($this->router->class);?></h1>
       </div>
       <div class="actions float-right">
       <?php 
       $attributes = array('id' => 'search_'.$this->router->class.'_form','enctype'=>'multipart/form-data', 'name' => 'search_'.$this->router->class.'_form','method' => 'get','class'=>'form-horizontal');
                            echo form_open('', $attributes);?>
                               <input type="text" name="search-text" class='auto'  style="width:300px;" id="search-text" value=""  />
                              <button type="submit" class="btn green">Search </button> &nbsp; &nbsp; &nbsp;
                                <?php echo form_close();?>
                                <?php if ($add_key) {
                                ?>
								<a class="btn default yellow-stripe" href="<?php echo DOMAIN_PATH.$this->router->class.'/add_'.$this->router->class; ?>">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">
										 New <?php echo ucfirst($this->router->class); ?>
									</span>
								</a> 
								<?php 
                            }?>
								
		</div>
		<div class="clear"></div>