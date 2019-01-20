<?php if(!defined('PARENT')) { exit; }

/* LOGIN TEMPLATE
----------------------------------*/

define('LOGIN_SCREEN', 1);
?>

    <div class="row">
      <div class="col-lg-9 col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-lock fa-fw"></i> <?php echo $this->LTEXT[0]; ?>
          </div>
          <div class="panel-body" id="logbody">
            <form method="post" action="#">
            <div class="form-group">
              <label><?php echo $this->LTEXT[1]; ?></label>
              <input type="text" name="fm[usr]" value="" class="form-control" onkeypress="if(mswKC(event)==13){mswAcs()}">
            </div>
            <div class="form-group">
              <label><?php echo $this->LTEXT[2]; ?></label>
              <input type="password" name="fm[pwd]" value="" class="form-control" onkeypress="if(mswKC(event)==13){mswAcs()}">
            </div>
            <div class="form-group text-center">
              <input type="hidden" name="fm[jnl]" value="<?php echo (isset($this->JOURNAL['id']) ? $this->JOURNAL['id'] : '0'); ?>">
              <input type="hidden" name="fm[cat]" value="<?php echo (isset($this->CATEGORY['id']) ? $this->CATEGORY['id'] : '0'); ?>">
              <button class="btn btn-success" type="button" onclick="mswAcs()"><i class="fa fa-sign-in fa-fw"></i> <?php echo $this->LTEXT[3]; ?></button>
            </div>
            </form>
          </div>
        </div>

      </div>
      <div class="col-lg-3 col-md-4">
        <?php
        include(dirname(__file__) . '/right-panel.tpl.php');
        ?>
      </div>
    </div>


