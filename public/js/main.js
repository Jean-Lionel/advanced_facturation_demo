(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	var $shell = $('#appShell');
	var $overlay = $('#sidebarOverlay');
	var mq = window.matchMedia('(max-width: 991.98px)');

	function isMobileNav() {
		return mq.matches;
	}

	function closeMobileSidebar() {
		$shell.removeClass('sidebar-open');
		$overlay.attr('aria-hidden', 'true');
	}

	function openMobileSidebar() {
		$shell.addClass('sidebar-open');
		$overlay.attr('aria-hidden', 'false');
	}

	// Mobile drawer only — sidebar stays fixed/expanded on desktop
	$('#sidebarCollapse').on('click', function () {
		if (!isMobileNav()) {
			return;
		}
		if ($shell.hasClass('sidebar-open')) {
			closeMobileSidebar();
		} else {
			openMobileSidebar();
		}
	});

	$overlay.on('click', function () {
		closeMobileSidebar();
	});

	$(document).on('keydown', function (e) {
		if (e.key === 'Escape') {
			closeMobileSidebar();
		}
	});

	$('#sidebar a').on('click', function () {
		if (isMobileNav()) {
			closeMobileSidebar();
		}
	});

	function syncSidebarMode() {
		$shell.removeClass('sidebar-collapsed');
		closeMobileSidebar();
	}

	syncSidebarMode();

	if (typeof mq.addEventListener === 'function') {
		mq.addEventListener('change', syncSidebarMode);
	} else if (typeof mq.addListener === 'function') {
		mq.addListener(syncSidebarMode);
	}

})(jQuery);
