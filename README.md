# SAé 2.01 - Consultation d'une base de donnée

### Auteur(s) : [Thibault MINNEBOO](mailto://thibault.minneboo@etudiant.univ-reims.fr)

## Installation / Configuration

Une fois arrivé sur le projet, veuillez suivre les instructions suivantes détaillant l'installation du projet :

1. Clonez le projet sur votre ordinateur personnel

```shell
git clone https://iut-info.univ-reims.fr/gitlab/minn0004/sae2-01.git
```

2. Dirigez-vous vers le répertoire nouvellement créé

```shell
cd sae2-01
```

3. Installez toutes les dépendances du projet

```shell
composer install
```

## Serveur Web Local

Afin de lancer le serveur de développement sur l'adresse [http://localhost:8000](http://localhost:8000/), veuillez utiliser les commandes suivantes : 

### Pour Linux

```shell
composer start:linux
```

### Pour Windows

```shell
composer start:windows
```

Par défaut, vous pouvez utiliser la commande `composer start` afin de lancer directement le serveur sous **Windows**.

## Style de codage

Nous utilisons dans ce projet la configuration PSR-12, voici les commandes nécessaire à la vérifications et à la correction des fichiers du projet : 

* Afin de vérifier la conformité des fichiers au standard PSR-12, veuillez taper la commande : 

```shell
composer test:cs
```

* Afin de corriger les fichiers non conformes au standard PSR-12, veuillez taper la commande : 

```shell
composer fix:cs
```