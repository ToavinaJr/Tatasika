// Exemple de fichier JS (script.js)

// Envoyer une requête vers le fichier PHP pour obtenir les données JSON
fetch('/src/api/php/send_data.php')
  .then(response => response.json())
  .then(data => {
    console.log('Données reçues de PHP:', data);
    
    // Utiliser les données (par exemple, les afficher dans le DOM)
    
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des données:', error);
  });
