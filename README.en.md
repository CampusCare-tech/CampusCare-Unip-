# **CampusCare-Unipê**

![Status](https://img.shields.io/badge/status-In%20Development-orange)
[![Language: PT-BR](https://img.shields.io/badge/Language-Portuguese-green)](README.md)
[![Language: EN](https://img.shields.io/badge/Language-English-red)](README.en.md)

**Optimizing campus maintenance and safety with the help of students.**

---

## **Project Description**

**CampusCare-Unipê** is a web system designed to streamline communication between students and administrative areas of educational institutions, enabling quick identification and resolution of campus needs.

Students can report issues or needs in specific campus blocks, such as maintenance, cleaning, security, or health, directly to the responsible teams, promoting a more organized and safer environment.

---

## **Features**

### **Student Workflow**

1. **Select the block**:

   - Initial interface displaying available campus blocks.

2. **Select the area within the block**:

   - Buttons to choose the area needing assistance (e.g., classroom, restroom, elevator).

3. **Provide the exact location**:

   - Form to input details (e.g., "Room A23," "2nd-floor men's restroom").

4. **Choose the type of assistance**:

   - Buttons for categories such as **maintenance**, **cleaning**, **security**, or **health**.

5. **Describe the issue**:

   - Form to detail the need (e.g., "air conditioner not working," "computer 345 broken").

6. **Automatic forwarding to the responsible area**:
   - Data is sent to the corresponding database table and will be available for the responsible administrative team.

---

## **Project Requirements**

### **Technologies Used**

- **Front-end**:

  - HTML
  - CSS
  - JavaScript

- **Back-end**:

  - PHP
  - MySQL (via PHPMyAdmin in XAMPP)

- **Version Control**:
  - Git

### **Required Environment**

1. **Local Server**:
   - XAMPP installed to configure Apache server and MySQL database.
2. **Browser**:
   - Any modern browser (e.g., Google Chrome, Mozilla Firefox).
3. **Code Editor**:
   - Recommended: Visual Studio Code with extensions for PHP, HTML, and CSS.

---

## **Environment Setup**

### 1. Install XAMPP:

- Download and install XAMPP from its [official page](https://www.apachefriends.org/index.html).
- Start the **Apache** and **MySQL** services in the control panel.

### 2. Configure the Database:

- Access **PHPMyAdmin** in your browser via `http://localhost/phpmyadmin`.
- Create a database named `unipe_campuscare_db`.
- Execute the following SQL script to create the tables:

```sql
-- Database creation
CREATE DATABASE IF NOT EXISTS unipe_campuscare_db;
USE unipe_campuscare_db;

-- Maintenance requests table
CREATE TABLE chamados_manutencao (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bloco VARCHAR(100) NOT NULL,
    local_tipo VARCHAR(50) NOT NULL,
    local_identificacao VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Cleaning requests table
CREATE TABLE chamados_limpeza (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bloco VARCHAR(100) NOT NULL,
    local_tipo VARCHAR(50) NOT NULL,
    local_identificacao VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Security requests table
CREATE TABLE chamados_seguranca (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bloco VARCHAR(100) NOT NULL,
    local_tipo VARCHAR(50) NOT NULL,
    local_identificacao VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Health requests table
CREATE TABLE chamados_saude (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bloco VARCHAR(100) NOT NULL,
    local_tipo VARCHAR(50) NOT NULL,
    local_identificacao VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contact-us table
CREATE TABLE chamados_contate (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL,
    assunto VARCHAR(100) NOT NULL,
    mensagem TEXT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 3. Configure the Project Code:

1. Clone the project repository:
   ```bash
   git clone https://github.com/CampusCare-tech/CampusCare-Unipe.git
   ```
2. Move the files to the `htdocs` folder in XAMPP.
3. Ensure the PHP files and the database are correctly connected:

   - Configure the `db_connection.php` file with the database details:

   ```php
   <?php
    function conectar() {
      // Database settings
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $dbname = 'unipe_campuscare_db';

      // Creating the connection
      $dbConnection = new mysqli($host, $user, $password, $dbname);

      // Check for connection errors
      if ($dbConnection->connect_error) {
          die("Connection failed: " . $dbConnection->connect_error);
      }

      return $dbConnection; // Returns the connection object
    }
   ?>
   ```

4. Open your browser and access `http://localhost/CampusCare-Unipe/00-public/index.php`.

---

## **Project Structure**

```plaintext
📁 CampusCare-Unipê
├── 📂 00-public
│   └── index.php       # Project homepage
├── 📂 assets           # Project resources
│   ├── 📂 css
│   │   ├── bg.gif
│   │   ├── bgs.jpg
│   │   ├── buttons.css
│   │   ├── fontawesome-all.min.css
│   │   ├── main.css
│   │   ├── noscript.css
│   │   └── overlay.png
│   ├── 📂 images
│   │   ├── campus.jpg  # Campus map image
│   │   └── mapa.png    # Detailed map image
│   ├── 📂 js
│   │   ├── breakpoints.min.js
│   │   ├── browser.min.js
│   │   ├── jquery.min.js
│   │   └── main.js
│   └── 📂 webfonts     # Fonts used in the project
├── 📂 01-includes      # Internal PHP functionality files
│   ├── contate_nos.php # Page for improvement suggestions
│   ├── db_connection.php # Database configuration
│   └── processar.php   # Form processing
├── 📂 02-sql
│   └── create_database.sql # Script for database creation
├── .gitignore          # File for versioning exclusions in Git
├── README.md           # Project documentation

```

---

## **Future Improvements**

- **Admin Dashboard with Statistics**: Develop a control panel to display statistics based on stored data.
- **Restructure Directory**: Adopt the MVC pattern.
- **Admin Pages**: Create specific admin interfaces for each responsible area.
- **Request Tracking**: Enable users to track the status of their requests.
- **Notifications**: Implement notifications for the responsible teams.

## **Contributors**

Special thanks to everyone involved in the development of this project:

- [Rafael Magno G.](https://github.com/rafaelmagnog)
- [Levi Adler](https://github.com/LeviAdler05)
- [José Edgar](https://github.com/JoseEdgar5508)
- [José Henrique](https://github.com/hique022)

---
