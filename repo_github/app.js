// app.js ou server.js
const express = require('express');
const app = express();
const path = require('path');

// Définir EJS comme moteur de vue
app.set('view engine', 'ejs');

// Définir le dossier des vues (optionnel si c'est le dossier "views")
app.set('views', path.join(__dirname, 'views'));

// Pour servir les fichiers statiques (CSS, images, etc.)
app.use(express.static(path.join(__dirname, 'public')));
