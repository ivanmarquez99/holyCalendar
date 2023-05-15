window.addEventListener("load", function() {
    var cambio = document.getElementById("password");
    var eye = document.querySelector('#button-see')
    
    eye.addEventListener("click", function() {
        
        if(cambio.type == "password"){
          cambio.type = "text";
          eye.innerHTML = '<i class="bi bi-eye-fill"></i>';
        } else {
          cambio.type = "password";
          eye.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
        }
    })
})

window.addEventListener("load", function() {

    tinymce.init({
        language: 'es',
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        toolbar: 'undo redo | blocks fontsize | bold italic underline strikethrough | link image media table | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name'
    });
})


function verificarPasswords() {
 
  
    // Ontenemos los valores de los campos de contraseñas 
    pass1 = document.getElementById('pass1');
    pass2 = document.getElementById('pass2');
 
    // Verificamos si las constraseñas no coinciden 
    if (pass1.value != pass2.value) {
 
        // Si las constraseñas no coinciden mostramos un mensaje 
        document.getElementById("error").classList.add("mostrar");
 
        return false;
    } else {
 
        // Si las contraseñas coinciden ocultamos el mensaje de error
        document.getElementById("error").classList.remove("mostrar");
 
        // Mostramos un mensaje mencionando que las Contraseñas coinciden 
        document.getElementById("ok").classList.remove("ocultar");
 
        // Desabilitamos el botón de login 
        document.getElementById("login").disabled = true;
 
        // Refrescamos la página (Simulación de envío del formulario) 
        setTimeout(function() {
            location.reload();
        }, 3000);
 
        return true;
    }

}


function descriptionModal(id) {

   var description = document.querySelector("#"+id).getAttribute('data-description');
   document.querySelector("#eventDescription").innerHTML = description;

   let myModal = new bootstrap.Modal('#modalDescription', {
    keyboard: false
    });
    myModal.show();
}