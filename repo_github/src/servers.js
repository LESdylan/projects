import express from 'express';
import path from 'path';
import dotenv from 'dotenv';
import { Octokit } from '@octokit/rest';

dotenv.config();

const app = express();
const port = 3000;

// Utiliser import.meta.url pour obtenir __dirname
const __dirname = path.dirname(new URL(import.meta.url).pathname);

// Spécifier correctement le chemin vers les vues dans le dossier 'pages'
app.set('views', path.join(__dirname, 'views/pages'));  
app.set('view cache',false);
// Définir le moteur de vue EJS
app.set('view engine', 'ejs');

// Octokit pour accéder à l'API GitHub
const octokit = new Octokit({
  auth: process.env.GITHUB_TOKEN,
});

// Fonction pour récupérer les dépôts GitHub
async function getRepos(username) {
  try {
    const response = await octokit.request('GET /users/{username}/repos', {
      username,
    });
    return response.data;
  } catch (error) {
    console.error('Erreur lors de la récupération des repos:', error);
    return [];
  }
}

// Route pour la page d'accueil
app.get('/', async (req, res) => {
  const username = 'dylan51100';  // Remplace par ton nom d'utilisateur GitHub
  const repos = await getRepos(username);

  res.render('index', {  // 'index' fait référence au fichier 'index.ejs' dans 'views/pages'
    title: 'Mon Portfolio GitHub',
    user: {
      name: username,
      totalRepos: repos.length,
      repos: repos.map((repo) => ({
        name: repo.name,
        description: repo.description,
        stars: repo.stargazers_count,
        html_url: repo.html_url,
        language: repo.language,
      })),
    },
  });
});

// Lancer le serveur
app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
