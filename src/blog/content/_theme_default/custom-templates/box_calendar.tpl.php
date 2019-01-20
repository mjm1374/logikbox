<?php if(!defined('PARENT') || empty($this->BOXES)) { exit; }

/* CUSTOM TEMPLATE - CALENDAR
   You can use any element from the box array:

   print_r($this->BOXES[$i])

   Or manually add your own code.
-----------------------------------------------*/

?>

        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-<?php echo $this->BOXES[$i]['icon']; ?> fa-fw"></i> <?php echo $this->BOXES[$i]['title']; ?>
          </div>
          <div class="panel-body">
            <div class="jcalendar">
            <?php
            // html/calendar-*.htm
            echo $this->CALENDAR;
            ?>
            </div>
            <div class="jcalendar_search" style="display:none">
              <select class="form-control" name="fm[calmnth]">
               <option value="-"><?php echo $this->GTEXT[1]; ?></option>
               <?php
               // html/option.htm
               echo $this->SELECT['months'];
               ?>
              </select>
              <select class="form-control" name="fm[calyr]">
               <option value="-"><?php echo $this->GTEXT[2]; ?></option>
               <?php
               // html/option.htm
               echo $this->SELECT['years'];
               ?>
              </select>
              <div class="text-center">
                <hr>
                <button class="btn btn-success btn-xs" type="button" onclick="mswCal('monthload')"><i class="fa fa-chevron-right fa-fw"></i></button>
                <button class="btn btn-default btn-xs calclose" type="button" onclick="mswCalOps('closemonthload')"><i class="fa fa-times fa-fw"></i></button>
              </div>
            </div>
          </div>
          <?php
          // Should we show reset panel on load..
          // We hide it via display as calendar navigation will require it be shown if month isn`t current month..
          ?>
          <div class="panel-footer calresetpanel"<?php echo ($this->GOPS['creset'] == 'no' ? ' style="display:none"' : ''); ?>>
            <a href="#" onclick="mswCal('reset');return false"><i class="fa fa-refresh fa-fw"></i> <?php echo $this->GTEXT[0]; ?></a>
          </div>
        </div>