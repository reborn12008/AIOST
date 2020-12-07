/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

function getIds(filter){

}

function filterItems(){
    var filter = [];
    for(var i=0; i<checkbox.length; i++) {
        if(checkbox[i].checked){
            filter.push(checkbox[i].value);
        }
    }
    alert(filter);
}
var checkbox = document.getElementsByClassName("filtercheckbox");

for(var i=0; i<checkbox.length; i++) {
    checkbox[i].addEventListener("change",filterItems);
}

let newImageInput = document.getElementById("newmaterial_image");
if(newImageInput){
    newImageInput.addEventListener("change",previewImage);
}

function previewImage(event){
    var reader = new FileReader();
    reader.onload = function (){
        var img = document.getElementById("image_preview");
        img.src = reader.result;
        img.className="visible";
    }
    reader.readAsDataURL(event.target.files[0]);
}

var editImageInput = document.getElementById("material_image_input");
if(editImageInput){
    editImageInput.addEventListener("change",previewEditImage);
}

function previewEditImage(event){
    var reader = new FileReader();
    reader.onload = function (){
        var img = document.getElementById("edit_image_preview");
        img.src = reader.result;
        img.className="visible";
    }
    reader.readAsDataURL(event.target.files[0]);
}


var newcategoryradio = document.getElementsByName("categoryselect[]");
for(var k=0; k<newcategoryradio.length; k++) {
    newcategoryradio[k].addEventListener("click",toggleNewCatInput);
}

function toggleNewCatInput(event){
    var rbtn = event.target.value;
    var ctinput = document.getElementById("newcategoryinput");
    if(rbtn == "newcategory"){
        ctinput.removeAttribute("disabled");
    }else{
        ctinput.setAttribute("disabled",true);
    }
}

var neweditcategoryradio = document.getElementsByName("material_category_input[]");
for(var l=0; l<neweditcategoryradio.length; l++) {
    neweditcategoryradio[l].addEventListener("click",toggleEditNewCatInput);
}

function toggleEditNewCatInput(event){
    var rdbtn = event.target.value;
    var nctinput = document.getElementById("neweditcategoryinput");
    console.log(rdbtn);
    if(rdbtn == "neweditcategory"){
        nctinput.removeAttribute("disabled");
    }else{
        nctinput.setAttribute("disabled",true);
    }
}
