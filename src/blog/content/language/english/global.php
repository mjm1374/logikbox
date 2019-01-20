<?php

/* CHARSET, LANG, DIR
--------------------------------------*/

$msw_html_charset = 'utf-8'; // Main HTML character set..
$msw_mail_charset = 'utf-8'; // Email header character set..
$msw_html_dir = 'ltr'; // HTML text direction..
$msw_html_lang = 'en'; // HTML lang var..

/* META
--------------------------------------*/

$msg_meta = '{website}';

/* ERRORS
--------------------------------------*/

$msw_err_headers = array(
  '400' => 'Error - Bad Request',
  '401' => 'Permission Denied',
  '403' => 'Permission Denied',
  '404' => 'Page Not Found',
  '500' => 'Internal Server Error',
  'msg' => array(
    'Sorry for the inconvenience.<br><br>If this persists, please let us know, thank you.',
    'Return to {website}',
    'Contact Us'
  )
);

/* JS CALENDAR
--------------------------------------*/

// Last 2 letters of language file:
//  admin/templates/js/plugins/i18n/*
$msw_cal = 'en';

/* JS GRAPH
--------------------------------------*/

$msw_graph = '["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]';

/* CALENDAR
--------------------------------------*/

$msw_calendar = array('January','February','March','April','May','June','July','August','September','October','November','December');
$msw_calendar2 = array('Jan','Feb','Mar','Apr','May','June','July','Aug','Sept','Oct','Nov','Dec');
$msw_calendar3 = array('Su','Mo','Tu','We','Th','Fr','Sa');
$msw_calendar4 = 'Last Month';
$msw_calendar5 = 'Next Month';
$msw_calendar6 = 'View Journals ({count})';
$msw_calendar7 = 'Reset';
$msw_calendar8 = 'Select Month..';
$msw_calendar9 = 'Select Year..';

/* PAGINATION
--------------------------------------*/

$msw_pages = array('First','Previous','Next','Last');

/* AJAX
--------------------------------------*/

$msw_ajax = 'System Error';
$msw_ajax2 = 'A problem has occurred with the server request.<br><br>Please try again or view the logs to see if an error has been logged preventing the ajax request completing.';
$msw_ajax3 = 'Test emails sent to the following addresses:<br><br>{emails}';
$msw_ajax4 = 'Completed';

/* COMMON
--------------------------------------*/

$msw_common = 'Yes';
$msw_common2 = 'No';
$msw_common3 = 'Delete';
$msw_common4 = 'Edit';
$msw_common5 = 'Update';
$msw_common6 = 'Cancel';
$msw_common7 = 'No entries found in database';
$msw_common8 = 'Please select at least one entry';
$msw_common9 = 'Are you sure?';
$msw_common10 = 'RSS Feed';

/* CRON JOBS
--------------------------------------*/

$msw_cron = 'Database Backup Completed';
$msw_cron2 = 'Blog / Journal Ops Completed';
$msw_cron3 = 'Blog / Journal Ops Completed - Nothing to Do';
$msw_cron4 = array(
  'Category Deleted (includes journals in this category, but not journals also in other categories)',
  'Journal Deleted',
  'Journal Activated'
);

?>