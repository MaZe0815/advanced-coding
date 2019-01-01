/* Global display function for shopping cart and inline search */
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

        var d_val = document.getElementById("input_inline_search");
        var d_res = document.getElementById("inline_search_results");

        if (d.style.display === "block" && d_val && d_res) {

            d_val.value = "";
            d_res.innerHTML = "";
        }

        d.style.display = "none";
    }
}

/* Global filter function for get params */
function filter_function(c_m, id) {

    url = new URL(window.location.href);

    console.log(url.searchParams.get('test'));

    if (c_m === "g") {

        if (url.searchParams.get('p')) {

            history.pushState({}, null, location.href.split('?')[0]);
        }

        insert_param("g", id);
    } else if (c_m === "p") {

        if (url.searchParams.get('p')) {

            history.pushState({}, null, location.href.split('?')[0]);
        }

        insert_param("c", id);
    } else if (c_m === "p_g") {

        if (location.href.includes('?')) {

            history.pushState({}, null, location.href.split('?')[0]);
            window.location.reload(true);
        }
    }
}

/* Global insert function for get params */
function insert_param(key, value) {

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

/* Asynchronious inline search function for product */
function asyn_search(path, target, search) {

    var len = document.getElementById('input_inline_search').value.length;

    if (len != 0 && len >= 5) {

        const markup = '<div class="card"><div><h2>###product_name####</h2></div><div class="manufacturer_platform"><p class="manufacturer_platform"> Plattform: <span>###platform####</span><br> Genre: <span>###genre####</span><br></p></div><div class="product_sub"><p><span class="price">Preis: ###price#### inkl. Mwst</span></p><a class="add_to_cart button button-primary" href="###base_url####/artikeluebersicht?pid=###product_id####" target="_self"><i class="fa fa-share"></i></a></div></div><hr>';

        var d = document.getElementById(target);
        d.style.display = "none";

        var xmlhttp;
        xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {

            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                if (xmlhttp.responseText !== "false") {

                    inline_search_results.innerHTML = "";
                    d.style.display = "none";

                    products = JSON.parse(xmlhttp.responseText);

                    for (var key in products) {
                        if (products.hasOwnProperty(key)) {

                            var product_markup = markup;
                            gross_price = new Intl.NumberFormat('de-DE', {style: 'currency', currency: 'EUR'}).format(products[key]['gross_price']);

                            var find = ["###product_name####",
                                "###base_url####", "###price####",
                                "###product_id####",
                                "###platform####",
                                "###genre####"];

                            var replace = [
                                products[key]['product_name'],
                                csrfObject.baseURL,
                                gross_price,
                                products[key]['id'],
                                products[key]['manucafturer_platform']['manufacturer'] + " " + products[key]['manucafturer_platform']['platform'],
                                products[key]['genre']['name']
                            ];

                            product_markup = replace_string(product_markup, find, replace);

                            inline_search_results.innerHTML += product_markup;
                        }
                    }

                    if (d.style.display === "none") {

                        d.style.display = "block";
                    }
                } else {

                    d.style.display = "none";
                }
            }
        }

        xmlhttp.open('POST', path, true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send('s=' + search);
    } else if (len == 0 || len < 5) {

        var d = document.getElementById(target);
        d.style.display = "none";
    }
}

/* String replace function for inline search markup */
function replace_string(str, find, replace) {

    for (var i = 0; i < find.length; i++) {

        str = str.replace(new RegExp(find[i], 'gi'), replace[i]);
    }
    return str;
}

/* Simple image replacement for article details */
function show_large(srcLarge) {

    document.getElementById("large_detail").src = srcLarge;
    return false;
}

/* Globally closing and handling of inline search behavior */
document.body.addEventListener("click", function (e) {

    var d = document.getElementById("inline_search");
    var d_val = document.getElementById("input_inline_search");
    var d_res = document.getElementById("inline_search_results");

    if (d.style.display === "block") {

        d_val.value = "";
        d_res.innerHTML = "";
        d.style.display = "none";
    } else {

        d_val.value = "";
    }

}, false);

/* Text cropping function */
var list = document.body.getElementsByClassName("crop");

for (var i = 0; i < list.length; i++) {

    crop_text_to_fit(list[i]);
}

function crop_text_to_fit(o) {

    var lastIndex;
    var txt = o.innerHTML;

    if (!o.title)
        o.title = txt;

    while (o.scrollHeight > o.clientHeight) {

        lastIndex = txt.lastIndexOf(" ");

        if (lastIndex == -1)
            return;
        txt = txt.substring(0, lastIndex);
        o.innerHTML = txt + "…";
    }
}

window.addEventListener('resize', function (event) {

    var list = document.body.getElementsByClassName("crop");

    for (var i = 0; i < list.length; i++) {
        crop_text_to_fit(list[i]);
    }
});

/* Topnav toggle */
function toggle_menu() {

    var x = document.getElementById("toggle_menu");

    if (x.className === "topnav") {

        x.className += " responsive";
    } else {

        x.className = "topnav";
    }
    return false;
}