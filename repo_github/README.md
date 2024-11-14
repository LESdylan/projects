# Repo-Gallery
- [documentation ocotkit](https://github.com/octokit/octokit.js?tab=readme-ov-file#features)
- [using the rest API](https://docs.github.com/en/rest/using-the-rest-api)
- [remix icon](https://remixicon.com/)

---
# definition of work
- work in module
```bash
    node server.js
```

```bash
project-root/
├── assets/
│   ├── images/                    # Images utilisées dans le projet
│   ├── icons/                     # Icônes utilisés dans le projet
│   ├── modules/                   # Modules de style, JS ou CSS
├── config/
│   ├── db.js                      # Connexions à la base de données
│   └── appConfig.js               # Configurations de l'application
├── controllers/
│   ├── apiController.js           # Contrôleur pour gérer les appels à l'API
│   └── viewController.js          # Contrôleur pour la logique de rendu des vues
├── middleware/
│   ├── auth.js                    # Middleware d'authentification
│   └── errorHandler.js            # Middleware pour la gestion des erreurs globales
├── models/
│   └── Repo.js                    # Modèle pour les données des dépôts GitHub
├── node_modules/                  # Modules npm installés
├── public/
│   ├── css/                       # Fichiers CSS pour le front-end
│   ├── js/                        # Scripts JavaScript pour le front-end
│   └── images/                    # Images statiques pour le front-end
├── routes/
│   ├── apiRoutes.js               # Routes pour les appels API
│   └── viewRoutes.js              # Routes pour les pages du site
├── sass/
│   ├── abstracts/                 # Variables, mixins Sass
│   ├── base/                      # Styles de base, typographie
│   ├── components/                # Styles pour les composants spécifiques
│   ├── layout/                    # Styles pour la mise en page (header, footer, etc.)
│   └── pages/                     # Styles pour des pages spécifiques
├── src/
│   ├── utils/
│   │   └── helpers.js             # Fonctions utilitaires génériques
│   ├── server.js                  # Point d'entrée pour démarrer le serveur
│   └── .env                       # Variables d'environnement
├── views/
│   ├── partials/                  # Vues partielles comme le header, le footer, la sidebar
│   ├── pages/                     # Pages principales comme l'index, les détails des projets
│   └── templates/                 # Modèles réutilisables pour les vues
├── .gitignore                     # Fichiers à ignorer par Git
├── app.js                         # Point d'entrée principal de l'application
├── package-lock.json              # Lock des dépendances npm
├── package.json                   # Informations sur le projet et les dépendances
└── README.md                      # Documentation du projet

```