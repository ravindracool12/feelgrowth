function brand_primary(a) {
    return get_color(get_color_name("brand-primary"), a)
}

function brand_success(a) {
    return get_color(get_color_name("brand-success"), a)
}

function brand_info(a) {
    return get_color(get_color_name("brand-info"), a)
}

function brand_warning(a) {
    return get_color(get_color_name("brand-warning"), a)
}

function brand_danger(a) {
    return get_color(get_color_name("brand-danger"), a)
}

function theme(a) {
    return a = a ? a : "base", get_color(get_color_name("theme"), a)
}

function theme_secondary(a) {
    return a = a ? a : "base", get_color(get_color_name("theme-secondary"))
}

function get_color_name(a) {
    return void 0 !== theme_colors[a] ? theme_colors[a] : global_colors[a]
}

function get_color(a, b) {
    return b = b ? b : "base", global_colors[a][b]
}

function changeTemplateTheme(a) {
    themeTemplate = a, $("body").attr("class", a + " " + themeColor), $(".theme-picker .icon").addClass("hide"), $(".theme-picker ." + a + " .icon").removeClass("hide")
}

function changeColorTheme(a) {
    themeColor = a, $("body").attr("class", a + " " + themeTemplate), $(".theme-picker .icon").addClass("hide"), $(".theme-picker ." + a + " .icon").removeClass("hide")
}! function(a) {
    var b = {
        init: function(b) {
            var c = {
                menuWidth: 250,
                edge: "left",
                closeOnClick: !1
            };
            b = a.extend(c, b), a(this).each(function() {
                function c(c) {
                    f = !1, g = !1, a("body").removeClass("overflow-no"), a("#sidenav-overlay").velocity({
                        opacity: 0
                    }, {
                        duration: 200,
                        queue: !1,
                        easing: "easeOutQuad",
                        complete: function() {
                            a(this).remove()
                        }
                    }), "left" === b.edge ? (a(".drag-target").css({
                        width: "",
                        right: "",
                        left: "0"
                    }), e.velocity({
                        left: -1 * (b.menuWidth + 10)
                    }, {
                        duration: 200,
                        queue: !1,
                        easing: "easeOutCubic",
                        complete: function() {
                            c === !0 && (e.removeAttr("style"), e.css("width", b.menuWidth))
                        }
                    })) : (a(".drag-target").css({
                        width: "",
                        right: "0",
                        left: ""
                    }), e.velocity({
                        right: -1 * (b.menuWidth + 10)
                    }, {
                        duration: 200,
                        queue: !1,
                        easing: "easeOutCubic",
                        complete: function() {
                            c === !0 && (e.removeAttr("style"), e.css("width", b.menuWidth))
                        }
                    }))
                }
                var d = a(this),
                    e = a(d.attr("data-activates"));
                250 != b.menuWidth && e.css("width", b.menuWidth), a("body").append(a('<div class="drag-target"></div>')), "left" == b.edge ? (e.css("left", -1 * (b.menuWidth + 10)), a(".drag-target").css({
                    left: 0
                })) : (e.addClass("right-aligned").css("right", -1 * (b.menuWidth + 10)).css("left", ""), a(".drag-target").css({
                    right: 0
                })), e.hasClass("fixed") && a(window).width() > 992 && e.css("left", 0), window.innerWidth > 992 && (g = !0), e.hasClass("fixed") && a(window).resize(function() {
                    window.innerWidth > 992 ? 0 !== a("#sidenav-overlay").css("opacity") && g ? c(!0) : (e.removeAttr("style"), e.css("width", b.menuWidth)) : g === !1 && ("left" === b.edge ? e.css("left", -1 * (b.menuWidth + 10)) : e.css("right", -1 * (b.menuWidth + 10)))
                }), b.closeOnClick === !0 && e.on("click.itemclick", "a:not(.collapsible-header)", function() {
                    g === !0 && c()
                });
                var f = !1,
                    g = !1;
                a(".drag-target").on("click", function() {
                    c()
                }), a(".drag-target").hammer({
                    prevent_default: !1
                }).bind("pan", function(d) {
                    if ("touch" == d.gesture.pointerType) {
                        var f = (d.gesture.direction, d.gesture.center.x);
                        d.gesture.center.y, d.gesture.velocityX;
                        if (0 === a("#sidenav-overlay").length) {
                            var h = a('<div id="sidenav-overlay"></div>');
                            h.css("opacity", 0).click(function() {
                                c()
                            }), a("body").append(h)
                        }
                        if ("left" === b.edge && (f > b.menuWidth ? f = b.menuWidth : 0 > f && (f = 0)), "left" === b.edge) f < b.menuWidth / 2 ? g = !1 : f >= b.menuWidth / 2 && (g = !0), e.css("left", f - b.menuWidth);
                        else {
                            f < a(window).width() - b.menuWidth / 2 ? g = !0 : f >= a(window).width() - b.menuWidth / 2 && (g = !1);
                            var i = -1 * (f - b.menuWidth / 2);
                            i > 0 && (i = 0), e.css("right", i)
                        }
                        "left" === b.edge ? (overlayPerc = f / b.menuWidth, a("#sidenav-overlay").velocity({
                            opacity: overlayPerc
                        }, {
                            duration: 50,
                            queue: !1,
                            easing: "easeOutQuad"
                        })) : (overlayPerc = Math.abs((f - a(window).width()) / b.menuWidth), a("#sidenav-overlay").velocity({
                            opacity: overlayPerc
                        }, {
                            duration: 50,
                            queue: !1,
                            easing: "easeOutQuad"
                        }))
                    }
                }).bind("panend", function(c) {
                    if ("touch" == c.gesture.pointerType) {
                        var d = c.gesture.velocityX;
                        f = !1, "left" === b.edge ? g && .3 >= d || -.5 > d ? (e.velocity({
                            left: 0
                        }, {
                            duration: 300,
                            queue: !1,
                            easing: "easeOutQuad"
                        }), a("#sidenav-overlay").velocity({
                            opacity: 1
                        }, {
                            duration: 50,
                            queue: !1,
                            easing: "easeOutQuad"
                        }), a(".drag-target").css({
                            width: "50%",
                            right: 0,
                            left: ""
                        })) : (!g || d > .3) && (e.velocity({
                            left: -1 * (b.menuWidth + 10)
                        }, {
                            duration: 200,
                            queue: !1,
                            easing: "easeOutQuad"
                        }), a("#sidenav-overlay").velocity({
                            opacity: 0
                        }, {
                            duration: 200,
                            queue: !1,
                            easing: "easeOutQuad",
                            complete: function() {
                                a(this).remove()
                            }
                        }), a(".drag-target").css({
                            width: "10px",
                            right: "",
                            left: 0
                        })) : g && d >= -.3 || d > .5 ? (e.velocity({
                            right: 0
                        }, {
                            duration: 300,
                            queue: !1,
                            easing: "easeOutQuad"
                        }), a("#sidenav-overlay").velocity({
                            opacity: 1
                        }, {
                            duration: 50,
                            queue: !1,
                            easing: "easeOutQuad"
                        }), a(".drag-target").css({
                            width: "50%",
                            right: "",
                            left: 0
                        })) : (!g || -.3 > d) && (e.velocity({
                            right: -1 * (b.menuWidth + 10)
                        }, {
                            duration: 200,
                            queue: !1,
                            easing: "easeOutQuad"
                        }), a("#sidenav-overlay").velocity({
                            opacity: 0
                        }, {
                            duration: 200,
                            queue: !1,
                            easing: "easeOutQuad",
                            complete: function() {
                                a(this).remove()
                            }
                        }), a(".drag-target").css({
                            width: "10px",
                            right: 0,
                            left: ""
                        })), a("body").addClass("overflow-no")
                    }
                }), d.click(function() {
                    if (g === !0) g = !1, f = !1, c();
                    else {
                        a("body").addClass("overflow-no"), "left" === b.edge ? (a(".drag-target").css({
                            width: "50%",
                            right: 0,
                            left: ""
                        }), e.velocity({
                            left: 0
                        }, {
                            duration: 300,
                            queue: !1,
                            easing: "easeOutQuad"
                        })) : (a(".drag-target").css({
                            width: "50%",
                            right: "",
                            left: 0
                        }), e.velocity({
                            right: 0
                        }, {
                            duration: 300,
                            queue: !1,
                            easing: "easeOutQuad"
                        }), e.css("left", ""));
                        var d = a('<div id="sidenav-overlay"></div>');
                        d.css("opacity", 0).click(function() {
                            g = !1, f = !1, c(), d.velocity({
                                opacity: 0
                            }, {
                                duration: 300,
                                queue: !1,
                                easing: "easeOutQuad",
                                complete: function() {
                                    a(this).remove()
                                }
                            })
                        }), a("body").append(d), d.velocity({
                            opacity: 1
                        }, {
                            duration: 300,
                            queue: !1,
                            easing: "easeOutQuad",
                            complete: function() {
                                g = !0, f = !1
                            }
                        })
                    }
                    return !1
                })
            })
        },
        show: function() {
            this.trigger("click")
        },
        hide: function() {
            a("#sidenav-overlay").trigger("click")
        }
    };
    a.fn.sideNav = function(c) {
        return b[c] ? b[c].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof c && c ? void a.error("Method " + c + " does not exist on jQuery.tooltip") : b.init.apply(this, arguments)
    }
}(jQuery),
function(a, b, c, d) {
    "use strict";

    function e(b, c) {
        g = this, this.element = a(b), this.options = a.extend({}, h, c), this._defaults = h, this._name = f, this.init()
    }
    var f = "ripples",
        g = null,
        h = {};
    e.prototype.init = function() {
        var c = this.element;
        c.on("mousedown touchstart", function(d) {
            if (!g.isTouch() || "mousedown" !== d.type) {
                c.find(".ripple-wrapper").length || c.append('<div class="ripple-wrapper"></div>');
                var e = c.children(".ripple-wrapper"),
                    f = g.getRelY(e, d),
                    h = g.getRelX(e, d);
                if (f || h) {
                    var i = g.getRipplesColor(c),
                        j = a("<div></div>");
                    j.addClass("ripple").css({
                            left: h,
                            top: f,
                            "background-color": i
                        }), e.append(j),
                        function() {
                            return b.getComputedStyle(j[0]).opacity
                        }(), g.rippleOn(c, j), setTimeout(function() {
                            g.rippleEnd(j)
                        }, 500), c.on("mouseup mouseleave touchend", function() {
                            j.data("mousedown", "off"), "off" === j.data("animating") && g.rippleOut(j)
                        })
                }
            }
        })
    }, e.prototype.getNewSize = function(a, b) {
        return Math.max(a.outerWidth(), a.outerHeight()) / b.outerWidth() * 2.5
    }, e.prototype.getRelX = function(a, b) {
        var c = a.offset();
        return g.isTouch() ? (b = b.originalEvent, 1 !== b.touches.length ? b.touches[0].pageX - c.left : !1) : b.pageX - c.left
    }, e.prototype.getRelY = function(a, b) {
        var c = a.offset();
        return g.isTouch() ? (b = b.originalEvent, 1 !== b.touches.length ? b.touches[0].pageY - c.top : !1) : b.pageY - c.top
    }, e.prototype.getRipplesColor = function(a) {
        var c = a.data("ripple-color") ? a.data("ripple-color") : b.getComputedStyle(a[0]).color;
        return c
    }, e.prototype.hasTransitionSupport = function() {
        var a = c.body || c.documentElement,
            b = a.style,
            e = b.transition !== d || b.WebkitTransition !== d || b.MozTransition !== d || b.MsTransition !== d || b.OTransition !== d;
        return e
    }, e.prototype.isTouch = function() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
    }, e.prototype.rippleEnd = function(a) {
        a.data("animating", "off"), "off" === a.data("mousedown") && g.rippleOut(a)
    }, e.prototype.rippleOut = function(a) {
        a.off(), g.hasTransitionSupport() ? a.addClass("ripple-out") : a.animate({
            opacity: 0
        }, 100, function() {
            a.trigger("transitionend")
        }), a.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
            a.remove()
        })
    }, e.prototype.rippleOn = function(a, b) {
        var c = g.getNewSize(a, b);
        g.hasTransitionSupport() ? b.css({
            "-ms-transform": "scale(" + c + ")",
            "-moz-transform": "scale(" + c + ")",
            "-webkit-transform": "scale(" + c + ")",
            transform: "scale(" + c + ")"
        }).addClass("ripple-on").data("animating", "on").data("mousedown", "on") : b.animate({
            width: 2 * Math.max(a.outerWidth(), a.outerHeight()),
            height: 2 * Math.max(a.outerWidth(), a.outerHeight()),
            "margin-left": -1 * Math.max(a.outerWidth(), a.outerHeight()),
            "margin-top": -1 * Math.max(a.outerWidth(), a.outerHeight()),
            opacity: .2
        }, 500, function() {
            b.trigger("transitionend")
        })
    }, a.fn.ripples = function(b) {
        return this.each(function() {
            a.data(this, "plugin_" + f) || a.data(this, "plugin_" + f, new e(this, b))
        })
    }
}(jQuery, window, document);
var theme_colors = {
        "brand-primary": "blue",
        "brand-success": "green",
        "brand-info": "purple",
        "brand-warning": "orange",
        "brand-danger": "red",
        theme: "pink",
        "theme-secondary": "blue"
    },
    global_colors = {
        red: {
            "lighten-5": "#FFEBEE",
            "lighten-4": "#FFCDD2",
            "lighten-3": "#EF9A9A",
            "lighten-2": "#E57373",
            "lighten-1": "#EF5350",
            base: "#F44336",
            "darken-1": "#E53935",
            "darken-2": "#D32F2F",
            "darken-3": "#C62828",
            "darken-4": "#B71C1C",
            "accent-1": "#FF8A80",
            "accent-2": "#FF5252",
            "accent-3": "#FF1744",
            "accent-4": "#D50000"
        },
        pink: {
            "lighten-5": "#fce4ec",
            "lighten-4": "#f8bbd0",
            "lighten-3": "#f48fb1",
            "lighten-2": "#f06292",
            "lighten-1": "#ec407a",
            base: "#e91e63",
            "darken-1": "#d81b60",
            "darken-2": "#c2185b",
            "darken-3": "#ad1457",
            "darken-4": "#880e4f",
            "accent-1": "#ff80ab",
            "accent-2": "#ff4081",
            "accent-3": "#f50057",
            "accent-4": "#c51162"
        },
        purple: {
            "lighten-5": "#f3e5f5",
            "lighten-4": "#e1bee7",
            "lighten-3": "#ce93d8",
            "lighten-2": "#ba68c8",
            "lighten-1": "#ab47bc",
            base: "#9c27b0",
            "darken-1": "#8e24aa",
            "darken-2": "#7b1fa2",
            "darken-3": "#6a1b9a",
            "darken-4": "#4a148c",
            "accent-1": "#ea80fc",
            "accent-2": "#e040fb",
            "accent-3": "#d500f9",
            "accent-4": "#aa00ff"
        },
        "deep-purple": {
            "lighten-5": "#ede7f6",
            "lighten-4": "#d1c4e9",
            "lighten-3": "#b39ddb",
            "lighten-2": "#9575cd",
            "lighten-1": "#7e57c2",
            base: "#673ab7",
            "darken-1": "#5e35b1",
            "darken-2": "#512da8",
            "darken-3": "#4527a0",
            "darken-4": "#311b92",
            "accent-1": "#b388ff",
            "accent-2": "#7c4dff",
            "accent-3": "#651fff",
            "accent-4": "#6200ea"
        },
        indigo: {
            "lighten-5": "#e8eaf6",
            "lighten-4": "#c5cae9",
            "lighten-3": "#9fa8da",
            "lighten-2": "#7986cb",
            "lighten-1": "#5c6bc0",
            base: "#3f51b5",
            "darken-1": "#3949ab",
            "darken-2": "#303f9f",
            "darken-3": "#283593",
            "darken-4": "#1a237e",
            "accent-1": "#8c9eff",
            "accent-2": "#536dfe",
            "accent-3": "#3d5afe",
            "accent-4": "#304ffe"
        },
        blue: {
            "lighten-5": "#E3F2FD",
            "lighten-4": "#BBDEFB",
            "lighten-3": "#90CAF9",
            "lighten-2": "#64B5F6",
            "lighten-1": "#42A5F5",
            base: "#2196F3",
            "darken-1": "#1E88E5",
            "darken-2": "#1976D2",
            "darken-3": "#1565C0",
            "darken-4": "#0D47A1",
            "accent-1": "#82B1FF",
            "accent-2": "#448AFF",
            "accent-3": "#2979FF",
            "accent-4": "#2962FF"
        },
        "light-blue": {
            "lighten-5": "#e1f5fe",
            "lighten-4": "#b3e5fc",
            "lighten-3": "#81d4fa",
            "lighten-2": "#4fc3f7",
            "lighten-1": "#29b6f6",
            base: "#03a9f4",
            "darken-1": "#039be5",
            "darken-2": "#0288d1",
            "darken-3": "#0277bd",
            "darken-4": "#01579b",
            "accent-1": "#80d8ff",
            "accent-2": "#40c4ff",
            "accent-3": "#00b0ff",
            "accent-4": "#0091ea"
        },
        cyan: {
            "lighten-5": "#e0f7fa",
            "lighten-4": "#b2ebf2",
            "lighten-3": "#80deea",
            "lighten-2": "#4dd0e1",
            "lighten-1": "#26c6da",
            base: "#00bcd4",
            "darken-1": "#00acc1",
            "darken-2": "#0097a7",
            "darken-3": "#00838f",
            "darken-4": "#006064",
            "accent-1": "#84ffff",
            "accent-2": "#18ffff",
            "accent-3": "#00e5ff",
            "accent-4": "#00b8d4"
        },
        teal: {
            "lighten-5": "#e0f2f1",
            "lighten-4": "#b2dfdb",
            "lighten-3": "#80cbc4",
            "lighten-2": "#4db6ac",
            "lighten-1": "#26a69a",
            base: "#009688",
            "darken-1": "#00897b",
            "darken-2": "#00796b",
            "darken-3": "#00695c",
            "darken-4": "#004d40",
            "accent-1": "#a7ffeb",
            "accent-2": "#64ffda",
            "accent-3": "#1de9b6",
            "accent-4": "#00bfa5"
        },
        green: {
            "lighten-5": "#E8F5E9",
            "lighten-4": "#C8E6C9",
            "lighten-3": "#A5D6A7",
            "lighten-2": "#81C784",
            "lighten-1": "#66BB6A",
            base: "#4CAF50",
            "darken-1": "#43A047",
            "darken-2": "#388E3C",
            "darken-3": "#2E7D32",
            "darken-4": "#1B5E20",
            "accent-1": "#B9F6CA",
            "accent-2": "#69F0AE",
            "accent-3": "#00E676",
            "accent-4": "#00C853"
        },
        "light-green": {
            "lighten-5": "#f1f8e9",
            "lighten-4": "#dcedc8",
            "lighten-3": "#c5e1a5",
            "lighten-2": "#aed581",
            "lighten-1": "#9ccc65",
            base: "#8bc34a",
            "darken-1": "#7cb342",
            "darken-2": "#689f38",
            "darken-3": "#558b2f",
            "darken-4": "#33691e",
            "accent-1": "#ccff90",
            "accent-2": "#b2ff59",
            "accent-3": "#76ff03",
            "accent-4": "#64dd17"
        },
        lime: {
            "lighten-5": "#f9fbe7",
            "lighten-4": "#f0f4c3",
            "lighten-3": "#e6ee9c",
            "lighten-2": "#dce775",
            "lighten-1": "#d4e157",
            base: "#cddc39",
            "darken-1": "#c0ca33",
            "darken-2": "#afb42b",
            "darken-3": "#9e9d24",
            "darken-4": "#827717",
            "accent-1": "#f4ff81",
            "accent-2": "#eeff41",
            "accent-3": "#c6ff00",
            "accent-4": "#aeea00"
        },
        yellow: {
            "lighten-5": "#fffde7",
            "lighten-4": "#fff9c4",
            "lighten-3": "#fff59d",
            "lighten-2": "#fff176",
            "lighten-1": "#ffee58",
            base: "#ffeb3b",
            "darken-1": "#fdd835",
            "darken-2": "#fbc02d",
            "darken-3": "#f9a825",
            "darken-4": "#f57f17",
            "accent-1": "#ffff8d",
            "accent-2": "#ffff00",
            "accent-3": "#ffea00",
            "accent-4": "#ffd600"
        },
        amber: {
            "lighten-5": "#fff8e1",
            "lighten-4": "#ffecb3",
            "lighten-3": "#ffe082",
            "lighten-2": "#ffd54f",
            "lighten-1": "#ffca28",
            base: "#ffc107",
            "darken-1": "#ffb300",
            "darken-2": "#ffa000",
            "darken-3": "#ff8f00",
            "darken-4": "#ff6f00",
            "accent-1": "#ffe57f",
            "accent-2": "#ffd740",
            "accent-3": "#ffc400",
            "accent-4": "#ffab00"
        },
        orange: {
            "lighten-5": "#fff3e0",
            "lighten-4": "#ffe0b2",
            "lighten-3": "#ffcc80",
            "lighten-2": "#ffb74d",
            "lighten-1": "#ffa726",
            base: "#ff9800",
            "darken-1": "#fb8c00",
            "darken-2": "#f57c00",
            "darken-3": "#ef6c00",
            "darken-4": "#e65100",
            "accent-1": "#ffd180",
            "accent-2": "#ffab40",
            "accent-3": "#ff9100",
            "accent-4": "#ff6d00"
        },
        "deep-orange": {
            "lighten-5": "#fbe9e7",
            "lighten-4": "#ffccbc",
            "lighten-3": "#ffab91",
            "lighten-2": "#ff8a65",
            "lighten-1": "#ff7043",
            base: "#ff5722",
            "darken-1": "#f4511e",
            "darken-2": "#e64a19",
            "darken-3": "#d84315",
            "darken-4": "#bf360c",
            "accent-1": "#ff9e80",
            "accent-2": "#ff6e40",
            "accent-3": "#ff3d00",
            "accent-4": "#dd2c00"
        },
        brown: {
            "lighten-5": "#efebe9",
            "lighten-4": "#d7ccc8",
            "lighten-3": "#bcaaa4",
            "lighten-2": "#a1887f",
            "lighten-1": "#8d6e63",
            base: "#795548",
            "darken-1": "#6d4c41",
            "darken-2": "#5d4037",
            "darken-3": "#4e342e",
            "darken-4": "#3e2723"
        },
        "blue-grey": {
            "lighten-5": "#eceff1",
            "lighten-4": "#cfd8dc",
            "lighten-3": "#b0bec5",
            "lighten-2": "#90a4ae",
            "lighten-1": "#78909c",
            base: "#607d8b",
            "darken-1": "#546e7a",
            "darken-2": "#455a64",
            "darken-3": "#37474f",
            "darken-4": "#263238"
        },
        grey: {
            "lighten-5": "#fafafa",
            "lighten-4": "#f5f5f5",
            "lighten-3": "#eeeeee",
            "lighten-2": "#e0e0e0",
            "lighten-1": "#bdbdbd",
            base: "#9e9e9e",
            "darken-1": "#757575",
            "darken-2": "#616161",
            "darken-3": "#424242",
            "darken-4": "#212121"
        },
        shades: {
            black: "#000000",
            white: "#FFFFFF"
        }
    };
$(function() {
    $('[data-toggle="tooltip"]').tooltip(), $('[data-toggle="popover"]').popover(), $(".navbar-toggle").sideNav({
        menuWidth: 260,
        closeOnClick: !0
    });
    var a = [".btn:not(.withoutripple)", ".card-image", ".navbar a:not(.withoutripple)", ".dropdown-menu a", ".nav-tabs a:not(.withoutripple)", ".withripple"].join(",");
    $("body").find(a).ripples(), $(".form-control").each(function() {
        $(this).val() && $(this).parent().addClass("filled"), $(this).bind("blur", function(a) {
            input = $(a.currentTarget), input.val() ? input.parent().addClass("filled") : input.parent().removeClass("filled"), input.parent().removeClass("active")
        }).bind("focus", function(a) {
            input = $(a.currentTarget), input.parent().addClass("active")
        })
    })
});
var themeColor = "theme-pink",
    themeTemplate = "theme-template-dark";
$(function() {
}), $(function() {
    $(".datepicker").datetimepicker({
        format: "MM/DD/YYYY"
    }), $(".timepicker").datetimepicker({
        format: "HH:mm"
    }), $(".datepicker-from").datetimepicker({
        format: "MM/DD/YYYY"
    }), $(".datepicker-until").datetimepicker({
        format: "MM/DD/YYYY"
    }), $(".datepicker-from").on("dp.change", function(a) {
        $(".datepicker-until").data("DateTimePicker").minDate(a.date)
    }), $(".datepicker-until").on("dp.change", function(a) {
        $(".datepicker-from").data("DateTimePicker").maxDate(a.date)
    })
})
