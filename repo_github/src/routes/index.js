app.get('/', (req, res) => {
    // Rendre la vue "index.ejs" située dans le dossier "views"
    res.render('index', {
        title: 'Mon Portfolio GitHub',
        user: {
          name: 'Alice',
          totalRepos: 5,
          repos: [
            { name: 'Repo 1', description: 'Description du repo 1', stars: 10 },
            { name: 'Repo 2', description: 'Description du repo 2', stars: 5 }
          ]
        }
      });
      
  });
  