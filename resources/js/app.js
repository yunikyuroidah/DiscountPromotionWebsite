import './bootstrap';

const enableAdminShortcut = () => {
	if (document.body?.dataset.page !== 'public') {
		return;
	}

	let shiftTTime = 0;

	document.addEventListener('keydown', (event) => {
		if (!event.shiftKey) {
			return;
		}

		const key = event.key.toLowerCase();

		if (key === 't') {
			event.preventDefault();
			shiftTTime = Date.now();
			return;
		}

		if (key === 'a' && shiftTTime && Date.now() - shiftTTime < 900) {
			event.preventDefault();
			window.location.href = '/admin/login';
			shiftTTime = 0;
		}
	});
};

enableAdminShortcut();
