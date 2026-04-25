# ⚽ Sports Club Manager

> Application web de gestion pour club sportif (football) développée avec **Symfony 7.4**

---

## 🚀 Aperçu

**Sports Club Manager** est une plateforme permettant de :

* structurer la gestion des joueurs
* améliorer la discipline (absences, sanctions)
* organiser les entraînements et événements
* gérer le matériel du club

Objectif : **optimiser l’organisation globale d’un club sportif**

---

## 🧠 Contexte

Projet basé sur un besoin réel d’un coach de football :

* absences non signalées
* manque de discipline
* suivi des joueurs insuffisant
* gestion du matériel complexe

➡️ Application pensée comme un **outil métier concret**. 

---

## 🛠️ Stack technique

![Symfony](https://img.shields.io/badge/Symfony-7.4-black?logo=symfony)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql)
![Doctrine](https://img.shields.io/badge/Doctrine-ORM-FC6A31)
![Twig](https://img.shields.io/badge/Twig-Template-339933)
![Docker](https://img.shields.io/badge/Docker-Optional-2496ED?logo=docker)

---

## 🏗️ Architecture

Architecture Symfony propre et factorisée :

```bash
src/
 ├── Controller/
 ├── Entity/
 ├── Repository/
 ├── Service/
```

### Règles du projet

* pas de boolean → utilisation de **status**
* logique métier → **Service**
* code → **factorisé et maintenable**

---

## 👥 Utilisateurs

### 👨‍🏫 Coach / Admin

* gestion complète
* suivi discipline
* organisation club

### 🧑 Joueur

* consulté dans le système
* lié à une équipe et contacts

### 👨‍👩‍👧 Responsable

* contact d’urgence
* peut être lié à plusieurs joueurs

---

## 📦 Fonctionnalités

### 👤 Joueurs

* fiche complète (nom, âge, adresse…)
* plusieurs postes
* plusieurs contacts

### 📞 Contacts

* parent / tuteur / urgence
* relation many-to-many avec Player

### ⚽ Équipes & catégories

* équipes liées à catégories (U10, U15…)
* joueurs assignés

### 🏃 Entraînements

* date / lieu / équipe
* présence des joueurs
* matériel utilisé

### 🏆 Événements

* matchs / tournois
* liés aux équipes

### ❌ Absences

```txt
pending
justified
unjustified
```

### ⚠️ Sanctions

```txt
warning
suspension
exclusion
```

### 🎒 Matériel

```txt
available
in_use
damaged
missing
ordered
in_order
```

---

## 🧩 Modélisation

### Entités principales

* Player
* ContactPerson
* Team
* Category
* Training
* Event
* Attendance
* Sanction
* Equipment
* User

### Relations clés

* Player ↔ Contact → many-to-many
* Player ↔ Position → many-to-many
* Player → Team → many-to-one
* Player → Attendance → one-to-many
* Training ↔ Equipment → many-to-many
* Event ↔ Team → many-to-many

---

## 🔐 Sécurité

Gestion des rôles :

```txt
ROLE_ADMIN
ROLE_COACH
ROLE_USER
```

Protection :

```php
$this->denyAccessUnlessGranted('ROLE_USER');
```

---

## ⚙️ Installation

```bash
git clone https://github.com/LorianaD/sports_club_manager.git
cd sports_club_manager

composer install

cp .env .env.local

symfony console doctrine:database:create
symfony console doctrine:migrations:migrate

symfony server:start
```

---

## 🧪 Commandes utiles

```bash
symfony console make:controller
symfony console make:entity
symfony console make:form
```

---

## 🗺️ Roadmap

* [x] Cahier des charges
* [x] MCD
* [x] MLD
* [ ] Entités Symfony
* [ ] Player / Contact
* [ ] Gestion absences
* [ ] Gestion sanctions
* [ ] Gestion matériel
* [ ] Dashboard

---

## 🔮 Évolutions

* notifications (email)
* statistiques (discipline, présence)
* application mobile
* gestion des licences

---

## 📸 Screenshots

```md
![Dashboard](./public/screenshots/dashboard.png)
```

---

## 👩‍💻 Auteur

**Loriana DIANO**

* GitHub : [https://github.com/LorianaD](https://github.com/LorianaD)
* Portfolio : [https://loriana.dianoholding.com](https://loriana.dianoholding.com)
* LinkedIn : [https://www.linkedin.com/in/loriana-diano-33187ba8/](https://www.linkedin.com/in/loriana-diano-33187ba8/)

---

## ⭐ Points forts du projet

* basé sur un besoin réel
* modélisation solide (MCD → MLD)
* respect des bonnes pratiques Symfony
* logique métier claire (discipline + organisation)