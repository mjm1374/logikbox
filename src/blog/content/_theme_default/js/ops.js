function mswNavState(pnl) {
  jQuery(document).ready(function() {
    jQuery.ajax({
      url: 'index.php',
      data: 'ajax-ops=menu-state&state=' + pnl,
      dataType: 'json',
      cache: false
    });
  });
  return false;
}

function mswAcs() {
  var usr = jQuery('input[name="fm[usr]"]').val();
  var pwd = jQuery('input[name="fm[pwd]"]').val();
  if (usr == '') {
    jQuery('input[name="fm[usr]"]').focus();
    return false;
  }
  if (pwd == '') {
    jQuery('input[name="fm[pwd]"]').focus();
    return false;
  }
  jQuery(document).ready(function() {
    mswShowSpin();
    jQuery.ajax({
      type: 'POST',
      url: 'index.php?ajax-ops=private',
      data: jQuery('#logbody > form').serialize(),
      cache: false,
      dataType: 'json',
      success: function (data) {
        mswCloseSpin();
        switch(data['status']) {
          case 'ok':
            window.location.reload();
            break;
          default:
            mswDialog(data['txt'][0], data['txt'][1], data['status']);
            break;
        }
      }
    });
  });
  return false;
}

function mswCal(dircn) {
  var dircnc = '';
  jQuery(document).ready(function() {
    if (dircn == 'monthload') {
      if (jQuery('select[name="fm[calmnth]"]').val() == '-') {
        jQuery('select[name="fm[calmnth]"]').focus();
        return false;
      }
      if (jQuery('select[name="fm[calyr]"]').val() == '-') {
        jQuery('select[name="fm[calyr]"]').focus();
        return false;
      }
      var dircnc = jQuery('select[name="fm[calmnth]"]').val() + '-' + jQuery('select[name="fm[calyr]"]').val();
      mswCalOps('closemonthload');
    }
    var myval = jQuery('.jcalendar').html();
    jQuery('.cal_nav .jmonthyear').html('&nbsp;').addClass('spin');
    if (jQuery('.jcalendar_search').attr('style') == '') {
      jQuery('.calresetpanel a i').addClass('fa-spin');
    }
    jQuery.ajax({
      url: 'index.php',
      data: 'ajax-ops=calendar&dircn=' + (dircnc ? dircnc : dircn),
      dataType: 'json',
      cache: false,
      success: function (data) {
        switch(data['status']) {
          case 'ok':
            jQuery('.jcalendar').html(data['calendar']);
            jQuery('.cal_nav .jmonthyear').removeClass('spin').html(data['monthyear']);
            jQuery('select[name="fm[calyr]"]').val(data['year']);
            jQuery('select[name="fm[calmnth]"]').val(data['month']);
            mswCalOps('today', data['today']);
            switch(data['reset']) {
              case 'yes':
                jQuery('.calresetpanel').slideDown();
                break;
              case 'no':
                if (jQuery('.jcalendar_search').attr('style') == '') {
                  jQuery('.calresetpanel a i').removeClass('fa-spin');
                  mswCalOps('closemonthload');
                }
                jQuery('.calresetpanel').hide();
                break;
            }
            break;
          default:
            jQuery('.jcalendar').html(myval);
            mswDialog(data['txt'][0], data['txt'][1], data['status']);
            break;
        }
      }
    });
  });
  return false;
}

function mswCalOps(op, vlu) {
  switch(op) {
    case 'closemonthload':
      jQuery('.jcalendar').show();
      jQuery('.jcalendar_search').hide();
      break;
    case 'showmonthload':
      jQuery('.jcalendar').hide();
      jQuery('.jcalendar_search').show();
      break;
    case 'today':
      if (jQuery('.today').html()) {
        jQuery('.mswcalendar td').removeClass('today');
        jQuery('td[class="d' + vlu + '"]').addClass('today');
      }
      break;
  }
}