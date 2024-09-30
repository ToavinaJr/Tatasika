function deletePublication(id) {
    console.log(id);
    fetch("http://localhost:12345/src/api/php/delete_publication.php",
        {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({"publication_id": id}) // Envoi du bon paramètre
        }
    )    
    .then(data => {
        console.log("Données reçues : ", data);
    })
    .catch(error => {
        console.error("Une erreur est survenue : ", error);
    });   
}
