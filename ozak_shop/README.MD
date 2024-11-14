- Gesetion Des dépendanccs avec Composer
Dotenv : pour changer es variables d'env, comme les informations de connexion à la base de données
- PHP mailer: pour envoyer des mails de confirmation de commande
- Valitron ou Respect/Validation : pour la validation des données de formulaire

Fonctionnalités Principales

-Catalogue de Produits : Page principale avec liste et détails des produits.
- Recherche et Filtrage : Filtrer les produits par catégorie, prix, popularité, etc.
- Gestion du Panier : Ajouter, modifier et supprimer des articles.
- Commande et Paiement : Valider la commande et, si nécessaire, simuler un processus de paiement.
- Authentification des Utilisateurs : Inscription, connexion, profil utilisateur, historique de commandes.
- Administration (optionnel) : Un panneau d'administration pour gérer les produits, catégories, commandes.

7. Sécurité
- Validation et Échappement des Données : Utilisez htmlspecialchars pour toutes les données en sortie et PDO pour la base de données pour éviter les injections SQL.
- Gestion des Sessions : Assurez-vous que les sessions sont sécurisées, surtout pour les informations sensibles comme le panier et les données utilisateur.
- Mots de Passe : Utilisez password_hash et password_verify pour stocker les mots de passe.

8. API REST(optionnel)
Si vous prévoyez d’ajouter une application mobile ou des interactions AJAX, il peut être utile d'implémenter une API REST pour gérer les actions de la boutique (ajout au panier, consultation des produits, etc.). Créez un dossier /api et gérez des routes comme :

GET /api/products : Récupérer la liste des produits.
POST /api/cart/add : Ajouter un produit au panier.


```php
//routage simple
// public/index.php
require_once '../config/config.php';
require_once '../app/Controllers/ProductController.php';

$controller = new ProductController();
if ($_SERVER['REQUEST_URI'] === '/products') {
    $controller->index();
} elseif ($_SERVER['REQUEST_URI'] === '/product/show') {
    $controller->show($_GET['id']);
}

```