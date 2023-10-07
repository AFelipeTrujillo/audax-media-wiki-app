# MediaWikiAPP
 
 The combined PHP and JavaScript application allows users to search for terms through an autocomplete function that queries the MediaWiki API. Once a user selects a term, the system attempts to store this term in a local database. If the term already exists or there is an issue, the user is notified.

# Integrated Development with PHP, JavaScript, and Docker Compose

## 1. Introduction

In today's modern web development landscape, understanding how backend and frontend technologies can come together in an integrated environment is essential. In this article, we'll explore an application that uses PHP for backend language, JavaScript on the frontend, and Docker Compose to orchestrate the development environment.

## 2. Backend: PHP

PHP is a widely-used server-side programming language. In our application:

- **Slim Framework** is employed to handle routing and HTTP responses.
- **Twig** is used as a templating engine to render views.
- The application connects to a MySQL database using PDO.
- Routes are provided to display pages, search an external API, and store selected terms in a database.

## 3. Frontend: JavaScript

The frontend, written in JavaScript with the jQuery library, provides user interactivity:

- **Autocomplete**: Users can search for terms, and search suggestions come from a query to the MediaWiki API.
- **Backend Integration**: Once a term is selected, JavaScript makes a POST request to the PHP server to store this term in the database. Users are notified based on the success or failure of this action.

## 4. Orchestration with Docker Compose

To ensure cohesive development and deployment, Docker Compose is used:

- **PHP**: There's a dedicated container serving the PHP application using Apache.
- **MySQL**: A MySQL container hosts the database.
- **Adminer**: It's a lightweight database management tool hosted in its own container.

These containers are interconnected, allowing the PHP application to communicate with the MySQL database. Docker Compose configuration also maps ports and volumes, facilitating development and data persistence.

![intro](https://i.imgur.com/6UIiMLv.png)

# How to install

1. Deploy docker container with **docker compose up**
2. Crear table in MySQL using **Admainer** in port 8081
3. Exec the next SQL code:
```
CREATE TABLE `audax_terms` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `term` varchar(150) NOT NULL UNIQUE,
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE='InnoDB';
```
4. Go to http://localhost:8080
5. Click en search
6. Look up for term