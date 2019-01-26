function mswCloseSpin() {
  jQuery('body').css({
    'opacity': '1.0'
  });
  jQuery('div[class="overlaySpinner"]').hide();
}

function mswShowSpin() {
  jQuery('body').css({
    'opacity': '0.8'
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

function mswAlert(txt) {
  alert(txt);
}

function mswKC(e) {
  return (e.keyCode ? e.keyCode : e.charCode);
}

function mswBoxSpin(box, act) {
  switch(act) {
    case 'spin':
      jQuery('input[name="'+ box + '"]').addClass('msw-box-spinner');
      break;
    case 'stop':
      jQuery('input[name="'+ box + '"]').removeClass('msw-box-spinner');
      break;
  }
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