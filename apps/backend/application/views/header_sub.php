<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a>
                    <a class="brand" href="<?php echo DOMAIN_PATH?>dashboard">
<!--                    <img src="<?php //echo ADMIN_THEME1?>img/logo_150_117.jpg" width="110px;"> -->
<?php echo $this->site_name;?>
                    
                    </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
           
                  <li><a href="<?php echo DOMAIN_PATH.'clearcache'?>">Clear Cache</a></li>
              
             
              <li><a href="javascript:;">Help</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> <?php echo $this->uname;?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo DOMAIN_PATH?>logout">Logout</a></li>
            </ul>
          </li>
        </ul>
<!--        <form class="navbar-search pull-right">-->
<!--          <input type="text" class="search-query" placeholder="Search">-->
<!--        </form>-->
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>