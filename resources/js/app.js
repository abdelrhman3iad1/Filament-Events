import './bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Echo = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST ?? window.location.hostname,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 6001,
    forceTLS: false,
    disableStats: true,
});