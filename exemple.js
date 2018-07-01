document.querySelector('body').addEventListener('click', function(el) {
    if(el.target.dataset.action === "infos") {
        const id = el.target.dataset.id;
        let xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
                const user = JSON.parse(this.response);
                debugger;
            }
        }
        xhttp.open("GET", "http://192.168.33.10/student/get/" + id, true);
        xhttp.send();
    }
});