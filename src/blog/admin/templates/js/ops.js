function mswAutoSlug(area) {
  jQuery(document).ready(function() {
    jQuery.ajax({
      type: 'POST',
      url: 'index.php?ajax-ops=slug&a=' + area,
      data: jQuery('.mainmswarea > form').serialize(),
      cache: false,
      dataType: 'json',
      success: function (data) {
        jQuery('input[name="fm[slug]"]').val(data['slug']);
      }
    });
  });
  return false;
}

function mswAction(act, fld, slt, cnf) {
  if (cnf) {
    var confirmSub = confirm(mswlang.aus);
    if (confirmSub) {
    } else {
      return false;
    }
  }
  if (slt == undefined) {
    var slt = 'no';
  }
  if (fld == undefined) {
    var fld = '.mainmswarea';
  }
  jQuery(document).ready(function() {
    if (slt == 'no') {
      mswShowSpin();
    }
    jQuery.ajax({
      type: 'POST',
      url: 'index.php?ajax-ops=' + act,
      data: jQuery((fld ? fld : '.mainmswarea') + ' > form').serialize(),
      cache: false,
      dataType: 'json',
      success: function (data) {
        if (slt == 'no'){
          mswCloseSpin();
          switch(data['status']) {
            case 'ok':
            case 'err':
              mswDialog(data['txt'][0], data['txt'][1], data['status']);
              if (data['tr-ds']) {
                for (var i=0; i<data['tr-ds'].length; i++) {
                  jQuery('#idr_' + data['tr-ds'][i]).remove();
                }
              }
              break;
            case 'rdr':
              window.location = data['loc'];
              break;
            default:
              break;
          }
        }
      }
    });
  });
  return false;
}

function mswKey() {
  mswBoxSpin('fm[apikey]', 'spin', 'left');
  jQuery(document).ready(function() {
    jQuery.ajax({
      url: 'index.php',
      data: 'ajax-ops=apikey',
      dataType: 'json',
      cache: false,
      success: function (data) {
        mswBoxSpin('fm[apikey]', 'stop', 'left');
        jQuery('input[name="fm[apikey]"]').val(data['key']);
      }
    });
  });
  return false;
}

function mswPanel(panl) {
  jQuery(document).ready(function() {
    jQuery.ajax({
      url: 'index.php',
      data: 'ajax-ops=menu-panel&pnl=' + panl,
      dataType: 'json',
      cache: false,
      success: function (data) {
      }
    });
  });
  return false;
}

function mswMail() {
  mswShowSpin();
  jQuery(document).ready(function() {
    jQuery.ajax({
      url: 'index.php',
      data: 'ajax-ops=mail',
      dataType: 'json',
      cache: false,
      success: function (data) {
        mswCloseSpin();
        mswDialog(data['txt'][0], data['txt'][1], 'ok');
      }
    });
  });
  return false;
}

function mswPass() {
  mswBoxSpin('fm[pass]', 'spin', 'left');
  jQuery(document).ready(function() {
    jQuery.ajax({
      url: 'index.php',
      data: 'ajax-ops=auto-pass',
      dataType: 'json',
      cache: false,
      success: function (data) {
        mswBoxSpin('fm[pass]', 'stop', 'left');
        jQuery('input[name="fm[pass]"]').val(data['pass']);
        jQuery('#passPreview').html(data['pass']);
      }
    });
  });
  return false;
}

function mswEnter() {
  if (jQuery('input[name="usr"]').val() == '') {
    jQuery('input[name="usr"]').focus();
  } else if (jQuery('input[name="pw"]').val() == '') {
    jQuery('input[name="pw"]').focus();
  } else {
    mswBoxSpin('usr', 'spin', 'right');
    jQuery(document).ready(function() {
      jQuery.ajax({
        type: 'POST',
        url: 'index.php?ajax-ops=login',
        data: jQuery('.mainmswarea > form').serialize(),
        cache: false,
        dataType: 'json',
        success: function (data) {
          switch(data['status']) {
            case 'ok':
              window.location = 'index.php';
              break;
            case 'err':
              mswBoxSpin('usr', 'stop', 'right');
              mswDialog(data['txt'][0], data['txt'][1], 'err');
              break;
          }
        }
      });
    });
    return false;
  }
  return false;
}

function mswRDR(act) {
  jQuery(document).ready(function() {
    mswShowSpin();
    setTimeout(function() {
      jQuery.ajax({
        url: 'index.php',
        data: 'ajax-ops=' + act,
        dataType: 'json',
        cache: false,
        success: function (data) {
          window.location = data['rdr'];
        }
      });
    }, 1500);
  });
  return false;
}