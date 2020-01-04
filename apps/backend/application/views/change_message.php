<?php 
      if ($this->session->flashdata($this->flash_sess_name)) {
          ?>
    <div class="alert alert-success">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

      <?php 
      $exp_flash_data = explode('~~', $this->session->flashdata($this->flash_sess_name));
      //print_r($exp_flash_data);exit;
      if (isset($exp_flash_data[0]) && $exp_flash_data[0]=='custom') {
          echo '<strong>'.($exp_flash_data[1]).'</strong>';
      } else {
          $change_mes = ((isset($exp_flash_data[2])?$exp_flash_data[2]:' Changed ').' : ');
          echo '<strong>'.($exp_flash_data[0]>0?''.strtoupper($this->router->class).'  '.$change_mes.' : ':'New '.strtoupper($this->router->class).' '.$change_mes).'</strong>'.$exp_flash_data[1];
      } ?>
      </div>
      <?php 
      }?>