-- Table: Client
CREATE TABLE _client (
    idClient INT AUTO_INCREMENT PRIMARY KEY,
    mdp VARCHAR(255) NOT NULL,
    dateInscription DATE NOT NULL,
    connecte BOOLEAN NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    tel CHAR(10) NOT NULL,
    adresse VARCHAR(50) NOT NULL,
    codePostal CHAR(5) NOT NULL,
    ville VARCHAR(50) NOT NULL,
    dateNaissance DATE NOT NULL,
    bloque BOOLEAN NOT NULL DEFAULT FALSE,
    resettoken VARCHAR(50),
    resettokenexp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: Vendeur
CREATE TABLE _vendeur (
    CA FLOAT NOT NULL DEFAULT 0,
    nbCommandes INTEGER NOT NULL DEFAULT 0,
    nbVentes INTEGER NOT NULL DEFAULT 0
);


-- Table: Produit
CREATE TABLE _produit (
    idProduit INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prixUnit FLOAT NOT NULL,
    prixLiv FLOAT NOT NULL,
    tauxTVA FLOAT NOT NULL,
    prixTotal FLOAT NOT NULL,
    photo1 VARCHAR(50),
    photo2 VARCHAR(50),
    photo3 VARCHAR(50),
    categorie VARCHAR(50),
    descript VARCHAR(500) NOT NULL,
    stock INTEGER NOT NULL,
    seuilAlerte INTEGER NOT NULL,
    interditMineurs BOOLEAN NOT NULL
);

-- Table: Commande
CREATE TABLE _commande (
    numCommande INT AUTO_INCREMENT PRIMARY KEY,
    idClient INTEGER NOT NULL,
    dateCommande DATE NOT NULL,
    adresseLiv VARCHAR(50) NOT NULL,
    codePostal CHAR(5) NOT NULL,
    ville VARCHAR(50) NOT NULL,
    prixTotal FLOAT NOT NULL,
    CGV BOOLEAN NOT NULL,
    modePaiement VARCHAR(50) NOT NULL,
    -- contrainte de clé étrangère
    FOREIGN KEY (idClient) REFERENCES _client(idClient)
);

-- Table : Commentaire 
CREATE TABLE _commentaire(
    idComm INT AUTO_INCREMENT PRIMARY KEY,
    contenu VARCHAR(255) NOT NULL,
    datePubli DATE NOT NULL,
    note INTEGER NOT NULL,
    nbPoucesHaut INTEGER NOT NULL,
    nbPoucesBas INTEGER NOT NULL,
    ratio INTEGER NOT NULL,
    idClient INTEGER NOT NULL,
    idProduit INTEGER NOT NULL,
    reponse VARCHAR(255),
    signale BOOLEAN NOT NULL DEFAULT FALSE,
    -- contrainte de clé étrangère
    FOREIGN KEY (idClient) REFERENCES _client(idClient),
    FOREIGN KEY (idProduit) REFERENCES _produit(idProduit)
);

-- Table : Panier
CREATE TABLE _panier (
    idClient INTEGER NOT NULL,
    idProduit INTEGER NOT NULL,
    qte INTEGER NOT NULL,
    -- contrainte de clé étrangère
    FOREIGN KEY (idClient) REFERENCES _client(idClient),
    FOREIGN KEY (idProduit) REFERENCES _produit(idProduit),
    -- contrainte de clé primaire
    PRIMARY KEY (idClient, idProduit)
);

-- Table : Récapitulatif
CREATE TABLE _recap (
    numCommande INTEGER NOT NULL,
    idProduit INTEGER NOT NULL,
    qte INTEGER NOT NULL,
    prix FLOAT NOT NULL,
    -- contrainte de clé étrangère
    FOREIGN KEY (numCommande) REFERENCES _commande(numCommande),
    FOREIGN KEY (idProduit) REFERENCES _produit(idProduit),
    -- contrainte de clé primaire
    PRIMARY KEY (numCommande, idProduit)
);