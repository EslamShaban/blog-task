import _ from 'lodash';
window._ = _;

import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });



import Echo from 'laravel-echo';

import Socketio from 'socket.io-client';

window.io = Socketio;

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ":6001"
});

window.Echo.join('online')
    .here((users) => {
        users.forEach(user => {
            $('#online-users-list').append(`<li id="user-${user.id}"><img src="${user.image}"><span class="online-status"></span>${user.name}</li>`);
        });
    })
    .joining((user) => {
        $('#online-users-list').append(`<li id="user-${user.id}"><img src="${user.image}"><span class="online-status"></span>${user.name}</li>`);
    })
    .leaving((user) => {
        $('#user-' + user.id).remove();
    })
    .error((error) => {
        console.error(error);
    });

window.Echo.channel('post-notification')

    .listen('NewPostEvent', (data) => {

        var notification = `<div class="col-12 px-3 text-left" style="background:#f7f7f7">
                            ${data.message}
                            <div class="col-12 border-bottom pb-3">
                                <span class="font-1">
                                    <span class="fas fa-clock"></span> now
                                </span>
                            </div>
                        </div>`;

        $("#notification-content").prepend(notification);
        $('#dropdown-notifications-icon').fadeIn();
        $("#dropdown-notifications-icon").text(parseInt($("#dropdown-notifications-icon").text()) + 1);


    });

window.Echo.private(`comment.${window.Laravel.user}`)

    .listen('NewCommentEvent', (data) => {

        var notification = `<div class="col-12 px-3 text-left" style="background:#f7f7f7">
                            ${data.message}
                            <div class="col-12 border-bottom pb-3">
                                <span class="font-1">
                                    <span class="fas fa-clock"></span> now
                                </span>
                            </div>
                        </div>`;

        $("#notification-content").prepend(notification);
        $('#dropdown-notifications-icon').fadeIn();
        $("#dropdown-notifications-icon").text(parseInt($("#dropdown-notifications-icon").text()) + 1);

    });