/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/webp-in-css/polyfill.js":
/*!**********************************************!*\
  !*** ./node_modules/webp-in-css/polyfill.js ***!
  \**********************************************/
/***/ (function() {

document.body.classList.remove('no-js');var i=new Image;i.onload=i.onerror=function(){document.body.classList.add(i.height==1?"webp":"no-webp")};i.src="data:image/webp;base64,UklGRhoAAABXRUJQVlA4TA0AAAAvAAAAEAcQERGIiP4HAA==";


/***/ }),

/***/ "./app/src/js/contact.js":
/*!*******************************!*\
  !*** ./app/src/js/contact.js ***!
  \*******************************/
/***/ (function(__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initContactForm: function() { return /* binding */ initContactForm; }
/* harmony export */ });
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i.return) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function initContactForm() {
  var form = document.querySelector('[data-contact-form]');
  var status = document.querySelector('[data-contact-status]');
  var submitButton = form === null || form === void 0 ? void 0 : form.querySelector('[type="submit"]');
  if (!(form instanceof HTMLFormElement) || !(status instanceof HTMLElement) || !(submitButton instanceof HTMLButtonElement)) {
    return;
  }
  var fields = Array.from(form.querySelectorAll('input:not([type="hidden"]), textarea'));
  var clearFieldError = function clearFieldError(field) {
    return field.removeAttribute('aria-invalid');
  };
  fields.forEach(function (field) {
    field.addEventListener('input', function () {
      return clearFieldError(field);
    });
    field.addEventListener('change', function () {
      return clearFieldError(field);
    });
  });
  form.addEventListener('submit', /*#__PURE__*/function () {
    var _ref = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee(event) {
      var _config$errors2;
      var invalidField, config, formData, _config$errors, _result$data3, response, result, _result$data, _result$data2, _config$errors3, fieldErrors, firstInvalid, _config$errors4, genericError, _t;
      return _regenerator().w(function (_context) {
        while (1) switch (_context.p = _context.n) {
          case 0:
            event.preventDefault();
            status.textContent = '';
            fields.forEach(clearFieldError);
            invalidField = fields.find(function (field) {
              return !field.checkValidity();
            });
            if (!invalidField) {
              _context.n = 1;
              break;
            }
            invalidField.setAttribute('aria-invalid', 'true');
            invalidField.reportValidity();
            return _context.a(2);
          case 1:
            config = window.futuretechContact;
            formData = new FormData(form);
            if (!(!(config !== null && config !== void 0 && config.ajaxUrl) || !config.nonce)) {
              _context.n = 2;
              break;
            }
            status.textContent = (config === null || config === void 0 || (_config$errors = config.errors) === null || _config$errors === void 0 ? void 0 : _config$errors.unavailable) || 'The contact form is not available right now. Please try again later.';
            status.dataset.state = 'error';
            return _context.a(2);
          case 2:
            formData.set('action', 'futuretech_contact_form');
            formData.set('nonce', config.nonce);
            submitButton.disabled = true;
            submitButton.classList.add('is-loading');
            submitButton.setAttribute('aria-busy', 'true');
            status.dataset.state = 'loading';
            status.textContent = ((_config$errors2 = config.errors) === null || _config$errors2 === void 0 ? void 0 : _config$errors2.sending) || 'Sending your message…';
            _context.p = 3;
            _context.n = 4;
            return fetch(config.ajaxUrl, {
              method: 'POST',
              credentials: 'same-origin',
              body: formData
            });
          case 4:
            response = _context.v;
            _context.n = 5;
            return response.json();
          case 5:
            result = _context.v;
            if (!(!response.ok || !result.success)) {
              _context.n = 6;
              break;
            }
            fieldErrors = ((_result$data = result.data) === null || _result$data === void 0 ? void 0 : _result$data.fields) || {};
            firstInvalid = fields.find(function (field) {
              return Object.prototype.hasOwnProperty.call(fieldErrors, field.name);
            });
            if (firstInvalid) {
              firstInvalid.setAttribute('aria-invalid', 'true');
              firstInvalid.focus();
            }
            throw new Error(((_result$data2 = result.data) === null || _result$data2 === void 0 ? void 0 : _result$data2.message) || ((_config$errors3 = config.errors) === null || _config$errors3 === void 0 ? void 0 : _config$errors3.generic) || 'Your message could not be sent. Please try again.');
          case 6:
            form.reset();
            status.dataset.state = 'success';
            status.textContent = ((_result$data3 = result.data) === null || _result$data3 === void 0 ? void 0 : _result$data3.message) || 'Thanks for reaching out. Your message has been sent.';
            _context.n = 8;
            break;
          case 7:
            _context.p = 7;
            _t = _context.v;
            status.dataset.state = 'error';
            genericError = ((_config$errors4 = config.errors) === null || _config$errors4 === void 0 ? void 0 : _config$errors4.generic) || 'Your message could not be sent. Please try again.';
            status.textContent = _t instanceof Error && !(_t instanceof SyntaxError) && !(_t instanceof TypeError) ? _t.message : genericError;
          case 8:
            _context.p = 8;
            submitButton.disabled = false;
            submitButton.classList.remove('is-loading');
            submitButton.removeAttribute('aria-busy');
            return _context.f(8);
          case 9:
            return _context.a(2);
        }
      }, _callee, null, [[3, 7, 8, 9]]);
    }));
    return function (_x) {
      return _ref.apply(this, arguments);
    };
  }());
}

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
    var featuredCardLimit = Number(grid.dataset.postFeaturedCount || 0);
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
        if (featuredCardLimit > 0) {
          card.classList.toggle('resource-card--featured', isVisible && visibleCards < featuredCardLimit);
        }
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
    var requestedResourceType = new URLSearchParams(window.location.search).get('resource_type');
    var requestedTab = tabs.find(function (tab) {
      return tab.dataset.postFilter === requestedResourceType;
    });
    if (requestedTab) {
      activateTab(requestedTab, false);
    }
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
/* harmony import */ var _contact__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./contact */ "./app/src/js/contact.js");





document.addEventListener('DOMContentLoaded', function () {
  (0,_header__WEBPACK_IMPORTED_MODULE_1__.initHeaderMenu)();
  (0,_posts__WEBPACK_IMPORTED_MODULE_2__.initPostTabs)();
  (0,_reader_reviews__WEBPACK_IMPORTED_MODULE_3__.initReaderReviewsSlider)();
  (0,_contact__WEBPACK_IMPORTED_MODULE_4__.initContactForm)();
});
}();
/******/ })()
;