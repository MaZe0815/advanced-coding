/* Global display function for shopping car and inline search */
function display_function(id, cid) {

    var display_id = id;
    var clicked_id = cid;
    var d = document.getElementById(display_id);

    var classes = document.getElementById(clicked_id);
    var classes_names = classes.className;

    if (classes_names.includes("fa-") === true) {

        classes.classList.add("fa-close");
        classes.classList.add("active");
    }

    if (classes_names.includes("fa-close") === true) {

        classes.classList.remove("fa-close");
        classes.classList.remove("active");
    }

    if (d.style.display === "none") {
        d.style.display = "block";
    } else {
        d.style.display = "none";
    }
}