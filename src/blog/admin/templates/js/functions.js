function mswLnk() {
  var cnt = jQuery('#three div[class="form-group"]').length;
  var faw = jQuery('input[name="fawe"]').val();
  var fau = jQuery('input[name="flink"]').val();
  if (faw == '') {
    jQuery('input[name="fawe"]').focus();
    return false;
  }
  if (fau == '') {
    jQuery('input[name="flink"]').focus();
    return false;
  }
  if (cnt > 0) {
    var lbxs = jQuery('#three div[class="form-group"]').last().clone();
    jQuery('#three div[class="form-group"]').last().after(lbxs);
  } else {
    jQuery('#three .panel-body .bxs').html('<div class="form-group"><div class="form-group input-group"><span class="input-group-addon"><i class="fa fa fa-fw"></i></span><input type="text" class="form-control" name="fm[links][]" value=""></div></div>');
  }
  jQuery('#three div[class="form-group"] i').last().attr('class','fa fa-' + faw + ' fa-fw');
  jQuery('#three div[class="form-group"] input[type="text"]').last().attr('name', 'fm[links][' + faw + ']')
  jQuery('#three div[class="form-group"] input[type="text"]').last().val(fau);
  jQuery('input[name="fawe"]').val('');
  jQuery('input[name="flink"]').val('');
}

function mswThmBox(ac,df,fd,lng,tp,tf) {
  var cnt = jQuery('.themearea tbody tr').length;
  var js = "jQuery('.mswdatepicker_" + cnt + "').datepicker({autoClose : " + ac + ",dateFormat : '" + df + "',firstDay : " + fd + ",language : '" + lng + "',timepicker : " + tp + ",timeFormat : '" + tf + "'})";
  var lbxs = jQuery('.themearea tbody tr').last().clone();
  jQuery('.themearea tbody tr').last().after(lbxs);
  jQuery('.themearea tbody tr input[name="fm[from][]"]').last().val('');
  jQuery('.themearea tbody tr input[name="fm[to][]"]').last().val('');
  jQuery('.themearea tbody tr select[name="fm[thm][]"]').last().val('none');
  jQuery('.themearea tbody tr input[name="fm[from][]"]').last().removeClass('mswdatepicker').addClass('mswdatepicker_' + cnt);
  jQuery('.themearea tbody tr input[name="fm[to][]"]').last().removeClass('mswdatepicker').addClass('mswdatepicker_' + cnt);
  jQuery('body').append('<script>' + js + '</script>');
}

function mswSlug(fld) {
  var str = jQuery('input[name="fm[' + fld + ']"]').val();
  var slug = str.replace('/', '-');
  var slug = slug.replace(' ', '-');
  var newslug = slug.toString().toLowerCase()
  .replace(/\s+/g, '-')
  .replace(/[^\u0100-\uFFFF\w\-]/g,'-')
  .replace(/\-\-+/g, '-')
  .replace(/^-+/, '-')
  .replace(/-+$/, '-');
  jQuery('input[name="fm[slug]"]').val(newslug);
}

function mswINP(area, bx) {
  jQuery('input[name="' + bx + '"]').val(area)
}

function mswSubmit(fm, bx) {
  if (jQuery('input[name="' + bx + '"]').val() == '') {
    jQuery('input[name="' + bx + '"]').focus();
    return false;
  }
  jQuery('#' + fm).submit();
}

function mswSB(panel, act) {
  switch(act) {
    case 'show':
      jQuery(panel).slideDown();
      break;
    case 'hide':
      jQuery(panel).hide();
      break;
  }
}

function mswTyp(ty) {
  switch(ty) {
    case 'admin':
      jQuery('#paccess').hide();
      break;
    case 'restricted':
      jQuery('#paccess').slideDown();
      break;
  }
}

function mswWin(win) {
  window.location = 'index.php?p=' + win;
}

function mswSC(fld, btn) {
  if (jQuery(fld + ' input:checkbox').prop('checked') == false) {
    jQuery(fld + ' input:checkbox').prop('checked', true);
    jQuery('#' + btn).removeClass('disabled');
  } else {
    jQuery(fld + ' input:checkbox').prop('checked', false);
    jQuery('#' + btn).addClass('disabled');
  }
}

function mswSCG(fld, btn) {
  var cnt = 0;
  jQuery(fld + ' input:checkbox').each(function() {
    if (jQuery(this).prop('checked') == true) {
      ++cnt;
    }
  });
  if (cnt > 0) {
    jQuery('#' + btn).removeClass('disabled');
  } else {
    jQuery('#' + btn).addClass('disabled');
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

function mswBoxSpin(box, act, whr) {
  switch(act) {
    case 'spin':
      jQuery('input[name="'+ box + '"]').addClass('msw-box-spinner-' + whr);
      break;
    case 'stop':
      jQuery('input[name="'+ box + '"]').removeClass('msw-box-spinner-' + whr);
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

function mswBB(type, box) {
  switch(type) {
    case 'bold':
      mswIAC(box, '[b]..[/b]');
      break;
    case 'italic':
      mswIAC(box, '[i]..[/i]');
      break;
    case 'underline':
      mswIAC(box, '[u]..[/u]');
      break;
    case 'url':
      mswIAC(box, '[url]http://www.example.com[/url]');
      break;
    case 'img':
      mswIAC(box, '[img]http://www.example.com/picture.png[/img]');
      break;
    case 'email':
      mswIAC(box, '[email]email@example.com[/email]');
      break;
    case 'youtube':
      mswIAC(box, '[youtube]abc123[/youtube]');
      break;
    case 'vimeo':
      mswIAC(box, '[vimeo]abc123[/vimeo]');
      break;
  }
}

// With thanks to Scott Klarr
// http://www.scottklarr.com
function mswIAC(field, text) {
  var txtarea = document.getElementById(field);
  var scrollPos = txtarea.scrollTop;
  var strPos = 0;
  var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 'ff' : (document.selection ? 'ie' : false));
  if (br == 'ie') {
    txtarea.focus();
    var range = document.selection.createRange();
    range.moveStart('character', -txtarea.value.length);
    strPos = range.text.length;
  }
  if (br == 'ff') {
    strPos = txtarea.selectionStart;
  }
  var front = (txtarea.value).substring(0, strPos);
  var back = (txtarea.value).substring(strPos, txtarea.value.length);
  txtarea.value = front + text + back;
  strPos = strPos + text.length;
  if (br == 'ie') {
    txtarea.focus();
    var range = document.selection.createRange();
    range.moveStart('character', -txtarea.value.length);
    range.moveStart('character', strPos);
    range.moveEnd('character', 0);
    range.select();
  }
  if (br == 'ff') {
    txtarea.selectionStart = strPos;
    txtarea.selectionEnd = strPos;
    txtarea.focus();
  }
  txtarea.scrollTop = scrollPos;
}

function mswClr() {
  if (jQuery('#passPreview')) {
    jQuery('#passPreview').html('&nbsp');
  }
}

function mswRemBox(area) {
  switch(area) {
    case 'theme':
      var n = jQuery('.themearea tbody tr').length;
      if (n > 1) {
        jQuery('.themearea tbody tr').last().remove();
      } else {
        jQuery('.themearea tbody tr input[type="text"]').val('');
        jQuery('.themearea tbody tr select').val('');
      }
      break;
  }
}