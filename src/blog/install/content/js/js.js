function mswIns() {
  mswShowSpin();
  jQuery(document).ready(function() {
    jQuery.ajax({
      type: 'POST',
      url: 'index.php?ajax-ops=install',
      data: jQuery("#formarea > form").serialize(),
      cache: false,
      dataType: 'json',
      success: function (data) {
        mswCloseSpin();
        switch(data['status']) {
          case 'ok':
            mswDialog(data['txt'][0], data['txt'][1], data['status']);
            break;
          case 'err':
            mswDialog(data['txt'][0], data['txt'][1], data['status']);
            break;
        }
      }
    });
  });
  return false;
}

function mswDialog(txt, msg, mtype) {
  if (jQuery('.bootbox')) {
    jQuery('.bootbox').remove();
  }
  if (jQuery('.modal-backdrop')) {
    jQuery('.modal-backdrop').remove();
  }
  switch(mtype) {
    case 'err':
      bootbox.dialog({
        message   : msg,
        title     : '<i class="fa fa-warning fa-fw"></i> ' + txt,
        className : 'msw-box-error',
        onEscape  : true,
        backdrop  : true
      });
      break;
    default:
      bootbox.dialog({
        message   : msg,
        title     : '<i class="fa fa-check fa-fw"></i> ' + txt,
        className : 'msw-box-ok',
        onEscape  : true,
        backdrop  : true
      });
      break;
  }
}

function mswCloseSpin() {
  jQuery('body').css({
    'opacity': '1.0'
  });
  jQuery('div[class="overlaySpinner"]').hide();
}

function mswShowSpin() {
  jQuery('body').css({
    'opacity': '0.7'
  });
  jQuery('.overlaySpinner').css({
    'left': '50%',
    'top': '50%',
    'position': 'fixed',
    'margin-left': -jQuery('.overlaySpinner').outerWidth() / 2,
    'margin-top': -jQuery('.overlaySpinner').outerHeight() / 2
  });
  jQuery('div[class="overlaySpinner"]').show();
}