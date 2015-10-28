/*!
 * jquery-confirm v1.7.9 (http://craftpip.github.io/jquery-confirm/)
 * Author: Boniface Pereira
 * Website: www.craftpip.com
 * Contact: hey@craftpip.com
 *
 * Copyright 2013-2015 jquery-confirm
 * Licensed under MIT (https://github.com/craftpip/jquery-confirm/blob/master/LICENSE)
 */
if (typeof jQuery === "undefined") {
    throw new Error("jquery-confirm requires jQuery");
}
var jconfirm, Jconfirm;
(function($) {
    $.confirm = function(options) {
        return jconfirm(options);
    };
    $.alert = function(options) {
        options.cancelButton = false;
        return jconfirm(options);
    };
    $.dialog = function(options) {
        options.cancelButton = false;
        options.confirmButton = false;
        options.confirmKeys = [13];
        return jconfirm(options);
    };
    jconfirm = function(options) {
        if (jconfirm.defaults) {
            $.extend(jconfirm.pluginDefaults, jconfirm.defaults);
        }
        var options = $.extend({}, jconfirm.pluginDefaults, options);
        return new Jconfirm(options);
    };
    Jconfirm = function(options) {
        $.extend(this, options);
        this._init();
    };
    Jconfirm.prototype = {
        _init: function() {
            var that = this;
            this._rand = Math.round(Math.random() * 99999);
            this._buildHTML();
            this._bindEvents();
            setTimeout(function() {
                that.open();
            }, 0);
        },
        animations: ["anim-scale", "anim-top", "anim-bottom", "anim-left", "anim-right", "anim-zoom", "anim-opacity", "anim-none", "anim-rotate", "anim-rotatex", "anim-rotatey", "anim-scalex", "anim-scaley"],
        _buildHTML: function() {
            var that = this;
            this.animation = "anim-" + this.animation.toLowerCase();
            if (this.animation === "none") {
                this.animationSpeed = 0;
            }
            this.$el = $(this.template).appendTo(this.container).addClass(this.theme);
            this.$el.find(".jconfirm-box-container").addClass(this.columnClass);
            this.CSS = {
                "-webkit-transition-duration": this.animationSpeed / 1000 + "s",
                "transition-duration": this.animationSpeed / 1000 + "s",
                "-webkjit-transition-timing-function": "cubic-bezier(0.27, 1.12, 0.32, " + this.animationBounce + ")",
                "transition-timing-function": "cubic-bezier(0.27, 1.12, 0.32, " + this.animationBounce + ")"
            };
            this.$el.find(".jconfirm-bg").css(this.CSS);
            this.$b = this.$el.find(".jconfirm-box").css(this.CSS).addClass(this.animation);
            if (this.rtl) {
                this.$el.addClass("rtl");
            }
            this.setTitle();
            this.contentDiv = this.$el.find("div.content");
            this.$btnc = this.$el.find(".buttons");
            if (this.confirmButton && this.confirmButton.trim() !== "") {
                this.$confirmButton = $('<button class="btn">' + this.confirmButton + "</button>").appendTo(this.$btnc).addClass(this.confirmButtonClass);
            }
            if (this.cancelButton && this.cancelButton.trim() !== "") {
                this.$cancelButton = $('<button class="btn">' + this.cancelButton + "</button>").appendTo(this.$btnc).addClass(this.cancelButtonClass);
            }
            if (!this.confirmButton && !this.cancelButton) {
                this.$btnc.remove();
            }
            if (!this.confirmButton && !this.cancelButton && this.closeIcon == null) {
                this.$closeButton = this.$b.find(".closeIcon").show();
            }
            if (this.closeIcon === true) {
                this.$closeButton = this.$b.find(".closeIcon").show();
            }
            this.setContent();
            if (this.autoClose) {
                this._startCountDown();
            }
        },
        setTitle: function(string) {
            this.title = (typeof string !== "undefined") ? string : this.title;
            if (this.title) {
                this.$el.find("div.title").html('<i class="' + this.icon + '"></i> ' + this.title);
            } else {
                this.$el.find("div.title").remove();
            }
        },
        setContent: function(string) {
            var that = this;
            this.content = (string) ? string : this.content;
            var animate = (string) ? true : false;
            if (typeof this.content === "boolean") {
                if (!this.content) {
                    this.contentDiv.remove();
                } else {
                    console.error("Invalid option for property content: passed TRUE");
                }
            } else {
                if (typeof this.content === "string") {
                    if (this.content.substr(0, 4).toLowerCase() === "url:") {
                        this.contentDiv.html("");
                        this.$btnc.find("button").prop("disabled", true);
                        var url = this.content.substring(4, this.content.length);
                        $.get(url).done(function(html) {
                            that.contentDiv.html(html);
                        }).always(function(data, status, xhr) {
                            if (typeof that.contentLoaded === "function") {
                                that.contentLoaded(data, status, xhr);
                            }
                            that.$btnc.find("button").prop("disabled", false);
                            that.setDialogCenter();
                        });
                    } else {
                        this.contentDiv.html(this.content);
                    }
                } else {
                    if (typeof this.content === "function") {
                        this.contentDiv.html("");
                        this.$btnc.find("button").attr("disabled", "disabled");
                        var promise = this.content(this);
                        if (typeof promise !== "object") {
                            console.error("The content function must return jquery promise.");
                        } else {
                            if (typeof promise.always !== "function") {
                                console.error("The object returned is not a jquery promise.");
                            } else {
                                promise.always(function(data, status) {
                                    that.$btnc.find("button").removeAttr("disabled");
                                    that.setDialogCenter();
                                });
                            }
                        }
                    } else {
                        console.error("Invalid option for property content, passed: " + typeof this.content);
                    }
                }
            }
            this.setDialogCenter(animate);
        },
        _startCountDown: function() {
            var opt = this.autoClose.split("|");
            if (/cancel/.test(opt[0]) && this.type === "alert") {
                return false;
            } else {
                if (/confirm|cancel/.test(opt[0])) {
                    this.$cd = $('<span class="countdown">').appendTo(this["$" + opt[0] + "Button"]);
                    var that = this;
                    that.$cd.parent().click();
                    var time = opt[1] / 1000;
                    this.interval = setInterval(function() {
                        that.$cd.html(" [" + (time -= 1) + "]");
                        if (time === 0) {
                            that.$cd.parent().trigger("click");
                            clearInterval(that.interval);
                        }
                    }, 1000);
                } else {
                    console.error("Invalid option " + opt[0] + ", must be confirm/cancel");
                }
            }
        },
        _bindEvents: function() {
            var that = this;
            var boxClicked = false;
            this.$el.find(".jconfirm-scrollpane").click(function(e) {
                if (!boxClicked) {
                    if (that.backgroundDismiss) {
                        that.cancel();
                        that.close();
                    } else {
                        that.$b.addClass("hilight");
                        setTimeout(function() {
                            that.$b.removeClass("hilight");
                        }, 400);
                    }
                }
                boxClicked = false;
            });
            this.$el.find(".jconfirm-box").click(function(e) {
                boxClicked = true;
            });
            if (this.$confirmButton) {
                this.$confirmButton.click(function(e) {
                    e.preventDefault();
                    var r = that.confirm(that.$b);
                    that.onAction();
                    if (typeof r === "undefined" || r) {
                        that.close();
                    }
                });
            }
            if (this.$cancelButton) {
                this.$cancelButton.click(function(e) {
                    e.preventDefault();
                    var r = that.cancel(that.$b);
                    that.onAction();
                    if (typeof r === "undefined" || r) {
                        that.close();
                    }
                });
            }
            if (this.$closeButton) {
                this.$closeButton.click(function(e) {
                    e.preventDefault();
                    that.cancel();
                    that.onAction();
                    that.close();
                });
            }
            if (this.keyboardEnabled) {
                setTimeout(function() {
                    $(window).on("keyup." + this._rand, function(e) {
                        that.reactOnKey(e);
                    });
                }, 500);
            }
            $(window).on("resize." + this._rand, function() {
                that.setDialogCenter(true);
            });
        },
        reactOnKey: function key(e) {
            var a = $(".jconfirm");
            if (a.eq(a.length - 1)[0] !== this.$el[0]) {
                return false;
            }
            var key = e.which;
            if (this.$b.find(":input").is(":focus") && /13|32/.test(key)) {
                return false;
            }
            if ($.inArray(key, this.cancelKeys) !== -1) {
                if (!this.backgroundDismiss) {
                    this.$el.find(".jconfirm-bg").click();
                    return false;
                }
                if (this.$cancelButton) {
                    this.$cancelButton.click();
                } else {
                    this.close();
                }
            }
            if ($.inArray(key, this.confirmKeys) !== -1) {
                if (this.$confirmButton) {
                    this.$confirmButton.click();
                }
            }
        },
        setDialogCenter: function(animate) {
            var windowHeight = $(window).height();
            var boxHeight = this.$b.outerHeight();
            var topMargin = (windowHeight - boxHeight) / 2;
            var minMargin = 100;
            if (boxHeight > (windowHeight - minMargin)) {
                var style = {
                    "margin-top": minMargin / 2,
                    "margin-bottom": minMargin / 2
                };
            } else {
                var style = {
                    "margin-top": topMargin
                };
            }
            if (animate) {
                this.$b.animate(style, {
                    duration: this.animationSpeed,
                    queue: false
                });
            } else {
                this.$b.css(style);
            }
        },
        close: function() {
            var that = this;
            if (this.isClosed()) {
                return false;
            }
            if (typeof this.onClose === "function") {
                this.onClose();
            }
            $(window).unbind("resize." + this._rand);
            if (this.keyboardEnabled) {
                $(window).unbind("keyup." + this._rand);
            }
            that.$el.find(".jconfirm-bg").removeClass("seen");
            this.$b.addClass(this.animation);
            setTimeout(function() {
                that.$el.remove();
            }, this.animationSpeed + 10);
            jconfirm.record.closed += 1;
            jconfirm.record.currentlyOpen -= 1;
            if (jconfirm.record.currentlyOpen < 1) {
                $("body").removeClass("jconfirm-noscroll");
            }
            return true;
        },
        open: function() {
            var that = this;
            if (this.isClosed()) {
                return false;
            }
            that.$el.find(".jconfirm-bg").addClass("seen");
            $("body").addClass("jconfirm-noscroll");
            this.$b.removeClass(this.animations.join(" "));
            $("body :focus").trigger("blur");
            this.$b.find("input[autofocus]:visible:first").focus();
            jconfirm.record.opened += 1;
            jconfirm.record.currentlyOpen += 1;
            if (typeof this.onOpen === "function") {
                this.onOpen();
            }
            return true;
        },
        isClosed: function() {
            return (this.$el.css("display") === "") ? true : false;
        }
    };
    jconfirm.pluginDefaults = {
        template: '<div class="jconfirm"><div class="jconfirm-bg"></div><div class="jconfirm-scrollpane"><div class="container"><div class="row"><div class="jconfirm-box-container span6 offset3"><div class="jconfirm-box"><div class="closeIcon"><span class="glyphicon glyphicon-remove"></span></div><div class="title"></div><div class="content"></div><div class="buttons"></div><div class="jquery-clear"></div></div></div></div></div></div></div>',
        title: "Hello",
        content: "Are you sure to continue?",
        contentLoaded: function() {},
        icon: "",
        confirmButton: "确定",
        cancelButton: "取消",
        confirmButtonClass: "ui-btn",
        cancelButtonClass: "btn-default",
        theme: "white",
        animation: "scale",
        animationSpeed: 400,
        animationBounce: 1.5,
        keyboardEnabled: false,
        rtl: false,
        confirmKeys: [13, 32],
        cancelKeys: [27],
        container: "body",
        confirm: function() {},
        cancel: function() {},
        backgroundDismiss: true,
        autoClose: false,
        closeIcon: null,
        columnClass: "col-md-6 col-md-offset-3",
        onOpen: function() {},
        onClose: function() {},
        onAction: function() {}
    };
    jconfirm.record = {
        opened: 0,
        closed: 0,
        currentlyOpen: 0
    };
})(jQuery);

/* NProgress, (c) 2013, 2014 Rico Sta. Cruz - http://ricostacruz.com/nprogress
 * @license MIT */

;(function(root, factory) {

  if (typeof define === 'function' && define.amd) {
    define(factory);
  } else if (typeof exports === 'object') {
    module.exports = factory();
  } else {
    root.NProgress = factory();
  }

})(this, function() {
  var NProgress = {};

  NProgress.version = '0.2.0';

  var Settings = NProgress.settings = {
    minimum: 0.08,
    easing: 'ease',
    positionUsing: '',
    speed: 200,
    trickle: true,
    trickleRate: 0.02,
    trickleSpeed: 800,
    showSpinner: true,
    barSelector: '[role="bar"]',
    spinnerSelector: '[role="spinner"]',
    parent: 'body',
    template: '<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'
  };

  /**
   * Updates configuration.
   *
   *     NProgress.configure({
   *       minimum: 0.1
   *     });
   */
  NProgress.configure = function(options) {
    var key, value;
    for (key in options) {
      value = options[key];
      if (value !== undefined && options.hasOwnProperty(key)) Settings[key] = value;
    }

    return this;
  };

  /**
   * Last number.
   */

  NProgress.status = null;

  /**
   * Sets the progress bar status, where `n` is a number from `0.0` to `1.0`.
   *
   *     NProgress.set(0.4);
   *     NProgress.set(1.0);
   */

  NProgress.set = function(n) {
    var started = NProgress.isStarted();

    n = clamp(n, Settings.minimum, 1);
    NProgress.status = (n === 1 ? null : n);

    var progress = NProgress.render(!started),
        bar      = progress.querySelector(Settings.barSelector),
        speed    = Settings.speed,
        ease     = Settings.easing;

    progress.offsetWidth; /* Repaint */

    queue(function(next) {
      // Set positionUsing if it hasn't already been set
      if (Settings.positionUsing === '') Settings.positionUsing = NProgress.getPositioningCSS();

      // Add transition
      css(bar, barPositionCSS(n, speed, ease));

      if (n === 1) {
        // Fade out
        css(progress, { 
          transition: 'none', 
          opacity: 1 
        });
        progress.offsetWidth; /* Repaint */

        setTimeout(function() {
          css(progress, { 
            transition: 'all ' + speed + 'ms linear', 
            opacity: 0 
          });
          setTimeout(function() {
            NProgress.remove();
            next();
          }, speed);
        }, speed);
      } else {
        setTimeout(next, speed);
      }
    });

    return this;
  };

  NProgress.isStarted = function() {
    return typeof NProgress.status === 'number';
  };

  /**
   * Shows the progress bar.
   * This is the same as setting the status to 0%, except that it doesn't go backwards.
   *
   *     NProgress.start();
   *
   */
  NProgress.start = function() {
    if (!NProgress.status) NProgress.set(0);

    var work = function() {
      setTimeout(function() {
        if (!NProgress.status) return;
        NProgress.trickle();
        work();
      }, Settings.trickleSpeed);
    };

    if (Settings.trickle) work();

    return this;
  };

  /**
   * Hides the progress bar.
   * This is the *sort of* the same as setting the status to 100%, with the
   * difference being `done()` makes some placebo effect of some realistic motion.
   *
   *     NProgress.done();
   *
   * If `true` is passed, it will show the progress bar even if its hidden.
   *
   *     NProgress.done(true);
   */

  NProgress.done = function(force) {
    if (!force && !NProgress.status) return this;

    return NProgress.inc(0.3 + 0.5 * Math.random()).set(1);
  };

  /**
   * Increments by a random amount.
   */

  NProgress.inc = function(amount) {
    var n = NProgress.status;

    if (!n) {
      return NProgress.start();
    } else {
      if (typeof amount !== 'number') {
        amount = (1 - n) * clamp(Math.random() * n, 0.1, 0.95);
      }

      n = clamp(n + amount, 0, 0.994);
      return NProgress.set(n);
    }
  };

  NProgress.trickle = function() {
    return NProgress.inc(Math.random() * Settings.trickleRate);
  };

  /**
   * Waits for all supplied jQuery promises and
   * increases the progress as the promises resolve.
   *
   * @param $promise jQUery Promise
   */
  (function() {
    var initial = 0, current = 0;

    NProgress.promise = function($promise) {
      if (!$promise || $promise.state() === "resolved") {
        return this;
      }

      if (current === 0) {
        NProgress.start();
      }

      initial++;
      current++;

      $promise.always(function() {
        current--;
        if (current === 0) {
            initial = 0;
            NProgress.done();
        } else {
            NProgress.set((initial - current) / initial);
        }
      });

      return this;
    };

  })();

  /**
   * (Internal) renders the progress bar markup based on the `template`
   * setting.
   */

  NProgress.render = function(fromStart) {
    if (NProgress.isRendered()) return document.getElementById('nprogress');

    addClass(document.documentElement, 'nprogress-busy');
    
    var progress = document.createElement('div');
    progress.id = 'nprogress';
    progress.innerHTML = Settings.template;

    var bar      = progress.querySelector(Settings.barSelector),
        perc     = fromStart ? '-100' : toBarPerc(NProgress.status || 0),
        parent   = document.querySelector(Settings.parent),
        spinner;
    
    css(bar, {
      transition: 'all 0 linear',
      transform: 'translate3d(' + perc + '%,0,0)'
    });

    if (!Settings.showSpinner) {
      spinner = progress.querySelector(Settings.spinnerSelector);
      spinner && removeElement(spinner);
    }

    if (parent != document.body) {
      addClass(parent, 'nprogress-custom-parent');
    }

    parent.appendChild(progress);
    return progress;
  };

  /**
   * Removes the element. Opposite of render().
   */

  NProgress.remove = function() {
    removeClass(document.documentElement, 'nprogress-busy');
    removeClass(document.querySelector(Settings.parent), 'nprogress-custom-parent');
    var progress = document.getElementById('nprogress');
    progress && removeElement(progress);
  };

  /**
   * Checks if the progress bar is rendered.
   */

  NProgress.isRendered = function() {
    return !!document.getElementById('nprogress');
  };

  /**
   * Determine which positioning CSS rule to use.
   */

  NProgress.getPositioningCSS = function() {
    // Sniff on document.body.style
    var bodyStyle = document.body.style;

    // Sniff prefixes
    var vendorPrefix = ('WebkitTransform' in bodyStyle) ? 'Webkit' :
                       ('MozTransform' in bodyStyle) ? 'Moz' :
                       ('msTransform' in bodyStyle) ? 'ms' :
                       ('OTransform' in bodyStyle) ? 'O' : '';

    if (vendorPrefix + 'Perspective' in bodyStyle) {
      // Modern browsers with 3D support, e.g. Webkit, IE10
      return 'translate3d';
    } else if (vendorPrefix + 'Transform' in bodyStyle) {
      // Browsers without 3D support, e.g. IE9
      return 'translate';
    } else {
      // Browsers without translate() support, e.g. IE7-8
      return 'margin';
    }
  };

  /**
   * Helpers
   */

  function clamp(n, min, max) {
    if (n < min) return min;
    if (n > max) return max;
    return n;
  }

  /**
   * (Internal) converts a percentage (`0..1`) to a bar translateX
   * percentage (`-100%..0%`).
   */

  function toBarPerc(n) {
    return (-1 + n) * 100;
  }


  /**
   * (Internal) returns the correct CSS for changing the bar's
   * position given an n percentage, and speed and ease from Settings
   */

  function barPositionCSS(n, speed, ease) {
    var barCSS;

    if (Settings.positionUsing === 'translate3d') {
      barCSS = { transform: 'translate3d('+toBarPerc(n)+'%,0,0)' };
    } else if (Settings.positionUsing === 'translate') {
      barCSS = { transform: 'translate('+toBarPerc(n)+'%,0)' };
    } else {
      barCSS = { 'margin-left': toBarPerc(n)+'%' };
    }

    barCSS.transition = 'all '+speed+'ms '+ease;

    return barCSS;
  }

  /**
   * (Internal) Queues a function to be executed.
   */

  var queue = (function() {
    var pending = [];
    
    function next() {
      var fn = pending.shift();
      if (fn) {
        fn(next);
      }
    }

    return function(fn) {
      pending.push(fn);
      if (pending.length == 1) next();
    };
  })();

  /**
   * (Internal) Applies css properties to an element, similar to the jQuery 
   * css method.
   *
   * While this helper does assist with vendor prefixed property names, it 
   * does not perform any manipulation of values prior to setting styles.
   */

  var css = (function() {
    var cssPrefixes = [ 'Webkit', 'O', 'Moz', 'ms' ],
        cssProps    = {};

    function camelCase(string) {
      return string.replace(/^-ms-/, 'ms-').replace(/-([\da-z])/gi, function(match, letter) {
        return letter.toUpperCase();
      });
    }

    function getVendorProp(name) {
      var style = document.body.style;
      if (name in style) return name;

      var i = cssPrefixes.length,
          capName = name.charAt(0).toUpperCase() + name.slice(1),
          vendorName;
      while (i--) {
        vendorName = cssPrefixes[i] + capName;
        if (vendorName in style) return vendorName;
      }

      return name;
    }

    function getStyleProp(name) {
      name = camelCase(name);
      return cssProps[name] || (cssProps[name] = getVendorProp(name));
    }

    function applyCss(element, prop, value) {
      prop = getStyleProp(prop);
      element.style[prop] = value;
    }

    return function(element, properties) {
      var args = arguments,
          prop, 
          value;

      if (args.length == 2) {
        for (prop in properties) {
          value = properties[prop];
          if (value !== undefined && properties.hasOwnProperty(prop)) applyCss(element, prop, value);
        }
      } else {
        applyCss(element, args[1], args[2]);
      }
    }
  })();

  /**
   * (Internal) Determines if an element or space separated list of class names contains a class name.
   */

  function hasClass(element, name) {
    var list = typeof element == 'string' ? element : classList(element);
    return list.indexOf(' ' + name + ' ') >= 0;
  }

  /**
   * (Internal) Adds a class to an element.
   */

  function addClass(element, name) {
    var oldList = classList(element),
        newList = oldList + name;

    if (hasClass(oldList, name)) return; 

    // Trim the opening space.
    element.className = newList.substring(1);
  }

  /**
   * (Internal) Removes a class from an element.
   */

  function removeClass(element, name) {
    var oldList = classList(element),
        newList;

    if (!hasClass(element, name)) return;

    // Replace the class name.
    newList = oldList.replace(' ' + name + ' ', ' ');

    // Trim the opening and closing spaces.
    element.className = newList.substring(1, newList.length - 1);
  }

  /**
   * (Internal) Gets a space separated list of the class names on the element. 
   * The list is wrapped with a single space on each end to facilitate finding 
   * matches within the list.
   */

  function classList(element) {
    return (' ' + (element.className || '') + ' ').replace(/\s+/gi, ' ');
  }

  /**
   * (Internal) Removes an element from the DOM.
   */

  function removeElement(element) {
    element && element.parentNode && element.parentNode.removeChild(element);
  }

  return NProgress;
});
/*
 * Toastr
 * Copyright 2012-2015
 * Authors: John Papa, Hans Fjällemark, and Tim Ferrell.
 * All Rights Reserved.
 * Use, reproduction, distribution, and modification of this code is subject to the terms and
 * conditions of the MIT license, available at http://www.opensource.org/licenses/mit-license.php
 *
 * ARIA Support: Greta Krafsig
 *
 * Project: https://github.com/CodeSeven/toastr
 */
/* global define */
(function (define) {
    define(['jquery'], function ($) {
        return (function () {
            var $container;
            var listener;
            var toastId = 0;
            var toastType = {
                error: 'error',
                info: 'info',
                success: 'success',
                warning: 'warning'
            };

            var toastr = {
                clear: clear,
                remove: remove,
                error: error,
                getContainer: getContainer,
                info: info,
                options: {},
                subscribe: subscribe,
                success: success,
                version: '2.1.2',
                warning: warning
            };

            var previousToast;

            return toastr;

            ////////////////

            function error(message, title, optionsOverride) {
                return notify({
                    type: toastType.error,
                    iconClass: getOptions().iconClasses.error,
                    message: message,
                    optionsOverride: optionsOverride,
                    title: title
                });
            }

            function getContainer(options, create) {
                if (!options) { options = getOptions(); }
                $container = $('#' + options.containerId);
                if ($container.length) {
                    return $container;
                }
                if (create) {
                    $container = createContainer(options);
                }
                return $container;
            }

            function info(message, title, optionsOverride) {
                return notify({
                    type: toastType.info,
                    iconClass: getOptions().iconClasses.info,
                    message: message,
                    optionsOverride: optionsOverride,
                    title: title
                });
            }

            function subscribe(callback) {
                listener = callback;
            }

            function success(message, title, optionsOverride) {
                return notify({
                    type: toastType.success,
                    iconClass: getOptions().iconClasses.success,
                    message: message,
                    optionsOverride: optionsOverride,
                    title: title
                });
            }

            function warning(message, title, optionsOverride) {
                return notify({
                    type: toastType.warning,
                    iconClass: getOptions().iconClasses.warning,
                    message: message,
                    optionsOverride: optionsOverride,
                    title: title
                });
            }

            function clear($toastElement, clearOptions) {
                var options = getOptions();
                if (!$container) { getContainer(options); }
                if (!clearToast($toastElement, options, clearOptions)) {
                    clearContainer(options);
                }
            }

            function remove($toastElement) {
                var options = getOptions();
                if (!$container) { getContainer(options); }
                if ($toastElement && $(':focus', $toastElement).length === 0) {
                    removeToast($toastElement);
                    return;
                }
                if ($container.children().length) {
                    $container.remove();
                }
            }

            // internal functions

            function clearContainer (options) {
                var toastsToClear = $container.children();
                for (var i = toastsToClear.length - 1; i >= 0; i--) {
                    clearToast($(toastsToClear[i]), options);
                }
            }

            function clearToast ($toastElement, options, clearOptions) {
                var force = clearOptions && clearOptions.force ? clearOptions.force : false;
                if ($toastElement && (force || $(':focus', $toastElement).length === 0)) {
                    $toastElement[options.hideMethod]({
                        duration: options.hideDuration,
                        easing: options.hideEasing,
                        complete: function () { removeToast($toastElement); }
                    });
                    return true;
                }
                return false;
            }

            function createContainer(options) {
                $container = $('<div/>')
                    .attr('id', options.containerId)
                    .addClass(options.positionClass)
                    .attr('aria-live', 'polite')
                    .attr('role', 'alert');

                $container.appendTo($(options.target));
                return $container;
            }

            function getDefaults() {
                return {
                    tapToDismiss: true,
                    toastClass: 'toast',
                    containerId: 'toast-container',
                    debug: false,

                    showMethod: 'fadeIn', //fadeIn, slideDown, and show are built into jQuery
                    showDuration: 300,
                    showEasing: 'swing', //swing and linear are built into jQuery
                    onShown: undefined,
                    hideMethod: 'fadeOut',
                    hideDuration: 1000,
                    hideEasing: 'swing',
                    onHidden: undefined,
                    closeMethod: false,
                    closeDuration: false,
                    closeEasing: false,

                    extendedTimeOut: 1000,
                    iconClasses: {
                        error: 'toast-error',
                        info: 'toast-info',
                        success: 'toast-success',
                        warning: 'toast-warning'
                    },
                    iconClass: 'toast-info',
                    positionClass: 'toast-top-right',
                    timeOut: 5000, // Set timeOut and extendedTimeOut to 0 to make it sticky
                    titleClass: 'toast-title',
                    messageClass: 'toast-message',
                    escapeHtml: false,
                    target: 'body',
                    closeHtml: '<button type="button">&times;</button>',
                    newestOnTop: true,
                    preventDuplicates: false,
                    progressBar: false
                };
            }

            function publish(args) {
                if (!listener) { return; }
                listener(args);
            }

            function notify(map) {
                var options = getOptions();
                var iconClass = map.iconClass || options.iconClass;

                if (typeof (map.optionsOverride) !== 'undefined') {
                    options = $.extend(options, map.optionsOverride);
                    iconClass = map.optionsOverride.iconClass || iconClass;
                }

                if (shouldExit(options, map)) { return; }

                toastId++;

                $container = getContainer(options, true);

                var intervalId = null;
                var $toastElement = $('<div/>');
                var $titleElement = $('<div/>');
                var $messageElement = $('<div/>');
                var $progressElement = $('<div/>');
                var $closeElement = $(options.closeHtml);
                var progressBar = {
                    intervalId: null,
                    hideEta: null,
                    maxHideTime: null
                };
                var response = {
                    toastId: toastId,
                    state: 'visible',
                    startTime: new Date(),
                    options: options,
                    map: map
                };

                personalizeToast();

                displayToast();

                handleEvents();

                publish(response);

                if (options.debug && console) {
                    console.log(response);
                }

                return $toastElement;

                function escapeHtml(source) {
                    if (source == null)
                        source = "";

                    return new String(source)
                        .replace(/&/g, '&amp;')
                        .replace(/"/g, '&quot;')
                        .replace(/'/g, '&#39;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;');
                }

                function personalizeToast() {
                    setIcon();
                    setTitle();
                    setMessage();
                    setCloseButton();
                    setProgressBar();
                    setSequence();
                }

                function handleEvents() {
                    $toastElement.hover(stickAround, delayedHideToast);
                    if (!options.onclick && options.tapToDismiss) {
                        $toastElement.click(hideToast);
                    }

                    if (options.closeButton && $closeElement) {
                        $closeElement.click(function (event) {
                            if (event.stopPropagation) {
                                event.stopPropagation();
                            } else if (event.cancelBubble !== undefined && event.cancelBubble !== true) {
                                event.cancelBubble = true;
                            }
                            hideToast(true);
                        });
                    }

                    if (options.onclick) {
                        $toastElement.click(function (event) {
                            options.onclick(event);
                            hideToast();
                        });
                    }
                }

                function displayToast() {
                    $toastElement.hide();

                    $toastElement[options.showMethod](
                        {duration: options.showDuration, easing: options.showEasing, complete: options.onShown}
                    );

                    if (options.timeOut > 0) {
                        intervalId = setTimeout(hideToast, options.timeOut);
                        progressBar.maxHideTime = parseFloat(options.timeOut);
                        progressBar.hideEta = new Date().getTime() + progressBar.maxHideTime;
                        if (options.progressBar) {
                            progressBar.intervalId = setInterval(updateProgress, 10);
                        }
                    }
                }

                function setIcon() {
                    if (map.iconClass) {
                        $toastElement.addClass(options.toastClass).addClass(iconClass);
                    }
                }

                function setSequence() {
                    if (options.newestOnTop) {
                        $container.prepend($toastElement);
                    } else {
                        $container.append($toastElement);
                    }
                }

                function setTitle() {
                    if (map.title) {
                        $titleElement.append(!options.escapeHtml ? map.title : escapeHtml(map.title)).addClass(options.titleClass);
                        $toastElement.append($titleElement);
                    }
                }

                function setMessage() {
                    if (map.message) {
                        $messageElement.append(!options.escapeHtml ? map.message : escapeHtml(map.message)).addClass(options.messageClass);
                        $toastElement.append($messageElement);
                    }
                }

                function setCloseButton() {
                    if (options.closeButton) {
                        $closeElement.addClass('toast-close-button').attr('role', 'button');
                        $toastElement.prepend($closeElement);
                    }
                }

                function setProgressBar() {
                    if (options.progressBar) {
                        $progressElement.addClass('toast-progress');
                        $toastElement.prepend($progressElement);
                    }
                }

                function shouldExit(options, map) {
                    if (options.preventDuplicates) {
                        if (map.message === previousToast) {
                            return true;
                        } else {
                            previousToast = map.message;
                        }
                    }
                    return false;
                }

                function hideToast(override) {
                    var method = override && options.closeMethod !== false ? options.closeMethod : options.hideMethod;
                    var duration = override && options.closeDuration !== false ?
                        options.closeDuration : options.hideDuration;
                    var easing = override && options.closeEasing !== false ? options.closeEasing : options.hideEasing;
                    if ($(':focus', $toastElement).length && !override) {
                        return;
                    }
                    clearTimeout(progressBar.intervalId);
                    return $toastElement[method]({
                        duration: duration,
                        easing: easing,
                        complete: function () {
                            removeToast($toastElement);
                            if (options.onHidden && response.state !== 'hidden') {
                                options.onHidden();
                            }
                            response.state = 'hidden';
                            response.endTime = new Date();
                            publish(response);
                        }
                    });
                }

                function delayedHideToast() {
                    if (options.timeOut > 0 || options.extendedTimeOut > 0) {
                        intervalId = setTimeout(hideToast, options.extendedTimeOut);
                        progressBar.maxHideTime = parseFloat(options.extendedTimeOut);
                        progressBar.hideEta = new Date().getTime() + progressBar.maxHideTime;
                    }
                }

                function stickAround() {
                    clearTimeout(intervalId);
                    progressBar.hideEta = 0;
                    $toastElement.stop(true, true)[options.showMethod](
                        {duration: options.showDuration, easing: options.showEasing}
                    );
                }

                function updateProgress() {
                    var percentage = ((progressBar.hideEta - (new Date().getTime())) / progressBar.maxHideTime) * 100;
                    $progressElement.width(percentage + '%');
                }
            }

            function getOptions() {
                return $.extend({}, getDefaults(), toastr.options);
            }

            function removeToast($toastElement) {
                if (!$container) { $container = getContainer(); }
                if ($toastElement.is(':visible')) {
                    return;
                }
                $toastElement.remove();
                $toastElement = null;
                if ($container.children().length === 0) {
                    $container.remove();
                    previousToast = undefined;
                }
            }

        })();
    });
}(typeof define === 'function' && define.amd ? define : function (deps, factory) {
    if (typeof module !== 'undefined' && module.exports) { //Node
        module.exports = factory(require('jquery'));
    } else {
        window.toastr = factory(window.jQuery);
    }
}));