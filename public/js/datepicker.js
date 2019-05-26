/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 36);
/******/ })
/************************************************************************/
/******/ ({

/***/ 36:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(37);


/***/ }),

/***/ 37:
/***/ (function(module, exports) {

$(document).ready(function () {
    $('.dropdown-submenu a.submenu').on("click", function (e) {
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });

    if ($("#start_date").length) {
        $("#start_date").datepicker({
            title: "Start Date",
            format: "yyyy-mm-dd",
            startDate: new Date(),
            autoclose: true,
            zIndexOffset: 1000,
            ignoreReadonly: true
        });

        $("#end_date").click(function () {
            if ($("#start_date").datepicker("getDate") === null) {
                $(this).attr("placeholder", "Fill in start date first...");
            }
        });

        if ($("#start_date").datepicker("getDate") != null) {
            var date = $("#start_date").datepicker("getDate");
            date.setDate(date.getDate() + 1);
            $("#end_date").datepicker({
                title: "End Date",
                format: "yyyy-mm-dd",
                startDate: date,
                autoclose: true,
                zIndexOffset: 1000,
                ignoreReadonly: true
            });
        }

        $("#start_date").on("changeDate", function (e) {
            $("#end_date").attr("placeholder", "End date...");
            $("#end_date").datepicker("destroy");
            var date = $(this).datepicker("getDate");
            date.setDate(date.getDate() + 1);
            $("#end_date").datepicker({
                title: "End Date",
                format: "yyyy-mm-dd",
                startDate: date,
                autoclose: true,
                zIndexOffset: 1000,
                ignoreReadonly: true
            });
            $("#end_date").focus();
        });
    }

    if ($("#start_date_readonly").length) {
        var date = new Date($("#start_date_readonly").val());
        date.setDate(date.getDate() + 1);
        $("#end_date").datepicker({
            title: "End Date",
            format: "yyyy-mm-dd",
            startDate: date,
            autoclose: true,
            zIndexOffset: 1000,
            ignoreReadonly: true
        });
    }

    $("#start_date_calender").click(function () {
        $("#start_date").focus();
    });

    $("#end_date_calender").click(function () {
        $("#end_date").focus();
        if ($("#start_date").datepicker("getDate") === null) {
            $("#end_date").attr("placeholder", "Fill in start date first...");
        }
    });
});

/***/ })

/******/ });