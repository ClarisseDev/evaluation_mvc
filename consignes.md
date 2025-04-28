# DWWM2024-11 BGE 2025/04/28
## Objectif
ECF Composants métier côté serveur, évaluation

## CDC
Une personne (aisée) possède un ou plusieurs biens (maison ou appartement), et doit payer des taxes foncières annuellement, indexées à leur surface, à leur situation géographique (il y a 2 régions: l'occitanie et le reste de la France), et éventuellement au fait qu'il dispose d'une piscine ou pas.
Le but est donc de faire une page Web qui me restitue la taxe que doit payer n'importe quel contribuable, fonction des biens qu'il possède.

## Détail
Les coûts:
- Occitanie: appartement (12 €/m2), maison (14 €/m2)
- Reste de la France: appartement (13 €/m2), maison (15 €/m2)
- Si piscine, un coût de 100€ est rajouté (quelque soit la région)
Une personne est caractérisée par: nom, prénom (ex: Durand, Paul)
Un appartement: région, ville, surface, étage (ex: Occitanie, Carcassonne, 150, 3)
Une maison: région, ville, surface, piscine ou pas (ex: Paca, SaintTropez, 100, oui)

## Consignes
- compétences en Architecture MVC, POO, Héritage, Composition sont à priori demandées
- le modèle est à soigner en priorité
- le programme principal est: index.php, il doit me permettre de rentrer facilement un scénario de fonctionnement (la personne, les biens)
- en version de base il me faut un rendu HTML simple mais conforme (toutes les balises nominales)
- IL EST POSSIBLE de simplifier le CDC s'il vous semble inabordable dans les temps: indiquer alors dans l'entête en commentaire ce que vous me livrez 
(par exemple vous ne gérez pas les maisons, ou on ne peut avoir qu'un bien par catégorie, ou ??) : je préfère avoir un scénario simplifié mais fonctionnel, qu'une usine à gaz qui ne focntionne pas bien sûr!
- soigner le codage (le nom des fichiers, des classes, des attributs, pas d'espace, ni d'accent dans les fichiers et répertoires)
- vérifier votre livraison (un NomPrénom.zip svp)

## Aide
Il s'agit de gérer une composition (1 classe est en lien 1..n avec une autre), on a fait un TD équivalent.
De plus il y a peut-être de l'héritage à implanter (n'y a-t-il pas de points communs entre la Maison et l'Appartement?).
Commencer par le Modèle, je rappelle qu'une classe=1 nom, des attributs, des méthodes

# Bonus
- Gérer la persistance dans un fichier (toutes vos simulations sont stockées dans un fichier texte ouvert en mode append, cf: https://phpsources.net/tutoriel-fichiers.htm)
- ou dans une BD Mysql
- faire une vue de qualité (avec css)

## Attendus
exemple de rendu:
Paul Durand possède:
- 1 appartement (Carcassonne, Occitanie) de 100 m2 étage 3: 1200€
- 1 appartement (Lyon, RhoneAlpes) de 50m2 étage 1: 750€
- 1 maison (SaintTropez, Paca) de 100 m2 avec Piscine: 1600€
Taxes foncières: 3550€

Bon courage, rendu vers 17h svp sur Elerni dans la rubrique AF, certains sont autorisés à le rendre 2h plus tard
