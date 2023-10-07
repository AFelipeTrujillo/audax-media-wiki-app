# MediaWikiAPP
 
 The combined PHP and JavaScript application allows users to search for terms through an autocomplete function that queries the MediaWiki API. Once a user selects a term, the system attempts to store this term in a local database. If the term already exists or there is an issue, the user is notified.

# Integrated Development with PHP, JavaScript, and Docker Compose

## 1. Introduction

In today's modern web development landscape, understanding how backend and frontend technologies can come together in an integrated environment is essential. In this code, we'll explore an application that uses PHP for backend language, JavaScript on the frontend, and Docker Compose to orchestrate the development environment.

## 2. Backend: PHP

PHP is a widely-used server-side programming language. In my application:

- **Slim Framework** ([go to main page](https://www.slimframework.com/)) is employed to handle routing and HTTP responses.
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

# Setting Up and Running the Application with Docker and MySQL

0. Open a terminal in the project folder.
1. Run the command: `docker-compose build`
2. Deploy the container using: `docker-compose up`
3. Open a new terminal tab.
4. Access **Adminer** by visiting [http://localhost:8081](http://localhost:8081).
5. Use the credentials provided in the `.env` file to log in.
6. Create a MySQL Table:
```
CREATE TABLE `audax_terms` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `term` varchar(150) NOT NULL UNIQUE,
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE='InnoDB';
```
7. Navigate to [http://localhost:8080](http://localhost:8080) in your web browser.
8. Click on the 'search' link or button to utilize the search functionality (http://localhost:8080/search).

# How to Read the Source Code

1. The **src** folder is set as a volume in the Docker container, mapped to **/var/www/html**.
2. Inside the **src** folder, you will find: The **public** folder which serves as the main entry point for the application. The main file named **index.php** ([go to file](https://github.com/AFelipeTrujillo/audax-media-wiki-app/blob/main/src/public/index.php)). This is where the application's core functionalities, including API endpoints and database connections, are defined.
3. The file **autocomplete.js** ([go to file](https://github.com/AFelipeTrujillo/audax-media-wiki-app/blob/main/src/public/autocomplete.js)) is a JavaScript script responsible for: Consuming the API endpoints defined in **index.php**. Providing autocomplete functionalities for the application.