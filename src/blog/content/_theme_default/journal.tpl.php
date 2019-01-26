<?php if(!defined('PARENT')) { exit; }

/* JOURNAL TEMPLATE
----------------------------------*/

?>

    <div class="row">
      <div class="col-lg-9 col-md-8">
        <div class="panel panel-default journalpagearea">
          <div class="panel-heading">
            <i class="fa fa-pencil fa-fw"></i> <?php echo $this->JDATA['title']; ?>
          </div>
          <div class="panel-body">
            <?php
            // Journal post..
            echo $this->JDATA['journal'];
            ?>
          </div>
          <div class="panel-footer postedby">
            <?php
            // If private, show padlock..
            if ($this->JDATA['private'] == 'yes') {
            ?>
            <span class="pull-right">
              <i class="fa fa-lock fa-fw"></i>
            </span>
            <?php
            }
            // Staff name who posted and publish time..
            echo '<i class="fa fa-user fa-fw"></i> ' . $this->JDATA['staff'];
            echo '&nbsp;&nbsp;&nbsp;<span class="jcal"><i class="fa fa-calendar fa-fw"></i> ' . $this->JDATA['pubdate'] . ' / ' . $this->JDATA['pubtime'];
            ?></span>
          </div>
        </div>

        <?php
        // AddThis social shares div..
        // Hidden initially, will show if plugin is found..
        ?>
        <div class="panel panel-default tags addthis_div" style="display:none">
          <div class="panel-body">
            <div class="addthis_sharing_toolbox"></div>
          </div>
        </div>

        <?php
        // Are comments available?
        if ($this->JOURNAL['encomms'] == 'yes') {
        ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-commenting-o fa-fw"></i> <?php echo $this->TEXT[0]; ?>
          </div>
          <div class="panel-body">
            <?php
            // Show disqus comments..
            // html/disqus.htm
            echo $this->JDATA['disqus'];
            ?>
          </div>
        </div>
        <?php
        }

        // Show categories..
        if ($this->CATEGORIES) {
        ?>
        <div class="panel panel-default tags">
          <div class="panel-body">
            <p><?php echo $this->TEXT[1]; ?>:</p>
            <?php
            // html/journal-category-link.htm
            echo $this->CATEGORIES;
            ?>
          </div>
        </div>
        <?php
        }

        // Are search tags present?
        if ($this->JDATA['tags']) {
        ?>
        <div class="panel panel-default tags">
          <div class="panel-body">
            <?php
            echo $this->JDATA['tags'];
            ?>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
      <div class="col-lg-3 col-md-4">
        <?php
        include(dirname(__file__) . '/right-panel.tpl.php');
        ?>
      </div>
    </div>


