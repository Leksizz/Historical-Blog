function getSessionData() {
    fetch('/')
        .then(response => response.json())
        .then(session => {
            console.log(session);
        });
}