var titre = document.title;

switch (titre) {
    case 'Tutti Frutti':
        document.getElementById('css').setAttribute('href', './styles/app.css');
        break;
    case 'Connexion':
        document.getElementById('css').setAttribute('href', './styles/userLogin.css');
        break;
    case 'Création de compte':
        document.getElementById('css').setAttribute('href', './styles/registration.css');
        break;
    case 'Informations':
        document.getElementById('css').setAttribute('href', './styles/releases.css');
        break;
    // Ajouter un case pour chaque nouvelle page
}