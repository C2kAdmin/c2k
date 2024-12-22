// mods/mod_contacto/mod_contacto.js

document.addEventListener("DOMContentLoaded", function() {
    const contactForm = document.getElementById("contactForm");

    contactForm.addEventListener("submit", function(event) {
        event.preventDefault();
        
        const formData = new FormData(contactForm);
        
        fetch("mods/mod_contacto/contact_me.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                document.getElementById("success-message").style.display = "block";
                document.getElementById("error-message").style.display = "none";
                contactForm.reset();
            } else {
                document.getElementById("success-message").style.display = "none";
                document.getElementById("error-message").style.display = "block";
            }
        })
        .catch(error => {
            document.getElementById("success-message").style.display = "none";
            document.getElementById("error-message").style.display = "block";
        });
    });
});
