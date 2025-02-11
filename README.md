# CampusCare-Unipê

[![Status](https://img.shields.io/badge/status-Em%20Desenvolvimento-orange)](README.md)
[![Idioma: PT-BR](https://img.shields.io/badge/Linguagem-Português-green)](README.md)
[![Language: EN](https://img.shields.io/badge/Language-English-red)](README.en.md)

**Otimizando a manutenção e segurança do campus com a colaboração dos alunos e equipes administrativas.**

---

## **Descrição do Projeto**

O **CampusCare-Unipê** é um sistema web projetado para facilitar a comunicação entre alunos e áreas administrativas de instituições de ensino, permitindo a identificação e resolução ágil de necessidades no campus.

Os alunos podem relatar problemas ou necessidades em blocos específicos da instituição, como manutenção, limpeza, segurança ou saúde, diretamente para os responsáveis, promovendo um ambiente mais organizado e seguro.

---

## **Funcionalidades**

### **Fluxo de uso pelo aluno**

1. **Selecionar o bloco**:

   - Interface inicial com os blocos do campus disponíveis.

2. **Selecionar a área dentro do bloco**:

   - Botões para escolher a área que precisa de assistência (ex.: sala, banheiro, elevador).

3. **Informar a localização exata**:

   - Formulário para inserir detalhes (ex.: "Sala A23", "Banheiro masculino do 2º andar").

4. **Escolher o tipo de assistência**:

   - Botões para categorias como **manutenção**, **limpeza**, **segurança**, ou **saúde**.

5. **Descrever o problema**:

   - Formulário para detalhar a necessidade (ex.: "ar-condicionado não funciona", "computador 345 quebrado").

6. **Envio automático para a área responsável**:
   - Dados são enviados para a tabela correspondente no banco de dados e estarão disponíveis para a equipe de administração da área.


### Área Administrativa

- **Dashboard de Estatísticas:**  
  A página inicial da área administrativa exibe cartões com estatísticas dos chamados:  
  - Chamados Abertos  
  - Chamados Concluídos  
  - Taxa de Resolução  
  Esses cartões são interativos, permitindo que o administrador selecione qual conjunto de chamados deseja visualizar.

- **Filtragem de Chamados:**  
  Ao clicar em um dos cartões (ex.: Chamados Abertos ou Concluídos), o sistema atualiza os links dos botões de serviço (manutenção, limpeza, saúde ou segurança) para mostrar a lista correspondente, sem alterar o banco de dados.

---

## Tecnologias Utilizadas

- **Front-end:**  
  - HTML  
  - CSS  
  - JavaScript

- **Back-end:**  
  - PHP  
  - MySQL (via PHPMyAdmin no XAMPP)

- **Controle de Versão:**  
  - Git

---

## **Configuração do Ambiente**

### 1. Instalar o XAMPP:

- Baixe o XAMPP em sua [página oficial](https://www.apachefriends.org/index.html) e instale.
- Inicie os serviços **Apache** e **MySQL** no painel de controle.

### 2. Configurar o Banco de Dados:

- Acesse o **PHPMyAdmin** no navegador através de `http://localhost/phpmyadmin`.
- Crie um banco de dados com o nome `unipe_campuscare_db`.
- Execute o seguinte script SQL para criar as tabelas:

```sql
-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS unipe_campuscare_db;
USE unipe_campuscare_db;

-- Tabela para chamados de manutenção
CREATE TABLE chamados_manutencao (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bloco VARCHAR(100) NOT NULL,
    local_tipo VARCHAR(50) NOT NULL,
    local_identificacao VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    status ENUM('Aberto', 'Concluído') DEFAULT 'Aberto', -- Adicionado
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para chamados de limpeza
CREATE TABLE chamados_limpeza (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bloco VARCHAR(100) NOT NULL,
    local_tipo VARCHAR(50) NOT NULL,
    local_identificacao VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    status ENUM('Aberto', 'Concluído') DEFAULT 'Aberto', -- Adicionado
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para chamados de segurança
CREATE TABLE chamados_seguranca (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bloco VARCHAR(100) NOT NULL,
    local_tipo VARCHAR(50) NOT NULL,
    local_identificacao VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    status ENUM('Aberto', 'Concluído') DEFAULT 'Aberto', -- Adicionado
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para chamados de saúde
CREATE TABLE chamados_saude (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bloco VARCHAR(100) NOT NULL,
    local_tipo VARCHAR(50) NOT NULL,
    local_identificacao VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    status ENUM('Aberto', 'Concluído') DEFAULT 'Aberto', -- Adicionado
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para administradores
CREATE TABLE IF NOT EXISTS admin_login (
    id INT PRIMARY KEY AUTO_INCREMENT,
    admin_username VARCHAR(50) NOT NULL UNIQUE,
    admin_password VARCHAR(255) NOT NULL  -- senha armazenada com password_hash()
);

INSERT INTO admin_login (admin_username, admin_password) VALUES ('admin', 'hash gerada');
```

### 3. Configurar o Código do Projeto:

1. Clone o repositório do projeto:
   ```bash
   git clone https://github.com/CampusCare-tech/CampusCare-Unipe.git
   ```
2. Mova os arquivos para a pasta `htdocs` do XAMPP.
3. Certifique-se de que os arquivos PHP e o banco de dados estão conectados corretamente:

   - Configure o arquivo `db_connection.php` com os dados do banco de dados:

   ```php
   <?php
    function conectar() {
      // Configurações do banco de dados
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $dbname = 'unipe_campuscare_db';

      // Criação da conexão
      $dbConnection = new mysqli($host, $user, $password, $dbname);

      // Verifica se há erros na conexão
      if ($dbConnection->connect_error) {
          die("Falha na conexão: " . $dbConnection->connect_error);
      }

      return $dbConnection; // Retorna o objeto de conexão
    }
   ?>

   ```

4. Abra o navegador e acesse
   área do usuário: `http://localhost/CampusCare-Unipe/00-public/index.php`.
   área administrativa: `http://localhost/CampusCare-Unipe/02-admin/admin_home.php`.

---

## Estrutura do Projeto

```plaintext
📁 CampusCare-Unipê
├── 📂 00-public
│   ├── 📂 assets       # Recursos do projeto (CSS, images, JS, webfonts)
│   ├── blocos.php
│   └── index.php       # Página inicial do projeto
│
├── 📂 01-includes      # Arquivos PHP para funcionalidades internas
│   ├── db_connection.php  # Configuração do banco de dados
│   └── processar.php      # Processamento de formulários
│
├── 📂 02-admin         # Área administrativa do sistema
│   ├── 📂 templates    # Modelos de páginas para administração
│   │   ├── admin_home_template.php
│   │   ├── admin_login_template.php
│   │   ├── admin_service_template.php
│   ├── admin_concluir_chamado.php
│   ├── admin_home.php
│   ├── admin_login.php
│   ├── admin_logout.php
│   ├── admin_register.php
│   └── admin_service.php
│
├── 📂 03-sql
│   └── create_database.sql  # Script para criação do banco de dados
│
├── 📂 scripts
│   └── generate_admin_hash.php  # Script para geração de hash de senha do admin
│
├── .gitignore          # Arquivo para exclusões no versionamento Git
├── README.en.md        # Documentação em inglês
└── README.md           # Documentação do projeto
```

---

## **Melhorias Futuras**

- Reestruturar o diretório adotando o padrão MVC.
- Permitir o acompanhamento do status do chamado.
- Implementar notificações para os responsáveis pelos chamados.

## **Contribuidores**

Agradecemos a todos que contribuíram para o desenvolvimento deste projeto:

- [Rafael Magno G.](https://github.com/rafaelmagnog)
- [Levi Adler](https://github.com/LeviAdler05)
- [José Edgar](https://github.com/JoseEdgar5508)
- [José Henrique](https://github.com/hique022)
