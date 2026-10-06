/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/webp-in-css/polyfill.js":
/*!**********************************************!*\
  !*** ./node_modules/webp-in-css/polyfill.js ***!
  \**********************************************/
/***/ (function() {

document.body.classList.remove('no-js');var i=new Image;i.onload=i.onerror=function(){document.body.classList.add(i.height==1?"webp":"no-webp")};i.src="data:image/webp;base64,UklGRhoAAABXRUJQVlA4TA0AAAAvAAAAEAcQERGIiP4HAA==";


/***/ }),

/***/ "./app/src/js/header.js":
/*!******************************!*\
  !*** ./app/src/js/header.js ***!
  \******************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initHeaderMenu: function() { return /* binding */ initHeaderMenu; }
/* harmony export */ });
function initHeaderMenu() {
  var siteHeader = document.querySelector('.site-header');
  var nav = document.querySelector('.primary-navigation');
  var menuToggle = document.querySelector('.mobile-menu-toggle');
  if (siteHeader === null || nav === null || menuToggle === null) {
    return;
  }
  var closeMenu = function closeMenu() {
    nav.classList.remove('is-open');
    menuToggle.classList.remove('is-active');
    siteHeader.classList.remove('is-menu-open');
    document.body.classList.remove('menu-open');
    menuToggle.setAttribute('aria-expanded', 'false');
  };
  var openMenu = function openMenu() {
    nav.classList.add('is-open');
    menuToggle.classList.add('is-active');
    siteHeader.classList.add('is-menu-open');
    document.body.classList.add('menu-open');
    menuToggle.setAttribute('aria-expanded', 'true');
  };
  menuToggle.addEventListener('click', function () {
    if (nav.classList.contains('is-open')) {
      closeMenu();
      return;
    }
    openMenu();
  });
  nav.addEventListener('click', function (event) {
    var target = event.target;
    if (!(target instanceof Element)) {
      return;
    }
    if (target.closest('a') !== null) {
      closeMenu();
    }
  });
  document.addEventListener('click', function (event) {
    if (!nav.classList.contains('is-open')) {
      return;
    }
    var target = event.target;
    if (!(target instanceof Element)) {
      return;
    }
    var clickedToggle = target.closest('.mobile-menu-toggle') !== null;
    var clickedNav = target.closest('.primary-navigation') !== null;
    if (!clickedToggle && !clickedNav) {
      closeMenu();
    }
  });
  window.addEventListener('resize', function () {
    if (window.innerWidth > 768) {
      closeMenu();
    }
  });
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && nav.classList.contains('is-open')) {
      closeMenu();
    }
  });
}

/***/ }),

/***/ "./app/src/js/posts.js":
/*!*****************************!*\
  !*** ./app/src/js/posts.js ***!
  \*****************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initPostTabs: function() { return /* binding */ initPostTabs; }
/* harmony export */ });
function initPostTabs() {
  document.querySelectorAll('[data-post-filters]').forEach(function (tabList) {
    var tabs = Array.from(tabList.querySelectorAll('[data-post-filter]'));
    var gridId = tabList.getAttribute('aria-controls');
    var grid = gridId ? document.getElementById(gridId) : tabList.parentElement.querySelector('[data-post-grid]');
    if (tabs.length === 0 || grid === null) {
      return;
    }
    var cards = Array.from(grid.querySelectorAll('[data-post-card]'));
    var emptyState = grid.querySelector('[data-post-empty]');
    var activateTab = function activateTab(activeTab, moveFocus) {
      var selectedCategory = activeTab.dataset.postFilter;
      var visibleCards = 0;
      tabs.forEach(function (tab) {
        var isActive = tab === activeTab;
        tab.setAttribute('aria-selected', String(isActive));
        tab.setAttribute('tabindex', isActive ? '0' : '-1');
        if (isActive && moveFocus) {
          tab.focus();
        }
      });
      if (activeTab.id) {
        grid.setAttribute('aria-labelledby', activeTab.id);
      }
      cards.forEach(function (card) {
        var categories = (card.dataset.categories || '').split(/\s+/).filter(Boolean);
        var isVisible = selectedCategory === 'all' || categories.includes(selectedCategory);
        card.hidden = !isVisible;
        if (isVisible) {
          visibleCards += 1;
        }
      });
      if (emptyState) {
        emptyState.hidden = visibleCards !== 0;
      }
    };
    tabs.forEach(function (tab, index) {
      tab.addEventListener('click', function () {
        return activateTab(tab, false);
      });
      tab.addEventListener('keydown', function (event) {
        var nextIndex = index;
        if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
          nextIndex = (index + 1) % tabs.length;
        } else if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
          nextIndex = (index - 1 + tabs.length) % tabs.length;
        } else if (event.key === 'Home') {
          nextIndex = 0;
        } else if (event.key === 'End') {
          nextIndex = tabs.length - 1;
        } else {
          return;
        }
        event.preventDefault();
        activateTab(tabs[nextIndex], true);
      });
    });
  });
}

/***/ }),

/***/ "./app/src/js/reader-reviews.js":
/*!**************************************!*\
  !*** ./app/src/js/reader-reviews.js ***!
  \**************************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initReaderReviewsSlider: function() { return /* binding */ initReaderReviewsSlider; }
/* harmony export */ });
function initReaderReviewsSlider() {
  var section = document.querySelector('[data-reader-reviews]');
  if (!section) {
    return;
  }
  var track = section.querySelector('[data-reader-reviews-track]');
  var slides = Array.from(section.querySelectorAll('[data-reader-review]'));
  var dots = Array.from(section.querySelectorAll('[data-reader-review-dot]'));
  if (!track || slides.length < 2 || dots.length !== slides.length) {
    return;
  }
  var setActiveDot = function setActiveDot(activeIndex) {
    dots.forEach(function (dot, index) {
      dot.setAttribute('aria-current', String(index === activeIndex));
    });
  };
  dots.forEach(function (dot, index) {
    dot.addEventListener('click', function () {
      var slide = slides[index];
      var targetLeft = slide.getBoundingClientRect().left - track.getBoundingClientRect().left + track.scrollLeft;
      var behavior = window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth';
      track.scrollTo({
        left: targetLeft,
        behavior: behavior
      });
      setActiveDot(index);
    });
  });
  var scrollFrame = null;
  track.addEventListener('scroll', function () {
    if (scrollFrame !== null) {
      window.cancelAnimationFrame(scrollFrame);
    }
    scrollFrame = window.requestAnimationFrame(function () {
      var trackLeft = track.getBoundingClientRect().left;
      var activeIndex = 0;
      var nearestDistance = Number.POSITIVE_INFINITY;
      slides.forEach(function (slide, index) {
        var distance = Math.abs(slide.getBoundingClientRect().left - trackLeft);
        if (distance < nearestDistance) {
          nearestDistance = distance;
          activeIndex = index;
        }
      });
      setActiveDot(activeIndex);
      scrollFrame = null;
    });
  }, {
    passive: true
  });
}

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		if (!(moduleId in __webpack_modules__)) {
/******/ 			delete __webpack_module_cache__[moduleId];
/******/ 			var e = new Error("Cannot find module '" + moduleId + "'");
/******/ 			e.code = 'MODULE_NOT_FOUND';
/******/ 			throw e;
/******/ 		}
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
!function() {
"use strict";
/*!****************************!*\
  !*** ./app/src/js/main.js ***!
  \****************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var webp_in_css_polyfill__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! webp-in-css/polyfill */ "./node_modules/webp-in-css/polyfill.js");
/* harmony import */ var _header__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./header */ "./app/src/js/header.js");
/* harmony import */ var _posts__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./posts */ "./app/src/js/posts.js");
/* harmony import */ var _reader_reviews__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./reader-reviews */ "./app/src/js/reader-reviews.js");




document.addEventListener('DOMContentLoaded', function () {
  (0,_header__WEBPACK_IMPORTED_MODULE_1__.initHeaderMenu)();
  (0,_posts__WEBPACK_IMPORTED_MODULE_2__.initPostTabs)();
  (0,_reader_reviews__WEBPACK_IMPORTED_MODULE_3__.initReaderReviewsSlider)();
});
}();
/******/ })()
;
//# sourceMappingURL=main.js.map