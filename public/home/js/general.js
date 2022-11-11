/* Custom General jQuery
/*--------------------------------------------------------------------------------------------------------------------------------------*/
; (function ($, window, document, undefined) {
	//Genaral Global variables
	//"use strict";
	var $win = $(window);
	var $doc = $(document);
	var $winW = function () { return $(window).width(); };
	var $winH = function () { return $(window).height(); };
	var $screensize = function (element) {
		$(element).width($winW()).height($winH());
	};

	var screencheck = function (mediasize) {
		if (typeof window.matchMedia !== "undefined") {
			var screensize = window.matchMedia("(max-width:" + mediasize + "px)");
			if (screensize.matches) {
				return true;
			} else {
				return false;
			}
		} else { // for IE9 and lower browser
			if ($winW() <= mediasize) {
				return true;
			} else {
				return false;
			}
		}
	};

	$doc.ready(function () {
		/*--------------------------------------------------------------------------------------------------------------------------------------*/
		// Remove No-js Class
		$("html").removeClass('no-js').addClass('js');
		$('#mainmenu > ul > li > .dropdown-menu').parent('li').addClass('has-menu');

		/* Title Box Icon
		---------------------------------------------------------------------*/
		$(window).on('resize', function () {
			$('.menu-list').each(function () {
				if (screencheck(1023)) {
					$(this).on('click', 'h5', function () {
						$(this).toggleClass('open').next('ul').slideToggle().not(':animate');
					});
				}
			});
		}).resize();



		/* Get Screen size
		---------------------------------------------------------------------*/
		$win.on('load', function () {
			$win.on('resize', function () {
				$screensize('your selector');
			}).resize();
		});


		/* Menu ICon Append prepend for responsive
		---------------------------------------------------------------------*/
		$(window).on('resize', function () {
			if (screencheck(1023)) {
				if (!$('#menu').length) {
					$('#mainmenu').prepend('<a href="#" id="menu" class="menulines-button"><span class="menulines"></span></a>');
				}
				$('.ftr-logo').prependTo($('.bottom-footer'));
				$('.connect-with-us ').prependTo($('.ftr-logo'));
				$('.connect-with-us').appendTo($('.copyright'));
			} else {
				$("#menu").remove();
				$('.bottom-footer > .ftr-logo').prependTo($('.copyright'));
				$('.copyright .connect-with-us').appendTo($('.bottom-footer'))
			}
		}).resize();

		$(window).on('resize', function () {
			if (screencheck(767)) {
				$('.connect-with-us h4').appendTo('.ftr-logo');
			} else {
				$('.ftr-logo h4').prependTo('.connect-with-us');
			}
		}).resize();


		/* Tab Content box 
		---------------------------------------------------------------------*/
		var tabBlockElement = $('.tab-data');
		$(tabBlockElement).each(function () {
			var $this = $(this),
				tabTrigger = $this.find(".tabnav li"),
				tabContent = $this.find(".tabcontent");
			var textval = [];
			tabTrigger.each(function () {
				textval.push($(this).text());
			});
			$this.find(tabTrigger).first().addClass("active");
			$this.find(tabContent).first().show();

			$(tabTrigger).on('click', function () {
				$(tabTrigger).removeClass("active");
				$(this).addClass("active");
				$(tabContent).hide().removeClass('visible');
				var activeTab = $(this).find("a").attr("data-rel");
				$this.find('#' + activeTab).fadeIn('normal').addClass('visible');

				return false;
			});

			var responsivetabActive = function () {
				if (screencheck(767)) {
					if (!$this.find('.tabMobiletrigger').length) {
						$(tabContent).each(function (index) {
							$(this).before("<h2 class='tabMobiletrigger'>" + textval[index] + "</h2>");
							$this.find('.tabMobiletrigger:first').addClass("rotate");
						});
						$('.tabMobiletrigger').click('click', function () {
							var tabAcoordianData = $(this).next('.tabcontent');
							if ($(tabAcoordianData).is(':visible')) {
								$(this).removeClass('rotate');
								$(tabAcoordianData).slideUp('normal');
								//return false;
							} else {
								$this.find('.tabMobiletrigger').removeClass('rotate');
								$(tabContent).slideUp('normal');
								$(this).addClass('rotate');
								$(tabAcoordianData).not(':animated').slideToggle('normal');
							}
							return false;
						});
					}

				} else {
					if ($('.tabMobiletrigger').length) {
						$('.tabMobiletrigger').remove();
						tabTrigger.removeClass("active");
						$this.find(tabTrigger).removeClass("active").first().addClass('active');
						$this.find(tabContent).hide().first().show();
					}
				}
			};
			$(window).on('resize', function () {
				if (!$this.hasClass('only-tab')) {
					responsivetabActive();
				}
			}).resize();
		});

		/* Accordion box JS
		---------------------------------------------------------------------*/
		$('.accordion-databox').each(function () {
			var $accordion = $(this),
				$accordionTrigger = $accordion.find('.accordion-trigger'),
				$accordionDatabox = $accordion.find('.accordion-data');

			$accordionTrigger.first().addClass('open');
			$accordionDatabox.first().show();

			$accordionTrigger.on('click', function (e) {
				var $this = $(this);
				var $accordionData = $this.next('.accordion-data');
				if ($accordionData.is($accordionDatabox) && $accordionData.is(':visible')) {
					$this.removeClass('open');
					$accordionData.slideUp(400);
					e.preventDefault();
				} else {
					$accordionTrigger.removeClass('open');
					$this.addClass('open');
					$accordionDatabox.slideUp(400);
					$accordionData.slideDown(400);
				}
			});
		});

		/* Mobile menu click
		---------------------------------------------------------------------*/
		$(document).on('click', "#menu", function () {
			$(this).toggleClass('menuopen');
			$(this).next('ul').slideToggle('normal');
			return false;
		});

		/* Header Sticky
		---------------------------------------------------------------------*/
		if ($("#header").length) {
			$(window).scroll(function () {
				var headerHeight = $('#header').outerHeight() - 20;
				if ($(this).scrollTop() > headerHeight) {
					$("#header").addClass("sticky");
				} else {
					$("#header").removeClass("sticky");
				}
			});
			var header = document.querySelectorAll('#header');
			Stickyfill.add(header);
		}

		/*Custom Dropdown
		---------------------------------------------------------------------*/
		function create_custom_dropdowns() {
			$('select').each(function (i, select) {
				if (!$(this).next().hasClass('dropdown')) {
					$(this).after('<div class="dropdown ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
					var dropdown = $(this).next();
					var options = $(select).find('option');
					var selected = $(this).find('option:selected');
					dropdown.find('.current').html(selected.data('display-text') || selected.text());
					options.each(function (j, o) {
						var display = $(o).data('display-text') || '';
						dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
					});
				}
			});
		}
		// Event listeners

		// Open/close
		$(document).on('click', '.dropdown', function (event) {
			$('.dropdown').not($(this)).removeClass('open');
			$(this).toggleClass('open');
			if ($(this).hasClass('open')) {
				$(this).find('.option').attr('tabindex', 0);
				$(this).find('.selected').focus();
			} else {
				$(this).find('.option').removeAttr('tabindex');
				$(this).focus();
			}
		});
		// Close when clicking outside
		$(document).on('click', function (event) {
			if ($(event.target).closest('.dropdown').length === 0) {
				$('.dropdown').removeClass('open');
				$('.dropdown .option').removeAttr('tabindex');
			}
			event.stopPropagation();
		});
		// Option click
		$(document).on('click', '.dropdown .option', function (event) {
			$(this).closest('.list').find('.selected').removeClass('selected');
			$(this).addClass('selected');
			var text = $(this).data('display-text') || $(this).text();
			$(this).closest('.dropdown').find('.current').text(text);
			$(this).closest('.dropdown').prev('select').val($(this).data('value')).trigger('change');
		});

		// Keyboard events
		$(document).on('keydown', '.dropdown', function (event) {
			var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
			// Space or Enter
			if (event.keyCode == 32 || event.keyCode == 13) {
				if ($(this).hasClass('open')) {
					focused_option.trigger('click');
				} else {
					$(this).trigger('click');
				}
				return false;
				// Down
			} else if (event.keyCode == 40) {
				if (!$(this).hasClass('open')) {
					$(this).trigger('click');
				} else {
					focused_option.next().focus();
				}
				return false;
				// Up
			} else if (event.keyCode == 38) {
				if (!$(this).hasClass('open')) {
					$(this).trigger('click');
				} else {
					var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
					focused_option.prev().focus();
				}
				return false;
				// Esc
			} else if (event.keyCode == 27) {
				if ($(this).hasClass('open')) {
					$(this).trigger('click');
				}
				return false;
			}
		});

		create_custom_dropdowns();

		/* MatchHeight Js
				-------------------------------------------------------------------------*/
		if ($('.Restaurantes-images').length) {
			$('.Restaurantes-images h4').matchHeight();
		}

		/*category-slider
		---------------------------------------------------------------------*/
		if ($(".category-slider").length) {
			var owl = $('.category-slider').owlCarousel({
				// $('.category-slider').owlCarousel({
				loop: true,
				margin: 30,
				items: 4,
				nav: true,
				responsive: {
					0: {
						items: 1
					},
					640: {
						items: 2
					},
					768: {
						items: 3
					},
					1024: {
						items: 3
					},
					1201: {
						items: 4
					}
				}
			})

			$('.owl-filter-bar').on('click', '.item', function () {

				var $item = $(this);
				var filter = $item.data('owl-filter')

				$item.addClass('active').siblings().removeClass('active');

				owl.owlcarousel2_filter(filter);

				return false;

			})
		}
		// owl.owlcarousel2_filter( '.blue' );


		var $clientSlider = $(".logo-boxes");

		$(window).resize(function () {
			showLogoSlider();
		});

		function showLogoSlider() {
			if ($clientSlider.data("owlCarousel") !== "undefined") {
				if (window.matchMedia('(max-width: 767px)').matches) {
					initialLogoSlider();
				} else {
					destroyLogoSlider();
				}
			}
		}
		showLogoSlider();

		function initialLogoSlider() {
			$clientSlider.addClass("owl-carousel").owlCarousel({
				items: 1,
				loop: true,
				margin: 30,
				dots: false,
				autoplay: true,
				autoplayTimeout: 5000,
				responsive: {
					0: {
						items: 2,

					},
					568: {
						items: 3
					},
					767: {
						items: 4,
						margin: 20
					}
				}
			});
		}

		function destroyLogoSlider() {
			$clientSlider.trigger("destroy.owl.carousel").removeClass("owl-carousel");
		}


		/*--------------------------------------------------------------------------------------------------------------------------------------*/
	});

	/*All function need to define here for use strict mode /*
	/*--------------------------------------------------------------------------------------------------------------------------------------*/
})(jQuery, window, document);