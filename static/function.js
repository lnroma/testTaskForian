function showFormAttributeCreate() {

    var form = document.getElementById('formAttr');

    if (form.style.display == "block") {
        form.style.display = 'none';
    } else {
        form.style.display = 'block';
    }
}

var name = document.getElementById('name');

function ajaxAttrib() {
    var place = document.getElementById('place');
    var type_input = document.getElementById('type_input');
    var requir = document.getElementById('requir');
    var sing = document.getElementById('sing');
    var req = new XMLHttpRequest();
    req.addEventListener('load',doneajax);
    req.open('POST','/contact/saveAttrib/ajax/true',true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send("name="+name.value
            +"&place="+place.value
            +"&type_input=text"
            +"&required="+requir.value
            +"&placeholder="+place.value
            +"&show_in_greed="+sing.value);
}

function doneajax() {
    var json = JSON.parse(this.response);
    var html = name+':<input type="text" name="attrib['+json.id+']>';
    var form = document.getElementsByClassName('create_contact');
    form[0].innerHTML = html;
    //form.innerHTML(html);
}