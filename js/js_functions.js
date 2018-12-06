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

function filter_function(c_m, id) {

    if (c_m === "g") {
        insertParam("g", id);
    }

    if (c_m === "p") {
        insertParam("c", id);
    }
}

function insertParam(key, value) {

    key = escape(key);
    value = escape(value);
    var kvp = document.location.search.substr(1).split('&');
    if (kvp == '') {
        document.location.search = '?' + key + '=' + value;
    } else {

        var i = kvp.length;
        var x;
        while (i--) {
            x = kvp[i].split('=');
            if (x[0] == key) {
                x[1] = value;
                kvp[i] = x.join('=');
                break;
            }
        }

        if (i < 0) {
            kvp[kvp.length] = [key, value].join('=');
        }

        document.location.search = kvp.join('&');
    }
}

function asyn_search(path, target, search) {

    console.log(search);

    var xmlhttp;
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            document.getElementById(target).innerHTML = xmlhttp.response;
        }
    }
    xmlhttp.open('POST', path, true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('s=' + search);
}