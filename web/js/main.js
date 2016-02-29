// @codekit-prepend "vendor/jquery-2.2.1.js"

$(document).ready(function () {

    $("body > header").on("click", "a#burger", function () {
        event.preventDefault();
        $("body > header ul.nav").toggleClass("show");
    });

});