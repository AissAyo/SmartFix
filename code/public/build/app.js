(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var _js_adminlte__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./js/adminlte */ "./assets/js/adminlte.js");
/* harmony import */ var _js_adminlte__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_js_adminlte__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var chart_js_auto__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! chart.js/auto */ "./node_modules/chart.js/auto/auto.js");
/* harmony import */ var chartjs_plugin_zoom__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! chartjs-plugin-zoom */ "./node_modules/chartjs-plugin-zoom/dist/chartjs-plugin-zoom.esm.js");
/* harmony import */ var _symfony_ux_chartjs__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @symfony/ux-chartjs */ "./node_modules/@symfony/ux-chartjs/dist/controller.js");
/* harmony import */ var _hotwired_stimulus__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @hotwired/stimulus */ "./node_modules/@hotwired/stimulus/dist/stimulus.js");
/* harmony import */ var _js_map_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./js/map.js */ "./assets/js/map.js");
/* harmony import */ var _js_map_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_js_map_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _js_theme_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./js/theme.js */ "./assets/js/theme.js");
/* harmony import */ var _js_theme_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_js_theme_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var _js_pricetable_toggler_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./js/pricetable-toggler.js */ "./assets/js/pricetable-toggler.js");
/* harmony import */ var _js_pricetable_toggler_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(_js_pricetable_toggler_js__WEBPACK_IMPORTED_MODULE_9__);
/* provided dependency */ var __webpack_provided_window_dot_jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
// ✅ FIRST: Import jQuery and assign it globally

window.$ = (jquery__WEBPACK_IMPORTED_MODULE_0___default());
__webpack_provided_window_dot_jQuery = (jquery__WEBPACK_IMPORTED_MODULE_0___default());

// ✅ THEN: Import other libraries that rely on jQuery

 // This one uses jQuery too

// ✅ ChartJS and plugins


chart_js_auto__WEBPACK_IMPORTED_MODULE_3__["default"].register(chartjs_plugin_zoom__WEBPACK_IMPORTED_MODULE_4__["default"]);


// ✅ Stimulus


// ✅ Other custom scripts (map, theme, etc.)




// ✅ Optional: Font Awesome
// import '@fortawesome/fontawesome-free/js/all';

/***/ }),

/***/ "./assets/js/adminlte.js":
/*!*******************************!*\
  !*** ./assets/js/adminlte.js ***!
  \*******************************/
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
__webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
__webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
__webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
__webpack_require__(/*! core-js/modules/es.symbol.to-primitive.js */ "./node_modules/core-js/modules/es.symbol.to-primitive.js");
__webpack_require__(/*! core-js/modules/es.error.cause.js */ "./node_modules/core-js/modules/es.error.cause.js");
__webpack_require__(/*! core-js/modules/es.error.to-string.js */ "./node_modules/core-js/modules/es.error.to-string.js");
__webpack_require__(/*! core-js/modules/es.array.concat.js */ "./node_modules/core-js/modules/es.array.concat.js");
__webpack_require__(/*! core-js/modules/es.array.find.js */ "./node_modules/core-js/modules/es.array.find.js");
__webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
__webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");
__webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
__webpack_require__(/*! core-js/modules/es.array.push.js */ "./node_modules/core-js/modules/es.array.push.js");
__webpack_require__(/*! core-js/modules/es.date.to-primitive.js */ "./node_modules/core-js/modules/es.date.to-primitive.js");
__webpack_require__(/*! core-js/modules/es.global-this.js */ "./node_modules/core-js/modules/es.global-this.js");
__webpack_require__(/*! core-js/modules/es.number.constructor.js */ "./node_modules/core-js/modules/es.number.constructor.js");
__webpack_require__(/*! core-js/modules/es.object.assign.js */ "./node_modules/core-js/modules/es.object.assign.js");
__webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
__webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
__webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
__webpack_require__(/*! core-js/modules/es.string.starts-with.js */ "./node_modules/core-js/modules/es.string.starts-with.js");
__webpack_require__(/*! core-js/modules/esnext.iterator.constructor.js */ "./node_modules/core-js/modules/esnext.iterator.constructor.js");
__webpack_require__(/*! core-js/modules/esnext.iterator.find.js */ "./node_modules/core-js/modules/esnext.iterator.find.js");
__webpack_require__(/*! core-js/modules/esnext.iterator.for-each.js */ "./node_modules/core-js/modules/esnext.iterator.for-each.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
__webpack_require__(/*! core-js/modules/web.self.js */ "./node_modules/core-js/modules/web.self.js");
__webpack_require__(/*! core-js/modules/web.timers.js */ "./node_modules/core-js/modules/web.timers.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
/*!
 * AdminLTE v4.0.0-beta3 (https://adminlte.io)
 * Copyright 2014-2024 Colorlib <https://colorlib.com>
 * Licensed under MIT (https://github.com/ColorlibHQ/AdminLTE/blob/master/LICENSE)
 */
(function (global, factory) {
  ( false ? 0 : _typeof(exports)) === 'object' && "object" !== 'undefined' ? factory(exports) :  true ? !(__WEBPACK_AMD_DEFINE_ARRAY__ = [exports], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : (0);
})(this, function (exports) {
  'use strict';

  var domContentLoadedCallbacks = [];
  var onDOMContentLoaded = function onDOMContentLoaded(callback) {
    if (document.readyState === 'loading') {
      // add listener on the first call when the document is in loading state
      if (!domContentLoadedCallbacks.length) {
        document.addEventListener('DOMContentLoaded', function () {
          for (var _i = 0, _domContentLoadedCall = domContentLoadedCallbacks; _i < _domContentLoadedCall.length; _i++) {
            var _callback = _domContentLoadedCall[_i];
            _callback();
          }
        });
      }
      domContentLoadedCallbacks.push(callback);
    } else {
      callback();
    }
  };
  /* SLIDE UP */
  var slideUp = function slideUp(target) {
    var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
    target.style.transitionProperty = 'height, margin, padding';
    target.style.transitionDuration = "".concat(duration, "ms");
    target.style.boxSizing = 'border-box';
    target.style.height = "".concat(target.offsetHeight, "px");
    target.style.overflow = 'hidden';
    window.setTimeout(function () {
      target.style.height = '0';
      target.style.paddingTop = '0';
      target.style.paddingBottom = '0';
      target.style.marginTop = '0';
      target.style.marginBottom = '0';
    }, 1);
    window.setTimeout(function () {
      target.style.display = 'none';
      target.style.removeProperty('height');
      target.style.removeProperty('padding-top');
      target.style.removeProperty('padding-bottom');
      target.style.removeProperty('margin-top');
      target.style.removeProperty('margin-bottom');
      target.style.removeProperty('overflow');
      target.style.removeProperty('transition-duration');
      target.style.removeProperty('transition-property');
    }, duration);
  };
  /* SLIDE DOWN */
  var slideDown = function slideDown(target) {
    var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
    target.style.removeProperty('display');
    var _window$getComputedSt = window.getComputedStyle(target),
      display = _window$getComputedSt.display;
    if (display === 'none') {
      display = 'block';
    }
    target.style.display = display;
    var height = target.offsetHeight;
    target.style.overflow = 'hidden';
    target.style.height = '0';
    target.style.paddingTop = '0';
    target.style.paddingBottom = '0';
    target.style.marginTop = '0';
    target.style.marginBottom = '0';
    window.setTimeout(function () {
      target.style.boxSizing = 'border-box';
      target.style.transitionProperty = 'height, margin, padding';
      target.style.transitionDuration = "".concat(duration, "ms");
      target.style.height = "".concat(height, "px");
      target.style.removeProperty('padding-top');
      target.style.removeProperty('padding-bottom');
      target.style.removeProperty('margin-top');
      target.style.removeProperty('margin-bottom');
    }, 1);
    window.setTimeout(function () {
      target.style.removeProperty('height');
      target.style.removeProperty('overflow');
      target.style.removeProperty('transition-duration');
      target.style.removeProperty('transition-property');
    }, duration);
  };

  /**
   * --------------------------------------------
   * @file AdminLTE layout.ts
   * @description Layout for AdminLTE.
   * @license MIT
   * --------------------------------------------
   */
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  var CLASS_NAME_HOLD_TRANSITIONS = 'hold-transition';
  var CLASS_NAME_APP_LOADED = 'app-loaded';
  /**
   * Class Definition
   * ====================================================
   */
  var Layout = /*#__PURE__*/function () {
    function Layout(element) {
      _classCallCheck(this, Layout);
      this._element = element;
    }
    return _createClass(Layout, [{
      key: "holdTransition",
      value: function holdTransition() {
        var resizeTimer;
        window.addEventListener('resize', function () {
          document.body.classList.add(CLASS_NAME_HOLD_TRANSITIONS);
          clearTimeout(resizeTimer);
          resizeTimer = setTimeout(function () {
            document.body.classList.remove(CLASS_NAME_HOLD_TRANSITIONS);
          }, 400);
        });
      }
    }]);
  }();
  onDOMContentLoaded(function () {
    var data = new Layout(document.body);
    data.holdTransition();
    setTimeout(function () {
      document.body.classList.add(CLASS_NAME_APP_LOADED);
    }, 400);
  });

  /**
   * --------------------------------------------
   * @file AdminLTE push-menu.ts
   * @description Push menu for AdminLTE.
   * @license MIT
   * --------------------------------------------
   */
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  var DATA_KEY$4 = 'lte.push-menu';
  var EVENT_KEY$4 = ".".concat(DATA_KEY$4);
  var EVENT_OPEN = "open".concat(EVENT_KEY$4);
  var EVENT_COLLAPSE = "collapse".concat(EVENT_KEY$4);
  var CLASS_NAME_SIDEBAR_MINI = 'sidebar-mini';
  var CLASS_NAME_SIDEBAR_COLLAPSE = 'sidebar-collapse';
  var CLASS_NAME_SIDEBAR_OPEN = 'sidebar-open';
  var CLASS_NAME_SIDEBAR_EXPAND = 'sidebar-expand';
  var CLASS_NAME_SIDEBAR_OVERLAY = 'sidebar-overlay';
  var CLASS_NAME_MENU_OPEN$1 = 'menu-open';
  var SELECTOR_APP_SIDEBAR = '.app-sidebar';
  var SELECTOR_SIDEBAR_MENU = '.sidebar-menu';
  var SELECTOR_NAV_ITEM$1 = '.nav-item';
  var SELECTOR_NAV_TREEVIEW = '.nav-treeview';
  var SELECTOR_APP_WRAPPER = '.app-wrapper';
  var SELECTOR_SIDEBAR_EXPAND = "[class*=\"".concat(CLASS_NAME_SIDEBAR_EXPAND, "\"]");
  var SELECTOR_SIDEBAR_TOGGLE = '[data-lte-toggle="sidebar"]';
  var Defaults = {
    sidebarBreakpoint: 992
  };
  /**
   * Class Definition
   * ====================================================
   */
  var PushMenu = /*#__PURE__*/function () {
    function PushMenu(element, config) {
      _classCallCheck(this, PushMenu);
      this._element = element;
      this._config = Object.assign(Object.assign({}, Defaults), config);
    }
    // TODO
    return _createClass(PushMenu, [{
      key: "menusClose",
      value: function menusClose() {
        var navTreeview = document.querySelectorAll(SELECTOR_NAV_TREEVIEW);
        navTreeview.forEach(function (navTree) {
          navTree.style.removeProperty('display');
          navTree.style.removeProperty('height');
        });
        var navSidebar = document.querySelector(SELECTOR_SIDEBAR_MENU);
        var navItem = navSidebar === null || navSidebar === void 0 ? void 0 : navSidebar.querySelectorAll(SELECTOR_NAV_ITEM$1);
        if (navItem) {
          navItem.forEach(function (navI) {
            navI.classList.remove(CLASS_NAME_MENU_OPEN$1);
          });
        }
      }
    }, {
      key: "expand",
      value: function expand() {
        var event = new Event(EVENT_OPEN);
        document.body.classList.remove(CLASS_NAME_SIDEBAR_COLLAPSE);
        document.body.classList.add(CLASS_NAME_SIDEBAR_OPEN);
        this._element.dispatchEvent(event);
      }
    }, {
      key: "collapse",
      value: function collapse() {
        var event = new Event(EVENT_COLLAPSE);
        document.body.classList.remove(CLASS_NAME_SIDEBAR_OPEN);
        document.body.classList.add(CLASS_NAME_SIDEBAR_COLLAPSE);
        this._element.dispatchEvent(event);
      }
    }, {
      key: "addSidebarBreakPoint",
      value: function addSidebarBreakPoint() {
        var _a, _b, _c;
        var sidebarExpandList = (_b = (_a = document.querySelector(SELECTOR_SIDEBAR_EXPAND)) === null || _a === void 0 ? void 0 : _a.classList) !== null && _b !== void 0 ? _b : [];
        var sidebarExpand = (_c = Array.from(sidebarExpandList).find(function (className) {
          return className.startsWith(CLASS_NAME_SIDEBAR_EXPAND);
        })) !== null && _c !== void 0 ? _c : '';
        var sidebar = document.getElementsByClassName(sidebarExpand)[0];
        var sidebarContent = window.getComputedStyle(sidebar, '::before').getPropertyValue('content');
        this._config = Object.assign(Object.assign({}, this._config), {
          sidebarBreakpoint: Number(sidebarContent.replace(/[^\d.-]/g, ''))
        });
        if (window.innerWidth <= this._config.sidebarBreakpoint) {
          this.collapse();
        } else {
          if (!document.body.classList.contains(CLASS_NAME_SIDEBAR_MINI)) {
            this.expand();
          }
          if (document.body.classList.contains(CLASS_NAME_SIDEBAR_MINI) && document.body.classList.contains(CLASS_NAME_SIDEBAR_COLLAPSE)) {
            this.collapse();
          }
        }
      }
    }, {
      key: "toggle",
      value: function toggle() {
        if (document.body.classList.contains(CLASS_NAME_SIDEBAR_COLLAPSE)) {
          this.expand();
        } else {
          this.collapse();
        }
      }
    }, {
      key: "init",
      value: function init() {
        this.addSidebarBreakPoint();
      }
    }]);
  }();
  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */
  onDOMContentLoaded(function () {
    var _a;
    var sidebar = document === null || document === void 0 ? void 0 : document.querySelector(SELECTOR_APP_SIDEBAR);
    if (sidebar) {
      var data = new PushMenu(sidebar, Defaults);
      data.init();
      window.addEventListener('resize', function () {
        data.init();
      });
    }
    var sidebarOverlay = document.createElement('div');
    sidebarOverlay.className = CLASS_NAME_SIDEBAR_OVERLAY;
    (_a = document.querySelector(SELECTOR_APP_WRAPPER)) === null || _a === void 0 ? void 0 : _a.append(sidebarOverlay);
    sidebarOverlay.addEventListener('touchstart', function (event) {
      event.preventDefault();
      var target = event.currentTarget;
      var data = new PushMenu(target, Defaults);
      data.collapse();
    }, {
      passive: true
    });
    sidebarOverlay.addEventListener('click', function (event) {
      event.preventDefault();
      var target = event.currentTarget;
      var data = new PushMenu(target, Defaults);
      data.collapse();
    });
    var fullBtn = document.querySelectorAll(SELECTOR_SIDEBAR_TOGGLE);
    fullBtn.forEach(function (btn) {
      btn.addEventListener('click', function (event) {
        event.preventDefault();
        var button = event.currentTarget;
        if ((button === null || button === void 0 ? void 0 : button.dataset.lteToggle) !== 'sidebar') {
          button = button === null || button === void 0 ? void 0 : button.closest(SELECTOR_SIDEBAR_TOGGLE);
        }
        if (button) {
          event === null || event === void 0 ? void 0 : event.preventDefault();
          var _data = new PushMenu(button, Defaults);
          _data.toggle();
        }
      });
    });
  });

  /**
   * --------------------------------------------
   * @file AdminLTE treeview.ts
   * @description Treeview plugin for AdminLTE.
   * @license MIT
   * --------------------------------------------
   */
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  // const NAME = 'Treeview'
  var DATA_KEY$3 = 'lte.treeview';
  var EVENT_KEY$3 = ".".concat(DATA_KEY$3);
  var EVENT_EXPANDED$2 = "expanded".concat(EVENT_KEY$3);
  var EVENT_COLLAPSED$2 = "collapsed".concat(EVENT_KEY$3);
  // const EVENT_LOAD_DATA_API = `load${EVENT_KEY}`
  var CLASS_NAME_MENU_OPEN = 'menu-open';
  var SELECTOR_NAV_ITEM = '.nav-item';
  var SELECTOR_NAV_LINK = '.nav-link';
  var SELECTOR_TREEVIEW_MENU = '.nav-treeview';
  var SELECTOR_DATA_TOGGLE$1 = '[data-lte-toggle="treeview"]';
  var Default$1 = {
    animationSpeed: 300,
    accordion: true
  };
  /**
   * Class Definition
   * ====================================================
   */
  var Treeview = /*#__PURE__*/function () {
    function Treeview(element, config) {
      _classCallCheck(this, Treeview);
      this._element = element;
      this._config = Object.assign(Object.assign({}, Default$1), config);
    }
    return _createClass(Treeview, [{
      key: "open",
      value: function open() {
        var _this = this;
        var _a, _b;
        var event = new Event(EVENT_EXPANDED$2);
        if (this._config.accordion) {
          var openMenuList = (_a = this._element.parentElement) === null || _a === void 0 ? void 0 : _a.querySelectorAll("".concat(SELECTOR_NAV_ITEM, ".").concat(CLASS_NAME_MENU_OPEN));
          openMenuList === null || openMenuList === void 0 ? void 0 : openMenuList.forEach(function (openMenu) {
            if (openMenu !== _this._element.parentElement) {
              openMenu.classList.remove(CLASS_NAME_MENU_OPEN);
              var _childElement = openMenu === null || openMenu === void 0 ? void 0 : openMenu.querySelector(SELECTOR_TREEVIEW_MENU);
              if (_childElement) {
                slideUp(_childElement, _this._config.animationSpeed);
              }
            }
          });
        }
        this._element.classList.add(CLASS_NAME_MENU_OPEN);
        var childElement = (_b = this._element) === null || _b === void 0 ? void 0 : _b.querySelector(SELECTOR_TREEVIEW_MENU);
        if (childElement) {
          slideDown(childElement, this._config.animationSpeed);
        }
        this._element.dispatchEvent(event);
      }
    }, {
      key: "close",
      value: function close() {
        var _a;
        var event = new Event(EVENT_COLLAPSED$2);
        this._element.classList.remove(CLASS_NAME_MENU_OPEN);
        var childElement = (_a = this._element) === null || _a === void 0 ? void 0 : _a.querySelector(SELECTOR_TREEVIEW_MENU);
        if (childElement) {
          slideUp(childElement, this._config.animationSpeed);
        }
        this._element.dispatchEvent(event);
      }
    }, {
      key: "toggle",
      value: function toggle() {
        if (this._element.classList.contains(CLASS_NAME_MENU_OPEN)) {
          this.close();
        } else {
          this.open();
        }
      }
    }]);
  }();
  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */
  onDOMContentLoaded(function () {
    var button = document.querySelectorAll(SELECTOR_DATA_TOGGLE$1);
    button.forEach(function (btn) {
      btn.addEventListener('click', function (event) {
        var target = event.target;
        var targetItem = target.closest(SELECTOR_NAV_ITEM);
        var targetLink = target.closest(SELECTOR_NAV_LINK);
        if ((target === null || target === void 0 ? void 0 : target.getAttribute('href')) === '#' || (targetLink === null || targetLink === void 0 ? void 0 : targetLink.getAttribute('href')) === '#') {
          event.preventDefault();
        }
        if (targetItem) {
          var data = new Treeview(targetItem, Default$1);
          data.toggle();
        }
      });
    });
  });

  /**
   * --------------------------------------------
   * @file AdminLTE direct-chat.ts
   * @description Direct chat for AdminLTE.
   * @license MIT
   * --------------------------------------------
   */
  /**
   * Constants
   * ====================================================
   */
  var DATA_KEY$2 = 'lte.direct-chat';
  var EVENT_KEY$2 = ".".concat(DATA_KEY$2);
  var EVENT_EXPANDED$1 = "expanded".concat(EVENT_KEY$2);
  var EVENT_COLLAPSED$1 = "collapsed".concat(EVENT_KEY$2);
  var SELECTOR_DATA_TOGGLE = '[data-lte-toggle="chat-pane"]';
  var SELECTOR_DIRECT_CHAT = '.direct-chat';
  var CLASS_NAME_DIRECT_CHAT_OPEN = 'direct-chat-contacts-open';
  /**
   * Class Definition
   * ====================================================
   */
  var DirectChat = /*#__PURE__*/function () {
    function DirectChat(element) {
      _classCallCheck(this, DirectChat);
      this._element = element;
    }
    return _createClass(DirectChat, [{
      key: "toggle",
      value: function toggle() {
        if (this._element.classList.contains(CLASS_NAME_DIRECT_CHAT_OPEN)) {
          var event = new Event(EVENT_COLLAPSED$1);
          this._element.classList.remove(CLASS_NAME_DIRECT_CHAT_OPEN);
          this._element.dispatchEvent(event);
        } else {
          var _event = new Event(EVENT_EXPANDED$1);
          this._element.classList.add(CLASS_NAME_DIRECT_CHAT_OPEN);
          this._element.dispatchEvent(_event);
        }
      }
    }]);
  }();
  /**
   *
   * Data Api implementation
   * ====================================================
   */
  onDOMContentLoaded(function () {
    var button = document.querySelectorAll(SELECTOR_DATA_TOGGLE);
    button.forEach(function (btn) {
      btn.addEventListener('click', function (event) {
        event.preventDefault();
        var target = event.target;
        var chatPane = target.closest(SELECTOR_DIRECT_CHAT);
        if (chatPane) {
          var data = new DirectChat(chatPane);
          data.toggle();
        }
      });
    });
  });

  /**
   * --------------------------------------------
   * @file AdminLTE card-widget.ts
   * @description Card widget for AdminLTE.
   * @license MIT
   * --------------------------------------------
   */
  /**
   * Constants
   * ====================================================
   */
  var DATA_KEY$1 = 'lte.card-widget';
  var EVENT_KEY$1 = ".".concat(DATA_KEY$1);
  var EVENT_COLLAPSED = "collapsed".concat(EVENT_KEY$1);
  var EVENT_EXPANDED = "expanded".concat(EVENT_KEY$1);
  var EVENT_REMOVE = "remove".concat(EVENT_KEY$1);
  var EVENT_MAXIMIZED$1 = "maximized".concat(EVENT_KEY$1);
  var EVENT_MINIMIZED$1 = "minimized".concat(EVENT_KEY$1);
  var CLASS_NAME_CARD = 'card';
  var CLASS_NAME_COLLAPSED = 'collapsed-card';
  var CLASS_NAME_COLLAPSING = 'collapsing-card';
  var CLASS_NAME_EXPANDING = 'expanding-card';
  var CLASS_NAME_WAS_COLLAPSED = 'was-collapsed';
  var CLASS_NAME_MAXIMIZED = 'maximized-card';
  var SELECTOR_DATA_REMOVE = '[data-lte-toggle="card-remove"]';
  var SELECTOR_DATA_COLLAPSE = '[data-lte-toggle="card-collapse"]';
  var SELECTOR_DATA_MAXIMIZE = '[data-lte-toggle="card-maximize"]';
  var SELECTOR_CARD = ".".concat(CLASS_NAME_CARD);
  var SELECTOR_CARD_BODY = '.card-body';
  var SELECTOR_CARD_FOOTER = '.card-footer';
  var Default = {
    animationSpeed: 500,
    collapseTrigger: SELECTOR_DATA_COLLAPSE,
    removeTrigger: SELECTOR_DATA_REMOVE,
    maximizeTrigger: SELECTOR_DATA_MAXIMIZE
  };
  var CardWidget = /*#__PURE__*/function () {
    function CardWidget(element, config) {
      _classCallCheck(this, CardWidget);
      this._element = element;
      this._parent = element.closest(SELECTOR_CARD);
      if (element.classList.contains(CLASS_NAME_CARD)) {
        this._parent = element;
      }
      this._config = Object.assign(Object.assign({}, Default), config);
    }
    return _createClass(CardWidget, [{
      key: "collapse",
      value: function collapse() {
        var _this2 = this;
        var _a, _b;
        var event = new Event(EVENT_COLLAPSED);
        if (this._parent) {
          this._parent.classList.add(CLASS_NAME_COLLAPSING);
          var elm = (_a = this._parent) === null || _a === void 0 ? void 0 : _a.querySelectorAll("".concat(SELECTOR_CARD_BODY, ", ").concat(SELECTOR_CARD_FOOTER));
          elm.forEach(function (el) {
            if (el instanceof HTMLElement) {
              slideUp(el, _this2._config.animationSpeed);
            }
          });
          setTimeout(function () {
            if (_this2._parent) {
              _this2._parent.classList.add(CLASS_NAME_COLLAPSED);
              _this2._parent.classList.remove(CLASS_NAME_COLLAPSING);
            }
          }, this._config.animationSpeed);
        }
        (_b = this._element) === null || _b === void 0 ? void 0 : _b.dispatchEvent(event);
      }
    }, {
      key: "expand",
      value: function expand() {
        var _this3 = this;
        var _a, _b;
        var event = new Event(EVENT_EXPANDED);
        if (this._parent) {
          this._parent.classList.add(CLASS_NAME_EXPANDING);
          var elm = (_a = this._parent) === null || _a === void 0 ? void 0 : _a.querySelectorAll("".concat(SELECTOR_CARD_BODY, ", ").concat(SELECTOR_CARD_FOOTER));
          elm.forEach(function (el) {
            if (el instanceof HTMLElement) {
              slideDown(el, _this3._config.animationSpeed);
            }
          });
          setTimeout(function () {
            if (_this3._parent) {
              _this3._parent.classList.remove(CLASS_NAME_COLLAPSED);
              _this3._parent.classList.remove(CLASS_NAME_EXPANDING);
            }
          }, this._config.animationSpeed);
        }
        (_b = this._element) === null || _b === void 0 ? void 0 : _b.dispatchEvent(event);
      }
    }, {
      key: "remove",
      value: function remove() {
        var _a;
        var event = new Event(EVENT_REMOVE);
        if (this._parent) {
          slideUp(this._parent, this._config.animationSpeed);
        }
        (_a = this._element) === null || _a === void 0 ? void 0 : _a.dispatchEvent(event);
      }
    }, {
      key: "toggle",
      value: function toggle() {
        var _a;
        if ((_a = this._parent) === null || _a === void 0 ? void 0 : _a.classList.contains(CLASS_NAME_COLLAPSED)) {
          this.expand();
          return;
        }
        this.collapse();
      }
    }, {
      key: "maximize",
      value: function maximize() {
        var _this4 = this;
        var _a;
        var event = new Event(EVENT_MAXIMIZED$1);
        if (this._parent) {
          this._parent.style.height = "".concat(this._parent.offsetHeight, "px");
          this._parent.style.width = "".concat(this._parent.offsetWidth, "px");
          this._parent.style.transition = 'all .15s';
          setTimeout(function () {
            var htmlTag = document.querySelector('html');
            if (htmlTag) {
              htmlTag.classList.add(CLASS_NAME_MAXIMIZED);
            }
            if (_this4._parent) {
              _this4._parent.classList.add(CLASS_NAME_MAXIMIZED);
              if (_this4._parent.classList.contains(CLASS_NAME_COLLAPSED)) {
                _this4._parent.classList.add(CLASS_NAME_WAS_COLLAPSED);
              }
            }
          }, 150);
        }
        (_a = this._element) === null || _a === void 0 ? void 0 : _a.dispatchEvent(event);
      }
    }, {
      key: "minimize",
      value: function minimize() {
        var _this5 = this;
        var _a;
        var event = new Event(EVENT_MINIMIZED$1);
        if (this._parent) {
          this._parent.style.height = 'auto';
          this._parent.style.width = 'auto';
          this._parent.style.transition = 'all .15s';
          setTimeout(function () {
            var _a;
            var htmlTag = document.querySelector('html');
            if (htmlTag) {
              htmlTag.classList.remove(CLASS_NAME_MAXIMIZED);
            }
            if (_this5._parent) {
              _this5._parent.classList.remove(CLASS_NAME_MAXIMIZED);
              if ((_a = _this5._parent) === null || _a === void 0 ? void 0 : _a.classList.contains(CLASS_NAME_WAS_COLLAPSED)) {
                _this5._parent.classList.remove(CLASS_NAME_WAS_COLLAPSED);
              }
            }
          }, 10);
        }
        (_a = this._element) === null || _a === void 0 ? void 0 : _a.dispatchEvent(event);
      }
    }, {
      key: "toggleMaximize",
      value: function toggleMaximize() {
        var _a;
        if ((_a = this._parent) === null || _a === void 0 ? void 0 : _a.classList.contains(CLASS_NAME_MAXIMIZED)) {
          this.minimize();
          return;
        }
        this.maximize();
      }
    }]);
  }();
  /**
   *
   * Data Api implementation
   * ====================================================
   */
  onDOMContentLoaded(function () {
    var collapseBtn = document.querySelectorAll(SELECTOR_DATA_COLLAPSE);
    collapseBtn.forEach(function (btn) {
      btn.addEventListener('click', function (event) {
        event.preventDefault();
        var target = event.target;
        var data = new CardWidget(target, Default);
        data.toggle();
      });
    });
    var removeBtn = document.querySelectorAll(SELECTOR_DATA_REMOVE);
    removeBtn.forEach(function (btn) {
      btn.addEventListener('click', function (event) {
        event.preventDefault();
        var target = event.target;
        var data = new CardWidget(target, Default);
        data.remove();
      });
    });
    var maxBtn = document.querySelectorAll(SELECTOR_DATA_MAXIMIZE);
    maxBtn.forEach(function (btn) {
      btn.addEventListener('click', function (event) {
        event.preventDefault();
        var target = event.target;
        var data = new CardWidget(target, Default);
        data.toggleMaximize();
      });
    });
  });

  /**
   * --------------------------------------------
   * @file AdminLTE fullscreen.ts
   * @description Fullscreen plugin for AdminLTE.
   * @license MIT
   * --------------------------------------------
   */
  /**
   * Constants
   * ============================================================================
   */
  var DATA_KEY = 'lte.fullscreen';
  var EVENT_KEY = ".".concat(DATA_KEY);
  var EVENT_MAXIMIZED = "maximized".concat(EVENT_KEY);
  var EVENT_MINIMIZED = "minimized".concat(EVENT_KEY);
  var SELECTOR_FULLSCREEN_TOGGLE = '[data-lte-toggle="fullscreen"]';
  var SELECTOR_MAXIMIZE_ICON = '[data-lte-icon="maximize"]';
  var SELECTOR_MINIMIZE_ICON = '[data-lte-icon="minimize"]';
  /**
   * Class Definition.
   * ============================================================================
   */
  var FullScreen = /*#__PURE__*/function () {
    function FullScreen(element, config) {
      _classCallCheck(this, FullScreen);
      this._element = element;
      this._config = config;
    }
    return _createClass(FullScreen, [{
      key: "inFullScreen",
      value: function inFullScreen() {
        var event = new Event(EVENT_MAXIMIZED);
        var iconMaximize = document.querySelector(SELECTOR_MAXIMIZE_ICON);
        var iconMinimize = document.querySelector(SELECTOR_MINIMIZE_ICON);
        void document.documentElement.requestFullscreen();
        if (iconMaximize) {
          iconMaximize.style.display = 'none';
        }
        if (iconMinimize) {
          iconMinimize.style.display = 'block';
        }
        this._element.dispatchEvent(event);
      }
    }, {
      key: "outFullscreen",
      value: function outFullscreen() {
        var event = new Event(EVENT_MINIMIZED);
        var iconMaximize = document.querySelector(SELECTOR_MAXIMIZE_ICON);
        var iconMinimize = document.querySelector(SELECTOR_MINIMIZE_ICON);
        void document.exitFullscreen();
        if (iconMaximize) {
          iconMaximize.style.display = 'block';
        }
        if (iconMinimize) {
          iconMinimize.style.display = 'none';
        }
        this._element.dispatchEvent(event);
      }
    }, {
      key: "toggleFullScreen",
      value: function toggleFullScreen() {
        if (document.fullscreenEnabled) {
          if (document.fullscreenElement) {
            this.outFullscreen();
          } else {
            this.inFullScreen();
          }
        }
      }
    }]);
  }();
  /**
   * Data Api implementation
   * ============================================================================
   */
  onDOMContentLoaded(function () {
    var buttons = document.querySelectorAll(SELECTOR_FULLSCREEN_TOGGLE);
    buttons.forEach(function (btn) {
      btn.addEventListener('click', function (event) {
        event.preventDefault();
        var target = event.target;
        var button = target.closest(SELECTOR_FULLSCREEN_TOGGLE);
        if (button) {
          var data = new FullScreen(button, undefined);
          data.toggleFullScreen();
        }
      });
    });
  });
  exports.CardWidget = CardWidget;
  exports.DirectChat = DirectChat;
  exports.FullScreen = FullScreen;
  exports.Layout = Layout;
  exports.PushMenu = PushMenu;
  exports.Treeview = Treeview;
});

/***/ }),

/***/ "./assets/js/map.js":
/*!**************************!*\
  !*** ./assets/js/map.js ***!
  \**************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
(function ($) {
  'use strict';

  $(document).ready(function () {
    //Google Map
    var mapProp = {
      center: new google.maps.LatLng(51.508742, -0.120850),
      zoom: 14,
      styles: [{
        "featureType": "all",
        "elementType": "all",
        "stylers": [{
          "visibility": "on"
        }]
      }, {
        "featureType": "all",
        "elementType": "geometry.fill",
        "stylers": [{
          "color": "#ffffff"
        }, {
          "visibility": "on"
        }]
      }, {
        "featureType": "all",
        "elementType": "labels.text.fill",
        "stylers": [{
          "saturation": 36
        }, {
          "color": "#aeaeae"
        }, {
          "lightness": 40
        }]
      }, {
        "featureType": "all",
        "elementType": "labels.text.stroke",
        "stylers": [{
          "visibility": "off"
        }, {
          "color": "#000000"
        }, {
          "lightness": 16
        }]
      }, {
        "featureType": "all",
        "elementType": "labels.icon",
        "stylers": [{
          "visibility": "off"
        }, {
          "color": "#aeaeae"
        }]
      }, {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [{
          "color": "#000000"
        }, {
          "lightness": 20
        }]
      }, {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [{
          "color": "#000000"
        }, {
          "lightness": 17
        }, {
          "weight": 1.2
        }]
      }, {
        "featureType": "administrative.country",
        "elementType": "geometry.fill",
        "stylers": [{
          "color": "#100d0d"
        }]
      }, {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [{
          "color": "#000000"
        }, {
          "lightness": 20
        }]
      }, {
        "featureType": "landscape.natural.landcover",
        "elementType": "geometry.fill",
        "stylers": [{
          "color": "#050404"
        }, {
          "visibility": "on"
        }]
      }, {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [{
          "color": "#000000"
        }, {
          "lightness": 21
        }]
      }, {
        "featureType": "poi.park",
        "elementType": "geometry.fill",
        "stylers": [{
          "saturation": "-43"
        }]
      }, {
        "featureType": "poi.park",
        "elementType": "geometry.stroke",
        "stylers": [{
          "visibility": "off"
        }]
      }, {
        "featureType": "road",
        "elementType": "geometry.fill",
        "stylers": [{
          "gamma": "10.00"
        }, {
          "lightness": "100"
        }, {
          "visibility": "on"
        }, {
          "color": "#1647c2"
        }]
      }, {
        "featureType": "road",
        "elementType": "geometry.stroke",
        "stylers": [{
          "color": "#c200ff"
        }]
      }, {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [{
          "color": "#000000"
        }, {
          "lightness": 17
        }]
      }, {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [{
          "color": "#000000"
        }, {
          "lightness": 29
        }, {
          "weight": 0.2
        }]
      }, {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [{
          "color": "#000000"
        }, {
          "lightness": 18
        }]
      }, {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [{
          "color": "#000000"
        }, {
          "lightness": 16
        }]
      }, {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [{
          "color": "#000000"
        }, {
          "lightness": 19
        }]
      }, {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [{
          "color": "#000000"
        }, {
          "lightness": 17
        }]
      }, {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [{
          "lightness": "-43"
        }, {
          "saturation": "6"
        }, {
          "gamma": "0.41"
        }, {
          "color": "#383838"
        }]
      }, {
        "featureType": "water",
        "elementType": "geometry.stroke",
        "stylers": [{
          "visibility": "off"
        }]
      }]
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
  });
})(jQuery);

/***/ }),

/***/ "./assets/js/pricetable-toggler.js":
/*!*****************************************!*\
  !*** ./assets/js/pricetable-toggler.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
(function ($) {
  'use strict';

  jQuery(document).ready(function () {
    // Pricetable Toggler
    var e = document.getElementById("filt-monthly"),
      d = document.getElementById("filt-yearly"),
      t = document.getElementById("switcher"),
      m = document.getElementById("monthly"),
      y = document.getElementById("yearly");
    e.addEventListener("click", function () {
      t.checked = false;
      e.classList.add("toggler--is-active");
      d.classList.remove("toggler--is-active");
      m.classList.remove("d-none");
      y.classList.add("d-none");
    });
    d.addEventListener("click", function () {
      t.checked = true;
      d.classList.add("toggler--is-active");
      e.classList.remove("toggler--is-active");
      m.classList.add("d-none");
      y.classList.remove("d-none");
    });
    t.addEventListener("click", function () {
      d.classList.toggle("toggler--is-active");
      e.classList.toggle("toggler--is-active");
      m.classList.toggle("d-none");
      y.classList.toggle("d-none");
    });
  });
})(jQuery);

/***/ }),

/***/ "./assets/js/theme.js":
/*!****************************!*\
  !*** ./assets/js/theme.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
__webpack_require__(/*! core-js/modules/es.array.find.js */ "./node_modules/core-js/modules/es.array.find.js");
__webpack_require__(/*! core-js/modules/es.array.reverse.js */ "./node_modules/core-js/modules/es.array.reverse.js");
__webpack_require__(/*! core-js/modules/es.date.to-string.js */ "./node_modules/core-js/modules/es.date.to-string.js");
__webpack_require__(/*! core-js/modules/es.number.to-fixed.js */ "./node_modules/core-js/modules/es.number.to-fixed.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/esnext.iterator.constructor.js */ "./node_modules/core-js/modules/esnext.iterator.constructor.js");
__webpack_require__(/*! core-js/modules/esnext.iterator.find.js */ "./node_modules/core-js/modules/esnext.iterator.find.js");
__webpack_require__(/*! core-js/modules/web.timers.js */ "./node_modules/core-js/modules/web.timers.js");
/*
Theme Name: Ducatibox - Car Service & Auto Repair Template
Version: 1.0
Author: WPThemeBooster
Author URL: 
Description: Ducatibox - Car Service & Auto Repair Template
*/
/*	IE 10 Fix*/

(function ($) {
  'use strict';

  jQuery(document).ready(function () {
    // Preloader
    setTimeout(function () {
      $('#preloader').addClass('hide');
    }, 1000);

    // Add Menu Item Current Class Auto
    function dynamicCurrentMenuClass(selector) {
      var FileName = window.location.href.split("/").reverse()[0];
      selector.find("li").each(function () {
        var anchor = $(this).find("a");
        if ($(anchor).attr("href") == FileName) {
          $(this).addClass("active");
        }
      });
      // if any li has .current elmnt add class
      selector.children("li").each(function () {
        if ($(this).find(".active").length) {
          $(this).addClass("active");
        }
      });
      // if no file name return
      if ("" == FileName) {
        selector.find("li").eq(0).addClass("active");
      }
    }
    if ($('.mainnav .main-menu').length) {
      dynamicCurrentMenuClass($('.mainnav .main-menu'));
    }

    // Mobile Responsive Menu 
    var mobileLogoContent = $('header .logo').html();
    var mobileMenuContent = $('.mainnav').html();
    $('.mr_menu .logo').append(mobileLogoContent);
    $('.mr_menu .mr_navmenu').append(mobileMenuContent);
    $('.mr_menu .mr_navmenu ul.main-menu li.menu-item-has-children').append($("<span class='submenu_opener'><i class='bi bi-chevron-right'></i></span>"));

    // Sub-Menu Open On-Click
    $('.mr_menu ul.main-menu li.menu-item-has-children .submenu_opener').on("click", function (e) {
      $(this).parent().toggleClass('nav_open');
      $(this).siblings('ul').slideToggle();
      e.stopPropagation();
      e.preventDefault();
    });

    // Active Mobile Responsive Menu : Add Class in body tag
    $('.mr_menu_toggle').on('click', function (e) {
      $('body').addClass('mr_menu_active');
      e.stopPropagation();
      e.preventDefault();
    });
    $('.mr_menu_close').on('click', function (e) {
      $('body').removeClass('mr_menu_active');
      e.stopPropagation();
      e.preventDefault();
    });

    // $('body').on('click', function(e) {
    //     $('body').removeClass('mr_menu_active');
    //     e.stopPropagation();
    //     e.preventDefault();
    // });

    // Aside info bar
    $('.aside_open').on("click", function (e) {
      e.preventDefault();
      $(this).addClass('close');
      $('.aside_info_wrapper').addClass('show');
    });
    $('.aside_close').on("click", function (e) {
      e.preventDefault();
      $('.aside_open').removeClass('close');
      $('.aside_info_wrapper').removeClass('show');
    });

    // Toggle Header Search
    $('.header_search .form-control-submit').on("click", function () {
      $('.open_search').toggleClass('active');
    });

    // Sticky Header
    var header = $("header");
    $(window).scroll(function () {
      var scroll = $(window).scrollTop();
      if (scroll >= 50) {
        header.addClass("sticky");
      } else {
        header.removeClass("sticky");
      }
    });

    // WOW Init
    new WOW().init();

    // Swiper Start

    // Main Slider One
    var SwiperSlider = new Swiper('.swiper-main-slider', {
      loop: true,
      // autoplay: {
      //     delay: 4000,
      // },
      autoHeight: true,
      speed: 2500,
      slidesPerView: 1,
      spaceBetween: 0,
      // navigation: {
      //     nextEl: '.swiper-button-next',
      //     prevEl: '.swiper-button-prev',
      // },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      }
    });

    // Main Slider Two
    var SwiperSlider2 = new Swiper('.style2 .swiper-main-slider', {
      loop: true,
      // autoplay: {
      //     delay: 4000,
      // },
      autoHeight: true,
      speed: 2500,
      slidesPerView: 1,
      spaceBetween: 0,
      // navigation: {
      //     nextEl: '.swiper-button-next',
      //     prevEl: '.swiper-button-prev',
      // },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: function renderBullet(index, className) {
          return '<span class="' + className + '">' + '<span class="number">' + (index + 1) + "</span>" + "</span>";
        }
      }
    });

    // Imagebox One
    var SwiperImagebox = new Swiper('.swiper-imagebox', {
      loop: true,
      autoplay: {
        delay: 4000
      },
      speed: 1500,
      slidesPerView: 1,
      spaceBetween: 0,
      // navigation: {
      //     nextEl: '.swiper-button-next',
      //     prevEl: '.swiper-button-prev',
      // },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      breakpoints: {
        600: {
          slidesPerView: 2
        },
        992: {
          slidesPerView: 3
        },
        1400: {
          slidesPerView: 4
        }
      }
    });

    // Testimonial One
    var SwiperTestimonial = new Swiper('.swiper-testimonial', {
      loop: true,
      autoplay: {
        delay: 4000
      },
      speed: 1500,
      slidesPerView: 1,
      spaceBetween: 30,
      // navigation: {
      //     nextEl: '.swiper-button-next',
      //     prevEl: '.swiper-button-prev',
      // },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      breakpoints: {
        768: {
          slidesPerView: 1
        }
      }
    });

    // Testimonial Two
    var SwiperTestimonialTwo = new Swiper('.swiper-testimonial2', {
      loop: true,
      // autoplay: {
      //     delay: 4000,
      // },
      speed: 1500,
      slidesPerView: 1,
      spaceBetween: 30,
      // navigation: {
      //     nextEl: '.swiper-button-next',
      //     prevEl: '.swiper-button-prev',
      // },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      breakpoints: {
        768: {
          slidesPerView: 1
        },
        1200: {
          slidesPerView: 3
        }
      }
    });

    // Clients Logo One
    var SwiperClients = new Swiper('.swiper-clients', {
      loop: true,
      autoplay: {
        delay: 4000
      },
      speed: 1500,
      slidesPerView: 1,
      spaceBetween: 30,
      // navigation: {
      //     nextEl: '.swiper-button-next',
      //     prevEl: '.swiper-button-prev',
      // },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      breakpoints: {
        400: {
          slidesPerView: 2
        },
        576: {
          slidesPerView: 3
        },
        992: {
          slidesPerView: 5
        }
      }
    });

    // Clients Logo Two
    var SwiperClients = new Swiper('.swiper-clients2', {
      loop: true,
      autoplay: {
        delay: 4000
      },
      speed: 1500,
      slidesPerView: 1,
      spaceBetween: 0,
      // navigation: {
      //     nextEl: '.swiper-button-next',
      //     prevEl: '.swiper-button-prev',
      // },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      breakpoints: {
        400: {
          slidesPerView: 2
        },
        576: {
          slidesPerView: 3
        },
        992: {
          slidesPerView: 5
        },
        1200: {
          slidesPerView: 6
        }
      }
    });

    // Blog
    var SwiperBlog = new Swiper('.swiper-blog', {
      loop: true,
      // autoplay: {
      //     delay: 4000,
      // },
      speed: 1500,
      slidesPerView: 1,
      spaceBetween: 30,
      // navigation: {
      //     nextEl: '.swiper-button-next',
      //     prevEl: '.swiper-button-prev',
      // },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      breakpoints: {
        768: {
          slidesPerView: 2
        },
        992: {
          slidesPerView: 2
        }
      }
    });

    // Landing Innerpages
    var SwiperInnerpages = new Swiper('.swiper-innerpages', {
      loop: true,
      autoplay: {
        delay: 4000
      },
      speed: 1500,
      slidesPerView: 1,
      spaceBetween: 0,
      breakpoints: {
        600: {
          slidesPerView: 2
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 30
        },
        1400: {
          slidesPerView: 4,
          spaceBetween: 40
        }
      }
    });

    // Odometer
    $('.odometer').appear();
    $('.odometer').appear(function () {
      var odo = $(".odometer");
      odo.each(function () {
        var countNumber = $(this).attr("data-count");
        $(this).html(countNumber);
      });
      window.odometerOptions = {
        format: 'd'
      };
    });

    // Alternate Hover/Active
    $('.wptb-image-box1, .wptb-image-box2, .wptb-blog-grid1, .wptb-packages1, .wptb-icon-box2').on("mouseenter", function () {
      $('.wptb-image-box1, .wptb-image-box2, .wptb-blog-grid1, .wptb-packages1, .wptb-icon-box2').removeClass('active');
    }).on('mouseleave', function () {
      $('.wptb-image-box1.highlight, .wptb-image-box2.highlight, .wptb-blog-grid1.highlight, .wptb-packages1.highlight, .wptb-icon-box2.highlight').addClass('active');
    });

    // accordion
    $(".wptb-accordion").on("click", ".wptb-item-title", function () {
      $(this).next().slideDown();
      $(".wptb-item--content").not($(this).next()).slideUp();
    });
    $(".wptb-accordion").on("click", ".wptb--item", function () {
      $(this).addClass("active").siblings().removeClass("active");
    });

    // Radial Progressbar
    function radial_animate() {
      $('svg.radial-progress').each(function (index, value) {
        $(this).find($('circle.bar--animated')).removeAttr('style');
        // Get element in Veiw port
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        if (elementBottom > viewportTop && elementTop < viewportBottom) {
          var percent = $(value).data('countervalue');
          var radius = $(this).find($('circle.bar--animated')).attr('r');
          var circumference = 2 * Math.PI * radius;
          var strokeDashOffset = circumference - percent * circumference / 100;
          $(this).find($('circle.bar--animated')).animate({
            'stroke-dashoffset': strokeDashOffset
          }, 2800);
        }
      });
    }
    // To check If it is in Viewport 
    var $window = $(window);
    function check_if_in_view() {
      $('.countervalue').each(function () {
        if ($(this).hasClass('start')) {
          var elementTop = $(this).offset().top;
          var elementBottom = elementTop + $(this).outerHeight();
          var viewportTop = $(window).scrollTop();
          var viewportBottom = viewportTop + $(window).height();
          if (elementBottom > viewportTop && elementTop < viewportBottom) {
            $(this).removeClass('start');
            $('.countervalue').text();
            var myNumbers = $(this).text();
            if (myNumbers == Math.floor(myNumbers)) {
              $(this).animate({
                Counter: $(this).text()
              }, {
                duration: 2800,
                easing: 'swing',
                step: function step(now) {
                  $(this).text(Math.ceil(now) + '%');
                }
              });
            } else {
              $(this).animate({
                Counter: $(this).text()
              }, {
                duration: 2800,
                easing: 'swing',
                step: function step(now) {
                  $(this).text(now.toFixed(2) + '$');
                }
              });
            }
            radial_animate();
          }
        }
      });
    }
    $window.on('scroll', check_if_in_view);

    // Fancybox
    $('[data-fancybox="video"]').fancybox({
      arrows: true,
      animationEffect: [
      //"false",            - disable
      //"fade",
      //"slide",
      //"circular",
      //"tube",
      //"zoom-in-out",
      "rotate"],
      transitionEffect: [
      //"false",            - disable
      //"fade",
      //"slide",
      "circular"
      //"tube",
      //"zoom-in-out",
      //"rotate"
      ],
      buttons: ["zoom",
      //"share",
      //"slideShow",
      "fullScreen",
      //"download",
      //"thumbs",
      "close"],
      infobar: false
    });

    // Youtube
    var $ytvideoTrigger = $(".ytplay-btn");
    $ytvideoTrigger.on("click", function (evt) {
      $(".ytube-video").addClass("play");
      $("#ytvideo")[0].src += "?autoplay=1";
    });

    // Vertical Accordion
    $('.wptb-country-tab--title').on('click', function () {
      $('.wptb-country-tab--item').removeClass('active');
      $(this).parent('.wptb-country-tab--item').addClass('active');
    });

    // Time Counter
    function makeTimer() {
      var endTime = new Date("14 March 2026");
      endTime = Date.parse(endTime) / 1000;
      var now = new Date();
      now = Date.parse(now) / 1000;
      var timeLeft = endTime - now;
      var days = Math.floor(timeLeft / 86400);
      var hours = Math.floor((timeLeft - days * 86400) / 3600);
      var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
      var seconds = Math.floor(timeLeft - days * 86400 - hours * 3600 - minutes * 60);
      if (hours < "10") {
        hours = "0" + hours;
      }
      if (minutes < "10") {
        minutes = "0" + minutes;
      }
      if (seconds < "10") {
        seconds = "0" + seconds;
      }
      $("#days").html(days);
      $("#hours").html(hours);
      $("#minutes").html(minutes);
      $("#seconds").html(seconds);
    }
    setInterval(function () {
      makeTimer();
    }, 1000);

    // Shop
    // Product Zoom
    $('.product_zoom_button_group > li > a').eq(0).addClass("selected");
    $('.product_zoom_container > .product_zoom_info').eq(0).css('display', 'block');
    $('.product_zoom_button_group').on("click", function (e) {
      if ($(e.target).is("a")) {
        /*Handle Tab Nav*/
        $('.product_zoom_button_group > li > a').removeClass("selected");
        $(e.target).addClass("selected");

        /*Handles Tab Content*/
        var clicked_index = $("a", this).index(e.target);
        $('.product_zoom_container > .product_zoom_info').css('display', 'none');
        $('.product_zoom_container > .product_zoom_info').eq(clicked_index).fadeIn();
      }
      $(this).blur();
      return false;
    });

    // Header Cart open
    $('a.wptb-cartt-icon').on('click', function (e) {
      e.preventDefault();
      $('.wptb-cartt-box').toggleClass('active');
      $('.wptb-person-box').removeClass('active'); // Hide the person box if it was opened
    });
    // Header person open
    $('a.wptb-person-icon').on('click', function (e) {
      e.preventDefault();
      $('.wptb-person-box').toggleClass('active');
      $('.wptb-cartt-box').removeClass('active'); // Hide the person box if it was opened
    });

    // Datepickr / Flatpicker
    $(".flatpickr").flatpickr({
      mode: "range",
      dateFormat: "d-M",
      minDate: "today"
    });
    $(".flatpickr-time").flatpickr({
      enableTime: true,
      noCalendar: true,
      dateFormat: 'h:i K'
    });

    // Nice Select
    $('select').niceSelect();

    // Totop Button
    $('.totop a').on('click', function (e) {
      e.preventDefault();
      $('html, body').animate({
        scrollTop: 0
      }, '300');
    });

    // Day-Night Mode Switcher
    var icon = document.getElementById("mode_switcher");

    // if (localStorage.getItem("theme") === "null"){
    //     localStorage.setItem("theme", "light");
    // }

    // let localData = localStorage.getItem("theme");

    // if (localData === "light") {
    //     icon.innerHTML = '<span><i class="bi bi-moon-fill"></i></span>';
    //     document.body.classList.remove("theme-style--light");
    // } else if (localData === "dark"){
    //     icon.innerHTML = '<span><i class="bi bi-sun-fill"></i></span>';
    //     document.body.classList.add("theme-style--light");
    // }

    icon.onclick = function () {
      document.body.classList.toggle("theme-style--light");
      if (document.body.classList.contains("theme-style--light")) {
        icon.innerHTML = '<span><i class="bi bi-sun-fill"></i></span>';
        localStorage.setItem("theme", "dark");
      } else {
        icon.innerHTML = '<span><i class="bi bi-moon-fill"></i></span>';
        localStorage.setItem("theme", "light");
      }
    };
  });
})(jQuery);

// Hide header on scroll down
var nav = document.querySelector(".header");
var scrollUp = "top-up";
var lastScroll = 800;
window.addEventListener("scroll", function () {
  var currentScroll = window.pageYOffset;
  if (currentScroll <= 800) {
    nav.classList.remove(scrollUp);
    $('.totop').removeClass('show');
    return;
  }
  if (currentScroll > lastScroll) {
    // down
    nav.classList.add(scrollUp);
    $('.totop').addClass('show');
  } else if (currentScroll < lastScroll) {
    // up
    nav.classList.remove(scrollUp);
    $('.totop').removeClass('show');
  }
  lastScroll = currentScroll;
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_bootstrap_dist_js_bootstrap_esm_js","vendors-node_modules_chartjs-plugin-zoom_dist_chartjs-plugin-zoom_esm_js-node_modules_core-js-05152d"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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LGdCQUFnQixDQUFDLFFBQVEsRUFBRSxZQUFNO0VBQ3BDLElBQU13VixhQUFhLEdBQUduVyxNQUFNLENBQUNvVyxXQUFXO0VBQ3hDLElBQUlELGFBQWEsSUFBSSxHQUFHLEVBQUU7SUFDdEJILEdBQUcsQ0FBQ2pULFNBQVMsQ0FBQ0csTUFBTSxDQUFDK1MsUUFBUSxDQUFDO0lBQzlCbFcsQ0FBQyxDQUFDLFFBQVEsQ0FBQyxDQUFDZ1EsV0FBVyxDQUFDLE1BQU0sQ0FBQztJQUMvQjtFQUNKO0VBRUEsSUFBSW9HLGFBQWEsR0FBR0QsVUFBVSxFQUFFO0lBQzVCO0lBQ0FGLEdBQUcsQ0FBQ2pULFNBQVMsQ0FBQ0MsR0FBRyxDQUFDaVQsUUFBUSxDQUFDO0lBQzNCbFcsQ0FBQyxDQUFDLFFBQVEsQ0FBQyxDQUFDME8sUUFBUSxDQUFDLE1BQU0sQ0FBQztFQUNoQyxDQUFDLE1BQU0sSUFBSTBILGFBQWEsR0FBR0QsVUFBVSxFQUFFO0lBQ25DO0lBQ0FGLEdBQUcsQ0FBQ2pULFNBQVMsQ0FBQ0csTUFBTSxDQUFDK1MsUUFBUSxDQUFDO0lBQzlCbFcsQ0FBQyxDQUFDLFFBQVEsQ0FBQyxDQUFDZ1EsV0FBVyxDQUFDLE1BQU0sQ0FBQztFQUNuQztFQUNBbUcsVUFBVSxHQUFHQyxhQUFhO0FBQzlCLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4uLy4uL3NyYy90cy91dGlsL2luZGV4LnRzIiwid2VicGFjazovLy8uLi8uLi9zcmMvdHMvbGF5b3V0LnRzIiwid2VicGFjazovLy8uLi8uLi9zcmMvdHMvcHVzaC1tZW51LnRzIiwid2VicGFjazovLy8uLi8uLi9zcmMvdHMvdHJlZXZpZXcudHMiLCJ3ZWJwYWNrOi8vLy4uLy4uL3NyYy90cy9kaXJlY3QtY2hhdC50cyIsIndlYnBhY2s6Ly8vLi4vLi4vc3JjL3RzL2NhcmQtd2lkZ2V0LnRzIiwid2VicGFjazovLy8uLi8uLi9zcmMvdHMvZnVsbHNjcmVlbi50cyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvbWFwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9wcmljZXRhYmxlLXRvZ2dsZXIuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL3RoZW1lLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIOKchSBGSVJTVDogSW1wb3J0IGpRdWVyeSBhbmQgYXNzaWduIGl0IGdsb2JhbGx5XG5pbXBvcnQgJCBmcm9tICdqcXVlcnknO1xud2luZG93LiQgPSAkO1xud2luZG93LmpRdWVyeSA9ICQ7XG5cbi8vIOKchSBUSEVOOiBJbXBvcnQgb3RoZXIgbGlicmFyaWVzIHRoYXQgcmVseSBvbiBqUXVlcnlcbmltcG9ydCAnYm9vdHN0cmFwJztcbmltcG9ydCAnLi9qcy9hZG1pbmx0ZSc7IC8vIFRoaXMgb25lIHVzZXMgalF1ZXJ5IHRvb1xuXG4vLyDinIUgQ2hhcnRKUyBhbmQgcGx1Z2luc1xuaW1wb3J0IENoYXJ0IGZyb20gJ2NoYXJ0LmpzL2F1dG8nO1xuaW1wb3J0IHpvb21QbHVnaW4gZnJvbSAnY2hhcnRqcy1wbHVnaW4tem9vbSc7XG5DaGFydC5yZWdpc3Rlcih6b29tUGx1Z2luKTtcbmltcG9ydCAnQHN5bWZvbnkvdXgtY2hhcnRqcyc7XG5cbi8vIOKchSBTdGltdWx1c1xuaW1wb3J0ICdAaG90d2lyZWQvc3RpbXVsdXMnO1xuXG4vLyDinIUgT3RoZXIgY3VzdG9tIHNjcmlwdHMgKG1hcCwgdGhlbWUsIGV0Yy4pXG5pbXBvcnQgJy4vanMvbWFwLmpzJztcbmltcG9ydCAnLi9qcy90aGVtZS5qcyc7XG5pbXBvcnQgJy4vanMvcHJpY2V0YWJsZS10b2dnbGVyLmpzJztcblxuLy8g4pyFIE9wdGlvbmFsOiBGb250IEF3ZXNvbWVcbi8vIGltcG9ydCAnQGZvcnRhd2Vzb21lL2ZvbnRhd2Vzb21lLWZyZWUvanMvYWxsJztcbiIsImNvbnN0IGRvbUNvbnRlbnRMb2FkZWRDYWxsYmFja3M6IEFycmF5PCgpID0+IHZvaWQ+ID0gW11cblxuY29uc3Qgb25ET01Db250ZW50TG9hZGVkID0gKGNhbGxiYWNrOiAoKSA9PiB2b2lkKTogdm9pZCA9PiB7XG4gIGlmIChkb2N1bWVudC5yZWFkeVN0YXRlID09PSAnbG9hZGluZycpIHtcbiAgICAvLyBhZGQgbGlzdGVuZXIgb24gdGhlIGZpcnN0IGNhbGwgd2hlbiB0aGUgZG9jdW1lbnQgaXMgaW4gbG9hZGluZyBzdGF0ZVxuICAgIGlmICghZG9tQ29udGVudExvYWRlZENhbGxiYWNrcy5sZW5ndGgpIHtcbiAgICAgIGRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ0RPTUNvbnRlbnRMb2FkZWQnLCAoKSA9PiB7XG4gICAgICAgIGZvciAoY29uc3QgY2FsbGJhY2sgb2YgZG9tQ29udGVudExvYWRlZENhbGxiYWNrcykge1xuICAgICAgICAgIGNhbGxiYWNrKClcbiAgICAgICAgfVxuICAgICAgfSlcbiAgICB9XG5cbiAgICBkb21Db250ZW50TG9hZGVkQ2FsbGJhY2tzLnB1c2goY2FsbGJhY2spXG4gIH0gZWxzZSB7XG4gICAgY2FsbGJhY2soKVxuICB9XG59XG5cbi8qIFNMSURFIFVQICovXG5jb25zdCBzbGlkZVVwID0gKHRhcmdldDogSFRNTEVsZW1lbnQsIGR1cmF0aW9uID0gNTAwKSA9PiB7XG4gIHRhcmdldC5zdHlsZS50cmFuc2l0aW9uUHJvcGVydHkgPSAnaGVpZ2h0LCBtYXJnaW4sIHBhZGRpbmcnXG4gIHRhcmdldC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2BcbiAgdGFyZ2V0LnN0eWxlLmJveFNpemluZyA9ICdib3JkZXItYm94J1xuICB0YXJnZXQuc3R5bGUuaGVpZ2h0ID0gYCR7dGFyZ2V0Lm9mZnNldEhlaWdodH1weGBcbiAgdGFyZ2V0LnN0eWxlLm92ZXJmbG93ID0gJ2hpZGRlbidcblxuICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XG4gICAgdGFyZ2V0LnN0eWxlLmhlaWdodCA9ICcwJ1xuICAgIHRhcmdldC5zdHlsZS5wYWRkaW5nVG9wID0gJzAnXG4gICAgdGFyZ2V0LnN0eWxlLnBhZGRpbmdCb3R0b20gPSAnMCdcbiAgICB0YXJnZXQuc3R5bGUubWFyZ2luVG9wID0gJzAnXG4gICAgdGFyZ2V0LnN0eWxlLm1hcmdpbkJvdHRvbSA9ICcwJ1xuICB9LCAxKVxuXG4gIHdpbmRvdy5zZXRUaW1lb3V0KCgpID0+IHtcbiAgICB0YXJnZXQuc3R5bGUuZGlzcGxheSA9ICdub25lJ1xuICAgIHRhcmdldC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgnaGVpZ2h0JylcbiAgICB0YXJnZXQuc3R5bGUucmVtb3ZlUHJvcGVydHkoJ3BhZGRpbmctdG9wJylcbiAgICB0YXJnZXQuc3R5bGUucmVtb3ZlUHJvcGVydHkoJ3BhZGRpbmctYm90dG9tJylcbiAgICB0YXJnZXQuc3R5bGUucmVtb3ZlUHJvcGVydHkoJ21hcmdpbi10b3AnKVxuICAgIHRhcmdldC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgnbWFyZ2luLWJvdHRvbScpXG4gICAgdGFyZ2V0LnN0eWxlLnJlbW92ZVByb3BlcnR5KCdvdmVyZmxvdycpXG4gICAgdGFyZ2V0LnN0eWxlLnJlbW92ZVByb3BlcnR5KCd0cmFuc2l0aW9uLWR1cmF0aW9uJylcbiAgICB0YXJnZXQuc3R5bGUucmVtb3ZlUHJvcGVydHkoJ3RyYW5zaXRpb24tcHJvcGVydHknKVxuICB9LCBkdXJhdGlvbilcbn1cblxuLyogU0xJREUgRE9XTiAqL1xuY29uc3Qgc2xpZGVEb3duID0gKHRhcmdldDogSFRNTEVsZW1lbnQsIGR1cmF0aW9uID0gNTAwKSA9PiB7XG4gIHRhcmdldC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgnZGlzcGxheScpXG4gIGxldCB7IGRpc3BsYXkgfSA9IHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKHRhcmdldClcblxuICBpZiAoZGlzcGxheSA9PT0gJ25vbmUnKSB7XG4gICAgZGlzcGxheSA9ICdibG9jaydcbiAgfVxuXG4gIHRhcmdldC5zdHlsZS5kaXNwbGF5ID0gZGlzcGxheVxuICBjb25zdCBoZWlnaHQgPSB0YXJnZXQub2Zmc2V0SGVpZ2h0XG4gIHRhcmdldC5zdHlsZS5vdmVyZmxvdyA9ICdoaWRkZW4nXG4gIHRhcmdldC5zdHlsZS5oZWlnaHQgPSAnMCdcbiAgdGFyZ2V0LnN0eWxlLnBhZGRpbmdUb3AgPSAnMCdcbiAgdGFyZ2V0LnN0eWxlLnBhZGRpbmdCb3R0b20gPSAnMCdcbiAgdGFyZ2V0LnN0eWxlLm1hcmdpblRvcCA9ICcwJ1xuICB0YXJnZXQuc3R5bGUubWFyZ2luQm90dG9tID0gJzAnXG5cbiAgd2luZG93LnNldFRpbWVvdXQoKCkgPT4ge1xuICAgIHRhcmdldC5zdHlsZS5ib3hTaXppbmcgPSAnYm9yZGVyLWJveCdcbiAgICB0YXJnZXQuc3R5bGUudHJhbnNpdGlvblByb3BlcnR5ID0gJ2hlaWdodCwgbWFyZ2luLCBwYWRkaW5nJ1xuICAgIHRhcmdldC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2BcbiAgICB0YXJnZXQuc3R5bGUuaGVpZ2h0ID0gYCR7aGVpZ2h0fXB4YFxuICAgIHRhcmdldC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgncGFkZGluZy10b3AnKVxuICAgIHRhcmdldC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgncGFkZGluZy1ib3R0b20nKVxuICAgIHRhcmdldC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgnbWFyZ2luLXRvcCcpXG4gICAgdGFyZ2V0LnN0eWxlLnJlbW92ZVByb3BlcnR5KCdtYXJnaW4tYm90dG9tJylcbiAgfSwgMSlcblxuICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XG4gICAgdGFyZ2V0LnN0eWxlLnJlbW92ZVByb3BlcnR5KCdoZWlnaHQnKVxuICAgIHRhcmdldC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgnb3ZlcmZsb3cnKVxuICAgIHRhcmdldC5zdHlsZS5yZW1vdmVQcm9wZXJ0eSgndHJhbnNpdGlvbi1kdXJhdGlvbicpXG4gICAgdGFyZ2V0LnN0eWxlLnJlbW92ZVByb3BlcnR5KCd0cmFuc2l0aW9uLXByb3BlcnR5JylcbiAgfSwgZHVyYXRpb24pXG59XG5cbi8qIFRPR0dMRSAqL1xuY29uc3Qgc2xpZGVUb2dnbGUgPSAodGFyZ2V0OiBIVE1MRWxlbWVudCwgZHVyYXRpb24gPSA1MDApID0+IHtcbiAgaWYgKHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKHRhcmdldCkuZGlzcGxheSA9PT0gJ25vbmUnKSB7XG4gICAgc2xpZGVEb3duKHRhcmdldCwgZHVyYXRpb24pXG4gICAgcmV0dXJuXG4gIH1cblxuICBzbGlkZVVwKHRhcmdldCwgZHVyYXRpb24pXG59XG5cbmV4cG9ydCB7XG4gIG9uRE9NQ29udGVudExvYWRlZCxcbiAgc2xpZGVVcCxcbiAgc2xpZGVEb3duLFxuICBzbGlkZVRvZ2dsZVxufVxuIiwiLyoqXG4gKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICogQGZpbGUgQWRtaW5MVEUgbGF5b3V0LnRzXG4gKiBAZGVzY3JpcHRpb24gTGF5b3V0IGZvciBBZG1pbkxURS5cbiAqIEBsaWNlbnNlIE1JVFxuICogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAqL1xuXG5pbXBvcnQge1xuICBvbkRPTUNvbnRlbnRMb2FkZWRcbn0gZnJvbSAnLi91dGlsL2luZGV4J1xuXG4vKipcbiAqIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICogQ29uc3RhbnRzXG4gKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAqL1xuXG5jb25zdCBDTEFTU19OQU1FX0hPTERfVFJBTlNJVElPTlMgPSAnaG9sZC10cmFuc2l0aW9uJ1xuY29uc3QgQ0xBU1NfTkFNRV9BUFBfTE9BREVEID0gJ2FwcC1sb2FkZWQnXG5cbi8qKlxuICogQ2xhc3MgRGVmaW5pdGlvblxuICogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICovXG5cbmNsYXNzIExheW91dCB7XG4gIF9lbGVtZW50OiBIVE1MRWxlbWVudFxuXG4gIGNvbnN0cnVjdG9yKGVsZW1lbnQ6IEhUTUxFbGVtZW50KSB7XG4gICAgdGhpcy5fZWxlbWVudCA9IGVsZW1lbnRcbiAgfVxuXG4gIGhvbGRUcmFuc2l0aW9uKCk6IHZvaWQge1xuICAgIGxldCByZXNpemVUaW1lcjogUmV0dXJuVHlwZTx0eXBlb2Ygc2V0VGltZW91dD5cbiAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcigncmVzaXplJywgKCkgPT4ge1xuICAgICAgZG9jdW1lbnQuYm9keS5jbGFzc0xpc3QuYWRkKENMQVNTX05BTUVfSE9MRF9UUkFOU0lUSU9OUylcbiAgICAgIGNsZWFyVGltZW91dChyZXNpemVUaW1lcilcbiAgICAgIHJlc2l6ZVRpbWVyID0gc2V0VGltZW91dCgoKSA9PiB7XG4gICAgICAgIGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LnJlbW92ZShDTEFTU19OQU1FX0hPTERfVFJBTlNJVElPTlMpXG4gICAgICB9LCA0MDApXG4gICAgfSlcbiAgfVxufVxuXG5vbkRPTUNvbnRlbnRMb2FkZWQoKCkgPT4ge1xuICBjb25zdCBkYXRhID0gbmV3IExheW91dChkb2N1bWVudC5ib2R5KVxuICBkYXRhLmhvbGRUcmFuc2l0aW9uKClcbiAgc2V0VGltZW91dCgoKSA9PiB7XG4gICAgZG9jdW1lbnQuYm9keS5jbGFzc0xpc3QuYWRkKENMQVNTX05BTUVfQVBQX0xPQURFRClcbiAgfSwgNDAwKVxufSlcblxuZXhwb3J0IGRlZmF1bHQgTGF5b3V0XG4iLCIvKipcbiAqIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gKiBAZmlsZSBBZG1pbkxURSBwdXNoLW1lbnUudHNcbiAqIEBkZXNjcmlwdGlvbiBQdXNoIG1lbnUgZm9yIEFkbWluTFRFLlxuICogQGxpY2Vuc2UgTUlUXG4gKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICovXG5cbmltcG9ydCB7XG4gIG9uRE9NQ29udGVudExvYWRlZFxufSBmcm9tICcuL3V0aWwvaW5kZXgnXG5cbi8qKlxuICogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gKiBDb25zdGFudHNcbiAqIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICovXG5cbmNvbnN0IERBVEFfS0VZID0gJ2x0ZS5wdXNoLW1lbnUnXG5jb25zdCBFVkVOVF9LRVkgPSBgLiR7REFUQV9LRVl9YFxuXG5jb25zdCBFVkVOVF9PUEVOID0gYG9wZW4ke0VWRU5UX0tFWX1gXG5jb25zdCBFVkVOVF9DT0xMQVBTRSA9IGBjb2xsYXBzZSR7RVZFTlRfS0VZfWBcblxuY29uc3QgQ0xBU1NfTkFNRV9TSURFQkFSX01JTkkgPSAnc2lkZWJhci1taW5pJ1xuY29uc3QgQ0xBU1NfTkFNRV9TSURFQkFSX0NPTExBUFNFID0gJ3NpZGViYXItY29sbGFwc2UnXG5jb25zdCBDTEFTU19OQU1FX1NJREVCQVJfT1BFTiA9ICdzaWRlYmFyLW9wZW4nXG5jb25zdCBDTEFTU19OQU1FX1NJREVCQVJfRVhQQU5EID0gJ3NpZGViYXItZXhwYW5kJ1xuY29uc3QgQ0xBU1NfTkFNRV9TSURFQkFSX09WRVJMQVkgPSAnc2lkZWJhci1vdmVybGF5J1xuY29uc3QgQ0xBU1NfTkFNRV9NRU5VX09QRU4gPSAnbWVudS1vcGVuJ1xuXG5jb25zdCBTRUxFQ1RPUl9BUFBfU0lERUJBUiA9ICcuYXBwLXNpZGViYXInXG5jb25zdCBTRUxFQ1RPUl9TSURFQkFSX01FTlUgPSAnLnNpZGViYXItbWVudSdcbmNvbnN0IFNFTEVDVE9SX05BVl9JVEVNID0gJy5uYXYtaXRlbSdcbmNvbnN0IFNFTEVDVE9SX05BVl9UUkVFVklFVyA9ICcubmF2LXRyZWV2aWV3J1xuY29uc3QgU0VMRUNUT1JfQVBQX1dSQVBQRVIgPSAnLmFwcC13cmFwcGVyJ1xuY29uc3QgU0VMRUNUT1JfU0lERUJBUl9FWFBBTkQgPSBgW2NsYXNzKj1cIiR7Q0xBU1NfTkFNRV9TSURFQkFSX0VYUEFORH1cIl1gXG5jb25zdCBTRUxFQ1RPUl9TSURFQkFSX1RPR0dMRSA9ICdbZGF0YS1sdGUtdG9nZ2xlPVwic2lkZWJhclwiXSdcblxudHlwZSBDb25maWcgPSB7XG4gIHNpZGViYXJCcmVha3BvaW50OiBudW1iZXI7XG59XG5cbmNvbnN0IERlZmF1bHRzID0ge1xuICBzaWRlYmFyQnJlYWtwb2ludDogOTkyXG59XG5cbi8qKlxuICogQ2xhc3MgRGVmaW5pdGlvblxuICogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICovXG5cbmNsYXNzIFB1c2hNZW51IHtcbiAgX2VsZW1lbnQ6IEhUTUxFbGVtZW50XG4gIF9jb25maWc6IENvbmZpZ1xuXG4gIGNvbnN0cnVjdG9yKGVsZW1lbnQ6IEhUTUxFbGVtZW50LCBjb25maWc6IENvbmZpZykge1xuICAgIHRoaXMuX2VsZW1lbnQgPSBlbGVtZW50XG4gICAgdGhpcy5fY29uZmlnID0geyAuLi5EZWZhdWx0cywgLi4uY29uZmlnIH1cbiAgfVxuXG4gIC8vIFRPRE9cbiAgbWVudXNDbG9zZSgpIHtcbiAgICBjb25zdCBuYXZUcmVldmlldyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGw8SFRNTEVsZW1lbnQ+KFNFTEVDVE9SX05BVl9UUkVFVklFVylcblxuICAgIG5hdlRyZWV2aWV3LmZvckVhY2gobmF2VHJlZSA9PiB7XG4gICAgICBuYXZUcmVlLnN0eWxlLnJlbW92ZVByb3BlcnR5KCdkaXNwbGF5JylcbiAgICAgIG5hdlRyZWUuc3R5bGUucmVtb3ZlUHJvcGVydHkoJ2hlaWdodCcpXG4gICAgfSlcblxuICAgIGNvbnN0IG5hdlNpZGViYXIgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFNFTEVDVE9SX1NJREVCQVJfTUVOVSlcbiAgICBjb25zdCBuYXZJdGVtID0gbmF2U2lkZWJhcj8ucXVlcnlTZWxlY3RvckFsbChTRUxFQ1RPUl9OQVZfSVRFTSlcblxuICAgIGlmIChuYXZJdGVtKSB7XG4gICAgICBuYXZJdGVtLmZvckVhY2gobmF2SSA9PiB7XG4gICAgICAgIG5hdkkuY2xhc3NMaXN0LnJlbW92ZShDTEFTU19OQU1FX01FTlVfT1BFTilcbiAgICAgIH0pXG4gICAgfVxuICB9XG5cbiAgZXhwYW5kKCkge1xuICAgIGNvbnN0IGV2ZW50ID0gbmV3IEV2ZW50KEVWRU5UX09QRU4pXG5cbiAgICBkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC5yZW1vdmUoQ0xBU1NfTkFNRV9TSURFQkFSX0NPTExBUFNFKVxuICAgIGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LmFkZChDTEFTU19OQU1FX1NJREVCQVJfT1BFTilcblxuICAgIHRoaXMuX2VsZW1lbnQuZGlzcGF0Y2hFdmVudChldmVudClcbiAgfVxuXG4gIGNvbGxhcHNlKCkge1xuICAgIGNvbnN0IGV2ZW50ID0gbmV3IEV2ZW50KEVWRU5UX0NPTExBUFNFKVxuXG4gICAgZG9jdW1lbnQuYm9keS5jbGFzc0xpc3QucmVtb3ZlKENMQVNTX05BTUVfU0lERUJBUl9PUEVOKVxuICAgIGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LmFkZChDTEFTU19OQU1FX1NJREVCQVJfQ09MTEFQU0UpXG5cbiAgICB0aGlzLl9lbGVtZW50LmRpc3BhdGNoRXZlbnQoZXZlbnQpXG4gIH1cblxuICBhZGRTaWRlYmFyQnJlYWtQb2ludCgpIHtcbiAgICBjb25zdCBzaWRlYmFyRXhwYW5kTGlzdCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoU0VMRUNUT1JfU0lERUJBUl9FWFBBTkQpPy5jbGFzc0xpc3QgPz8gW11cbiAgICBjb25zdCBzaWRlYmFyRXhwYW5kID0gQXJyYXkuZnJvbShzaWRlYmFyRXhwYW5kTGlzdCkuZmluZChjbGFzc05hbWUgPT4gY2xhc3NOYW1lLnN0YXJ0c1dpdGgoQ0xBU1NfTkFNRV9TSURFQkFSX0VYUEFORCkpID8/ICcnXG4gICAgY29uc3Qgc2lkZWJhciA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlDbGFzc05hbWUoc2lkZWJhckV4cGFuZClbMF1cbiAgICBjb25zdCBzaWRlYmFyQ29udGVudCA9IHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKHNpZGViYXIsICc6OmJlZm9yZScpLmdldFByb3BlcnR5VmFsdWUoJ2NvbnRlbnQnKVxuICAgIHRoaXMuX2NvbmZpZyA9IHsgLi4udGhpcy5fY29uZmlnLCBzaWRlYmFyQnJlYWtwb2ludDogTnVtYmVyKHNpZGViYXJDb250ZW50LnJlcGxhY2UoL1teXFxkLi1dL2csICcnKSkgfVxuXG4gICAgaWYgKHdpbmRvdy5pbm5lcldpZHRoIDw9IHRoaXMuX2NvbmZpZy5zaWRlYmFyQnJlYWtwb2ludCkge1xuICAgICAgdGhpcy5jb2xsYXBzZSgpXG4gICAgfSBlbHNlIHtcbiAgICAgIGlmICghZG9jdW1lbnQuYm9keS5jbGFzc0xpc3QuY29udGFpbnMoQ0xBU1NfTkFNRV9TSURFQkFSX01JTkkpKSB7XG4gICAgICAgIHRoaXMuZXhwYW5kKClcbiAgICAgIH1cblxuICAgICAgaWYgKGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LmNvbnRhaW5zKENMQVNTX05BTUVfU0lERUJBUl9NSU5JKSAmJiBkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC5jb250YWlucyhDTEFTU19OQU1FX1NJREVCQVJfQ09MTEFQU0UpKSB7XG4gICAgICAgIHRoaXMuY29sbGFwc2UoKVxuICAgICAgfVxuICAgIH1cbiAgfVxuXG4gIHRvZ2dsZSgpIHtcbiAgICBpZiAoZG9jdW1lbnQuYm9keS5jbGFzc0xpc3QuY29udGFpbnMoQ0xBU1NfTkFNRV9TSURFQkFSX0NPTExBUFNFKSkge1xuICAgICAgdGhpcy5leHBhbmQoKVxuICAgIH0gZWxzZSB7XG4gICAgICB0aGlzLmNvbGxhcHNlKClcbiAgICB9XG4gIH1cblxuICBpbml0KCkge1xuICAgIHRoaXMuYWRkU2lkZWJhckJyZWFrUG9pbnQoKVxuICB9XG59XG5cbi8qKlxuICogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gKiBEYXRhIEFwaSBpbXBsZW1lbnRhdGlvblxuICogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gKi9cblxub25ET01Db250ZW50TG9hZGVkKCgpID0+IHtcbiAgY29uc3Qgc2lkZWJhciA9IGRvY3VtZW50Py5xdWVyeVNlbGVjdG9yKFNFTEVDVE9SX0FQUF9TSURFQkFSKSBhcyBIVE1MRWxlbWVudCB8IHVuZGVmaW5lZFxuXG4gIGlmIChzaWRlYmFyKSB7XG4gICAgY29uc3QgZGF0YSA9IG5ldyBQdXNoTWVudShzaWRlYmFyLCBEZWZhdWx0cylcbiAgICBkYXRhLmluaXQoKVxuXG4gICAgd2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ3Jlc2l6ZScsICgpID0+IHtcbiAgICAgIGRhdGEuaW5pdCgpXG4gICAgfSlcbiAgfVxuXG4gIGNvbnN0IHNpZGViYXJPdmVybGF5ID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnZGl2JylcbiAgc2lkZWJhck92ZXJsYXkuY2xhc3NOYW1lID0gQ0xBU1NfTkFNRV9TSURFQkFSX09WRVJMQVlcbiAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcihTRUxFQ1RPUl9BUFBfV1JBUFBFUik/LmFwcGVuZChzaWRlYmFyT3ZlcmxheSlcblxuICBzaWRlYmFyT3ZlcmxheS5hZGRFdmVudExpc3RlbmVyKCd0b3VjaHN0YXJ0JywgZXZlbnQgPT4ge1xuICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KClcbiAgICBjb25zdCB0YXJnZXQgPSBldmVudC5jdXJyZW50VGFyZ2V0IGFzIEhUTUxFbGVtZW50XG4gICAgY29uc3QgZGF0YSA9IG5ldyBQdXNoTWVudSh0YXJnZXQsIERlZmF1bHRzKVxuICAgIGRhdGEuY29sbGFwc2UoKVxuICB9LCB7IHBhc3NpdmU6IHRydWUgfSlcbiAgc2lkZWJhck92ZXJsYXkuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBldmVudCA9PiB7XG4gICAgZXZlbnQucHJldmVudERlZmF1bHQoKVxuICAgIGNvbnN0IHRhcmdldCA9IGV2ZW50LmN1cnJlbnRUYXJnZXQgYXMgSFRNTEVsZW1lbnRcbiAgICBjb25zdCBkYXRhID0gbmV3IFB1c2hNZW51KHRhcmdldCwgRGVmYXVsdHMpXG4gICAgZGF0YS5jb2xsYXBzZSgpXG4gIH0pXG5cbiAgY29uc3QgZnVsbEJ0biA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoU0VMRUNUT1JfU0lERUJBUl9UT0dHTEUpXG5cbiAgZnVsbEJ0bi5mb3JFYWNoKGJ0biA9PiB7XG4gICAgYnRuLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZXZlbnQgPT4ge1xuICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKVxuXG4gICAgICBsZXQgYnV0dG9uID0gZXZlbnQuY3VycmVudFRhcmdldCBhcyBIVE1MRWxlbWVudCB8IHVuZGVmaW5lZFxuXG4gICAgICBpZiAoYnV0dG9uPy5kYXRhc2V0Lmx0ZVRvZ2dsZSAhPT0gJ3NpZGViYXInKSB7XG4gICAgICAgIGJ1dHRvbiA9IGJ1dHRvbj8uY2xvc2VzdChTRUxFQ1RPUl9TSURFQkFSX1RPR0dMRSkgYXMgSFRNTEVsZW1lbnQgfCB1bmRlZmluZWRcbiAgICAgIH1cblxuICAgICAgaWYgKGJ1dHRvbikge1xuICAgICAgICBldmVudD8ucHJldmVudERlZmF1bHQoKVxuICAgICAgICBjb25zdCBkYXRhID0gbmV3IFB1c2hNZW51KGJ1dHRvbiwgRGVmYXVsdHMpXG4gICAgICAgIGRhdGEudG9nZ2xlKClcbiAgICAgIH1cbiAgICB9KVxuICB9KVxufSlcblxuZXhwb3J0IGRlZmF1bHQgUHVzaE1lbnVcbiIsIi8qKlxuICogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAqIEBmaWxlIEFkbWluTFRFIHRyZWV2aWV3LnRzXG4gKiBAZGVzY3JpcHRpb24gVHJlZXZpZXcgcGx1Z2luIGZvciBBZG1pbkxURS5cbiAqIEBsaWNlbnNlIE1JVFxuICogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAqL1xuXG5pbXBvcnQge1xuICBvbkRPTUNvbnRlbnRMb2FkZWQsXG4gIHNsaWRlRG93bixcbiAgc2xpZGVVcFxufSBmcm9tICcuL3V0aWwvaW5kZXgnXG5cbi8qKlxuICogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gKiBDb25zdGFudHNcbiAqIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICovXG5cbi8vIGNvbnN0IE5BTUUgPSAnVHJlZXZpZXcnXG5jb25zdCBEQVRBX0tFWSA9ICdsdGUudHJlZXZpZXcnXG5jb25zdCBFVkVOVF9LRVkgPSBgLiR7REFUQV9LRVl9YFxuXG5jb25zdCBFVkVOVF9FWFBBTkRFRCA9IGBleHBhbmRlZCR7RVZFTlRfS0VZfWBcbmNvbnN0IEVWRU5UX0NPTExBUFNFRCA9IGBjb2xsYXBzZWQke0VWRU5UX0tFWX1gXG4vLyBjb25zdCBFVkVOVF9MT0FEX0RBVEFfQVBJID0gYGxvYWQke0VWRU5UX0tFWX1gXG5cbmNvbnN0IENMQVNTX05BTUVfTUVOVV9PUEVOID0gJ21lbnUtb3BlbidcbmNvbnN0IFNFTEVDVE9SX05BVl9JVEVNID0gJy5uYXYtaXRlbSdcbmNvbnN0IFNFTEVDVE9SX05BVl9MSU5LID0gJy5uYXYtbGluaydcbmNvbnN0IFNFTEVDVE9SX1RSRUVWSUVXX01FTlUgPSAnLm5hdi10cmVldmlldydcbmNvbnN0IFNFTEVDVE9SX0RBVEFfVE9HR0xFID0gJ1tkYXRhLWx0ZS10b2dnbGU9XCJ0cmVldmlld1wiXSdcblxuY29uc3QgRGVmYXVsdCA9IHtcbiAgYW5pbWF0aW9uU3BlZWQ6IDMwMCxcbiAgYWNjb3JkaW9uOiB0cnVlXG59XG5cbnR5cGUgQ29uZmlnID0ge1xuICBhbmltYXRpb25TcGVlZDogbnVtYmVyO1xuICBhY2NvcmRpb246IGJvb2xlYW47XG59XG5cbi8qKlxuICogQ2xhc3MgRGVmaW5pdGlvblxuICogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICovXG5cbmNsYXNzIFRyZWV2aWV3IHtcbiAgX2VsZW1lbnQ6IEhUTUxFbGVtZW50XG4gIF9jb25maWc6IENvbmZpZ1xuXG4gIGNvbnN0cnVjdG9yKGVsZW1lbnQ6IEhUTUxFbGVtZW50LCBjb25maWc6IENvbmZpZykge1xuICAgIHRoaXMuX2VsZW1lbnQgPSBlbGVtZW50XG4gICAgdGhpcy5fY29uZmlnID0geyAuLi5EZWZhdWx0LCAuLi5jb25maWcgfVxuICB9XG5cbiAgb3BlbigpOiB2b2lkIHtcbiAgICBjb25zdCBldmVudCA9IG5ldyBFdmVudChFVkVOVF9FWFBBTkRFRClcblxuICAgIGlmICh0aGlzLl9jb25maWcuYWNjb3JkaW9uKSB7XG4gICAgICBjb25zdCBvcGVuTWVudUxpc3QgPSB0aGlzLl9lbGVtZW50LnBhcmVudEVsZW1lbnQ/LnF1ZXJ5U2VsZWN0b3JBbGwoYCR7U0VMRUNUT1JfTkFWX0lURU19LiR7Q0xBU1NfTkFNRV9NRU5VX09QRU59YClcblxuICAgICAgb3Blbk1lbnVMaXN0Py5mb3JFYWNoKG9wZW5NZW51ID0+IHtcbiAgICAgICAgaWYgKG9wZW5NZW51ICE9PSB0aGlzLl9lbGVtZW50LnBhcmVudEVsZW1lbnQpIHtcbiAgICAgICAgICBvcGVuTWVudS5jbGFzc0xpc3QucmVtb3ZlKENMQVNTX05BTUVfTUVOVV9PUEVOKVxuICAgICAgICAgIGNvbnN0IGNoaWxkRWxlbWVudCA9IG9wZW5NZW51Py5xdWVyeVNlbGVjdG9yKFNFTEVDVE9SX1RSRUVWSUVXX01FTlUpIGFzIEhUTUxFbGVtZW50IHwgdW5kZWZpbmVkXG4gICAgICAgICAgaWYgKGNoaWxkRWxlbWVudCkge1xuICAgICAgICAgICAgc2xpZGVVcChjaGlsZEVsZW1lbnQsIHRoaXMuX2NvbmZpZy5hbmltYXRpb25TcGVlZClcbiAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICAgIH0pXG4gICAgfVxuXG4gICAgdGhpcy5fZWxlbWVudC5jbGFzc0xpc3QuYWRkKENMQVNTX05BTUVfTUVOVV9PUEVOKVxuXG4gICAgY29uc3QgY2hpbGRFbGVtZW50ID0gdGhpcy5fZWxlbWVudD8ucXVlcnlTZWxlY3RvcihTRUxFQ1RPUl9UUkVFVklFV19NRU5VKSBhcyBIVE1MRWxlbWVudCB8IHVuZGVmaW5lZFxuICAgIGlmIChjaGlsZEVsZW1lbnQpIHtcbiAgICAgIHNsaWRlRG93bihjaGlsZEVsZW1lbnQsIHRoaXMuX2NvbmZpZy5hbmltYXRpb25TcGVlZClcbiAgICB9XG5cbiAgICB0aGlzLl9lbGVtZW50LmRpc3BhdGNoRXZlbnQoZXZlbnQpXG4gIH1cblxuICBjbG9zZSgpOiB2b2lkIHtcbiAgICBjb25zdCBldmVudCA9IG5ldyBFdmVudChFVkVOVF9DT0xMQVBTRUQpXG5cbiAgICB0aGlzLl9lbGVtZW50LmNsYXNzTGlzdC5yZW1vdmUoQ0xBU1NfTkFNRV9NRU5VX09QRU4pXG5cbiAgICBjb25zdCBjaGlsZEVsZW1lbnQgPSB0aGlzLl9lbGVtZW50Py5xdWVyeVNlbGVjdG9yKFNFTEVDVE9SX1RSRUVWSUVXX01FTlUpIGFzIEhUTUxFbGVtZW50IHwgdW5kZWZpbmVkXG4gICAgaWYgKGNoaWxkRWxlbWVudCkge1xuICAgICAgc2xpZGVVcChjaGlsZEVsZW1lbnQsIHRoaXMuX2NvbmZpZy5hbmltYXRpb25TcGVlZClcbiAgICB9XG5cbiAgICB0aGlzLl9lbGVtZW50LmRpc3BhdGNoRXZlbnQoZXZlbnQpXG4gIH1cblxuICB0b2dnbGUoKTogdm9pZCB7XG4gICAgaWYgKHRoaXMuX2VsZW1lbnQuY2xhc3NMaXN0LmNvbnRhaW5zKENMQVNTX05BTUVfTUVOVV9PUEVOKSkge1xuICAgICAgdGhpcy5jbG9zZSgpXG4gICAgfSBlbHNlIHtcbiAgICAgIHRoaXMub3BlbigpXG4gICAgfVxuICB9XG59XG5cbi8qKlxuICogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gKiBEYXRhIEFwaSBpbXBsZW1lbnRhdGlvblxuICogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gKi9cblxub25ET01Db250ZW50TG9hZGVkKCgpID0+IHtcbiAgY29uc3QgYnV0dG9uID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChTRUxFQ1RPUl9EQVRBX1RPR0dMRSlcblxuICBidXR0b24uZm9yRWFjaChidG4gPT4ge1xuICAgIGJ0bi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGV2ZW50ID0+IHtcbiAgICAgIGNvbnN0IHRhcmdldCA9IGV2ZW50LnRhcmdldCBhcyBIVE1MRWxlbWVudFxuICAgICAgY29uc3QgdGFyZ2V0SXRlbSA9IHRhcmdldC5jbG9zZXN0KFNFTEVDVE9SX05BVl9JVEVNKSBhcyBIVE1MRWxlbWVudCB8IHVuZGVmaW5lZFxuICAgICAgY29uc3QgdGFyZ2V0TGluayA9IHRhcmdldC5jbG9zZXN0KFNFTEVDVE9SX05BVl9MSU5LKSBhcyBIVE1MQW5jaG9yRWxlbWVudCB8IHVuZGVmaW5lZFxuXG4gICAgICBpZiAodGFyZ2V0Py5nZXRBdHRyaWJ1dGUoJ2hyZWYnKSA9PT0gJyMnIHx8IHRhcmdldExpbms/LmdldEF0dHJpYnV0ZSgnaHJlZicpID09PSAnIycpIHtcbiAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKVxuICAgICAgfVxuXG4gICAgICBpZiAodGFyZ2V0SXRlbSkge1xuICAgICAgICBjb25zdCBkYXRhID0gbmV3IFRyZWV2aWV3KHRhcmdldEl0ZW0sIERlZmF1bHQpXG4gICAgICAgIGRhdGEudG9nZ2xlKClcbiAgICAgIH1cbiAgICB9KVxuICB9KVxufSlcblxuZXhwb3J0IGRlZmF1bHQgVHJlZXZpZXdcbiIsIi8qKlxuICogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAqIEBmaWxlIEFkbWluTFRFIGRpcmVjdC1jaGF0LnRzXG4gKiBAZGVzY3JpcHRpb24gRGlyZWN0IGNoYXQgZm9yIEFkbWluTFRFLlxuICogQGxpY2Vuc2UgTUlUXG4gKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICovXG5cbmltcG9ydCB7XG4gIG9uRE9NQ29udGVudExvYWRlZFxufSBmcm9tICcuL3V0aWwvaW5kZXgnXG5cbi8qKlxuICogQ29uc3RhbnRzXG4gKiA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gKi9cblxuY29uc3QgREFUQV9LRVkgPSAnbHRlLmRpcmVjdC1jaGF0J1xuY29uc3QgRVZFTlRfS0VZID0gYC4ke0RBVEFfS0VZfWBcbmNvbnN0IEVWRU5UX0VYUEFOREVEID0gYGV4cGFuZGVkJHtFVkVOVF9LRVl9YFxuY29uc3QgRVZFTlRfQ09MTEFQU0VEID0gYGNvbGxhcHNlZCR7RVZFTlRfS0VZfWBcblxuY29uc3QgU0VMRUNUT1JfREFUQV9UT0dHTEUgPSAnW2RhdGEtbHRlLXRvZ2dsZT1cImNoYXQtcGFuZVwiXSdcbmNvbnN0IFNFTEVDVE9SX0RJUkVDVF9DSEFUID0gJy5kaXJlY3QtY2hhdCdcblxuY29uc3QgQ0xBU1NfTkFNRV9ESVJFQ1RfQ0hBVF9PUEVOID0gJ2RpcmVjdC1jaGF0LWNvbnRhY3RzLW9wZW4nXG5cbi8qKlxuICogQ2xhc3MgRGVmaW5pdGlvblxuICogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICovXG5cbmNsYXNzIERpcmVjdENoYXQge1xuICBfZWxlbWVudDogSFRNTEVsZW1lbnRcbiAgY29uc3RydWN0b3IoZWxlbWVudDogSFRNTEVsZW1lbnQpIHtcbiAgICB0aGlzLl9lbGVtZW50ID0gZWxlbWVudFxuICB9XG5cbiAgdG9nZ2xlKCk6IHZvaWQge1xuICAgIGlmICh0aGlzLl9lbGVtZW50LmNsYXNzTGlzdC5jb250YWlucyhDTEFTU19OQU1FX0RJUkVDVF9DSEFUX09QRU4pKSB7XG4gICAgICBjb25zdCBldmVudCA9IG5ldyBFdmVudChFVkVOVF9DT0xMQVBTRUQpXG5cbiAgICAgIHRoaXMuX2VsZW1lbnQuY2xhc3NMaXN0LnJlbW92ZShDTEFTU19OQU1FX0RJUkVDVF9DSEFUX09QRU4pXG5cbiAgICAgIHRoaXMuX2VsZW1lbnQuZGlzcGF0Y2hFdmVudChldmVudClcbiAgICB9IGVsc2Uge1xuICAgICAgY29uc3QgZXZlbnQgPSBuZXcgRXZlbnQoRVZFTlRfRVhQQU5ERUQpXG5cbiAgICAgIHRoaXMuX2VsZW1lbnQuY2xhc3NMaXN0LmFkZChDTEFTU19OQU1FX0RJUkVDVF9DSEFUX09QRU4pXG5cbiAgICAgIHRoaXMuX2VsZW1lbnQuZGlzcGF0Y2hFdmVudChldmVudClcbiAgICB9XG4gIH1cbn1cblxuLyoqXG4gKlxuICogRGF0YSBBcGkgaW1wbGVtZW50YXRpb25cbiAqID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAqL1xuXG5vbkRPTUNvbnRlbnRMb2FkZWQoKCkgPT4ge1xuICBjb25zdCBidXR0b24gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKFNFTEVDVE9SX0RBVEFfVE9HR0xFKVxuXG4gIGJ1dHRvbi5mb3JFYWNoKGJ0biA9PiB7XG4gICAgYnRuLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZXZlbnQgPT4ge1xuICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKVxuICAgICAgY29uc3QgdGFyZ2V0ID0gZXZlbnQudGFyZ2V0IGFzIEhUTUxFbGVtZW50XG4gICAgICBjb25zdCBjaGF0UGFuZSA9IHRhcmdldC5jbG9zZXN0KFNFTEVDVE9SX0RJUkVDVF9DSEFUKSBhcyBIVE1MRWxlbWVudCB8IHVuZGVmaW5lZFxuXG4gICAgICBpZiAoY2hhdFBhbmUpIHtcbiAgICAgICAgY29uc3QgZGF0YSA9IG5ldyBEaXJlY3RDaGF0KGNoYXRQYW5lKVxuICAgICAgICBkYXRhLnRvZ2dsZSgpXG4gICAgICB9XG4gICAgfSlcbiAgfSlcbn0pXG5cbmV4cG9ydCBkZWZhdWx0IERpcmVjdENoYXRcbiIsIi8qKlxuICogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAqIEBmaWxlIEFkbWluTFRFIGNhcmQtd2lkZ2V0LnRzXG4gKiBAZGVzY3JpcHRpb24gQ2FyZCB3aWRnZXQgZm9yIEFkbWluTFRFLlxuICogQGxpY2Vuc2UgTUlUXG4gKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICovXG5cbmltcG9ydCB7XG4gIG9uRE9NQ29udGVudExvYWRlZCxcbiAgc2xpZGVVcCxcbiAgc2xpZGVEb3duXG59IGZyb20gJy4vdXRpbC9pbmRleCdcblxuLyoqXG4gKiBDb25zdGFudHNcbiAqID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAqL1xuXG5jb25zdCBEQVRBX0tFWSA9ICdsdGUuY2FyZC13aWRnZXQnXG5jb25zdCBFVkVOVF9LRVkgPSBgLiR7REFUQV9LRVl9YFxuY29uc3QgRVZFTlRfQ09MTEFQU0VEID0gYGNvbGxhcHNlZCR7RVZFTlRfS0VZfWBcbmNvbnN0IEVWRU5UX0VYUEFOREVEID0gYGV4cGFuZGVkJHtFVkVOVF9LRVl9YFxuY29uc3QgRVZFTlRfUkVNT1ZFID0gYHJlbW92ZSR7RVZFTlRfS0VZfWBcbmNvbnN0IEVWRU5UX01BWElNSVpFRCA9IGBtYXhpbWl6ZWQke0VWRU5UX0tFWX1gXG5jb25zdCBFVkVOVF9NSU5JTUlaRUQgPSBgbWluaW1pemVkJHtFVkVOVF9LRVl9YFxuXG5jb25zdCBDTEFTU19OQU1FX0NBUkQgPSAnY2FyZCdcbmNvbnN0IENMQVNTX05BTUVfQ09MTEFQU0VEID0gJ2NvbGxhcHNlZC1jYXJkJ1xuY29uc3QgQ0xBU1NfTkFNRV9DT0xMQVBTSU5HID0gJ2NvbGxhcHNpbmctY2FyZCdcbmNvbnN0IENMQVNTX05BTUVfRVhQQU5ESU5HID0gJ2V4cGFuZGluZy1jYXJkJ1xuY29uc3QgQ0xBU1NfTkFNRV9XQVNfQ09MTEFQU0VEID0gJ3dhcy1jb2xsYXBzZWQnXG5jb25zdCBDTEFTU19OQU1FX01BWElNSVpFRCA9ICdtYXhpbWl6ZWQtY2FyZCdcblxuY29uc3QgU0VMRUNUT1JfREFUQV9SRU1PVkUgPSAnW2RhdGEtbHRlLXRvZ2dsZT1cImNhcmQtcmVtb3ZlXCJdJ1xuY29uc3QgU0VMRUNUT1JfREFUQV9DT0xMQVBTRSA9ICdbZGF0YS1sdGUtdG9nZ2xlPVwiY2FyZC1jb2xsYXBzZVwiXSdcbmNvbnN0IFNFTEVDVE9SX0RBVEFfTUFYSU1JWkUgPSAnW2RhdGEtbHRlLXRvZ2dsZT1cImNhcmQtbWF4aW1pemVcIl0nXG5jb25zdCBTRUxFQ1RPUl9DQVJEID0gYC4ke0NMQVNTX05BTUVfQ0FSRH1gXG5jb25zdCBTRUxFQ1RPUl9DQVJEX0JPRFkgPSAnLmNhcmQtYm9keSdcbmNvbnN0IFNFTEVDVE9SX0NBUkRfRk9PVEVSID0gJy5jYXJkLWZvb3RlcidcblxudHlwZSBDb25maWcgPSB7XG4gIGFuaW1hdGlvblNwZWVkOiBudW1iZXI7XG4gIGNvbGxhcHNlVHJpZ2dlcjogc3RyaW5nO1xuICByZW1vdmVUcmlnZ2VyOiBzdHJpbmc7XG4gIG1heGltaXplVHJpZ2dlcjogc3RyaW5nO1xufVxuXG5jb25zdCBEZWZhdWx0OiBDb25maWcgPSB7XG4gIGFuaW1hdGlvblNwZWVkOiA1MDAsXG4gIGNvbGxhcHNlVHJpZ2dlcjogU0VMRUNUT1JfREFUQV9DT0xMQVBTRSxcbiAgcmVtb3ZlVHJpZ2dlcjogU0VMRUNUT1JfREFUQV9SRU1PVkUsXG4gIG1heGltaXplVHJpZ2dlcjogU0VMRUNUT1JfREFUQV9NQVhJTUlaRVxufVxuXG5jbGFzcyBDYXJkV2lkZ2V0IHtcbiAgX2VsZW1lbnQ6IEhUTUxFbGVtZW50XG4gIF9wYXJlbnQ6IEhUTUxFbGVtZW50IHwgdW5kZWZpbmVkXG4gIF9jbG9uZTogSFRNTEVsZW1lbnQgfCB1bmRlZmluZWRcbiAgX2NvbmZpZzogQ29uZmlnXG5cbiAgY29uc3RydWN0b3IoZWxlbWVudDogSFRNTEVsZW1lbnQsIGNvbmZpZzogQ29uZmlnKSB7XG4gICAgdGhpcy5fZWxlbWVudCA9IGVsZW1lbnRcbiAgICB0aGlzLl9wYXJlbnQgPSBlbGVtZW50LmNsb3Nlc3QoU0VMRUNUT1JfQ0FSRCkgYXMgSFRNTEVsZW1lbnQgfCB1bmRlZmluZWRcblxuICAgIGlmIChlbGVtZW50LmNsYXNzTGlzdC5jb250YWlucyhDTEFTU19OQU1FX0NBUkQpKSB7XG4gICAgICB0aGlzLl9wYXJlbnQgPSBlbGVtZW50XG4gICAgfVxuXG4gICAgdGhpcy5fY29uZmlnID0geyAuLi5EZWZhdWx0LCAuLi5jb25maWcgfVxuICB9XG5cbiAgY29sbGFwc2UoKSB7XG4gICAgY29uc3QgZXZlbnQgPSBuZXcgRXZlbnQoRVZFTlRfQ09MTEFQU0VEKVxuXG4gICAgaWYgKHRoaXMuX3BhcmVudCkge1xuICAgICAgdGhpcy5fcGFyZW50LmNsYXNzTGlzdC5hZGQoQ0xBU1NfTkFNRV9DT0xMQVBTSU5HKVxuXG4gICAgICBjb25zdCBlbG0gPSB0aGlzLl9wYXJlbnQ/LnF1ZXJ5U2VsZWN0b3JBbGwoYCR7U0VMRUNUT1JfQ0FSRF9CT0RZfSwgJHtTRUxFQ1RPUl9DQVJEX0ZPT1RFUn1gKVxuXG4gICAgICBlbG0uZm9yRWFjaChlbCA9PiB7XG4gICAgICAgIGlmIChlbCBpbnN0YW5jZW9mIEhUTUxFbGVtZW50KSB7XG4gICAgICAgICAgc2xpZGVVcChlbCwgdGhpcy5fY29uZmlnLmFuaW1hdGlvblNwZWVkKVxuICAgICAgICB9XG4gICAgICB9KVxuXG4gICAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgaWYgKHRoaXMuX3BhcmVudCkge1xuICAgICAgICAgIHRoaXMuX3BhcmVudC5jbGFzc0xpc3QuYWRkKENMQVNTX05BTUVfQ09MTEFQU0VEKVxuICAgICAgICAgIHRoaXMuX3BhcmVudC5jbGFzc0xpc3QucmVtb3ZlKENMQVNTX05BTUVfQ09MTEFQU0lORylcbiAgICAgICAgfVxuICAgICAgfSwgdGhpcy5fY29uZmlnLmFuaW1hdGlvblNwZWVkKVxuICAgIH1cblxuICAgIHRoaXMuX2VsZW1lbnQ/LmRpc3BhdGNoRXZlbnQoZXZlbnQpXG4gIH1cblxuICBleHBhbmQoKSB7XG4gICAgY29uc3QgZXZlbnQgPSBuZXcgRXZlbnQoRVZFTlRfRVhQQU5ERUQpXG5cbiAgICBpZiAodGhpcy5fcGFyZW50KSB7XG4gICAgICB0aGlzLl9wYXJlbnQuY2xhc3NMaXN0LmFkZChDTEFTU19OQU1FX0VYUEFORElORylcblxuICAgICAgY29uc3QgZWxtID0gdGhpcy5fcGFyZW50Py5xdWVyeVNlbGVjdG9yQWxsKGAke1NFTEVDVE9SX0NBUkRfQk9EWX0sICR7U0VMRUNUT1JfQ0FSRF9GT09URVJ9YClcblxuICAgICAgZWxtLmZvckVhY2goZWwgPT4ge1xuICAgICAgICBpZiAoZWwgaW5zdGFuY2VvZiBIVE1MRWxlbWVudCkge1xuICAgICAgICAgIHNsaWRlRG93bihlbCwgdGhpcy5fY29uZmlnLmFuaW1hdGlvblNwZWVkKVxuICAgICAgICB9XG4gICAgICB9KVxuXG4gICAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgaWYgKHRoaXMuX3BhcmVudCkge1xuICAgICAgICAgIHRoaXMuX3BhcmVudC5jbGFzc0xpc3QucmVtb3ZlKENMQVNTX05BTUVfQ09MTEFQU0VEKVxuICAgICAgICAgIHRoaXMuX3BhcmVudC5jbGFzc0xpc3QucmVtb3ZlKENMQVNTX05BTUVfRVhQQU5ESU5HKVxuICAgICAgICB9XG4gICAgICB9LCB0aGlzLl9jb25maWcuYW5pbWF0aW9uU3BlZWQpXG4gICAgfVxuXG4gICAgdGhpcy5fZWxlbWVudD8uZGlzcGF0Y2hFdmVudChldmVudClcbiAgfVxuXG4gIHJlbW92ZSgpIHtcbiAgICBjb25zdCBldmVudCA9IG5ldyBFdmVudChFVkVOVF9SRU1PVkUpXG5cbiAgICBpZiAodGhpcy5fcGFyZW50KSB7XG4gICAgICBzbGlkZVVwKHRoaXMuX3BhcmVudCwgdGhpcy5fY29uZmlnLmFuaW1hdGlvblNwZWVkKVxuICAgIH1cblxuICAgIHRoaXMuX2VsZW1lbnQ/LmRpc3BhdGNoRXZlbnQoZXZlbnQpXG4gIH1cblxuICB0b2dnbGUoKSB7XG4gICAgaWYgKHRoaXMuX3BhcmVudD8uY2xhc3NMaXN0LmNvbnRhaW5zKENMQVNTX05BTUVfQ09MTEFQU0VEKSkge1xuICAgICAgdGhpcy5leHBhbmQoKVxuICAgICAgcmV0dXJuXG4gICAgfVxuXG4gICAgdGhpcy5jb2xsYXBzZSgpXG4gIH1cblxuICBtYXhpbWl6ZSgpIHtcbiAgICBjb25zdCBldmVudCA9IG5ldyBFdmVudChFVkVOVF9NQVhJTUlaRUQpXG5cbiAgICBpZiAodGhpcy5fcGFyZW50KSB7XG4gICAgICB0aGlzLl9wYXJlbnQuc3R5bGUuaGVpZ2h0ID0gYCR7dGhpcy5fcGFyZW50Lm9mZnNldEhlaWdodH1weGBcbiAgICAgIHRoaXMuX3BhcmVudC5zdHlsZS53aWR0aCA9IGAke3RoaXMuX3BhcmVudC5vZmZzZXRXaWR0aH1weGBcbiAgICAgIHRoaXMuX3BhcmVudC5zdHlsZS50cmFuc2l0aW9uID0gJ2FsbCAuMTVzJ1xuXG4gICAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgY29uc3QgaHRtbFRhZyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ2h0bWwnKVxuXG4gICAgICAgIGlmIChodG1sVGFnKSB7XG4gICAgICAgICAgaHRtbFRhZy5jbGFzc0xpc3QuYWRkKENMQVNTX05BTUVfTUFYSU1JWkVEKVxuICAgICAgICB9XG5cbiAgICAgICAgaWYgKHRoaXMuX3BhcmVudCkge1xuICAgICAgICAgIHRoaXMuX3BhcmVudC5jbGFzc0xpc3QuYWRkKENMQVNTX05BTUVfTUFYSU1JWkVEKVxuXG4gICAgICAgICAgaWYgKHRoaXMuX3BhcmVudC5jbGFzc0xpc3QuY29udGFpbnMoQ0xBU1NfTkFNRV9DT0xMQVBTRUQpKSB7XG4gICAgICAgICAgICB0aGlzLl9wYXJlbnQuY2xhc3NMaXN0LmFkZChDTEFTU19OQU1FX1dBU19DT0xMQVBTRUQpXG4gICAgICAgICAgfVxuICAgICAgICB9XG4gICAgICB9LCAxNTApXG4gICAgfVxuXG4gICAgdGhpcy5fZWxlbWVudD8uZGlzcGF0Y2hFdmVudChldmVudClcbiAgfVxuXG4gIG1pbmltaXplKCkge1xuICAgIGNvbnN0IGV2ZW50ID0gbmV3IEV2ZW50KEVWRU5UX01JTklNSVpFRClcblxuICAgIGlmICh0aGlzLl9wYXJlbnQpIHtcbiAgICAgIHRoaXMuX3BhcmVudC5zdHlsZS5oZWlnaHQgPSAnYXV0bydcbiAgICAgIHRoaXMuX3BhcmVudC5zdHlsZS53aWR0aCA9ICdhdXRvJ1xuICAgICAgdGhpcy5fcGFyZW50LnN0eWxlLnRyYW5zaXRpb24gPSAnYWxsIC4xNXMnXG5cbiAgICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBjb25zdCBodG1sVGFnID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignaHRtbCcpXG5cbiAgICAgICAgaWYgKGh0bWxUYWcpIHtcbiAgICAgICAgICBodG1sVGFnLmNsYXNzTGlzdC5yZW1vdmUoQ0xBU1NfTkFNRV9NQVhJTUlaRUQpXG4gICAgICAgIH1cblxuICAgICAgICBpZiAodGhpcy5fcGFyZW50KSB7XG4gICAgICAgICAgdGhpcy5fcGFyZW50LmNsYXNzTGlzdC5yZW1vdmUoQ0xBU1NfTkFNRV9NQVhJTUlaRUQpXG5cbiAgICAgICAgICBpZiAodGhpcy5fcGFyZW50Py5jbGFzc0xpc3QuY29udGFpbnMoQ0xBU1NfTkFNRV9XQVNfQ09MTEFQU0VEKSkge1xuICAgICAgICAgICAgdGhpcy5fcGFyZW50LmNsYXNzTGlzdC5yZW1vdmUoQ0xBU1NfTkFNRV9XQVNfQ09MTEFQU0VEKVxuICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgfSwgMTApXG4gICAgfVxuXG4gICAgdGhpcy5fZWxlbWVudD8uZGlzcGF0Y2hFdmVudChldmVudClcbiAgfVxuXG4gIHRvZ2dsZU1heGltaXplKCkge1xuICAgIGlmICh0aGlzLl9wYXJlbnQ/LmNsYXNzTGlzdC5jb250YWlucyhDTEFTU19OQU1FX01BWElNSVpFRCkpIHtcbiAgICAgIHRoaXMubWluaW1pemUoKVxuICAgICAgcmV0dXJuXG4gICAgfVxuXG4gICAgdGhpcy5tYXhpbWl6ZSgpXG4gIH1cbn1cblxuLyoqXG4gKlxuICogRGF0YSBBcGkgaW1wbGVtZW50YXRpb25cbiAqID09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAqL1xuXG5vbkRPTUNvbnRlbnRMb2FkZWQoKCkgPT4ge1xuICBjb25zdCBjb2xsYXBzZUJ0biA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoU0VMRUNUT1JfREFUQV9DT0xMQVBTRSlcblxuICBjb2xsYXBzZUJ0bi5mb3JFYWNoKGJ0biA9PiB7XG4gICAgYnRuLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZXZlbnQgPT4ge1xuICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKVxuICAgICAgY29uc3QgdGFyZ2V0ID0gZXZlbnQudGFyZ2V0IGFzIEhUTUxFbGVtZW50XG4gICAgICBjb25zdCBkYXRhID0gbmV3IENhcmRXaWRnZXQodGFyZ2V0LCBEZWZhdWx0KVxuICAgICAgZGF0YS50b2dnbGUoKVxuICAgIH0pXG4gIH0pXG5cbiAgY29uc3QgcmVtb3ZlQnRuID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChTRUxFQ1RPUl9EQVRBX1JFTU9WRSlcblxuICByZW1vdmVCdG4uZm9yRWFjaChidG4gPT4ge1xuICAgIGJ0bi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGV2ZW50ID0+IHtcbiAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KClcbiAgICAgIGNvbnN0IHRhcmdldCA9IGV2ZW50LnRhcmdldCBhcyBIVE1MRWxlbWVudFxuICAgICAgY29uc3QgZGF0YSA9IG5ldyBDYXJkV2lkZ2V0KHRhcmdldCwgRGVmYXVsdClcbiAgICAgIGRhdGEucmVtb3ZlKClcbiAgICB9KVxuICB9KVxuXG4gIGNvbnN0IG1heEJ0biA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoU0VMRUNUT1JfREFUQV9NQVhJTUlaRSlcblxuICBtYXhCdG4uZm9yRWFjaChidG4gPT4ge1xuICAgIGJ0bi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGV2ZW50ID0+IHtcbiAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KClcbiAgICAgIGNvbnN0IHRhcmdldCA9IGV2ZW50LnRhcmdldCBhcyBIVE1MRWxlbWVudFxuICAgICAgY29uc3QgZGF0YSA9IG5ldyBDYXJkV2lkZ2V0KHRhcmdldCwgRGVmYXVsdClcbiAgICAgIGRhdGEudG9nZ2xlTWF4aW1pemUoKVxuICAgIH0pXG4gIH0pXG59KVxuXG5leHBvcnQgZGVmYXVsdCBDYXJkV2lkZ2V0XG4iLCIvKipcbiAqIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gKiBAZmlsZSBBZG1pbkxURSBmdWxsc2NyZWVuLnRzXG4gKiBAZGVzY3JpcHRpb24gRnVsbHNjcmVlbiBwbHVnaW4gZm9yIEFkbWluTFRFLlxuICogQGxpY2Vuc2UgTUlUXG4gKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuICovXG5cbmltcG9ydCB7XG4gIG9uRE9NQ29udGVudExvYWRlZFxufSBmcm9tICcuL3V0aWwvaW5kZXgnXG5cbi8qKlxuICogQ29uc3RhbnRzXG4gKiA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gKi9cbmNvbnN0IERBVEFfS0VZID0gJ2x0ZS5mdWxsc2NyZWVuJ1xuY29uc3QgRVZFTlRfS0VZID0gYC4ke0RBVEFfS0VZfWBcbmNvbnN0IEVWRU5UX01BWElNSVpFRCA9IGBtYXhpbWl6ZWQke0VWRU5UX0tFWX1gXG5jb25zdCBFVkVOVF9NSU5JTUlaRUQgPSBgbWluaW1pemVkJHtFVkVOVF9LRVl9YFxuXG5jb25zdCBTRUxFQ1RPUl9GVUxMU0NSRUVOX1RPR0dMRSA9ICdbZGF0YS1sdGUtdG9nZ2xlPVwiZnVsbHNjcmVlblwiXSdcbmNvbnN0IFNFTEVDVE9SX01BWElNSVpFX0lDT04gPSAnW2RhdGEtbHRlLWljb249XCJtYXhpbWl6ZVwiXSdcbmNvbnN0IFNFTEVDVE9SX01JTklNSVpFX0lDT04gPSAnW2RhdGEtbHRlLWljb249XCJtaW5pbWl6ZVwiXSdcblxuLyoqXG4gKiBDbGFzcyBEZWZpbml0aW9uLlxuICogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVxuICovXG5jbGFzcyBGdWxsU2NyZWVuIHtcbiAgX2VsZW1lbnQ6IEhUTUxFbGVtZW50XG4gIF9jb25maWc6IHVuZGVmaW5lZFxuXG4gIGNvbnN0cnVjdG9yKGVsZW1lbnQ6IEhUTUxFbGVtZW50LCBjb25maWc/OiB1bmRlZmluZWQpIHtcbiAgICB0aGlzLl9lbGVtZW50ID0gZWxlbWVudFxuICAgIHRoaXMuX2NvbmZpZyA9IGNvbmZpZ1xuICB9XG5cbiAgaW5GdWxsU2NyZWVuKCk6IHZvaWQge1xuICAgIGNvbnN0IGV2ZW50ID0gbmV3IEV2ZW50KEVWRU5UX01BWElNSVpFRClcblxuICAgIGNvbnN0IGljb25NYXhpbWl6ZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3I8SFRNTEVsZW1lbnQ+KFNFTEVDVE9SX01BWElNSVpFX0lDT04pXG4gICAgY29uc3QgaWNvbk1pbmltaXplID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcjxIVE1MRWxlbWVudD4oU0VMRUNUT1JfTUlOSU1JWkVfSUNPTilcblxuICAgIHZvaWQgZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LnJlcXVlc3RGdWxsc2NyZWVuKClcblxuICAgIGlmIChpY29uTWF4aW1pemUpIHtcbiAgICAgIGljb25NYXhpbWl6ZS5zdHlsZS5kaXNwbGF5ID0gJ25vbmUnXG4gICAgfVxuXG4gICAgaWYgKGljb25NaW5pbWl6ZSkge1xuICAgICAgaWNvbk1pbmltaXplLnN0eWxlLmRpc3BsYXkgPSAnYmxvY2snXG4gICAgfVxuXG4gICAgdGhpcy5fZWxlbWVudC5kaXNwYXRjaEV2ZW50KGV2ZW50KVxuICB9XG5cbiAgb3V0RnVsbHNjcmVlbigpOiB2b2lkIHtcbiAgICBjb25zdCBldmVudCA9IG5ldyBFdmVudChFVkVOVF9NSU5JTUlaRUQpXG5cbiAgICBjb25zdCBpY29uTWF4aW1pemUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yPEhUTUxFbGVtZW50PihTRUxFQ1RPUl9NQVhJTUlaRV9JQ09OKVxuICAgIGNvbnN0IGljb25NaW5pbWl6ZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3I8SFRNTEVsZW1lbnQ+KFNFTEVDVE9SX01JTklNSVpFX0lDT04pXG5cbiAgICB2b2lkIGRvY3VtZW50LmV4aXRGdWxsc2NyZWVuKClcblxuICAgIGlmIChpY29uTWF4aW1pemUpIHtcbiAgICAgIGljb25NYXhpbWl6ZS5zdHlsZS5kaXNwbGF5ID0gJ2Jsb2NrJ1xuICAgIH1cblxuICAgIGlmIChpY29uTWluaW1pemUpIHtcbiAgICAgIGljb25NaW5pbWl6ZS5zdHlsZS5kaXNwbGF5ID0gJ25vbmUnXG4gICAgfVxuXG4gICAgdGhpcy5fZWxlbWVudC5kaXNwYXRjaEV2ZW50KGV2ZW50KVxuICB9XG5cbiAgdG9nZ2xlRnVsbFNjcmVlbigpOiB2b2lkIHtcbiAgICBpZiAoZG9jdW1lbnQuZnVsbHNjcmVlbkVuYWJsZWQpIHtcbiAgICAgIGlmIChkb2N1bWVudC5mdWxsc2NyZWVuRWxlbWVudCkge1xuICAgICAgICB0aGlzLm91dEZ1bGxzY3JlZW4oKVxuICAgICAgfSBlbHNlIHtcbiAgICAgICAgdGhpcy5pbkZ1bGxTY3JlZW4oKVxuICAgICAgfVxuICAgIH1cbiAgfVxufVxuXG4vKipcbiAqIERhdGEgQXBpIGltcGxlbWVudGF0aW9uXG4gKiA9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gKi9cbm9uRE9NQ29udGVudExvYWRlZCgoKSA9PiB7XG4gIGNvbnN0IGJ1dHRvbnMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKFNFTEVDVE9SX0ZVTExTQ1JFRU5fVE9HR0xFKVxuXG4gIGJ1dHRvbnMuZm9yRWFjaChidG4gPT4ge1xuICAgIGJ0bi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGV2ZW50ID0+IHtcbiAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KClcblxuICAgICAgY29uc3QgdGFyZ2V0ID0gZXZlbnQudGFyZ2V0IGFzIEhUTUxFbGVtZW50XG4gICAgICBjb25zdCBidXR0b24gPSB0YXJnZXQuY2xvc2VzdChTRUxFQ1RPUl9GVUxMU0NSRUVOX1RPR0dMRSkgYXMgSFRNTEVsZW1lbnQgfCB1bmRlZmluZWRcblxuICAgICAgaWYgKGJ1dHRvbikge1xuICAgICAgICBjb25zdCBkYXRhID0gbmV3IEZ1bGxTY3JlZW4oYnV0dG9uLCB1bmRlZmluZWQpXG4gICAgICAgIGRhdGEudG9nZ2xlRnVsbFNjcmVlbigpXG4gICAgICB9XG4gICAgfSlcbiAgfSlcbn0pXG5cbmV4cG9ydCBkZWZhdWx0IEZ1bGxTY3JlZW5cbiIsIihmdW5jdGlvbiAoJCkge1xuXHQndXNlIHN0cmljdCc7XG5cdFxuICAgICQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICAvL0dvb2dsZSBNYXBcbiAgICAgICAgICAgIHZhciBtYXBQcm9wPSB7XG4gICAgICAgICAgICAgICAgY2VudGVyOm5ldyBnb29nbGUubWFwcy5MYXRMbmcoNTEuNTA4NzQyLC0wLjEyMDg1MCksXG4gICAgICAgICAgICAgICAgem9vbTogMTQsXG4gICAgICAgICAgICAgICAgc3R5bGVzOiBbXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcImFsbFwiLFxuICAgICAgICAgICAgICAgIFwiZWxlbWVudFR5cGVcIjogXCJhbGxcIixcbiAgICAgICAgICAgICAgICBcInN0eWxlcnNcIjogW1xuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcInZpc2liaWxpdHlcIjogXCJvblwiXG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBdXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIFwiZmVhdHVyZVR5cGVcIjogXCJhbGxcIixcbiAgICAgICAgICAgICAgICBcImVsZW1lbnRUeXBlXCI6IFwiZ2VvbWV0cnkuZmlsbFwiLFxuICAgICAgICAgICAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwiY29sb3JcIjogXCIjZmZmZmZmXCJcbiAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJ2aXNpYmlsaXR5XCI6IFwib25cIlxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgXVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBcImZlYXR1cmVUeXBlXCI6IFwiYWxsXCIsXG4gICAgICAgICAgICAgICAgXCJlbGVtZW50VHlwZVwiOiBcImxhYmVscy50ZXh0LmZpbGxcIixcbiAgICAgICAgICAgICAgICBcInN0eWxlcnNcIjogW1xuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcInNhdHVyYXRpb25cIjogMzZcbiAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJjb2xvclwiOiBcIiNhZWFlYWVcIlxuICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcImxpZ2h0bmVzc1wiOiA0MFxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgXVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBcImZlYXR1cmVUeXBlXCI6IFwiYWxsXCIsXG4gICAgICAgICAgICAgICAgXCJlbGVtZW50VHlwZVwiOiBcImxhYmVscy50ZXh0LnN0cm9rZVwiLFxuICAgICAgICAgICAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwidmlzaWJpbGl0eVwiOiBcIm9mZlwiXG4gICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwiY29sb3JcIjogXCIjMDAwMDAwXCJcbiAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJsaWdodG5lc3NcIjogMTZcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcImFsbFwiLFxuICAgICAgICAgICAgICAgIFwiZWxlbWVudFR5cGVcIjogXCJsYWJlbHMuaWNvblwiLFxuICAgICAgICAgICAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwidmlzaWJpbGl0eVwiOiBcIm9mZlwiXG4gICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwiY29sb3JcIjogXCIjYWVhZWFlXCJcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcImFkbWluaXN0cmF0aXZlXCIsXG4gICAgICAgICAgICAgICAgXCJlbGVtZW50VHlwZVwiOiBcImdlb21ldHJ5LmZpbGxcIixcbiAgICAgICAgICAgICAgICBcInN0eWxlcnNcIjogW1xuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcImNvbG9yXCI6IFwiIzAwMDAwMFwiXG4gICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwibGlnaHRuZXNzXCI6IDIwXG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBdXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIFwiZmVhdHVyZVR5cGVcIjogXCJhZG1pbmlzdHJhdGl2ZVwiLFxuICAgICAgICAgICAgICAgIFwiZWxlbWVudFR5cGVcIjogXCJnZW9tZXRyeS5zdHJva2VcIixcbiAgICAgICAgICAgICAgICBcInN0eWxlcnNcIjogW1xuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcImNvbG9yXCI6IFwiIzAwMDAwMFwiXG4gICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwibGlnaHRuZXNzXCI6IDE3XG4gICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwid2VpZ2h0XCI6IDEuMlxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgXVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBcImZlYXR1cmVUeXBlXCI6IFwiYWRtaW5pc3RyYXRpdmUuY291bnRyeVwiLFxuICAgICAgICAgICAgICAgIFwiZWxlbWVudFR5cGVcIjogXCJnZW9tZXRyeS5maWxsXCIsXG4gICAgICAgICAgICAgICAgXCJzdHlsZXJzXCI6IFtcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJjb2xvclwiOiBcIiMxMDBkMGRcIlxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgXVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBcImZlYXR1cmVUeXBlXCI6IFwibGFuZHNjYXBlXCIsXG4gICAgICAgICAgICAgICAgXCJlbGVtZW50VHlwZVwiOiBcImdlb21ldHJ5XCIsXG4gICAgICAgICAgICAgICAgXCJzdHlsZXJzXCI6IFtcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJjb2xvclwiOiBcIiMwMDAwMDBcIlxuICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcImxpZ2h0bmVzc1wiOiAyMFxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgXVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBcImZlYXR1cmVUeXBlXCI6IFwibGFuZHNjYXBlLm5hdHVyYWwubGFuZGNvdmVyXCIsXG4gICAgICAgICAgICAgICAgXCJlbGVtZW50VHlwZVwiOiBcImdlb21ldHJ5LmZpbGxcIixcbiAgICAgICAgICAgICAgICBcInN0eWxlcnNcIjogW1xuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcImNvbG9yXCI6IFwiIzA1MDQwNFwiXG4gICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwidmlzaWJpbGl0eVwiOiBcIm9uXCJcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcInBvaVwiLFxuICAgICAgICAgICAgICAgIFwiZWxlbWVudFR5cGVcIjogXCJnZW9tZXRyeVwiLFxuICAgICAgICAgICAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwiY29sb3JcIjogXCIjMDAwMDAwXCJcbiAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJsaWdodG5lc3NcIjogMjFcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcInBvaS5wYXJrXCIsXG4gICAgICAgICAgICAgICAgXCJlbGVtZW50VHlwZVwiOiBcImdlb21ldHJ5LmZpbGxcIixcbiAgICAgICAgICAgICAgICBcInN0eWxlcnNcIjogW1xuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcInNhdHVyYXRpb25cIjogXCItNDNcIlxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgXVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBcImZlYXR1cmVUeXBlXCI6IFwicG9pLnBhcmtcIixcbiAgICAgICAgICAgICAgICBcImVsZW1lbnRUeXBlXCI6IFwiZ2VvbWV0cnkuc3Ryb2tlXCIsXG4gICAgICAgICAgICAgICAgXCJzdHlsZXJzXCI6IFtcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJ2aXNpYmlsaXR5XCI6IFwib2ZmXCJcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcInJvYWRcIixcbiAgICAgICAgICAgICAgICBcImVsZW1lbnRUeXBlXCI6IFwiZ2VvbWV0cnkuZmlsbFwiLFxuICAgICAgICAgICAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwiZ2FtbWFcIjogXCIxMC4wMFwiXG4gICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwibGlnaHRuZXNzXCI6IFwiMTAwXCJcbiAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJ2aXNpYmlsaXR5XCI6IFwib25cIlxuICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcImNvbG9yXCI6IFwiIzE2NDdjMlwiXG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBdXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIFwiZmVhdHVyZVR5cGVcIjogXCJyb2FkXCIsXG4gICAgICAgICAgICAgICAgXCJlbGVtZW50VHlwZVwiOiBcImdlb21ldHJ5LnN0cm9rZVwiLFxuICAgICAgICAgICAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwiY29sb3JcIjogXCIjYzIwMGZmXCJcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcInJvYWQuaGlnaHdheVwiLFxuICAgICAgICAgICAgICAgIFwiZWxlbWVudFR5cGVcIjogXCJnZW9tZXRyeS5maWxsXCIsXG4gICAgICAgICAgICAgICAgXCJzdHlsZXJzXCI6IFtcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJjb2xvclwiOiBcIiMwMDAwMDBcIlxuICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcImxpZ2h0bmVzc1wiOiAxN1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgXVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBcImZlYXR1cmVUeXBlXCI6IFwicm9hZC5oaWdod2F5XCIsXG4gICAgICAgICAgICAgICAgXCJlbGVtZW50VHlwZVwiOiBcImdlb21ldHJ5LnN0cm9rZVwiLFxuICAgICAgICAgICAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwiY29sb3JcIjogXCIjMDAwMDAwXCJcbiAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJsaWdodG5lc3NcIjogMjlcbiAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJ3ZWlnaHRcIjogMC4yXG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBdXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIFwiZmVhdHVyZVR5cGVcIjogXCJyb2FkLmFydGVyaWFsXCIsXG4gICAgICAgICAgICAgICAgXCJlbGVtZW50VHlwZVwiOiBcImdlb21ldHJ5XCIsXG4gICAgICAgICAgICAgICAgXCJzdHlsZXJzXCI6IFtcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJjb2xvclwiOiBcIiMwMDAwMDBcIlxuICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcImxpZ2h0bmVzc1wiOiAxOFxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgXVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBcImZlYXR1cmVUeXBlXCI6IFwicm9hZC5sb2NhbFwiLFxuICAgICAgICAgICAgICAgIFwiZWxlbWVudFR5cGVcIjogXCJnZW9tZXRyeVwiLFxuICAgICAgICAgICAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwiY29sb3JcIjogXCIjMDAwMDAwXCJcbiAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJsaWdodG5lc3NcIjogMTZcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcInRyYW5zaXRcIixcbiAgICAgICAgICAgICAgICBcImVsZW1lbnRUeXBlXCI6IFwiZ2VvbWV0cnlcIixcbiAgICAgICAgICAgICAgICBcInN0eWxlcnNcIjogW1xuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcImNvbG9yXCI6IFwiIzAwMDAwMFwiXG4gICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwibGlnaHRuZXNzXCI6IDE5XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBdXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgIFwiZmVhdHVyZVR5cGVcIjogXCJ3YXRlclwiLFxuICAgICAgICAgICAgICAgIFwiZWxlbWVudFR5cGVcIjogXCJnZW9tZXRyeVwiLFxuICAgICAgICAgICAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwiY29sb3JcIjogXCIjMDAwMDAwXCJcbiAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgXCJsaWdodG5lc3NcIjogMTdcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcIndhdGVyXCIsXG4gICAgICAgICAgICAgICAgXCJlbGVtZW50VHlwZVwiOiBcImdlb21ldHJ5LmZpbGxcIixcbiAgICAgICAgICAgICAgICBcInN0eWxlcnNcIjogW1xuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcImxpZ2h0bmVzc1wiOiBcIi00M1wiXG4gICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwic2F0dXJhdGlvblwiOiBcIjZcIlxuICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICBcImdhbW1hXCI6IFwiMC40MVwiXG4gICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwiY29sb3JcIjogXCIjMzgzODM4XCJcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgXCJmZWF0dXJlVHlwZVwiOiBcIndhdGVyXCIsXG4gICAgICAgICAgICAgICAgXCJlbGVtZW50VHlwZVwiOiBcImdlb21ldHJ5LnN0cm9rZVwiLFxuICAgICAgICAgICAgICAgIFwic3R5bGVyc1wiOiBbXG4gICAgICAgICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIFwidmlzaWJpbGl0eVwiOiBcIm9mZlwiXG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBdXG4gICAgICAgICAgICB9XG4gICAgICAgIF1cbiAgICAgICAgICAgIH07XG4gICAgICAgICAgICB2YXIgbWFwPW5ldyBnb29nbGUubWFwcy5NYXAoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJnb29nbGVNYXBcIiksbWFwUHJvcCk7XG4gICAgfSk7XG5cdFxuXHRcbn0pKGpRdWVyeSk7IiwiXG4oZnVuY3Rpb24gKCQpIHtcblx0J3VzZSBzdHJpY3QnO1xuXHRcblx0alF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XG5cbiAgICAgICAgLy8gUHJpY2V0YWJsZSBUb2dnbGVyXG4gICAgICAgIHZhciBlID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJmaWx0LW1vbnRobHlcIiksXG4gICAgICAgICAgICBkID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJmaWx0LXllYXJseVwiKSxcbiAgICAgICAgICAgIHQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInN3aXRjaGVyXCIpLFxuICAgICAgICAgICAgbSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibW9udGhseVwiKSxcbiAgICAgICAgICAgIHkgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInllYXJseVwiKTtcblxuICAgICAgICBlLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCBmdW5jdGlvbigpe1xuICAgICAgICAgICAgdC5jaGVja2VkID0gZmFsc2U7XG4gICAgICAgICAgICBlLmNsYXNzTGlzdC5hZGQoXCJ0b2dnbGVyLS1pcy1hY3RpdmVcIik7XG4gICAgICAgICAgICBkLmNsYXNzTGlzdC5yZW1vdmUoXCJ0b2dnbGVyLS1pcy1hY3RpdmVcIik7XG4gICAgICAgICAgICBtLmNsYXNzTGlzdC5yZW1vdmUoXCJkLW5vbmVcIik7XG4gICAgICAgICAgICB5LmNsYXNzTGlzdC5hZGQoXCJkLW5vbmVcIik7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIGQuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICB0LmNoZWNrZWQgPSB0cnVlO1xuICAgICAgICAgICAgZC5jbGFzc0xpc3QuYWRkKFwidG9nZ2xlci0taXMtYWN0aXZlXCIpO1xuICAgICAgICAgICAgZS5jbGFzc0xpc3QucmVtb3ZlKFwidG9nZ2xlci0taXMtYWN0aXZlXCIpO1xuICAgICAgICAgICAgbS5jbGFzc0xpc3QuYWRkKFwiZC1ub25lXCIpO1xuICAgICAgICAgICAgeS5jbGFzc0xpc3QucmVtb3ZlKFwiZC1ub25lXCIpO1xuICAgICAgICB9KTtcblxuICAgICAgICB0LmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCBmdW5jdGlvbigpe1xuICAgICAgICAgICAgZC5jbGFzc0xpc3QudG9nZ2xlKFwidG9nZ2xlci0taXMtYWN0aXZlXCIpO1xuICAgICAgICAgICAgZS5jbGFzc0xpc3QudG9nZ2xlKFwidG9nZ2xlci0taXMtYWN0aXZlXCIpO1xuICAgICAgICAgICAgbS5jbGFzc0xpc3QudG9nZ2xlKFwiZC1ub25lXCIpO1xuICAgICAgICAgICAgeS5jbGFzc0xpc3QudG9nZ2xlKFwiZC1ub25lXCIpO1xuICAgICAgICB9KTtcblxuXG4gICAgfSk7ICAgICAgXG59KShqUXVlcnkpOyIsIi8qXG5UaGVtZSBOYW1lOiBEdWNhdGlib3ggLSBDYXIgU2VydmljZSAmIEF1dG8gUmVwYWlyIFRlbXBsYXRlXG5WZXJzaW9uOiAxLjBcbkF1dGhvcjogV1BUaGVtZUJvb3N0ZXJcbkF1dGhvciBVUkw6IFxuRGVzY3JpcHRpb246IER1Y2F0aWJveCAtIENhciBTZXJ2aWNlICYgQXV0byBSZXBhaXIgVGVtcGxhdGVcbiovXG4vKlx0SUUgMTAgRml4Ki9cblxuKGZ1bmN0aW9uICgkKSB7XG5cdCd1c2Ugc3RyaWN0Jztcblx0XG5cdGpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuXG4gICAgICAgIC8vIFByZWxvYWRlclxuICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgJCgnI3ByZWxvYWRlcicpLmFkZENsYXNzKCdoaWRlJyk7XG4gICAgICAgIH0sIDEwMDApO1xuXG4gICAgICAgIC8vIEFkZCBNZW51IEl0ZW0gQ3VycmVudCBDbGFzcyBBdXRvXG4gICAgICAgIGZ1bmN0aW9uIGR5bmFtaWNDdXJyZW50TWVudUNsYXNzKHNlbGVjdG9yKSB7XG4gICAgICAgICAgICBsZXQgRmlsZU5hbWUgPSB3aW5kb3cubG9jYXRpb24uaHJlZi5zcGxpdChcIi9cIikucmV2ZXJzZSgpWzBdO1xuICBcbiAgICAgICAgICAgIHNlbGVjdG9yLmZpbmQoXCJsaVwiKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgbGV0IGFuY2hvciA9ICQodGhpcykuZmluZChcImFcIik7XG4gICAgICAgICAgICAgIGlmICgkKGFuY2hvcikuYXR0cihcImhyZWZcIikgPT0gRmlsZU5hbWUpIHtcbiAgICAgICAgICAgICAgICAkKHRoaXMpLmFkZENsYXNzKFwiYWN0aXZlXCIpO1xuICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIC8vIGlmIGFueSBsaSBoYXMgLmN1cnJlbnQgZWxtbnQgYWRkIGNsYXNzXG4gICAgICAgICAgICBzZWxlY3Rvci5jaGlsZHJlbihcImxpXCIpLmVhY2goZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICBpZiAoJCh0aGlzKS5maW5kKFwiLmFjdGl2ZVwiKS5sZW5ndGgpIHtcbiAgICAgICAgICAgICAgICAkKHRoaXMpLmFkZENsYXNzKFwiYWN0aXZlXCIpO1xuICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIC8vIGlmIG5vIGZpbGUgbmFtZSByZXR1cm5cbiAgICAgICAgICAgIGlmIChcIlwiID09IEZpbGVOYW1lKSB7XG4gICAgICAgICAgICAgIHNlbGVjdG9yLmZpbmQoXCJsaVwiKS5lcSgwKS5hZGRDbGFzcyhcImFjdGl2ZVwiKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgICAgIFxuICAgICAgICBpZiAoJCgnLm1haW5uYXYgLm1haW4tbWVudScpLmxlbmd0aCkge1xuICAgICAgICAgICAgZHluYW1pY0N1cnJlbnRNZW51Q2xhc3MoJCgnLm1haW5uYXYgLm1haW4tbWVudScpKTtcbiAgICAgICAgfVxuXG4gICAgICAgIC8vIE1vYmlsZSBSZXNwb25zaXZlIE1lbnUgXG4gICAgICAgIHZhciBtb2JpbGVMb2dvQ29udGVudCA9ICQoJ2hlYWRlciAubG9nbycpLmh0bWwoKTtcbiAgICAgICAgdmFyIG1vYmlsZU1lbnVDb250ZW50ID0gJCgnLm1haW5uYXYnKS5odG1sKCk7XG5cdFx0JCgnLm1yX21lbnUgLmxvZ28nKS5hcHBlbmQobW9iaWxlTG9nb0NvbnRlbnQpO1xuXHRcdCQoJy5tcl9tZW51IC5tcl9uYXZtZW51JykuYXBwZW5kKG1vYmlsZU1lbnVDb250ZW50KTtcbiAgICAgICAgJCggJy5tcl9tZW51IC5tcl9uYXZtZW51IHVsLm1haW4tbWVudSBsaS5tZW51LWl0ZW0taGFzLWNoaWxkcmVuJykuYXBwZW5kKCAkKCBcIjxzcGFuIGNsYXNzPSdzdWJtZW51X29wZW5lcic+PGkgY2xhc3M9J2JpIGJpLWNoZXZyb24tcmlnaHQnPjwvaT48L3NwYW4+XCIgKSApO1xuXG4gICAgICAgIC8vIFN1Yi1NZW51IE9wZW4gT24tQ2xpY2tcbiAgICAgICAgJCgnLm1yX21lbnUgdWwubWFpbi1tZW51IGxpLm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4gLnN1Ym1lbnVfb3BlbmVyJykub24oXCJjbGlja1wiLCBmdW5jdGlvbihlKXtcbiAgICAgICAgICAgICQodGhpcykucGFyZW50KCkudG9nZ2xlQ2xhc3MoJ25hdl9vcGVuJyk7XG4gICAgICAgICAgICAkKHRoaXMpLnNpYmxpbmdzKCd1bCcpLnNsaWRlVG9nZ2xlKCk7XG4gICAgICAgICAgICBlLnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICB9KTtcbiAgICAgICAgXG4gICAgICAgIC8vIEFjdGl2ZSBNb2JpbGUgUmVzcG9uc2l2ZSBNZW51IDogQWRkIENsYXNzIGluIGJvZHkgdGFnXG4gICAgICAgICQoJy5tcl9tZW51X3RvZ2dsZScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgICAgICQoJ2JvZHknKS5hZGRDbGFzcygnbXJfbWVudV9hY3RpdmUnKTtcbiAgICAgICAgICAgIGUuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIH0pO1xuICAgICAgICAkKCcubXJfbWVudV9jbG9zZScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygnbXJfbWVudV9hY3RpdmUnKTtcbiAgICAgICAgICAgIGUuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIH0pO1xuICAgICAgICBcbiAgICAgICAgLy8gJCgnYm9keScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgLy8gICAgICQoJ2JvZHknKS5yZW1vdmVDbGFzcygnbXJfbWVudV9hY3RpdmUnKTtcbiAgICAgICAgLy8gICAgIGUuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgIC8vICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIC8vIH0pO1xuXG5cbiAgICAgICAgLy8gQXNpZGUgaW5mbyBiYXJcbiAgICAgICAgJCgnLmFzaWRlX29wZW4nKS5vbihcImNsaWNrXCIsIGZ1bmN0aW9uKGUpIHtcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgICQodGhpcykuYWRkQ2xhc3MoJ2Nsb3NlJyk7XG4gICAgICAgICAgICAkKCcuYXNpZGVfaW5mb193cmFwcGVyJykuYWRkQ2xhc3MoJ3Nob3cnKTtcbiAgICAgICAgfSk7XG4gICAgICAgICQoJy5hc2lkZV9jbG9zZScpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24oZSkge1xuICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgJCgnLmFzaWRlX29wZW4nKS5yZW1vdmVDbGFzcygnY2xvc2UnKTtcbiAgICAgICAgICAgICQoJy5hc2lkZV9pbmZvX3dyYXBwZXInKS5yZW1vdmVDbGFzcygnc2hvdycpO1xuICAgICAgICB9KTtcblxuICAgICAgICAvLyBUb2dnbGUgSGVhZGVyIFNlYXJjaFxuICAgICAgICAkKCcuaGVhZGVyX3NlYXJjaCAuZm9ybS1jb250cm9sLXN1Ym1pdCcpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAkKCcub3Blbl9zZWFyY2gnKS50b2dnbGVDbGFzcygnYWN0aXZlJyk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIC8vIFN0aWNreSBIZWFkZXJcbiAgICAgICAgdmFyIGhlYWRlciA9ICQoXCJoZWFkZXJcIik7XG4gICAgICAgICQod2luZG93KS5zY3JvbGwoZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICB2YXIgc2Nyb2xsID0gJCh3aW5kb3cpLnNjcm9sbFRvcCgpO1xuXG4gICAgICAgICAgICBpZiAoc2Nyb2xsID49IDUwKSB7XG4gICAgICAgICAgICAgICAgaGVhZGVyLmFkZENsYXNzKFwic3RpY2t5XCIpO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICBoZWFkZXIucmVtb3ZlQ2xhc3MoXCJzdGlja3lcIik7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuXG5cbiAgICAgICAgLy8gV09XIEluaXRcbiAgICAgICAgbmV3IFdPVygpLmluaXQoKTtcblxuICAgICAgICAvLyBTd2lwZXIgU3RhcnRcblxuICAgICAgICAvLyBNYWluIFNsaWRlciBPbmVcbiAgICAgICAgdmFyIFN3aXBlclNsaWRlciA9IG5ldyBTd2lwZXIoJy5zd2lwZXItbWFpbi1zbGlkZXInLCB7XG4gICAgICAgICAgICBsb29wOiB0cnVlLFxuICAgICAgICAgICAgLy8gYXV0b3BsYXk6IHtcbiAgICAgICAgICAgIC8vICAgICBkZWxheTogNDAwMCxcbiAgICAgICAgICAgIC8vIH0sXG4gICAgICAgICAgICBhdXRvSGVpZ2h0OiB0cnVlLFxuICAgICAgICAgICAgc3BlZWQ6IDI1MDAsXG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiAxLFxuICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiAwLCAgICAgICAgICAgIFxuICAgICAgICAgICAgLy8gbmF2aWdhdGlvbjoge1xuICAgICAgICAgICAgLy8gICAgIG5leHRFbDogJy5zd2lwZXItYnV0dG9uLW5leHQnLFxuICAgICAgICAgICAgLy8gICAgIHByZXZFbDogJy5zd2lwZXItYnV0dG9uLXByZXYnLFxuICAgICAgICAgICAgLy8gfSxcbiAgICAgICAgICAgIHBhZ2luYXRpb246IHtcbiAgICAgICAgICAgICAgICBlbDogJy5zd2lwZXItcGFnaW5hdGlvbicsXG4gICAgICAgICAgICAgICAgY2xpY2thYmxlOiB0cnVlLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfSk7XG5cbiAgICAgICAgLy8gTWFpbiBTbGlkZXIgVHdvXG4gICAgICAgIHZhciBTd2lwZXJTbGlkZXIyID0gbmV3IFN3aXBlcignLnN0eWxlMiAuc3dpcGVyLW1haW4tc2xpZGVyJywge1xuICAgICAgICAgICAgbG9vcDogdHJ1ZSxcbiAgICAgICAgICAgIC8vIGF1dG9wbGF5OiB7XG4gICAgICAgICAgICAvLyAgICAgZGVsYXk6IDQwMDAsXG4gICAgICAgICAgICAvLyB9LFxuICAgICAgICAgICAgYXV0b0hlaWdodDogdHJ1ZSxcbiAgICAgICAgICAgIHNwZWVkOiAyNTAwLFxuICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogMSxcbiAgICAgICAgICAgIHNwYWNlQmV0d2VlbjogMCwgICAgICAgICAgICBcbiAgICAgICAgICAgIC8vIG5hdmlnYXRpb246IHtcbiAgICAgICAgICAgIC8vICAgICBuZXh0RWw6ICcuc3dpcGVyLWJ1dHRvbi1uZXh0JyxcbiAgICAgICAgICAgIC8vICAgICBwcmV2RWw6ICcuc3dpcGVyLWJ1dHRvbi1wcmV2JyxcbiAgICAgICAgICAgIC8vIH0sXG4gICAgICAgICAgICBwYWdpbmF0aW9uOiB7XG4gICAgICAgICAgICAgICAgZWw6ICcuc3dpcGVyLXBhZ2luYXRpb24nLFxuICAgICAgICAgICAgICAgIGNsaWNrYWJsZTogdHJ1ZSxcbiAgICAgICAgICAgICAgICByZW5kZXJCdWxsZXQ6IGZ1bmN0aW9uIChpbmRleCwgY2xhc3NOYW1lKSB7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiAnPHNwYW4gY2xhc3M9XCInICsgY2xhc3NOYW1lICsgJ1wiPicgKyAnPHNwYW4gY2xhc3M9XCJudW1iZXJcIj4nICsgKGluZGV4ICsgMSkgKyBcIjwvc3Bhbj5cIiArIFwiPC9zcGFuPlwiO1xuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB9LFxuICAgICAgICB9KTtcblxuICAgICAgICAvLyBJbWFnZWJveCBPbmVcbiAgICAgICAgdmFyIFN3aXBlckltYWdlYm94ID0gbmV3IFN3aXBlcignLnN3aXBlci1pbWFnZWJveCcsIHtcbiAgICAgICAgICAgIGxvb3A6IHRydWUsXG4gICAgICAgICAgICBhdXRvcGxheToge1xuICAgICAgICAgICAgICAgIGRlbGF5OiA0MDAwLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNwZWVkOiAxNTAwLFxuICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogMSxcbiAgICAgICAgICAgIHNwYWNlQmV0d2VlbjogMCwgICAgICAgICAgICBcbiAgICAgICAgICAgIC8vIG5hdmlnYXRpb246IHtcbiAgICAgICAgICAgIC8vICAgICBuZXh0RWw6ICcuc3dpcGVyLWJ1dHRvbi1uZXh0JyxcbiAgICAgICAgICAgIC8vICAgICBwcmV2RWw6ICcuc3dpcGVyLWJ1dHRvbi1wcmV2JyxcbiAgICAgICAgICAgIC8vIH0sXG4gICAgICAgICAgICBwYWdpbmF0aW9uOiB7XG4gICAgICAgICAgICAgICAgZWw6ICcuc3dpcGVyLXBhZ2luYXRpb24nLFxuICAgICAgICAgICAgICAgIGNsaWNrYWJsZTogdHJ1ZVxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGJyZWFrcG9pbnRzOiB7XG4gICAgICAgICAgICAgICAgNjAwOiB7XG4gICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiAyLFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgOTkyOiB7XG4gICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiAzLFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgMTQwMDoge1xuICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogNCxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgICAgICAvLyBUZXN0aW1vbmlhbCBPbmVcbiAgICAgICAgdmFyIFN3aXBlclRlc3RpbW9uaWFsID0gbmV3IFN3aXBlcignLnN3aXBlci10ZXN0aW1vbmlhbCcsIHtcbiAgICAgICAgICAgIGxvb3A6IHRydWUsXG4gICAgICAgICAgICBhdXRvcGxheToge1xuICAgICAgICAgICAgICAgIGRlbGF5OiA0MDAwLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIHNwZWVkOiAxNTAwLFxuICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogMSxcbiAgICAgICAgICAgIHNwYWNlQmV0d2VlbjogMzAsICAgICAgICAgICAgXG4gICAgICAgICAgICAvLyBuYXZpZ2F0aW9uOiB7XG4gICAgICAgICAgICAvLyAgICAgbmV4dEVsOiAnLnN3aXBlci1idXR0b24tbmV4dCcsXG4gICAgICAgICAgICAvLyAgICAgcHJldkVsOiAnLnN3aXBlci1idXR0b24tcHJldicsXG4gICAgICAgICAgICAvLyB9LFxuICAgICAgICAgICAgcGFnaW5hdGlvbjoge1xuICAgICAgICAgICAgICAgIGVsOiAnLnN3aXBlci1wYWdpbmF0aW9uJyxcbiAgICAgICAgICAgICAgICBjbGlja2FibGU6IHRydWVcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBicmVha3BvaW50czoge1xuICAgICAgICAgICAgICAgIDc2ODoge1xuICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogMSxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgICAgICAvLyBUZXN0aW1vbmlhbCBUd29cbiAgICAgICAgdmFyIFN3aXBlclRlc3RpbW9uaWFsVHdvID0gbmV3IFN3aXBlcignLnN3aXBlci10ZXN0aW1vbmlhbDInLCB7XG4gICAgICAgICAgICBsb29wOiB0cnVlLFxuICAgICAgICAgICAgLy8gYXV0b3BsYXk6IHtcbiAgICAgICAgICAgIC8vICAgICBkZWxheTogNDAwMCxcbiAgICAgICAgICAgIC8vIH0sXG4gICAgICAgICAgICBzcGVlZDogMTUwMCxcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDEsXG4gICAgICAgICAgICBzcGFjZUJldHdlZW46IDMwLCAgICAgICAgICAgIFxuICAgICAgICAgICAgLy8gbmF2aWdhdGlvbjoge1xuICAgICAgICAgICAgLy8gICAgIG5leHRFbDogJy5zd2lwZXItYnV0dG9uLW5leHQnLFxuICAgICAgICAgICAgLy8gICAgIHByZXZFbDogJy5zd2lwZXItYnV0dG9uLXByZXYnLFxuICAgICAgICAgICAgLy8gfSxcbiAgICAgICAgICAgIHBhZ2luYXRpb246IHtcbiAgICAgICAgICAgICAgICBlbDogJy5zd2lwZXItcGFnaW5hdGlvbicsXG4gICAgICAgICAgICAgICAgY2xpY2thYmxlOiB0cnVlXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgYnJlYWtwb2ludHM6IHtcbiAgICAgICAgICAgICAgICA3Njg6IHtcbiAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDEsXG4gICAgICAgICAgICAgICAgfSxcblxuICAgICAgICAgICAgICAgIDEyMDA6IHtcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogMyxcbiAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuXG4gICAgICAgIC8vIENsaWVudHMgTG9nbyBPbmVcbiAgICAgICAgdmFyIFN3aXBlckNsaWVudHMgPSBuZXcgU3dpcGVyKCcuc3dpcGVyLWNsaWVudHMnLCB7XG4gICAgICAgICAgICBsb29wOiB0cnVlLFxuICAgICAgICAgICAgYXV0b3BsYXk6IHtcbiAgICAgICAgICAgICAgICBkZWxheTogNDAwMCxcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzcGVlZDogMTUwMCxcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDEsXG4gICAgICAgICAgICBzcGFjZUJldHdlZW46IDMwLCAgICAgICAgICAgIFxuICAgICAgICAgICAgLy8gbmF2aWdhdGlvbjoge1xuICAgICAgICAgICAgLy8gICAgIG5leHRFbDogJy5zd2lwZXItYnV0dG9uLW5leHQnLFxuICAgICAgICAgICAgLy8gICAgIHByZXZFbDogJy5zd2lwZXItYnV0dG9uLXByZXYnLFxuICAgICAgICAgICAgLy8gfSxcbiAgICAgICAgICAgIHBhZ2luYXRpb246IHtcbiAgICAgICAgICAgICAgICBlbDogJy5zd2lwZXItcGFnaW5hdGlvbicsXG4gICAgICAgICAgICAgICAgY2xpY2thYmxlOiB0cnVlXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgYnJlYWtwb2ludHM6IHtcbiAgICAgICAgICAgICAgICA0MDA6IHtcbiAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDIsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICA1NzY6IHtcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogMyxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgIDk5Mjoge1xuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiA1LFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuXG4gICAgICAgIC8vIENsaWVudHMgTG9nbyBUd29cbiAgICAgICAgdmFyIFN3aXBlckNsaWVudHMgPSBuZXcgU3dpcGVyKCcuc3dpcGVyLWNsaWVudHMyJywge1xuICAgICAgICAgICAgbG9vcDogdHJ1ZSxcbiAgICAgICAgICAgIGF1dG9wbGF5OiB7XG4gICAgICAgICAgICAgICAgZGVsYXk6IDQwMDAsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3BlZWQ6IDE1MDAsXG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiAxLFxuICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiAwLCAgICAgICAgICAgIFxuICAgICAgICAgICAgLy8gbmF2aWdhdGlvbjoge1xuICAgICAgICAgICAgLy8gICAgIG5leHRFbDogJy5zd2lwZXItYnV0dG9uLW5leHQnLFxuICAgICAgICAgICAgLy8gICAgIHByZXZFbDogJy5zd2lwZXItYnV0dG9uLXByZXYnLFxuICAgICAgICAgICAgLy8gfSxcbiAgICAgICAgICAgIHBhZ2luYXRpb246IHtcbiAgICAgICAgICAgICAgICBlbDogJy5zd2lwZXItcGFnaW5hdGlvbicsXG4gICAgICAgICAgICAgICAgY2xpY2thYmxlOiB0cnVlXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgYnJlYWtwb2ludHM6IHtcbiAgICAgICAgICAgICAgICA0MDA6IHtcbiAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDIsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICA1NzY6IHtcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzUGVyVmlldzogMyxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgIDk5Mjoge1xuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiA1LFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgMTIwMDoge1xuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiA2LFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuXG4gICAgICAgIC8vIEJsb2dcbiAgICAgICAgdmFyIFN3aXBlckJsb2cgPSBuZXcgU3dpcGVyKCcuc3dpcGVyLWJsb2cnLCB7XG4gICAgICAgICAgICBsb29wOiB0cnVlLFxuICAgICAgICAgICAgLy8gYXV0b3BsYXk6IHtcbiAgICAgICAgICAgIC8vICAgICBkZWxheTogNDAwMCxcbiAgICAgICAgICAgIC8vIH0sXG4gICAgICAgICAgICBzcGVlZDogMTUwMCxcbiAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDEsXG4gICAgICAgICAgICBzcGFjZUJldHdlZW46IDMwLCAgICAgICAgICAgIFxuICAgICAgICAgICAgLy8gbmF2aWdhdGlvbjoge1xuICAgICAgICAgICAgLy8gICAgIG5leHRFbDogJy5zd2lwZXItYnV0dG9uLW5leHQnLFxuICAgICAgICAgICAgLy8gICAgIHByZXZFbDogJy5zd2lwZXItYnV0dG9uLXByZXYnLFxuICAgICAgICAgICAgLy8gfSxcbiAgICAgICAgICAgIHBhZ2luYXRpb246IHtcbiAgICAgICAgICAgICAgICBlbDogJy5zd2lwZXItcGFnaW5hdGlvbicsXG4gICAgICAgICAgICAgICAgY2xpY2thYmxlOiB0cnVlXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgYnJlYWtwb2ludHM6IHtcbiAgICAgICAgICAgICAgICA3Njg6IHtcbiAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDIsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICA5OTI6IHtcbiAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IDIsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICAgICAgLy8gTGFuZGluZyBJbm5lcnBhZ2VzXG4gICAgICAgIHZhciBTd2lwZXJJbm5lcnBhZ2VzID0gbmV3IFN3aXBlcignLnN3aXBlci1pbm5lcnBhZ2VzJywge1xuICAgICAgICAgICAgbG9vcDogdHJ1ZSxcbiAgICAgICAgICAgIGF1dG9wbGF5OiB7XG4gICAgICAgICAgICAgICAgZGVsYXk6IDQwMDAsXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3BlZWQ6IDE1MDAsXG4gICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiAxLFxuICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiAwLCBcbiAgICAgICAgICAgIGJyZWFrcG9pbnRzOiB7XG4gICAgICAgICAgICAgICAgNjAwOiB7XG4gICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiAyLFxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgOTkyOiB7XG4gICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiAzLFxuICAgICAgICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiAzMCwgXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICAxNDAwOiB7XG4gICAgICAgICAgICAgICAgICBzbGlkZXNQZXJWaWV3OiA0LFxuICAgICAgICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiA0MCwgXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cblxuICAgICAgICAvLyBPZG9tZXRlclxuICAgICAgICAkKCcub2RvbWV0ZXInKS5hcHBlYXIoKTtcbiAgICAgICAgJCgnLm9kb21ldGVyJykuYXBwZWFyKGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICB2YXIgb2RvID0gJChcIi5vZG9tZXRlclwiKTtcbiAgICAgICAgICAgIG9kby5lYWNoKGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgIHZhciBjb3VudE51bWJlciA9ICQodGhpcykuYXR0cihcImRhdGEtY291bnRcIik7XG4gICAgICAgICAgICAgICAgJCh0aGlzKS5odG1sKGNvdW50TnVtYmVyKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgd2luZG93Lm9kb21ldGVyT3B0aW9ucyA9IHtcbiAgICAgICAgICAgICAgICBmb3JtYXQ6ICdkJyxcbiAgICAgICAgICAgIH07XG4gICAgICAgIH0pO1xuXG5cbiAgICAgICAgLy8gQWx0ZXJuYXRlIEhvdmVyL0FjdGl2ZVxuICAgICAgICAkKCcud3B0Yi1pbWFnZS1ib3gxLCAud3B0Yi1pbWFnZS1ib3gyLCAud3B0Yi1ibG9nLWdyaWQxLCAud3B0Yi1wYWNrYWdlczEsIC53cHRiLWljb24tYm94MicpLm9uKFwibW91c2VlbnRlclwiLCBmdW5jdGlvbigpeyAgICAgXG4gICAgICAgICAgICAkKCcud3B0Yi1pbWFnZS1ib3gxLCAud3B0Yi1pbWFnZS1ib3gyLCAud3B0Yi1ibG9nLWdyaWQxLCAud3B0Yi1wYWNrYWdlczEsIC53cHRiLWljb24tYm94MicpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTsgICAgXG4gICAgICAgIH0pLm9uKCdtb3VzZWxlYXZlJywgIGZ1bmN0aW9uKCl7IFxuICAgICAgICAgICAgJCgnLndwdGItaW1hZ2UtYm94MS5oaWdobGlnaHQsIC53cHRiLWltYWdlLWJveDIuaGlnaGxpZ2h0LCAud3B0Yi1ibG9nLWdyaWQxLmhpZ2hsaWdodCwgLndwdGItcGFja2FnZXMxLmhpZ2hsaWdodCwgLndwdGItaWNvbi1ib3gyLmhpZ2hsaWdodCcpLmFkZENsYXNzKCdhY3RpdmUnKTsgICAgIFxuICAgICAgICB9KTtcblxuICAgICAgICAvLyBhY2NvcmRpb25cbiAgICAgICAgJChcIi53cHRiLWFjY29yZGlvblwiKS5vbihcImNsaWNrXCIsXCIud3B0Yi1pdGVtLXRpdGxlXCIsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICQodGhpcykubmV4dCgpLnNsaWRlRG93bigpO1xuICAgICAgICAgICAgJChcIi53cHRiLWl0ZW0tLWNvbnRlbnRcIikubm90KCQodGhpcykubmV4dCgpKS5zbGlkZVVwKCk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgICQoXCIud3B0Yi1hY2NvcmRpb25cIikub24oXCJjbGlja1wiLFwiLndwdGItLWl0ZW1cIiwgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJCh0aGlzKS5hZGRDbGFzcyhcImFjdGl2ZVwiKS5zaWJsaW5ncygpLnJlbW92ZUNsYXNzKFwiYWN0aXZlXCIpO1xuICAgICAgICB9KTtcblxuXG4gICAgICAgIC8vIFJhZGlhbCBQcm9ncmVzc2JhclxuICAgICAgICBmdW5jdGlvbiByYWRpYWxfYW5pbWF0ZSgpIHsgXG4gICAgICAgICAgICAkKCdzdmcucmFkaWFsLXByb2dyZXNzJykuZWFjaChmdW5jdGlvbiggaW5kZXgsIHZhbHVlICkgeyBcbiAgXG4gICAgICAgICAgICAgICAgJCh0aGlzKS5maW5kKCQoJ2NpcmNsZS5iYXItLWFuaW1hdGVkJykpLnJlbW92ZUF0dHIoICdzdHlsZScgKTsgICAgXG4gICAgICAgICAgICAgICAgLy8gR2V0IGVsZW1lbnQgaW4gVmVpdyBwb3J0XG4gICAgICAgICAgICAgICAgdmFyIGVsZW1lbnRUb3AgPSAkKHRoaXMpLm9mZnNldCgpLnRvcDtcbiAgICAgICAgICAgICAgICB2YXIgZWxlbWVudEJvdHRvbSA9IGVsZW1lbnRUb3AgKyAkKHRoaXMpLm91dGVySGVpZ2h0KCk7XG4gICAgICAgICAgICAgICAgdmFyIHZpZXdwb3J0VG9wID0gJCh3aW5kb3cpLnNjcm9sbFRvcCgpO1xuICAgICAgICAgICAgICAgIHZhciB2aWV3cG9ydEJvdHRvbSA9IHZpZXdwb3J0VG9wICsgJCh3aW5kb3cpLmhlaWdodCgpO1xuICAgICAgICAgICAgICAgIFxuICAgICAgICAgICAgICAgIGlmKGVsZW1lbnRCb3R0b20gPiB2aWV3cG9ydFRvcCAmJiBlbGVtZW50VG9wIDwgdmlld3BvcnRCb3R0b20pIHtcbiAgICAgICAgICAgICAgICAgICAgdmFyIHBlcmNlbnQgPSAkKHZhbHVlKS5kYXRhKCdjb3VudGVydmFsdWUnKTtcbiAgICAgICAgICAgICAgICAgICAgdmFyIHJhZGl1cyA9ICQodGhpcykuZmluZCgkKCdjaXJjbGUuYmFyLS1hbmltYXRlZCcpKS5hdHRyKCdyJyk7XG4gICAgICAgICAgICAgICAgICAgIHZhciBjaXJjdW1mZXJlbmNlID0gMiAqIE1hdGguUEkgKiByYWRpdXM7XG4gICAgICAgICAgICAgICAgICAgIHZhciBzdHJva2VEYXNoT2Zmc2V0ID0gY2lyY3VtZmVyZW5jZSAtICgocGVyY2VudCAqIGNpcmN1bWZlcmVuY2UpIC8gMTAwKTtcbiAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS5maW5kKCQoJ2NpcmNsZS5iYXItLWFuaW1hdGVkJykpLmFuaW1hdGUoeydzdHJva2UtZGFzaG9mZnNldCc6IHN0cm9rZURhc2hPZmZzZXR9LCAyODAwKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgICAgICAvLyBUbyBjaGVjayBJZiBpdCBpcyBpbiBWaWV3cG9ydCBcbiAgICAgICAgdmFyICR3aW5kb3cgPSAkKHdpbmRvdyk7XG4gICAgICAgIGZ1bmN0aW9uIGNoZWNrX2lmX2luX3ZpZXcoKSB7ICAgIFxuICAgICAgICAgICAgJCgnLmNvdW50ZXJ2YWx1ZScpLmVhY2goZnVuY3Rpb24oKXtcbiAgICAgICAgICAgICAgICBpZiAoJCh0aGlzKS5oYXNDbGFzcygnc3RhcnQnKSl7XG4gICAgICAgICAgICAgICAgICAgIHZhciBlbGVtZW50VG9wID0gJCh0aGlzKS5vZmZzZXQoKS50b3A7XG4gICAgICAgICAgICAgICAgICAgIHZhciBlbGVtZW50Qm90dG9tID0gZWxlbWVudFRvcCArICQodGhpcykub3V0ZXJIZWlnaHQoKTtcblxuICAgICAgICAgICAgICAgICAgICB2YXIgdmlld3BvcnRUb3AgPSAkKHdpbmRvdykuc2Nyb2xsVG9wKCk7XG4gICAgICAgICAgICAgICAgICAgIHZhciB2aWV3cG9ydEJvdHRvbSA9IHZpZXdwb3J0VG9wICsgJCh3aW5kb3cpLmhlaWdodCgpO1xuXG4gICAgICAgICAgICAgICAgICAgIGlmIChlbGVtZW50Qm90dG9tID4gdmlld3BvcnRUb3AgJiYgZWxlbWVudFRvcCA8IHZpZXdwb3J0Qm90dG9tKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAkKHRoaXMpLnJlbW92ZUNsYXNzKCdzdGFydCcpO1xuICAgICAgICAgICAgICAgICAgICAgICAgJCgnLmNvdW50ZXJ2YWx1ZScpLnRleHQoKTtcbiAgICAgICAgICAgICAgICAgICAgICAgIHZhciBteU51bWJlcnMgPSAkKHRoaXMpLnRleHQoKTtcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmIChteU51bWJlcnMgPT0gTWF0aC5mbG9vcihteU51bWJlcnMpKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS5hbmltYXRlKHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgQ291bnRlcjogJCh0aGlzKS50ZXh0KClcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9LCB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGR1cmF0aW9uOiAyODAwLFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBlYXNpbmc6ICdzd2luZycsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHN0ZXA6IGZ1bmN0aW9uKG5vdykge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS50ZXh0KE1hdGguY2VpbChub3cpICArICclJyk7ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAkKHRoaXMpLmFuaW1hdGUoe1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBDb3VudGVyOiAkKHRoaXMpLnRleHQoKVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0sIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZHVyYXRpb246IDI4MDAsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGVhc2luZzogJ3N3aW5nJyxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgc3RlcDogZnVuY3Rpb24obm93KSB7ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICQodGhpcykudGV4dChub3cudG9GaXhlZCgyKSAgKyAnJCcpOyBcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgICAgICAgICByYWRpYWxfYW5pbWF0ZSgpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cbiAgICAgICAgJHdpbmRvdy5vbignc2Nyb2xsJywgY2hlY2tfaWZfaW5fdmlldyk7XG5cblxuICAgICAgICAvLyBGYW5jeWJveFxuICAgICAgICAkKCdbZGF0YS1mYW5jeWJveD1cInZpZGVvXCJdJykuZmFuY3lib3goe1xuXHRcdFx0YXJyb3dzOiB0cnVlLFxuXHRcdFx0YW5pbWF0aW9uRWZmZWN0OiBbXG5cdFx0XHQvL1wiZmFsc2VcIiwgICAgICAgICAgICAtIGRpc2FibGVcblx0XHRcdC8vXCJmYWRlXCIsXG5cdFx0XHQvL1wic2xpZGVcIixcblx0XHRcdC8vXCJjaXJjdWxhclwiLFxuXHRcdFx0Ly9cInR1YmVcIixcblx0XHRcdC8vXCJ6b29tLWluLW91dFwiLFxuXHRcdFx0XCJyb3RhdGVcIlxuXHRcdFx0XSxcblx0XHRcdHRyYW5zaXRpb25FZmZlY3Q6IFtcblx0XHRcdC8vXCJmYWxzZVwiLCAgICAgICAgICAgIC0gZGlzYWJsZVxuXHRcdFx0Ly9cImZhZGVcIixcblx0XHRcdC8vXCJzbGlkZVwiLFxuXHRcdFx0XCJjaXJjdWxhclwiLFxuXHRcdFx0Ly9cInR1YmVcIixcblx0XHRcdC8vXCJ6b29tLWluLW91dFwiLFxuXHRcdFx0Ly9cInJvdGF0ZVwiXG5cdFx0XHRdLFxuXHRcdFx0YnV0dG9uczogW1xuXHRcdFx0XCJ6b29tXCIsXG5cdFx0XHQvL1wic2hhcmVcIixcblx0XHRcdC8vXCJzbGlkZVNob3dcIixcblx0XHRcdFwiZnVsbFNjcmVlblwiLFxuXHRcdFx0Ly9cImRvd25sb2FkXCIsXG5cdFx0XHQvL1widGh1bWJzXCIsXG5cdFx0XHRcImNsb3NlXCJcblx0XHRcdF0sXG5cdFx0XHRpbmZvYmFyOiBmYWxzZSxcblx0XHR9KTtcblxuICAgICAgICAvLyBZb3V0dWJlXG4gICAgICAgIHZhciAkeXR2aWRlb1RyaWdnZXIgPSAkKFwiLnl0cGxheS1idG5cIik7XG4gICAgICAgICR5dHZpZGVvVHJpZ2dlci5vbihcImNsaWNrXCIsIGZ1bmN0aW9uKGV2dCkgeyAgXG4gICAgICAgICAgICAkKFwiLnl0dWJlLXZpZGVvXCIpLmFkZENsYXNzKFwicGxheVwiKTtcbiAgICAgICAgICAgICQoXCIjeXR2aWRlb1wiKVswXS5zcmMgKz0gXCI/YXV0b3BsYXk9MVwiO1xuICAgICAgICB9KTtcblxuICAgICAgICAvLyBWZXJ0aWNhbCBBY2NvcmRpb25cbiAgICAgICAgICAkKCcud3B0Yi1jb3VudHJ5LXRhYi0tdGl0bGUnKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAkKCcud3B0Yi1jb3VudHJ5LXRhYi0taXRlbScpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcbiAgICAgICAgICAgICQodGhpcykucGFyZW50KCcud3B0Yi1jb3VudHJ5LXRhYi0taXRlbScpLmFkZENsYXNzKCdhY3RpdmUnKTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgLy8gVGltZSBDb3VudGVyXG4gICAgICAgIGZ1bmN0aW9uIG1ha2VUaW1lcigpIHtcbiAgICAgICAgICAgIHZhciBlbmRUaW1lID0gbmV3IERhdGUoXCIxNCBNYXJjaCAyMDI2XCIpOyAgICAgIFxuICAgICAgICAgICAgZW5kVGltZSA9IChEYXRlLnBhcnNlKGVuZFRpbWUpIC8gMTAwMCk7XG4gICAgXG4gICAgICAgICAgICB2YXIgbm93ID0gbmV3IERhdGUoKTtcbiAgICAgICAgICAgIG5vdyA9IChEYXRlLnBhcnNlKG5vdykgLyAxMDAwKTtcbiAgICBcbiAgICAgICAgICAgIHZhciB0aW1lTGVmdCA9IGVuZFRpbWUgLSBub3c7XG4gICAgXG4gICAgICAgICAgICB2YXIgZGF5cyA9IE1hdGguZmxvb3IodGltZUxlZnQgLyA4NjQwMCk7IFxuICAgICAgICAgICAgdmFyIGhvdXJzID0gTWF0aC5mbG9vcigodGltZUxlZnQgLSAoZGF5cyAqIDg2NDAwKSkgLyAzNjAwKTtcbiAgICAgICAgICAgIHZhciBtaW51dGVzID0gTWF0aC5mbG9vcigodGltZUxlZnQgLSAoZGF5cyAqIDg2NDAwKSAtIChob3VycyAqIDM2MDAgKSkgLyA2MCk7XG4gICAgICAgICAgICB2YXIgc2Vjb25kcyA9IE1hdGguZmxvb3IoKHRpbWVMZWZ0IC0gKGRheXMgKiA4NjQwMCkgLSAoaG91cnMgKiAzNjAwKSAtIChtaW51dGVzICogNjApKSk7XG4gICAgICAgIFxuICAgICAgICAgICAgaWYgKGhvdXJzIDwgXCIxMFwiKSB7IGhvdXJzID0gXCIwXCIgKyBob3VyczsgfVxuICAgICAgICAgICAgaWYgKG1pbnV0ZXMgPCBcIjEwXCIpIHsgbWludXRlcyA9IFwiMFwiICsgbWludXRlczsgfVxuICAgICAgICAgICAgaWYgKHNlY29uZHMgPCBcIjEwXCIpIHsgc2Vjb25kcyA9IFwiMFwiICsgc2Vjb25kczsgfVxuICAgIFxuICAgICAgICAgICAgJChcIiNkYXlzXCIpLmh0bWwoZGF5cyk7XG4gICAgICAgICAgICAkKFwiI2hvdXJzXCIpLmh0bWwoaG91cnMpO1xuICAgICAgICAgICAgJChcIiNtaW51dGVzXCIpLmh0bWwobWludXRlcyk7XG4gICAgICAgICAgICAkKFwiI3NlY29uZHNcIikuaHRtbChzZWNvbmRzKTsgICBcbiAgICAgICAgfVxuICAgICAgICBzZXRJbnRlcnZhbChmdW5jdGlvbigpIHsgbWFrZVRpbWVyKCk7IH0sIDEwMDApO1xuXG5cbiAgICAgICAgLy8gU2hvcFxuICAgICAgICAvLyBQcm9kdWN0IFpvb21cbiAgICAgICAgJCgnLnByb2R1Y3Rfem9vbV9idXR0b25fZ3JvdXAgPiBsaSA+IGEnKS5lcSgwKS5hZGRDbGFzcyggXCJzZWxlY3RlZFwiICk7XG4gICAgICAgICQoJy5wcm9kdWN0X3pvb21fY29udGFpbmVyID4gLnByb2R1Y3Rfem9vbV9pbmZvJykuZXEoMCkuY3NzKCdkaXNwbGF5JywnYmxvY2snKTtcbiAgICAgICAgJCgnLnByb2R1Y3Rfem9vbV9idXR0b25fZ3JvdXAnKS5vbihcImNsaWNrXCIsZnVuY3Rpb24oZSl7XG4gICAgICAgICAgICBpZigkKGUudGFyZ2V0KS5pcyhcImFcIikpe1xuXG4gICAgICAgICAgICAgICAgLypIYW5kbGUgVGFiIE5hdiovXG4gICAgICAgICAgICAgICAgJCgnLnByb2R1Y3Rfem9vbV9idXR0b25fZ3JvdXAgPiBsaSA+IGEnKS5yZW1vdmVDbGFzcyggXCJzZWxlY3RlZFwiKTtcbiAgICAgICAgICAgICAgICAkKGUudGFyZ2V0KS5hZGRDbGFzcyggXCJzZWxlY3RlZFwiKTtcbiAgICAgICAgICAgICAgICBcbiAgICAgICAgICAgICAgICAvKkhhbmRsZXMgVGFiIENvbnRlbnQqL1xuICAgICAgICAgICAgICAgIHZhciBjbGlja2VkX2luZGV4ID0gJChcImFcIix0aGlzKS5pbmRleChlLnRhcmdldCk7XG4gICAgICAgICAgICAgICAgJCgnLnByb2R1Y3Rfem9vbV9jb250YWluZXIgPiAucHJvZHVjdF96b29tX2luZm8nKS5jc3MoJ2Rpc3BsYXknLCdub25lJyk7XG4gICAgICAgICAgICAgICAgJCgnLnByb2R1Y3Rfem9vbV9jb250YWluZXIgPiAucHJvZHVjdF96b29tX2luZm8nKS5lcShjbGlja2VkX2luZGV4KS5mYWRlSW4oKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgICQodGhpcykuYmx1cigpO1xuICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgICAgICB9KTtcblxuICAgICAgICAvLyBIZWFkZXIgQ2FydCBvcGVuXG5cdFx0JCgnYS53cHRiLWNhcnR0LWljb24nKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xuXHRcdFx0ZS5wcmV2ZW50RGVmYXVsdCgpO1xuXHRcdFx0JCgnLndwdGItY2FydHQtYm94JykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgICAgICAgJCgnLndwdGItcGVyc29uLWJveCcpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTsgLy8gSGlkZSB0aGUgcGVyc29uIGJveCBpZiBpdCB3YXMgb3BlbmVkXG5cbiAgICAgICAgfSk7XG4gICAgICAgIC8vIEhlYWRlciBwZXJzb24gb3BlblxuICAgICAgICAkKCdhLndwdGItcGVyc29uLWljb24nKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xuICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgJCgnLndwdGItcGVyc29uLWJveCcpLnRvZ2dsZUNsYXNzKCdhY3RpdmUnKTtcbiAgICAgICAgICAgICQoJy53cHRiLWNhcnR0LWJveCcpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTsgLy8gSGlkZSB0aGUgcGVyc29uIGJveCBpZiBpdCB3YXMgb3BlbmVkXG5cbiAgICAgICAgfSk7XG5cbiAgICAgICAgLy8gRGF0ZXBpY2tyIC8gRmxhdHBpY2tlclxuICAgICAgICAkKFwiLmZsYXRwaWNrclwiKS5mbGF0cGlja3Ioe1xuICAgICAgICAgICAgbW9kZTogXCJyYW5nZVwiLFxuICAgICAgICAgICAgZGF0ZUZvcm1hdDogXCJkLU1cIixcbiAgICAgICAgICAgIG1pbkRhdGU6IFwidG9kYXlcIixcbiAgICAgICAgfSk7XG4gICAgICAgICQoXCIuZmxhdHBpY2tyLXRpbWVcIikuZmxhdHBpY2tyKHtcblx0XHRcdGVuYWJsZVRpbWU6IHRydWUsXG4gICAgICAgICAgICBub0NhbGVuZGFyOiB0cnVlLFxuICAgICAgICAgICAgZGF0ZUZvcm1hdDogJ2g6aSBLJ1xuXHRcdH0pO1xuXG4gICAgICAgIC8vIE5pY2UgU2VsZWN0XG4gICAgICAgICQoJ3NlbGVjdCcpLm5pY2VTZWxlY3QoKTtcblxuICAgICAgICAvLyBUb3RvcCBCdXR0b25cbiAgICAgICAgJCgnLnRvdG9wIGEnKS5vbignY2xpY2snLCBmdW5jdGlvbihlKSB7XG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICAkKCdodG1sLCBib2R5JykuYW5pbWF0ZSh7c2Nyb2xsVG9wOiAwfSwgJzMwMCcpO1xuICAgICAgICB9KTtcblxuICAgICAgICAvLyBEYXktTmlnaHQgTW9kZSBTd2l0Y2hlclxuICAgICAgICB2YXIgaWNvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwibW9kZV9zd2l0Y2hlclwiKTtcblxuICAgICAgICAvLyBpZiAobG9jYWxTdG9yYWdlLmdldEl0ZW0oXCJ0aGVtZVwiKSA9PT0gXCJudWxsXCIpe1xuICAgICAgICAvLyAgICAgbG9jYWxTdG9yYWdlLnNldEl0ZW0oXCJ0aGVtZVwiLCBcImxpZ2h0XCIpO1xuICAgICAgICAvLyB9XG5cbiAgICAgICAgLy8gbGV0IGxvY2FsRGF0YSA9IGxvY2FsU3RvcmFnZS5nZXRJdGVtKFwidGhlbWVcIik7XG5cbiAgICAgICAgLy8gaWYgKGxvY2FsRGF0YSA9PT0gXCJsaWdodFwiKSB7XG4gICAgICAgIC8vICAgICBpY29uLmlubmVySFRNTCA9ICc8c3Bhbj48aSBjbGFzcz1cImJpIGJpLW1vb24tZmlsbFwiPjwvaT48L3NwYW4+JztcbiAgICAgICAgLy8gICAgIGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LnJlbW92ZShcInRoZW1lLXN0eWxlLS1saWdodFwiKTtcbiAgICAgICAgLy8gfSBlbHNlIGlmIChsb2NhbERhdGEgPT09IFwiZGFya1wiKXtcbiAgICAgICAgLy8gICAgIGljb24uaW5uZXJIVE1MID0gJzxzcGFuPjxpIGNsYXNzPVwiYmkgYmktc3VuLWZpbGxcIj48L2k+PC9zcGFuPic7XG4gICAgICAgIC8vICAgICBkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC5hZGQoXCJ0aGVtZS1zdHlsZS0tbGlnaHRcIik7XG4gICAgICAgIC8vIH1cblxuICAgICAgICBpY29uLm9uY2xpY2sgPSBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LnRvZ2dsZShcInRoZW1lLXN0eWxlLS1saWdodFwiKTtcbiAgICAgICAgICAgIGlmIChkb2N1bWVudC5ib2R5LmNsYXNzTGlzdC5jb250YWlucyhcInRoZW1lLXN0eWxlLS1saWdodFwiKSl7XG4gICAgICAgICAgICAgICAgaWNvbi5pbm5lckhUTUwgPSAnPHNwYW4+PGkgY2xhc3M9XCJiaSBiaS1zdW4tZmlsbFwiPjwvaT48L3NwYW4+JztcbiAgICAgICAgICAgICAgICBsb2NhbFN0b3JhZ2Uuc2V0SXRlbShcInRoZW1lXCIsIFwiZGFya1wiKTtcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgaWNvbi5pbm5lckhUTUwgPSAnPHNwYW4+PGkgY2xhc3M9XCJiaSBiaS1tb29uLWZpbGxcIj48L2k+PC9zcGFuPic7XG4gICAgICAgICAgICAgICAgbG9jYWxTdG9yYWdlLnNldEl0ZW0oXCJ0aGVtZVwiLCBcImxpZ2h0XCIpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9XG5cbiAgICB9KTsgICAgICBcbn0pKGpRdWVyeSk7XG5cbi8vIEhpZGUgaGVhZGVyIG9uIHNjcm9sbCBkb3duXG5jb25zdCBuYXYgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiLmhlYWRlclwiKTtcbmNvbnN0IHNjcm9sbFVwID0gXCJ0b3AtdXBcIjtcbmxldCBsYXN0U2Nyb2xsID0gODAwO1xuXG53aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcihcInNjcm9sbFwiLCAoKSA9PiB7XG4gICAgY29uc3QgY3VycmVudFNjcm9sbCA9IHdpbmRvdy5wYWdlWU9mZnNldDtcbiAgICBpZiAoY3VycmVudFNjcm9sbCA8PSA4MDApIHtcbiAgICAgICAgbmF2LmNsYXNzTGlzdC5yZW1vdmUoc2Nyb2xsVXApO1xuICAgICAgICAkKCcudG90b3AnKS5yZW1vdmVDbGFzcygnc2hvdycpO1xuICAgICAgICByZXR1cm47XG4gICAgfVxuICAgIFxuICAgIGlmIChjdXJyZW50U2Nyb2xsID4gbGFzdFNjcm9sbCkge1xuICAgICAgICAvLyBkb3duXG4gICAgICAgIG5hdi5jbGFzc0xpc3QuYWRkKHNjcm9sbFVwKTtcbiAgICAgICAgJCgnLnRvdG9wJykuYWRkQ2xhc3MoJ3Nob3cnKTtcbiAgICB9IGVsc2UgaWYgKGN1cnJlbnRTY3JvbGwgPCBsYXN0U2Nyb2xsKSB7XG4gICAgICAgIC8vIHVwXG4gICAgICAgIG5hdi5jbGFzc0xpc3QucmVtb3ZlKHNjcm9sbFVwKTtcbiAgICAgICAgJCgnLnRvdG9wJykucmVtb3ZlQ2xhc3MoJ3Nob3cnKTtcbiAgICB9XG4gICAgbGFzdFNjcm9sbCA9IGN1cnJlbnRTY3JvbGw7XG59KTtcblxuXG4iXSwibmFtZXMiOlsiJCIsIndpbmRvdyIsImpRdWVyeSIsIkNoYXJ0Iiwiem9vbVBsdWdpbiIsInJlZ2lzdGVyIiwiZG9tQ29udGVudExvYWRlZENhbGxiYWNrcyIsIm9uRE9NQ29udGVudExvYWRlZCIsImNhbGxiYWNrIiwiZG9jdW1lbnQiLCJyZWFkeVN0YXRlIiwibGVuZ3RoIiwiYWRkRXZlbnRMaXN0ZW5lciIsIl9pIiwiX2RvbUNvbnRlbnRMb2FkZWRDYWxsIiwicHVzaCIsInNsaWRlVXAiLCJ0YXJnZXQiLCJkdXJhdGlvbiIsImFyZ3VtZW50cyIsInVuZGVmaW5lZCIsInN0eWxlIiwidHJhbnNpdGlvblByb3BlcnR5IiwidHJhbnNpdGlvbkR1cmF0aW9uIiwiY29uY2F0IiwiYm94U2l6aW5nIiwiaGVpZ2h0Iiwib2Zmc2V0SGVpZ2h0Iiwib3ZlcmZsb3ciLCJzZXRUaW1lb3V0IiwicGFkZGluZ1RvcCIsInBhZGRpbmdCb3R0b20iLCJtYXJnaW5Ub3AiLCJtYXJnaW5Cb3R0b20iLCJkaXNwbGF5IiwicmVtb3ZlUHJvcGVydHkiLCJzbGlkZURvd24iLCJfd2luZG93JGdldENvbXB1dGVkU3QiLCJnZXRDb21wdXRlZFN0eWxlIiwiQ0xBU1NfTkFNRV9IT0xEX1RSQU5TSVRJT05TIiwiQ0xBU1NfTkFNRV9BUFBfTE9BREVEIiwiTGF5b3V0IiwiZWxlbWVudCIsIl9jbGFzc0NhbGxDaGVjayIsIl9lbGVtZW50IiwiaG9sZFRyYW5zaXRpb24iLCJyZXNpemVUaW1lciIsImJvZHkiLCJjbGFzc0xpc3QiLCJhZGQiLCJjbGVhclRpbWVvdXQiLCJyZW1vdmUiLCJkYXRhIiwiREFUQV9LRVkkNCIsIkVWRU5UX0tFWSQ0IiwiRVZFTlRfT1BFTiIsIkVWRU5UX0NPTExBUFNFIiwiQ0xBU1NfTkFNRV9TSURFQkFSX01JTkkiLCJDTEFTU19OQU1FX1NJREVCQVJfQ09MTEFQU0UiLCJDTEFTU19OQU1FX1NJREVCQVJfT1BFTiIsIkNMQVNTX05BTUVfU0lERUJBUl9FWFBBTkQiLCJDTEFTU19OQU1FX1NJREVCQVJfT1ZFUkxBWSIsIkNMQVNTX05BTUVfTUVOVV9PUEVOJDEiLCJTRUxFQ1RPUl9BUFBfU0lERUJBUiIsIlNFTEVDVE9SX1NJREVCQVJfTUVOVSIsIlNFTEVDVE9SX05BVl9JVEVNJDEiLCJTRUxFQ1RPUl9OQVZfVFJFRVZJRVciLCJTRUxFQ1RPUl9BUFBfV1JBUFBFUiIsIlNFTEVDVE9SX1NJREVCQVJfRVhQQU5EIiwiU0VMRUNUT1JfU0lERUJBUl9UT0dHTEUiLCJEZWZhdWx0cyIsInNpZGViYXJCcmVha3BvaW50IiwiUHVzaE1lbnUiLCJjb25maWciLCJfY29uZmlnIiwiT2JqZWN0IiwiYXNzaWduIiwibWVudXNDbG9zZSIsIm5hdlRyZWV2aWV3IiwicXVlcnlTZWxlY3RvckFsbCIsImZvckVhY2giLCJuYXZUcmVlIiwibmF2U2lkZWJhciIsInF1ZXJ5U2VsZWN0b3IiLCJuYXZJdGVtIiwibmF2SSIsImV4cGFuZCIsImV2ZW50IiwiRXZlbnQiLCJkaXNwYXRjaEV2ZW50IiwiY29sbGFwc2UiLCJhZGRTaWRlYmFyQnJlYWtQb2ludCIsInNpZGViYXJFeHBhbmRMaXN0IiwiX2IiLCJfYSIsInNpZGViYXJFeHBhbmQiLCJfYyIsIkFycmF5IiwiZnJvbSIsImZpbmQiLCJjbGFzc05hbWUiLCJzdGFydHNXaXRoIiwic2lkZWJhciIsImdldEVsZW1lbnRzQnlDbGFzc05hbWUiLCJzaWRlYmFyQ29udGVudCIsImdldFByb3BlcnR5VmFsdWUiLCJOdW1iZXIiLCJyZXBsYWNlIiwiaW5uZXJXaWR0aCIsImNvbnRhaW5zIiwidG9nZ2xlIiwiaW5pdCIsInNpZGViYXJPdmVybGF5IiwiY3JlYXRlRWxlbWVudCIsImFwcGVuZCIsInByZXZlbnREZWZhdWx0IiwiY3VycmVudFRhcmdldCIsInBhc3NpdmUiLCJmdWxsQnRuIiwiYnRuIiwiYnV0dG9uIiwiZGF0YXNldCIsImx0ZVRvZ2dsZSIsImNsb3Nlc3QiLCJEQVRBX0tFWSQzIiwiRVZFTlRfS0VZJDMiLCJFVkVOVF9FWFBBTkRFRCQyIiwiRVZFTlRfQ09MTEFQU0VEJDIiLCJDTEFTU19OQU1FX01FTlVfT1BFTiIsIlNFTEVDVE9SX05BVl9JVEVNIiwiU0VMRUNUT1JfTkFWX0xJTksiLCJTRUxFQ1RPUl9UUkVFVklFV19NRU5VIiwiU0VMRUNUT1JfREFUQV9UT0dHTEUkMSIsIkRlZmF1bHQkMSIsImFuaW1hdGlvblNwZWVkIiwiYWNjb3JkaW9uIiwiVHJlZXZpZXciLCJvcGVuIiwiX3RoaXMiLCJvcGVuTWVudUxpc3QiLCJwYXJlbnRFbGVtZW50Iiwib3Blbk1lbnUiLCJjaGlsZEVsZW1lbnQiLCJjbG9zZSIsInRhcmdldEl0ZW0iLCJ0YXJnZXRMaW5rIiwiZ2V0QXR0cmlidXRlIiwiREFUQV9LRVkkMiIsIkVWRU5UX0tFWSQyIiwiRVZFTlRfRVhQQU5ERUQkMSIsIkVWRU5UX0NPTExBUFNFRCQxIiwiU0VMRUNUT1JfREFUQV9UT0dHTEUiLCJTRUxFQ1RPUl9ESVJFQ1RfQ0hBVCIsIkNMQVNTX05BTUVfRElSRUNUX0NIQVRfT1BFTiIsIkRpcmVjdENoYXQiLCJjaGF0UGFuZSIsIkRBVEFfS0VZJDEiLCJFVkVOVF9LRVkkMSIsIkVWRU5UX0NPTExBUFNFRCIsIkVWRU5UX0VYUEFOREVEIiwiRVZFTlRfUkVNT1ZFIiwiRVZFTlRfTUFYSU1JWkVEJDEiLCJFVkVOVF9NSU5JTUlaRUQkMSIsIkNMQVNTX05BTUVfQ0FSRCIsIkNMQVNTX05BTUVfQ09MTEFQU0VEIiwiQ0xBU1NfTkFNRV9DT0xMQVBTSU5HIiwiQ0xBU1NfTkFNRV9FWFBBTkRJTkciLCJDTEFTU19OQU1FX1dBU19DT0xMQVBTRUQiLCJDTEFTU19OQU1FX01BWElNSVpFRCIsIlNFTEVDVE9SX0RBVEFfUkVNT1ZFIiwiU0VMRUNUT1JfREFUQV9DT0xMQVBTRSIsIlNFTEVDVE9SX0RBVEFfTUFYSU1JWkUiLCJTRUxFQ1RPUl9DQVJEIiwiU0VMRUNUT1JfQ0FSRF9CT0RZIiwiU0VMRUNUT1JfQ0FSRF9GT09URVIiLCJEZWZhdWx0IiwiY29sbGFwc2VUcmlnZ2VyIiwicmVtb3ZlVHJpZ2dlciIsIm1heGltaXplVHJpZ2dlciIsIkNhcmRXaWRnZXQiLCJfcGFyZW50IiwiX3RoaXMyIiwiZWxtIiwiZWwiLCJIVE1MRWxlbWVudCIsIl90aGlzMyIsIm1heGltaXplIiwiX3RoaXM0Iiwid2lkdGgiLCJvZmZzZXRXaWR0aCIsInRyYW5zaXRpb24iLCJodG1sVGFnIiwibWluaW1pemUiLCJfdGhpczUiLCJ0b2dnbGVNYXhpbWl6ZSIsImNvbGxhcHNlQnRuIiwicmVtb3ZlQnRuIiwibWF4QnRuIiwiREFUQV9LRVkiLCJFVkVOVF9LRVkiLCJFVkVOVF9NQVhJTUlaRUQiLCJFVkVOVF9NSU5JTUlaRUQiLCJTRUxFQ1RPUl9GVUxMU0NSRUVOX1RPR0dMRSIsIlNFTEVDVE9SX01BWElNSVpFX0lDT04iLCJTRUxFQ1RPUl9NSU5JTUlaRV9JQ09OIiwiRnVsbFNjcmVlbiIsImluRnVsbFNjcmVlbiIsImljb25NYXhpbWl6ZSIsImljb25NaW5pbWl6ZSIsImRvY3VtZW50RWxlbWVudCIsInJlcXVlc3RGdWxsc2NyZWVuIiwib3V0RnVsbHNjcmVlbiIsImV4aXRGdWxsc2NyZWVuIiwidG9nZ2xlRnVsbFNjcmVlbiIsImZ1bGxzY3JlZW5FbmFibGVkIiwiZnVsbHNjcmVlbkVsZW1lbnQiLCJidXR0b25zIiwicmVhZHkiLCJtYXBQcm9wIiwiY2VudGVyIiwiZ29vZ2xlIiwibWFwcyIsIkxhdExuZyIsInpvb20iLCJzdHlsZXMiLCJtYXAiLCJNYXAiLCJnZXRFbGVtZW50QnlJZCIsImUiLCJkIiwidCIsIm0iLCJ5IiwiY2hlY2tlZCIsImFkZENsYXNzIiwiZHluYW1pY0N1cnJlbnRNZW51Q2xhc3MiLCJzZWxlY3RvciIsIkZpbGVOYW1lIiwibG9jYXRpb24iLCJocmVmIiwic3BsaXQiLCJyZXZlcnNlIiwiZWFjaCIsImFuY2hvciIsImF0dHIiLCJjaGlsZHJlbiIsImVxIiwibW9iaWxlTG9nb0NvbnRlbnQiLCJodG1sIiwibW9iaWxlTWVudUNvbnRlbnQiLCJvbiIsInBhcmVudCIsInRvZ2dsZUNsYXNzIiwic2libGluZ3MiLCJzbGlkZVRvZ2dsZSIsInN0b3BQcm9wYWdhdGlvbiIsInJlbW92ZUNsYXNzIiwiaGVhZGVyIiwic2Nyb2xsIiwic2Nyb2xsVG9wIiwiV09XIiwiU3dpcGVyU2xpZGVyIiwiU3dpcGVyIiwibG9vcCIsImF1dG9IZWlnaHQiLCJzcGVlZCIsInNsaWRlc1BlclZpZXciLCJzcGFjZUJldHdlZW4iLCJwYWdpbmF0aW9uIiwiY2xpY2thYmxlIiwiU3dpcGVyU2xpZGVyMiIsInJlbmRlckJ1bGxldCIsImluZGV4IiwiU3dpcGVySW1hZ2Vib3giLCJhdXRvcGxheSIsImRlbGF5IiwiYnJlYWtwb2ludHMiLCJTd2lwZXJUZXN0aW1vbmlhbCIsIlN3aXBlclRlc3RpbW9uaWFsVHdvIiwiU3dpcGVyQ2xpZW50cyIsIlN3aXBlckJsb2ciLCJTd2lwZXJJbm5lcnBhZ2VzIiwiYXBwZWFyIiwib2RvIiwiY291bnROdW1iZXIiLCJvZG9tZXRlck9wdGlvbnMiLCJmb3JtYXQiLCJuZXh0Iiwibm90IiwicmFkaWFsX2FuaW1hdGUiLCJ2YWx1ZSIsInJlbW92ZUF0dHIiLCJlbGVtZW50VG9wIiwib2Zmc2V0IiwidG9wIiwiZWxlbWVudEJvdHRvbSIsIm91dGVySGVpZ2h0Iiwidmlld3BvcnRUb3AiLCJ2aWV3cG9ydEJvdHRvbSIsInBlcmNlbnQiLCJyYWRpdXMiLCJjaXJjdW1mZXJlbmNlIiwiTWF0aCIsIlBJIiwic3Ryb2tlRGFzaE9mZnNldCIsImFuaW1hdGUiLCIkd2luZG93IiwiY2hlY2tfaWZfaW5fdmlldyIsImhhc0NsYXNzIiwidGV4dCIsIm15TnVtYmVycyIsImZsb29yIiwiQ291bnRlciIsImVhc2luZyIsInN0ZXAiLCJub3ciLCJjZWlsIiwidG9GaXhlZCIsImZhbmN5Ym94IiwiYXJyb3dzIiwiYW5pbWF0aW9uRWZmZWN0IiwidHJhbnNpdGlvbkVmZmVjdCIsImluZm9iYXIiLCIkeXR2aWRlb1RyaWdnZXIiLCJldnQiLCJzcmMiLCJtYWtlVGltZXIiLCJlbmRUaW1lIiwiRGF0ZSIsInBhcnNlIiwidGltZUxlZnQiLCJkYXlzIiwiaG91cnMiLCJtaW51dGVzIiwic2Vjb25kcyIsInNldEludGVydmFsIiwiY3NzIiwiaXMiLCJjbGlja2VkX2luZGV4IiwiZmFkZUluIiwiYmx1ciIsImZsYXRwaWNrciIsIm1vZGUiLCJkYXRlRm9ybWF0IiwibWluRGF0ZSIsImVuYWJsZVRpbWUiLCJub0NhbGVuZGFyIiwibmljZVNlbGVjdCIsImljb24iLCJvbmNsaWNrIiwiaW5uZXJIVE1MIiwibG9jYWxTdG9yYWdlIiwic2V0SXRlbSIsIm5hdiIsInNjcm9sbFVwIiwibGFzdFNjcm9sbCIsImN1cnJlbnRTY3JvbGwiLCJwYWdlWU9mZnNldCJdLCJzb3VyY2VSb290IjoiIn0=