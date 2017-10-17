var $container;
jQuery(function ($) {
    
    "use strict";

    /* Counter */
    $('.cnt-no').counterUp({
        delay: 100,
        time: 2000
    });

    /* ---------------------------------------------------------------------------
	 * Main menu
	 * --------------------------------------------------------------------------- */
	$('#menu > ul').aigroup_menu({
		delay: 0,
		hoverClass: 'hover',
		arrows: true,
		animation: ''
	});

    /* Scroll to top */
    var offset = 220;
    var duration = 1000;
    $(window).scroll(function () {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(duration);
        } else {
            $('.back-to-top').fadeOut(duration);
        }
    });
    $('.back-to-top').click(function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, duration);
        return false;
    });

    // For place holder

    var _debug = false;
    var _placeholderSupport = function () {
        var t = document.createElement("input");
        t.type = "text";
        return (typeof t.placeholder !== "undefined");
    }();

    window.onload = function () {
        var arrInputs = document.getElementsByTagName("input");
        var arrTextareas = document.getElementsByTagName("textarea");
        var combinedArray = [];
        for (var i = 0; i < arrInputs.length; i++)
            combinedArray.push(arrInputs[i]);
        for (var i = 0; i < arrTextareas.length; i++)
            combinedArray.push(arrTextareas[i]);
        for (var i = 0; i < combinedArray.length; i++) {
            var curInput = combinedArray[i];
            if (!curInput.type || curInput.type == "" || curInput.type == "text" || curInput.type == "textarea")
                HandlePlaceholder(curInput);
            else if (curInput.type == "password")
                ReplaceWithText(curInput);
        }

        if (!_placeholderSupport) {
            for (var i = 0; i < document.forms.length; i++) {
                var oForm = document.forms[i];
                if (oForm.attachEvent) {
                    oForm.attachEvent("onsubmit", function () {
                        PlaceholderFormSubmit(oForm);
                    });
                } else if (oForm.addEventListener)
                    oForm.addEventListener("submit", function () {
                        PlaceholderFormSubmit(oForm);
                    }, false);
            }
        }
    };

    function PlaceholderFormSubmit(oForm) {
        for (var i = 0; i < oForm.elements.length; i++) {
            var curElement = oForm.elements[i];
            HandlePlaceholderItemSubmit(curElement);
        }
    }

    function HandlePlaceholderItemSubmit(element) {
        if (element.name) {
            var curPlaceholder = element.getAttribute("placeholder");
            if (curPlaceholder && curPlaceholder.length > 0 && element.value === curPlaceholder) {
                element.value = "";
                window.setTimeout(function () {
                    element.value = curPlaceholder;
                }, 100);
            }
        }
    }

    function ReplaceWithText(oPasswordTextbox) {
        if (_placeholderSupport)
            return;
        var oTextbox = document.createElement("input");
        oTextbox.type = "text";
        oTextbox.id = oPasswordTextbox.id;
        oTextbox.name = oPasswordTextbox.name;
        //oTextbox.style = oPasswordTextbox.style;
        oTextbox.className = oPasswordTextbox.className;
        for (var i = 0; i < oPasswordTextbox.attributes.length; i++) {
            var curName = oPasswordTextbox.attributes.item(i).nodeName;
            var curValue = oPasswordTextbox.attributes.item(i).nodeValue;
            if (curName !== "type" && curName !== "name") {
                oTextbox.setAttribute(curName, curValue);
            }
        }
        oTextbox.originalTextbox = oPasswordTextbox;
        oPasswordTextbox.parentNode.replaceChild(oTextbox, oPasswordTextbox);
        HandlePlaceholder(oTextbox);
        if (!_placeholderSupport) {
            oPasswordTextbox.onblur = function () {
                if (this.dummyTextbox && this.value.length === 0) {
                    this.parentNode.replaceChild(this.dummyTextbox, this);
                }
            };
        }
    }

    function HandlePlaceholder(oTextbox) {
        if (!_placeholderSupport) {
            var curPlaceholder = oTextbox.getAttribute("placeholder");
            if (curPlaceholder && curPlaceholder.length > 0) {
                Debug("Placeholder found for input box '" + oTextbox.name + "': " + curPlaceholder);
                oTextbox.value = curPlaceholder;
                oTextbox.setAttribute("old_color", oTextbox.style.color);
                oTextbox.style.color = "#c0c0c0";
                oTextbox.onfocus = function () {
                    var _this = this;
                    if (this.originalTextbox) {
                        _this = this.originalTextbox;
                        _this.dummyTextbox = this;
                        this.parentNode.replaceChild(this.originalTextbox, this);
                        _this.focus();
                    }
                    Debug("input box '" + _this.name + "' focus");
                    _this.style.color = _this.getAttribute("old_color");
                    if (_this.value === curPlaceholder)
                        _this.value = "";
                };
                oTextbox.onblur = function () {
                    var _this = this;
                    Debug("input box '" + _this.name + "' blur");
                    if (_this.value === "") {
                        _this.style.color = "#c0c0c0";
                        _this.value = curPlaceholder;
                    }
                };
            } else {
                Debug("input box '" + oTextbox.name + "' does not have placeholder attribute");
            }
        } else {
            Debug("browser has native support for placeholder");
        }
    }

    function Debug(msg) {
        if (typeof _debug !== "undefined" && _debug) {
            var oConsole = document.getElementById("Console");
            if (!oConsole) {
                oConsole = document.createElement("div");
                oConsole.id = "Console";
                document.body.appendChild(oConsole);
            }
            oConsole.innerHTML += msg + "<br />";
        }
    }

});

jQuery(window).load(function() {
    
    "use strict";
    
    /* Home page Slider */
    jQuery('.slider-banner').flexslider({
        animation: "fade",
        directionNav: true,
        slideshow: true,
        slideshowSpeed: 5000,
        animationSpeed: 1500,

        after: function (slider) {
            if (!slider.playing) {
                slider.play();
            }
        }
    });
    
   
    
    
    
    
});

function isMobile() {
    
    "use strict";
    
    return (
        (navigator.userAgent.match(/Android/i)) ||
        (navigator.userAgent.match(/webOS/i)) ||
        (navigator.userAgent.match(/iPhone/i)) ||
        (navigator.userAgent.match(/iPod/i)) ||
        (navigator.userAgent.match(/iPad/i)) ||
        (navigator.userAgent.match(/BlackBerry/))
    );
}
/* For Animation */
try {

    wow = new WOW({
        animateClass: 'animated',
        offset: 100
    });
    wow.init();
} catch (e) {};

