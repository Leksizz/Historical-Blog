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
    'blog': []
};

function cssLoader(path) {
    for (let folder in links) {
        if (links.hasOwnProperty(folder)) {
            const files = links[folder];
            if (files.includes(path)) {
                $('<link>', {
                    rel: 'stylesheet',
                    type: 'text/css',
                    href: '/public/css/' + folder + '.css'
                }).appendTo('head');
                console.log();
            }
        }
    }
}

$(document).ready(function () {
    cssLoader(window.location.pathname);
});