<?php if (!defined('PARENT')) { die('Permission Denied'); }
if (!EN_BB) {
  exit;
}
?>

  <div class="panel panel-default">

    <div class="panel-heading"><i class="fa fa-text-width fa-fw"></i> <?php echo $msw_adm_bb; ?></div>
    <div class="panel-body">
      <?php echo $msw_adm_bb2; ?>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[b]</b> <?php echo $msw_adm_bb3; ?> <b>[/b]</b></p>
      <hr>
      <p><b><?php echo $msw_adm_bb3; ?></b></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[u]</b> <?php echo $msw_adm_bb4; ?> <b>[/u]</b></p>
      <hr>
      <p><span style="text-decoration:underline"><?php echo $msw_adm_bb4; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[i]</b> <?php echo $msw_adm_bb5; ?> <b>[/i]</b></p>
      <hr>
      <p><span style="font-style:italic"><?php echo $msw_adm_bb5; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[s]</b> <?php echo $msw_adm_bb6; ?> <b>[/s]</b></p>
      <hr>
      <p><span style="text-decoration:line-through"><?php echo $msw_adm_bb6; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[del]</b> <?php echo $msw_adm_bb7; ?> <b>[/del]</b></p>
      <hr>
      <p><span style="text-decoration:line-through;color:red"><?php echo $msw_adm_bb7; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[ins]</b> <?php echo $msw_adm_bb8; ?> <b>[/ins]</b></p>
      <hr>
      <p><span style="background:yellow"><?php echo $msw_adm_bb8; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[em]</b> <?php echo $msw_adm_bb9; ?> <b>[/em]</b></p>
      <hr>
      <p><span style="font-style:italic;font-weight:bold"><?php echo $msw_adm_bb9; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[color=#FF0000]</b> <?php echo $msw_adm_bb10; ?><b> [/color]</b></p>
      <hr>
      <p><span style="color:red"><?php echo $msw_adm_bb10; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[color=blue]</b> <?php echo $msw_adm_bb11; ?> <b>[/color]</b></p>
      <hr>
      <p><span style="color:blue"><?php echo $msw_adm_bb11; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[h1]</b> <?php echo $msw_adm_bb12; ?> <b>[/h1]</b></p>
      <hr>
      <p><span style="font-weight:bold;font-size:22px"><?php echo $msw_adm_bb12; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[h2]</b> <?php echo $msw_adm_bb13; ?> <b>[/h2]</b></p>
      <hr>
      <p><span style="font-weight:bold;font-size:20px"><?php echo $msw_adm_bb13; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[h3]</b> <?php echo $msw_adm_bb14; ?> <b>[/h3]</b></p>
      <hr>
      <p><span style="font-weight:bold;font-size:18px"><?php echo $msw_adm_bb14; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[h4]</b> <?php echo $msw_adm_bb15; ?> <b>[/h4]</b></p>
      <hr>
      <p><span style="font-weight:bold;font-size:16px"><?php echo $msw_adm_bb15; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[center]</b> <?php echo $msw_adm_bb31; ?> <b>[/center]</b></p>
      <hr>
      <p><span style="display:block;text-align:center"><?php echo $msw_adm_bb31; ?></span></p>
    </div>

  </div>

  <div class="fieldHeadWrapper">
    <p><?php echo $msw_adm_bb17; ?>:</p>
  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[url=http://www.google.co.uk]</b> Google <b>[/url]</b></p>
      <hr>
      <p><a href="http://www.google.co.uk">Google</a></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[url]</b> http://www.google.co.uk <b>[/url]</b></p>
      <hr>
      <p><a href="http://www.google.co.uk">http://www.google.co.uk</a></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[urlnew=http://www.google.co.uk]</b> Google <b>[/urlnew]</b></p>
      <hr>
      <p><a href="http://www.google.co.uk" onclick="window.open(this);return false">Google</a> (<?php echo $msw_adm_bb27; ?>)</p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[email]</b> myname@mydomain.com <b>[/email]</b></p>
      <hr>
      <p><a href="mailto:myname@mydomain.com">myname@mydomain.com</a></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[email=myname@mydomain.com]</b> My Email Address <b>[/email]</b></p>
      <hr>
      <p><a href="mailto:myname@mydomain.com"><?php echo $msw_adm_bb26; ?></a></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[img]</b> http://www.mydomain.com/images/logo.png <b>[/img]</b></p>
      <hr>
      <p><img src="templates/images/test-image.png" alt="" title=""></p>
    </div>

  </div>

  <div class="fieldHeadWrapper">
    <p><?php echo $msw_adm_bb28; ?>:</p>
  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[youtube]</b>ABC123<b>[/youtube]</b></p>
      <hr>
      <p><?php echo $msw_adm_bb29; ?></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[vimeo]</b>ABC123<b>[/vimeo]</b></p>
      <hr>
      <p><?php echo $msw_adm_bb29; ?></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[dailymotion]</b>ABC123<b>[/dailymotion]</b></p>
      <hr>
      <p><?php echo $msw_adm_bb33; ?></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[soundcloud]</b>123456<b>[/soundcloud]</b></p>
      <hr>
      <p><?php echo $msw_adm_bb32; ?></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[mp3]</b>filepath/to/file.mp3<b>[/mp3]</b></p>
      <hr>
      <p><?php echo $msw_adm_bb30; ?></p>
    </div>

  </div>

  <div class="fieldHeadWrapper">
    <p><?php echo $msw_adm_bb18; ?>:</p>
  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[list]</b><br><b>&nbsp;[*]</b> <?php echo $msw_adm_bb20; ?> 1 <b>[/*]<br>&nbsp;[*]</b> <?php echo $msw_adm_bb20; ?> 2 <b>[/*]<br>&nbsp;[*]</b> <?php echo $msw_adm_bb20; ?> 3 <b>[/*]<br>[/list]</b></p>
      <hr>
      <div><ul class="bbUl"><li><?php echo $msw_adm_bb20; ?> 1</li><li><?php echo $msw_adm_bb20; ?> 2</li><li><?php echo $msw_adm_bb20; ?> 3</li></ul></div>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[list=n]</b><br><b>&nbsp;[*]</b> <?php echo $msw_adm_bb21; ?> 1 <b>[/*]<br>&nbsp;[*]</b> <?php echo $msw_adm_bb21; ?> 2 <b>[/*]<br>&nbsp;[*]</b> <?php echo $msw_adm_bb21; ?> 3 <b>[/*]<br>[/list]</b></p>
      <hr>
      <div><ul class="bbUlNumbered"><li><?php echo $msw_adm_bb21; ?> 1</li><li><?php echo $msw_adm_bb21; ?> 2</li><li><?php echo $msw_adm_bb21; ?> 3</li></ul></div>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[list=a]</b><br><b>&nbsp;[*]</b> <?php echo $msw_adm_bb22; ?> 1 <b>[/*]<br>&nbsp;[*]</b> <?php echo $msw_adm_bb22; ?> 2 <b>[/*]<br>&nbsp;[*]</b> <?php echo $msw_adm_bb22; ?> 3 <b>[/*]<br>[/list]</b></p>
      <hr>
      <div><ul class="bbUlAlpha"><li><?php echo $msw_adm_bb22; ?> 1</li><li><?php echo $msw_adm_bb22; ?> 2</li><li><?php echo $msw_adm_bb22; ?> 3</li></ul></div>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[list=ua]</b><br><b>&nbsp;[*]</b> <?php echo $msw_adm_bb22; ?> 1 <b>[/*]<br>&nbsp;[*]</b> <?php echo $msw_adm_bb22; ?> 2 <b>[/*]<br>&nbsp;[*]</b> <?php echo $msw_adm_bb22; ?> 3 <b>[/*]<br>[/list]</b></p>
      <hr>
      <div><ul class="bbUlUpperAlpha"><li><?php echo $msw_adm_bb22; ?> 1</li><li><?php echo $msw_adm_bb22; ?> 2</li><li><?php echo $msw_adm_bb22; ?> 3</li></ul></div>
    </div>

  </div>

  <div class="fieldHeadWrapper">
    <p><?php echo $msw_adm_bb19; ?>:</p>
  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[b][u]</b><?php echo $msw_adm_bb23; ?> <b>[/u][/b]</b></p>
      <hr>
      <p><span style="text-decoration:underline;font-weight:bold"><?php echo $msw_adm_bb23; ?></span></p>
    </div>

  </div>

  <div class="panel panel-default">

    <div class="panel-body">
      <p><b>[color=blue][b][u]</b> <?php echo $msw_adm_bb24; ?> <b>[/u][/b][/color]</b></p>
      <hr>
      <p><span style="text-decoration:underline;font-weight:bold;color:blue"><?php echo $msw_adm_bb24; ?></span></p>
    </div>

  </div>