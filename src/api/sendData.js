

const btn = document.getElementById("send-btn");

btn.addEventListener('click', function() {
    const data = 1

    const response = fetch("src/api/getData.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    });
    
    
})