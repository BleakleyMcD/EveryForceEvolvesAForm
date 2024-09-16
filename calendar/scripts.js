const OPERATION_CONFIRMATION_HTML = '<span><code>Enter</code> to confirm, <code>Escape</code> to cancel</span>';

let hovered = null;
let operation = null;

const calendar = document.querySelector('.calendar');
const splashWrapper = document.querySelector('.splash_wrapper');

if (splashWrapper) {
	const version = document.body.dataset.version;
	if (localStorage.getItem('feberSplashSeen') !== version) {
		splashWrapper.show();
		localStorage.setItem('feberSplashSeen', version);
	}
}

function renderOperation() {
	let message;

	if (operation?.type === 'delete') {
		message = `<span>${operation.events.length} events marked for deletion</span>${OPERATION_CONFIRMATION_HTML}`;
	} else if (operation?.type === 'repeat') {
		message = `<span>Repeat event ${operation.interval} ${operation.count} times</span>${OPERATION_CONFIRMATION_HTML}`;
	} else {
		message = '';
	}

	const tooltip = document.querySelector('.tooltip');
	const toolsWrapper = document.querySelector('.tools_wrapper');
	if (message) {
		tooltip.innerHTML = message;
		toolsWrapper.classList.add('tooltip_active');
	} else {
		toolsWrapper.classList.remove('tooltip_active');
	}
}

function executeDelete() {
	const form = document.createElement('form');

	form.action = './?delete';
	form.method = 'post';

	for (const event of operation.events) {
		const input = document.createElement('input');
		input.name = 'ids[]';
		input.type = 'hidden';
		input.value = event.dataset.id;

		form.appendChild(input);
	}

	document.body.appendChild(form);

	form.submit();
}

function executeRepeat() {
	const form = document.createElement('form');

	form.action = './?repeat';
	form.method = 'post';

	const inputCount = document.createElement('input');

	inputCount.name = 'count';
	inputCount.type = 'hidden';
	inputCount.value = operation.count || 0;

	form.appendChild(inputCount);

	const inputId = document.createElement('input');

	inputId.name = 'id';
	inputId.type = 'hidden';
	inputId.value = operation.event.dataset.id;

	form.appendChild(inputId);

	const inputInterval = document.createElement('input');

	inputInterval.name = 'interval';
	inputInterval.type = 'hidden';
	inputInterval.value = operation.interval;

	form.appendChild(inputInterval);

	document.body.appendChild(form);

	form.submit();
}

document.addEventListener('click', event => {
	if (event.target.id === 'menu_button') {
		const menuButton = document.querySelector('#menu_button');
		const menu = document.querySelector('#menu');

		if (menuButton.getAttribute('aria-expanded') === 'false') {
			menu.classList.add('active');
			menu.querySelector('a:first-child').focus();
			menuButton.setAttribute('aria-expanded', 'true');
		} else {
			menu.classList.remove('active');
			menuButton.setAttribute('aria-expanded', 'false');
		}

		event.preventDefault();
	} else if (event.target.getAttribute('href') === '#about') {
		const menuParent = event.target.closest('#menu');

		if (menuParent) {
			const menuButton = document.querySelector('#menu_button');
			menuButton.setAttribute('aria-expanded', 'false');
			menuParent.classList.remove('active');
		}

		if (document.querySelector('.splash_wrapper').open) {
			if (!menuParent) {
				document.querySelector('.splash_wrapper').close();
			}
		} else {
			document.querySelector('.splash_wrapper').show();
		}

		event.preventDefault();
	}
});

if (calendar) {
	document.addEventListener('focusin', event => {
		const eventAnchor = event.target.closest('.event');
		if (eventAnchor) {
			hovered = eventAnchor;
		} else {
			hovered = null;
		}
	});

	document.addEventListener('mouseover', event => {
		const eventAnchor = event.target.closest('.event');
		if (eventAnchor) {
			hovered = eventAnchor;
		} else {
			hovered = null;
		}
	});
}

document.addEventListener('keydown', event => {
	switch (event.key) {
		case 'Enter': {
			if (operation) {
				if (operation.type === 'delete') {
					executeDelete();
				} else if (operation.type === 'repeat') {
					executeRepeat();
				}

				operation = null;
				document.querySelectorAll('.pending_operation').forEach(element => element.classList.remove('pending_operation'));
				renderOperation();

				event.preventDefault();
			}

			return;
		}
		case 'Escape': {
			if (operation) {
				operation = null;
				document.querySelectorAll('.pending_operation').forEach(element => element.classList.remove('pending_operation'));
				renderOperation();
			} else {
				const menuButton = document.querySelector('#menu_button');
				const menu = document.querySelector('#menu');

				if (menuButton.getAttribute('aria-expanded') === 'true') {
					const menu = document.querySelector('#menu');
					menu.classList.remove('active');
					menuButton.setAttribute('aria-expanded', 'false');
					menuButton.focus();
				}
			}

			return
		}
		case 'r': {
			if (calendar) {
				location.search = '?reverse';
				return;
			}
		}
		case 'x': {
			if (hovered) {			
				hovered.classList.add('pending_operation');

				if (operation?.type === 'delete') {
					if (operation.events.includes(hovered)) {
						if (operation.events.length === 1) {
							operation = null;
						} else {
							operation.events = operation.events.filter(event => event !== hovered);
						}
						hovered.classList.remove('pending_operation');
					} else {
						operation.events.push(hovered)
					}
				} else {
					operation = {
						events: [hovered],
						type: 'delete'
					};
				}

				renderOperation();
			}

			return;
		}
		case 'b': {
			if (hovered) {
				hovered.classList.add('pending_operation');

				operation = {
					count: '0',
					event: hovered,
					interval: 'biweekly',
					type: 'repeat'
				};

				renderOperation();
			}

			return;
		}
		case 'd': {
			if (hovered) {
				hovered.classList.add('pending_operation');

				operation = {
					count: '0',
					event: hovered,
					interval: 'daily',
					type: 'repeat'
				};

				renderOperation();
			}

			return;
		}
		case 'w': {
			if (hovered) {
				hovered.classList.add('pending_operation');

				operation = {
					count: '0',
					event: hovered,
					interval: 'weekly',
					type: 'repeat'
				};

				renderOperation();
			}

			return;
		}
		case 'Backspace': {
			if (operation?.type === 'repeat') {
				operation.count = operation.count.slice(0, -1);
				renderOperation();
			}

			return;
		}
		default: {
			if (/^[0-9]$/.test(event.key)) {
				if (operation?.type === 'repeat') {
					if (operation.count === '0') {
						operation.count = event.key;
					} else {
						operation.count += event.key;
					}

					renderOperation();
				}
			}
		}
	}
});
