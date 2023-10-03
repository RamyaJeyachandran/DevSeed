/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./public/src/js/doctor.js ***!
  \*********************************/
(function () {
  "use strict";

  /*------------------------------------- Window Doctor Load Event--BEGIN ---------------------------------------*/
  window.addEventListener("load", function (e) {
    e.preventDefault();
    var pathname = window.location.pathname;
    var base_url = window.location.origin;
    console.log(pathname);
    switch (pathname) {
      case '/Doctor':
        $("#txtDOB").val('');
        console.log("called");
        addDoctorLoadEvent(base_url);
        break;
      case '/SearchDoctor':
        break;
      case 'showDoctor':
        break;
    }
    return;
  });
  /*--------------------------------------------Window Doctor Load Event END--------------------------------------*/

  /* --------------- Doctor Add form submit Begins ------------------------*/

  var doctorFrom = document.getElementById('frmDoctor');
  if (doctorFrom != null) {
    console.log("called");
    //Doctor registeration
    doctorFrom.addEventListener("submit", function (e) {
      e.preventDefault();
      var doctorData = new FormData(doctorFrom);
      var doctorParams = new URLSearchParams(doctorData);
      var options = {
        method: "POST",
        body: doctorParams
      };
      var base_url = window.location.origin;
      var url = base_url + '/api/addDoctor';
      var drerrorModal = tailwind.Modal.getInstance(document.querySelector("#warning-modal-preview"));
      fetch(url, options).then(function (response) {
        return response.json();
      }).then(function (data) {
        if (data.Success == 'Success') {
          $('#divDrMsg span').text(data.Message);
          $('#divDoctorCodeNo span').text(data.doctorCodeNo);
          if (data.ShowModal == 1) {
            var successModal = tailwind.Modal.getInstance(document.querySelector("#success-modal-preview"));
            successModal.show();
            document.getElementById("frmDoctor").reset();
          }
        } else {
          $('#divDrErrorHead span').text(data.Success);
          $('#divDrErrorMsg span').text(data.Message);
          if (data.ShowModal == 1) {
            drerrorModal.show();
          }
        }
      })["catch"](function (error) {
        $('#divDrErrorHead span').text('Error');
        $('#divDrErrorMsg span').text(error);
        drerrorModal.show();
      });
      window.scrollTo(0, 0);
    });
  }
  /* --------------- Doctor Add form submit End ------------------------*/
})();
/******/ })()
;