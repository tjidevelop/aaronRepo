/*
@Name:		Horizontal multilevel menu
@Author:    August Infotech
@WWW:       www.augustinfotech.com
@Version:   1.0 - multiple columns last attribute
*/

(function($){
	$.fn.extend({
		aigroup_menu: function(options) {
			
			var defaults = {
				delay       : 50,
				hoverClass  : 'hover',
				arrows      : true,
				animation   : '',
				addLast		: false
			};
			
			options = $.extend(defaults, options);
			
			var menu = $(this);
			//menu.find("li:has(ul)").addClass("submenu dropdown");
			menu.find("li:has(ul) ul").addClass("dropdown-menu");	

			/*if(options.arrows) {
				menu.find("li ul li:has(ul) > a").append("<b class='caret'></b>");
			}*/

			menu.find("li").hover(function() {
				$(this).addClass(options.hoverClass);
				if (options.animation === "fade") {
					$(this).children("ul").fadeIn(options.delay);
				} else if (options.animation === "toggle") {
					$(this).children("ul").slideToggle(options.delay);
				}
			}, function(){
				$(this).removeClass(options.hoverClass);
				if (options.animation === "fade") {
					$(this).children("ul").fadeOut(options.delay);
				} else if (options.animation === "toggle") {
					$(this).children("ul").slideToggle(options.delay);
				}
			});
			
			if(options.addLast) {
				$("> li:last-child", menu)
					.addClass("last")
					.prev()
						.addClass("last")
						.prev()
							.addClass("last");
				$(".submenu ul li:last-child", menu).addClass("last-item");
			}
			
			menu.find("> li.submenu > a").append("<b class='caret'></b>");
	
		}
	});
})(jQuery);