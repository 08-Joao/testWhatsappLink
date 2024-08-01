var whatsAppButton = document.getElementById("whatsapp");

whatsAppButton.addEventListener("click", async function() {
    try { 
        const response  = await fetch("./scripts/script.php", {
            method: "POST",
            body: JSON.stringify({action: "getWhatsAppLink"}),
            headers: {
                "Content-Type": "application/json"
            }
        });
    
        if (response.ok) {
            const data = await response.json();
            console.log("Resposta do PHP: ", data.link)

            window.open(data.link);
        }else { 
            console.log("Erro na resposta do servidor: ", response.statusText);
        }
    } catch (error) { 
        console.log("Erro na requisição: ",error)
    }
});

