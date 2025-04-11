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
/******/ 	__webpack_require__.p = "/dist/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
__webpack_require__(2);

/***/ }),
/* 1 */
/***/ (function(module, exports) {

throw new Error("Module build failed: ModuleBuildError: Module build failed: \n  }\n  ^\n      Invalid CSS after \"  }\": expected 1 selector or at-rule, was \"<<<<<<< HEAD\"\n      in /Users/lawrence/Sites/localhost/asha-law/wp-content/themes/asha-law/sass/style.scss (line 39, column 4)\n    at /Users/lawrence/Sites/localhost/asha-law/wp-content/themes/asha-law/node_modules/webpack/lib/NormalModule.js:195:19\n    at /Users/lawrence/Sites/localhost/asha-law/wp-content/themes/asha-law/node_modules/loader-runner/lib/LoaderRunner.js:367:11\n    at /Users/lawrence/Sites/localhost/asha-law/wp-content/themes/asha-law/node_modules/loader-runner/lib/LoaderRunner.js:233:18\n    at context.callback (/Users/lawrence/Sites/localhost/asha-law/wp-content/themes/asha-law/node_modules/loader-runner/lib/LoaderRunner.js:111:13)\n    at Object.callback (/Users/lawrence/Sites/localhost/asha-law/wp-content/themes/asha-law/node_modules/sass-loader/lib/loader.js:55:13)\n    at Object.done [as callback] (/Users/lawrence/Sites/localhost/asha-law/wp-content/themes/asha-law/node_modules/neo-async/async.js:8069:18)\n    at options.error (/Users/lawrence/Sites/localhost/asha-law/wp-content/themes/asha-law/node_modules/node-sass/lib/index.js:293:32)");

/***/ }),
/* 2 */
/***/ (function(module, exports) {

$ = jQuery.noConflict();
let windowSize = false;
let windowHeight = $(window).height();
let gutenbergScrollAnims = false;
let blockTriggerHeight = $(window).height() * 0.33;

$(document).ready(function () {
  $('.c-single-quiz__gf-btn').click(function () {
    $('.dark-bg').addClass('show-dark-bg');
    $('.c-popup-modal').addClass('c-popup-modal__active');
    console.log('does this work');
  });

  $(".close-icon").click(function () {
    $(".overlay-menu").removeClass("show-overlay-menu");
  });

  if (jQuery(".gutenberg-styles > *").length && !(window.location.hash != "" && jQuery(window.location.hash).length)) {
    gutenbergScrollAnims = true;
    jQuery(".gutenberg-styles > *").each(function () {
      let offset = jQuery(this).get(0).getBoundingClientRect().top;
      jQuery(this).data("offset", offset);
      jQuery(this).addClass("to-reveal");
    });

    let numRevealed = 0;
    jQuery(".gutenberg-styles .to-reveal").each(function () {
      if (jQuery(window).scrollTop() + windowHeight - blockTriggerHeight >= jQuery(this).data("offset")) {
        numRevealed++;
        const thisRef = $(this);
        setTimeout(function () {
          thisRef.removeClass("to-reveal");
          thisRef.addClass("revealed");
        }, 700 + numRevealed * 600);
      }
    });
  }
});

$(window).scroll(() => {
  let scrolled = $(window).scrollTop();
  // gutenberg scroll anims
  if (gutenbergScrollAnims) {
    $(".gutenberg-styles .to-reveal").each(function () {
      if (scrolled + windowHeight - blockTriggerHeight >= $(this).data("offset")) {
        $(this).removeClass("to-reveal");
        $(this).addClass("revealed");
      }
    });
  }
});

$(window).resize(() => {
  if (jQuery(".gutenberg-styles > *").length && !(window.location.hash != "" && jQuery(window.location.hash).length)) {
    gutenbergScrollAnims = true;
    jQuery(".gutenberg-styles > *").each(function () {
      let offset = jQuery(this).get(0).getBoundingClientRect().top;
      jQuery(this).data("offset", offset);
      jQuery(this).addClass("to-reveal");
    });

    let numRevealed = 0;
    jQuery(".gutenberg-styles .to-reveal").each(function () {
      if (jQuery(window).scrollTop() + (windowHeight - blockTriggerHeight) >= jQuery(this).data("offset")) {
        numRevealed++;
        const thisRef = $(this);
        setTimeout(function () {
          thisRef.removeClass("to-reveal");
          thisRef.addClass("revealed");
        }, 700 + numRevealed * 600);
      }
    });
  }
});

/***/ })
/******/ ]);
//# sourceMappingURL=main.js.map