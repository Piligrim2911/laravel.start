/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/resource_actions.js ***!
  \******************************************/
$(document).on('click', '#save-close', function (e) {
  e.preventDefault();
  var form = $('#formContent');
  var redirectUrl = form.data('action-index');

  if (form.valid()) {
    $(this).attr('disabled', 'disabled');
    var editorFieldName = $('#formContent textarea.editor').attr('name');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: form.attr('action'),
      data: window.editor ? form.serialize() + '&' + editorFieldName + '=' + encodeURIComponent(escapeHtml(window.editor.getData())) : form.serialize(),
      dataType: "json",
      success: function success(result) {
        if (!result.error) {
          callToaster("success", result.successTitle, result.successMessage, redirectUrl);
        }
      },
      error: function error(jqXHR, Exception) {
        $('div#ajaxMessages').removeClass().addClass('alert alert-danger');
        setTimeout(function () {
          $('div#ajaxMessages').html('<p><i class="fa fa-check"></i>При выполнении AJAX-запроса произошла ошибка</p>');
          $('div#ajaxMessages').slideDown('slow');
        }, 250);
        setTimeout(function () {
          $('div#ajaxMessages').slideUp('slow');
        }, 3000);
      }
    });
  } else {
    $("html, body").animate({
      scrollTop: 0
    }, "slow");
  }
});
$(document).on('click', '#save', function (e) {
  e.preventDefault();
  var form = $('#formContent');

  if (form.valid()) {
    var editorFieldName = $('#formContent textarea.editor').attr('name');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: form.attr('action'),
      data: window.editor ? form.serialize() + '&' + editorFieldName + '=' + encodeURIComponent(escapeHtml(window.editor.getData())) : form.serialize(),
      dataType: "json",
      success: function success(result) {
        if (!result.error) {
          var toaster = $('#toaster');

          if (toaster.length != 0) {
            if ($("input[name='id']").val() == 0) {
              var redirectUrl = result.id + '/edit';
              callToaster("success", result.successTitle, result.successMessage, redirectUrl);
            } else {
              callToaster("success", result.successTitle, result.successMessage);
            }
          }
        } else {}
      },
      error: function error(jqXHR, Exception) {
        console.log(jqXHR);
        callToaster("error", "Error", jqXHR);
      }
    });
  } else {
    $("html, body").animate({
      scrollTop: 0
    }, "slow");
  }
});
$(document).on('click', '#close', function (e) {
  e.preventDefault();
  document.location.href = $('#formContent').data('action-index');
});
$(document).on('click', '.destroy', function (e) {
  e.preventDefault();
  var link = $(this);
  var id = link.attr('data-item-id');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: link.attr('href'),
    data: {
      "_method": "delete"
    },
    dataType: "json",
    success: function success(result) {
      if (!result.error) {
        var toaster = $('#toaster');

        if (toaster.length != 0) {
          callToaster("success", result.successTitle, result.successMessage);
        }

        var restoreLink = $('<a>').html('<i id="stat_' + id + '" class="icon fas fa-trash-restore"></i>').attr('data-item-id', id).attr('href', result.restoreLink).addClass('restore d-inline mr-2');
        var deleteLink = $('<a>').html('<i id="stat_' + id + '" class="icon far fa-trash-alt"></i>').attr('data-item-id', id).attr('href', result.deleteLink).addClass('delete d-inline');
        link.closest('tr').addClass('deleted');
        link.closest('tr').find('td.status').find('a').removeAttr('href').find('i').addClass('disabled');
        link.closest('tr').find('td.actions').hide().html('').append(restoreLink).append(deleteLink).fadeIn();
      }
    },
    error: function error(jqXHR, Exception) {
      console.log('error?');
      console.log(jqXHR);
    }
  });
});
$(document).on('click', '.restore', function (e) {
  e.preventDefault();
  var link = $(this);
  var id = link.attr('data-item-id');
  console.log(id);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: link.attr('href'),
    data: {},
    dataType: "json",
    success: function success(result) {
      if (!result.error) {
        var toaster = $('#toaster');

        if (toaster.length != 0) {
          callToaster("success", result.successTitle, result.successMessage);
        }

        var editLink = $('<a>').html('<i class="icon fas fa-edit"></i>').attr('href', result.editLink).addClass('d-inline mr-2');
        var destroyLink = $('<a>').html('<i class="far fa-trash-alt"></i>').attr('data-item-id', id).attr('href', result.destroyLink).addClass('destroy');
        link.closest('tr').removeClass('deleted');
        link.closest('tr').find('td.status').find('a').attr('href', result.updateStatusLink).find('i').removeClass('disabled');
        link.closest('tr').find('td.actions').hide().html('').append(editLink).append(destroyLink).fadeIn();
      }
    },
    error: function error(jqXHR, Exception) {
      console.log(jqXHR);
    }
  });
});
$(document).on('click', '.delete', function (e) {
  e.preventDefault();
  var link = $(this);
  var csrf_token = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: link.attr('href'),
    data: {
      "_method": "delete"
    },
    dataType: "json",
    success: function success(result) {
      if (!result.error) {
        var toaster = $('#toaster');

        if (toaster.length != 0) {
          callToaster("success", result.successTitle, result.successMessage);
        }

        link.closest('tr').fadeOut();
      }
    },
    error: function error(jqXHR, Exception) {}
  });
});
$(document).on('click', '.updStatus', function (e) {
  e.preventDefault();
  var link = $(this);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: link.attr('href'),
    dataType: "json",
    success: function success(result) {
      $('#stat_' + link.data('item-id')).fadeOut('slow', function () {
        $('#stat_' + link.data('item-id')).removeClass().addClass(result["class"]).attr('title', result.attr_title).fadeIn();
      });
    },
    error: function error(jqXHR, Exception) {
      console.log(jqXHR);
    }
  });
});
/******/ })()
;