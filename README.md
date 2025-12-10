 ---------------
| Symfony-Books |
 ---------------

Partie Rouge : Loic
Partie Verte : Jason
Partie Violette : David

-------------------------------------------------------------------------

Etapes pour restaurer le projet Symfony-Books :

1 - Télécharger le projet :
git clone https://github.com/N0zik/symfony-books.git

2.1 - Installer Composer :
composer install
ou
composer i

2.2 - npm run build

3 - Télécharger la BDD symfony-books.sql :
https://github.com/N0zik/symfony-books/blob/master/symfony-books.sql

4 - Créer la BDD symfony-books dans PhpMyAdmin :
Choisir l'interclassement utf8mb4_general_ci

5 - Restaurer la base BDD dans PhpMyAdmin :
Cliquer sur importer puis sélectionner le fichier symfony-books.sql

6 - Lancer le serveur :
symfony serve

7 - Accéder au site depuis le navigateur :
http://localhost:8000/

-------------------------------------------------------------------------

Comptes déjà créés dans la BDD :

Compte utilisateur simple :
Email : test@test.com
MDP : azerty

Compte utilisateur banni :
Email : banni@test.com
MDP : azerty

Compte administrateur :
Email : admin@admin.com
MDP : azerty

-------------------------------------------------------------------------

A savoir :

Un visiteur a accès au site complet, mais ne peut utiliser aucun service. Il doit soit s'inscrire, soit se connecter.

Un utilisateur simple a accès au site complet, il peut utiliser les services (payer un abonnement, emprunter, commenter et noter des livres, réserver des salles de travail, éditer ses informations personnelles ainsi que ses informations de connexion depuis son profil). Consulter son historique d'emprunts de livres et son historique de réservations de salles de travail.
=> Système de paiement de l'abonnement non réussi. L'utilisateur a donc accès à tout sans être passé par la case paiement.

Un utilisateur banni a accès au site complet, mais ne peut plus utiliser aucun service. Il voit la mention "Votre compte est Banni : Vous ne pouvez plus accéder aux services." dans son profil. Il peut visualiser la bibliothèque mais n'a plus accès aux fonctions.

Un administrateur a accès au site complet, en plus des fonctions de l'utilisateur simple, il a accès à une page d'administration où il peut :
- Gérer les utilisateurs
- Gérer les salles de travail
- Gérer les livres
- Gérer les commentaires
- Gérer l'abonnement
