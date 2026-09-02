// Espera a página carregar
document.addEventListener("DOMContentLoaded", function() {
    let meuForm = document.getElementById("meuForm");
    
    if (meuForm) {
        meuForm.onsubmit = function(event) {
            // Seleciona todos os inputs e selects com a classe 'validar'
            let campos = document.querySelectorAll(".validar");
            let valido = true;

            for (let campo of campos) {
                if (campo.value.trim() === "") {
                    valido = false;
                    campo.style.border = "2px solid #FF4C4C"; 
                } else {
                    campo.style.border = "2px solid #333333";
                }
            }

            if (!valido) {
                alert("Por favor, preencha todos os campos obrigatórios!"); 
                event.preventDefault(); // Cancela o envio
            }
        };
    }
});