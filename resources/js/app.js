import './bootstrap';

if (!import.meta.env.PROD && 'serviceWorker' in navigator) {
	window.addEventListener('load', async () => {
		const registrations = await navigator.serviceWorker.getRegistrations();
		await Promise.all(registrations.map((registration) => registration.unregister()));
	});
}

if (import.meta.env.PROD && 'serviceWorker' in navigator) {
	window.addEventListener('load', () => {
		navigator.serviceWorker.register('/sw.js').catch(() => {
			// Ignore registration errors and keep the app usable online.
		});
	});
}
