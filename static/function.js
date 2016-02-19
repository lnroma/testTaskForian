function showFormAttributeCreate() {

    var form = document.getElementById('formAttr');

    if (form.style.display == "block") {
        form.style.display = 'none';
    } else {
        form.style.display = 'block';
    }
}



function ajaxAttrib() {
    var name = document.getElementById('name');
    var place = document.getElementById('place');
    var typeInput = _getSelectedType();
    var requir = document.getElementById('requir').checked ? 1 : 0;
    var sing = document.getElementById('sing').checked ? 1 : 0;
    var req = new XMLHttpRequest();
    req.addEventListener('load',doneajax);
    req.open('POST','/contact/saveAttrib/ajax/true',true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    console.log(sing);
    req.send("name="+name.value
            +"&place="+place.value
            +"&type_input="+typeInput
            +"&required=1"+requir
            +"&placeholder="+place.value
            +"&show_in_greed="+sing);
}

/** wrap ajax to form **/
function doneajax() {
    console.log(this.response);
    var json = JSON.parse(this.response);
    var wrapForm = document.getElementById('js-wrapper');
    var wrapper = document.createElement('input');
    wrapper.setAttribute('type','text');
    wrapper.setAttribute('name','attrib['+json.id+']');
    wrapper.setAttribute('placeholder',json.place);
    var name = document.createTextNode(json.name+':');
    wrapForm.appendChild(name);
    wrapForm.appendChild(wrapper);
    alert(json.message);
}

function _getSelectedType() {
    var type = document.getElementById("type_input");
    var inputIndex = type.options[type.selectedIndex].value;
    console.log(inputIndex);
    return inputIndex;
}