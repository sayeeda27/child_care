<div class="reg-area text-center">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="reg-title text-center">
            <h3>LogIn</h3>
        </div>
      </div>
    </div>
     <div class="reg-form">
        <form method="post" action="<?php echo base_url();?>welcome/validation">
                <input type="text" class="form-control" name="user_email" placeholder="user email" value="<?php echo set_value('user_email');?>">
                <span class="text-danger"><?php echo form_error('user_email'); ?></span>
                <input type="password" class="form-control" name="user_password" placeholder="user password" value="<?php echo set_value('user_password');?>">
                <span class="text-danger"><?php echo form_error('user_password'); ?></span>
                <button type="submit" name ="login" value="Login" class="btn" >Login</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>welcome">Register</a>
                
        </form>
     </div>
      <?php
        echo $message;     
     ?>
  </div>
</div>