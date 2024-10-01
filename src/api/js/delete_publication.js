function deletePublication(id) {
    fetch("src/api/php/delete_publication.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({"publication_id": id}) // Envoi du bon paramètre
    }) 
    .then(data => {
        if (data.status === "success") {
            location.reload();
        
         } 
         
    })
    .catch(error => {
        console.error("Une erreur est survenue : ", error);
    });

}
