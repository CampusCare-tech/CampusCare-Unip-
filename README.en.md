# CampusCare-Unipê

[![Status](https://img.shields.io/badge/status-Em%20Desenvolvimento-orange)](README.md)
[![Language: PT-BR](https://img.shields.io/badge/Linguagem-Português-green)](README.md)
[![Language: EN](https://img.shields.io/badge/Language-English-red)](README.en.md)

**Optimizing campus maintenance and security with the collaboration of students and administrative teams.**

---

## **Project Description**

CampusCare-Unipê** is a web system designed to facilitate communication between students and the administrative areas of educational institutions, allowing the identification and agile resolution of needs on campus.

Students can report problems or needs in specific blocks of the institution, such as maintenance, cleaning, security or health, directly to those responsible, promoting a more organized and secure environment.

---

## **Functionalities**

### **Student use flow**

1. **Select the block**:

   - Initial interface with the available campus blocks.

2. **Select the area within the block**:

   - Buttons to choose the area that needs assistance (e.g. room, bathroom, elevator).

3. **Enter exact location**:

   - Form to enter details (e.g. “Room A23”, “2nd floor men's restroom”).

4. **Choose the type of assistance**:

   - Buttons for categories such as **maintenance**, **cleaning**, **security**, or **health**.

5. **Describe the problem**:

   - Form to detail the need (e.g. “air conditioning not working”, “computer 345 broken”).

6. **Automatic forwarding to the area responsible**:
   - Data is sent to the corresponding table in the database and will be available to the area's administration team.


### Administrative Area

- Statistics dashboard  
  The home page of the administrative area displays cards with call statistics:  
  - Open Calls  
  - Calls Completed  
  - Resolution Rate  
  These cards are interactive, allowing the administrator to select which set of calls they wish to view.

- Call filtering  
  When you click on one of the cards (e.g. Open or Completed Calls), the system updates the service button links (maintenance, cleaning, health or security) to show the corresponding list, without altering the database.

---

## Technologies Used

- Front-end  
  - HTML  
  - CSS  
  - JavaScript

- **Back-end:**  
  - PHP  
  - MySQL (via PHPMyAdmin in XAMPP)

- Version control:**  
  - Git

---

## **Environment configuration**

### 1. Install XAMPP:

- Download XAMPP from its [official website](https://www.apachefriends.org/index.html) and install.
- Start the **Apache** and **MySQL** services in the control panel.

### 2. Configure the Database:

- Access **PHPMyAdmin** in the browser via `http://localhost/phpmyadmin`.
- Create a database with the name `unipe_campuscare_db`.
- Run the following SQL script to create the tables:

```sql
-- Database creation
CREATE DATABASE IF NOT EXISTS unipe_campuscare_db;
USE unipe_campuscare_db;

-- Table for maintenance calls
CREATE TABLE maintenance_calls (
    id INT PRIMARY KEY AUTO_INCREMENT,
    block VARCHAR(100) NOT NULL,
    local_type VARCHAR(50) NOT NULL,
    local_identification VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    status ENUM('Open', 'Completed') DEFAULT 'Open', -- Added
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for cleaning tickets
CREATE TABLE cleaning_calls (
    id INT PRIMARY KEY AUTO_INCREMENT,
    block VARCHAR(100) NOT NULL,
    local_type VARCHAR(50) NOT NULL,
    local_identification VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    status ENUM('Open', 'Completed') DEFAULT 'Open', -- Added
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for security calls
CREATE TABLE security_calls (
    id INT PRIMARY KEY AUTO_INCREMENT,
    block VARCHAR(100) NOT NULL,
    local_type VARCHAR(50) NOT NULL,
    local_identification VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    status ENUM('Open', 'Completed') DEFAULT 'Open', -- Added
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for health calls
CREATE TABLE health_calls (
    id INT PRIMARY KEY AUTO_INCREMENT,
    block VARCHAR(100) NOT NULL,
    local_type VARCHAR(50) NOT NULL,
    local_identification VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    status ENUM('Open', 'Completed') DEFAULT 'Open', -- Added
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for administrators
CREATE TABLE IF NOT EXISTS admin_login (
    id INT PRIMARY KEY AUTO_INCREMENT,
    admin_username VARCHAR(50) NOT NULL UNIQUE,
    admin_password VARCHAR(255) NOT NULL -- password stored with password_hash()
);

INSERT INTO admin_login (admin_username, admin_password) VALUES ('admin', 'generated hash');
```

### 3. Configure the Project Code:

1. Clone the project repository:
   ```bash
   git clone https://github.com/CampusCare-tech/CampusCare-Unipe.git
   ```
2. Move the files to the XAMPP `htdocs` folder.
3. Make sure that the PHP files and the database are connected correctly:

   - Configure the `db_connection.php` file with the database data:

   ```php
   <?php
    function connect() {
      // Database settings
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $dbname = 'unipe_campuscare_db';

      // Connection creation
      $dbConnection = new mysqli($host, $user, $password, $dbname);

      // Checks for errors in the connection
      if ($dbConnection->connect_error) {
          die("Connection failed: ” . $dbConnection->connect_error);
      }

      return $dbConnection; // Return the connection object
    }
   ?>

   ```


4. Open your browser and go to
   user area: `http://localhost/CampusCare-Unipe/00-public/index.php`.
   administrative area: `http://localhost/CampusCare-Unipe/02-admin/admin_home.php`.

---

## Project structure

```plaintext
📁 CampusCare-Unipê
├── 📂 00-public
│ ├── 📂 assets # Project assets (CSS, images, JS, webfonts)
│ ├── blocks.php
│ └── index.php # Project home page
│
├── 📂 01-includes # PHP files for internal functionality
│ ├── db_connection.php # Database configuration
│ └── process.php # Forms processing
│
├── 📂 02-admin # System admin area
│ ├── 📂 templates # Administration page templates
│ │ ├── admin_home_template.php
│ │ ├── admin_login_template.php
│ │ ├── admin_service_template.php
│ ├── admin_complete_call.php
│ ├── admin_home.php
│ ├── admin_login.php
│ ├── admin_logout.php
│ ├── admin_register.php
│ └── admin_service.php
│
├── 📂 03-sql
│ └── create_database.sql # Script for creating the database
│
├── 📂 scripts
│ └── generate_admin_hash.php # Script for generating admin password hash
│
├── .gitignore # File for deletions in Git versioning
├── README.en.md # Documentation in English
└── README.md # Project documentation
```

---

## **Future Improvements**

- Restructure the directory adopting the MVC standard.
- Allow monitoring of ticket status.
- Implement notifications for call handlers.

## **Contributors**

Thanks to everyone who contributed to the development of this project:

- [Rafael Magno G.](https://github.com/rafaelmagnog)
- [Levi Adler](https://github.com/LeviAdler05)
- [José Edgar](https://github.com/JoseEdgar5508)
- [José Henrique](https://github.com/hique022)

---
