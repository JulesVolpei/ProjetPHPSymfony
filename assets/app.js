import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import './styles/userLogin.css';
import './styles/registration.css';
import './js/jquery-3.7.1.min.js';
import './js/random.js';
// Ajouter les routes vers les nouveaux styles

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

var titre = document.title;

switch (titre) {
    case 'Hello HomePageController!':
        document.getElementById('css').setAttribute('href', './styles/app.css');
        break;
    case 'Log in!':
        document.getElementById('css').setAttribute('href', './styles/userLogin.css');
        break;
    case 'Création de compte':
        document.getElementById('css').setAttribute('href', './styles/registration.css');
        break;
    // Ajouter un case pour chaque nouvelle page
}
