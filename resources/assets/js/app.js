document.addEventListener("DOMContentLoaded", function() {
    const input = document.getElementsByName('photo')[0];

    input.onchange = function () {
        document.getElementsByClassName("filename")[0].innerHTML = this.value;
    };
});
