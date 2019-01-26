function loadTopMenu() {
  var html  = '<ul class="nav navbar-top-links navbar-right hidden-xs">';
  html     += ' <li><a href="https://www.maianweblog.com/purchase.html" onclick="window.open(this);return false"><i class="fa fa-shopping-cart fa-fw"></i> Purchase Licence</a></li>';
  html     += ' <li><a href="bugs.html"><i class="fa fa-bug fa-fw"></i> Bug Reports</a></li>';
  html     += ' <li><a href="upgrades.html"><i class="fa fa-history fa-fw"></i> Upgrades</a></li>';
  html     += ' <li><a href="support.html"><i class="fa fa-life-saver fa-fw"></i> Support</a></li>';
  html     += ' <li><a href="https://www.maianscriptworld.co.uk/" onclick="window.open(this);return false"><i class="fa fa-external-link fa-fw"></i> Other Software</a></li>';
  html     += '</ul>';
  jQuery('div[class="navbar-header"]').after(html);
}

function loadLeftMenu() {
  var html  = '<ul class="nav" id="side-menu">';
  html     += '  <li><a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Docs Main Page</a></li>';
  html     += '  <li><a href="versions.html"><i class="fa fa-search-plus fa-fw"></i> Free v Commercial</a></li>';
  html     += '  <li><a href="white.html"><i class="fa fa-tag fa-fw"></i> White Label Licence</a></li>';
  html     += '  <li><a href="install.html"><i class="fa fa-cog fa-fw"></i> Maian Weblog Setup</a></li>';
  html     += '  <li><a href="language.html"><i class="fa fa-file-text-o fa-fw"></i> Templates/Language</a></li>';
  html     += '  <li><a href="plugins.html"><i class="fa fa-wrench fa-fw"></i> Plugins &amp; Features</a></li>';
  html     += '  <li><a href="overview.html"><i class="fa fa-desktop fa-fw"></i> Frontend Overview</a></li>';
  html     += '  <li><a href="api.html"><i class="fa fa-cogs fa-fw"></i> API</a></li>';
  html     += '  <li><a href="faq.html"><i class="fa fa-question-circle fa-fw"></i> F.A.Q</a></li>';
  html     += '  <li><a href="info.html"><i class="fa fa-info-circle fa-fw"></i> Software Info</a></li>';
  html     += '</ul>';
  jQuery('div[class="sidebar-collapse"]').html(html);
}

function loadFooter() {
  var d     = new Date();
  var year  = d.getFullYear();
  var html  = '<hr><a href="https://www.facebook.com/msworlduk/" onclick="window.open(this);return false"><img src="content/images/facebook.png" alt="Maian Script World on Facebook"></a>';
  html     += '<a href="https://twitter.com/#!/maianscripts" onclick="window.open(this);return false"><img src="content/images/twitter.png" alt="Maian Script World on Twitter"></a>';
  html     += '<a href="http://www.dailymotion.com/maianmedia" onclick="window.open(this);return false"><img src="content/images/videos.png" alt="Maian Script World on DailyMotion"></a>';
  html     += '<a href="https://www.maianweblog.com/rss.html" onclick="window.open(this);return false"><img src="content/images/rssfeeds.png" alt="Maian Weblog Updates"></a>';
  html     += '<p>Powered by <a href="https://www.maianweblog.com" onclick="window.open(this);return false">Maian Weblog</a><br>&copy; '+'2003-'+year+' Maian Script World. All Rights Reserved. <a href="disclaimer.html">Disclaimer</a></p>';
  jQuery('div[class="row footerArea"]').html(html);
}

function mswWindow(w_url, w_height, w_width, w_title) {
  if (w_height > 0) {
    iBox.showURL(w_url, '',{
      width  : w_width,
      height : w_height
    });
  } else {
    iBox.showURL(w_url, '');
  }
}