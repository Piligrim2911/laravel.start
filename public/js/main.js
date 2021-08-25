/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
function callToaster(type, title, message) {
  var redirectUrl = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;
  var redirectCallback = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;
  var positionClass;

  if (document.dir != "rtl") {
    positionClass = "toast-top-right";
  } else {
    positionClass = "toast-top-left";
  }

  toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: false,
    progressBar: true,
    positionClass: positionClass,
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "2000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut"
  };

  switch (type) {
    case 'info':
      toastr.info(message, title);
      break;

    case 'success':
      if (redirectUrl) {
        toastr.options.onHidden = function () {
          document.location.href = redirectUrl;
        };
      }

      if (redirectCallback) {
        toastr.options.onHidden = function () {
          redirectCallback();
        };
      }

      toastr.success(message, title);
      break;

    case 'error':
      toastr.error(message, title);
      break;

    default:
      toastr.success(message, title);
      break;
  }
}
/******/ })()
;