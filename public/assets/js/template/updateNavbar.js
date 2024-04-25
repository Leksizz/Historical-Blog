async function updateNavbar() {
    try {
        const response = await $.ajax({
            url: '/getSession',
            method: 'GET',
            dataType: 'json'
        });
        let navbarContent;
        if (response.session) {
            navbarContent = `
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 dropstart">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="nickname" href="#" role="button" data-bs-toggle="dropdown">
                            </a>
                            <ul class="dropdown-menu bg-dark">
                                <li><a class="profile dropdown-item text-light" href="/profile"><i class="fa-solid fa-user pe-2"></i>Профиль</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="exit dropdown-item text-light" href="/logout"><i class="fa-solid fa-door-open pe-2"></i>Выход</a></li>
                            </ul>
                        </li>
                    </ul>
            `;
            document.getElementById('navbarSupportedContent').innerHTML = navbarContent;
            const nickname = document.getElementById('nickname');
            nickname.innerHTML = response.session.nickname;
        } else {
            navbarContent = `
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"></li>
                    </ul>
                    <a class="me-3 btn btn-secondary" href="/register" role="button">Регистрация</a>
                    <a class="btn btn-secondary" href="/login" role="button">Вход</a>
            `;
            document.getElementById('navbarSupportedContent').innerHTML = navbarContent;
        }
    } catch (error) {
        console.error('Ошибка при выполнении запроса:', error);
    }
}

$(document).ready(function () {
    updateNavbar();
});