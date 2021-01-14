(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/browser-calls"],{

/***/ "./resources/js/browser-calls.js":
/*!***************************************!*\
  !*** ./resources/js/browser-calls.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $(document).on('click', '.makeCall', function (e) {
    e.preventDefault();
    var phone = parseInt($('#dialer-screen').text());
    var regEx = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    axios.post('/conversation/call', {
      phoneNumber: phone
    }).then(function (response) {
      console.log(response);
    })["catch"](function (error) {
      console.log(error);
    });
  });
});

/***/ }),

/***/ 2:
/*!*********************************************!*\
  !*** multi ./resources/js/browser-calls.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Projects\connexxiontelecom\cnx247v2\resources\js\browser-calls.js */"./resources/js/browser-calls.js");


/***/ })

},[[2,"/js/manifest"]]]);
