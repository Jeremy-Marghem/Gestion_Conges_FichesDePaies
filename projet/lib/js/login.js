var form = document.getElementById("formulaire");

form.addEventListener("submit",function(e){
    if(form.elements.login.value!=="jeremy"){
       form.elements.login.style.borderColor = "red";
       form.elements.login.value = "";
       form.elements.password.value="";
       e.preventDefault();
    }
});


