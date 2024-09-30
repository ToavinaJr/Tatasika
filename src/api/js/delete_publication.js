function deletePublication(id) {
    fetch("src/api/php/delete_publication.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({"publication_id": id}) // Envoi du bon paramètre
    })
    .then(response => response.json()) // Transformation de la réponse en JSON
    .then(data => {
        if (data.status === "success") {
            console.log("Publication supprimée avec succès : ", data);
            // Optionnel : Supprimer l'élément visuellement du DOM si nécessaire
            document.getElementById(`publication-${id}`).remove();
        } else {
            console.error("Erreur lors de la suppression de la publication : ", data.message);
        }
    })
    .catch(error => {
        console.error("Une erreur est survenue : ", error);
    });
}
