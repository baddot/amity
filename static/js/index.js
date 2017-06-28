document.querySelector("section.login form").addEventListener("submit", function(e) {
    e.preventDefault();
    const r = new XMLHttpRequest();
    r.open("POST", "/login", true);
    r.cache = r.contentType = r.processData = false;
    r.onload = () => {
        if (r.readyState === 4 && r.status === 200) {
            if (Boolean(JSON.parse(r.responseText)) === true) {
                window.location.href = "/user";
            } else {
                new Notyf({
                    delay: 7000
                }).alert("Такого пользователя не существует!");
            }
        }
    };
    r.send(new FormData(this));
});