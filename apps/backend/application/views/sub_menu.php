<!-- /navbar -->
<div class="subnavbar nav">
<div class="menu-expand"><span>Show Menu</span>

    </div>
  <div class="subnavbar-inner ">
    <div class="container ">
      <ul class="mainnav ">
     
        <li class="<?php echo($this->uri->segment(1)=='dashboard'?'active':'');?>"><a href="<?php echo DOMAIN_PATH?>dashboard"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>

         <li class="dropdown <?php echo($this->uri->segment(1)=='category'?'active':'');?>"><a class="dropdown" href="<?php echo DOMAIN_PATH?>category"> <i class="icon-list-alt"></i><span> Category</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo DOMAIN_PATH?>category/addCategory">Add Category</a></li>
          </ul>
        </li>
        <li class="dropdown <?php echo($this->uri->segment(1)=='product'?'active':'');?>"><a class="dropdown" href="<?php echo DOMAIN_PATH?>product"> <i class="icon-list-alt"></i><span> Product</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo DOMAIN_PATH?>product/addProduct">Add Product</a></li>
          </ul>
        </li>
       
       <li class="<?php echo($this->uri->segment(1)=='orders'?'active':'');?>"><a href="<?php echo DOMAIN_PATH?>orders"><i class="icon-list-alt"></i><span>Orders</span> </a> </li>
       
        
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
