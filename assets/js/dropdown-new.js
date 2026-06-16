(function () {
	'use strict';

	const widgetSelector = '.wp-dropdown-new-widget .wp-dropdown-new';

	function setPanelState(item, open, immediate) {
		const trigger = item.querySelector(':scope > .wp-dropdown-new_parent');
		const panel = item.querySelector(':scope > .wp-dropdown-new_wrapper__content');

		if (!trigger || !panel) {
			return;
		}

		item.classList.toggle('is-open', open);
		trigger.setAttribute('aria-expanded', open ? 'true' : 'false');

		if (immediate) {
			panel.style.transition = 'none';
		}

		if (open) {
			panel.style.height = `${panel.scrollHeight}px`;
		} else {
			panel.style.height = `${panel.scrollHeight}px`;
			panel.offsetHeight;
			panel.style.height = '0px';
		}

		if (immediate) {
			window.requestAnimationFrame(() => {
				panel.style.removeProperty('transition');
			});
		}
	}

	function closeSiblingItems(widget, currentItem) {
		widget.querySelectorAll('.wp-dropdown-new_item.is-open').forEach((item) => {
			if (item !== currentItem) {
				setPanelState(item, false, false);
			}
		});
	}

	function refreshOpenPanels(widget) {
		widget.querySelectorAll('.wp-dropdown-new_item.is-open').forEach((item) => {
			const panel = item.querySelector(':scope > .wp-dropdown-new_wrapper__content');

			if (panel) {
				panel.style.height = `${panel.scrollHeight}px`;
			}
		});
	}

	function initWidget(widget) {
		if (widget.dataset.dropdownNewReady === 'true') {
			refreshOpenPanels(widget);
			return;
		}

		widget.dataset.dropdownNewReady = 'true';

		const singleOpen = widget.dataset.singleOpen === 'true';
		const triggers = widget.querySelectorAll(
			'.wp-dropdown-new_item.has-children > .wp-dropdown-new_parent'
		);

		triggers.forEach((trigger) => {
			trigger.addEventListener('click', () => {
				const item = trigger.closest('.wp-dropdown-new_item');
				const shouldOpen = !item.classList.contains('is-open');

				if (shouldOpen && singleOpen) {
					closeSiblingItems(widget, item);
				}

				setPanelState(item, shouldOpen, false);
			});
		});

		if (widget.dataset.openFirst === 'true' && triggers.length) {
			const firstItem = triggers[0].closest('.wp-dropdown-new_item');
			setPanelState(firstItem, true, true);
		}
	}

	function initWithin(scope) {
		if (scope.matches && scope.matches(widgetSelector)) {
			initWidget(scope);
		}

		if (scope.querySelectorAll) {
			scope.querySelectorAll(widgetSelector).forEach(initWidget);
		}
	}

	function boot() {
		initWithin(document);

		const observer = new MutationObserver((mutations) => {
			mutations.forEach((mutation) => {
				mutation.addedNodes.forEach((node) => {
					if (node.nodeType === Node.ELEMENT_NODE) {
						initWithin(node);
					}
				});
			});
		});

		observer.observe(document.documentElement, {
			childList: true,
			subtree: true,
		});

		window.addEventListener('resize', () => {
			document.querySelectorAll(widgetSelector).forEach(refreshOpenPanels);
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', boot);
	} else {
		boot();
	}
})();

