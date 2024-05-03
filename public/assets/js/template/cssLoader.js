const links = {
    'main': [
        '/'
    ],
    'user': [
        '/login',
        '/profile',
        '/register'
    ],
    'errors': [
        '/404'
    ],
    'post': [
        '/addPost',
    ]
};

function cssLoader(path) {
    for (let folder in links) {
        if (links.hasOwnProperty(folder)) {
            const files = links[folder];
            if (files.includes(path)) {
                $('<link>', {
                    rel: 'stylesheet',
                    type: 'text/css',
                    href: '/assets/css/' + folder + '.css'
                }).appendTo('head');
                console.log();
            }
        }
    }
}

$(document).ready(function () {
    cssLoader(window.location.pathname);
});