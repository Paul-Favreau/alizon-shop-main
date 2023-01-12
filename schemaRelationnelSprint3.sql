-- Table: Client
CREATE TABLE _client (
    idClient INT AUTO_INCREMENT PRIMARY KEY,
    mdp VARCHAR(255) NOT NULL,
    dateInscription DATE NOT NULL,
    connecte BOOLEAN NOT NULL DEFAULT TRUE,
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
    resettokenexp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CGU BOOLEAN NOT NULL DEFAULT TRUE
);

-- Table: Produit
CREATE TABLE _produit (
    idProduit INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prixUnit FLOAT NOT NULL,
    prixLiv FLOAT NOT NULL,
    tauxTVA FLOAT NOT NULL,
    prixTotal FLOAT NOT NULL,
    photo1 VARCHAR(500),
    photo2 VARCHAR(500),
    photo3 VARCHAR(500),
    categorie VARCHAR(50),
    descript VARCHAR(500) NOT NULL,
    stock INTEGER NOT NULL,
    seuilAlerte INTEGER NOT NULL,
    interditMineurs BOOLEAN NOT NULL,
    dateAjout DATE NOT NULL,
    score FLOAT NOT NULL DEFAULT 0,
    masque BOOLEAN NOT NULL DEFAULT FALSE
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
    CGV BOOLEAN NOT NULL DEFAULT TRUE,
    modePaiement VARCHAR(50) NOT NULL,
    -- contrainte de clé étrangère
    FOREIGN KEY (idClient) REFERENCES _client(idClient)
);

-- Table : Commentaire 
CREATE TABLE _commentaire(
    idComm INT AUTO_INCREMENT PRIMARY KEY,
    contenu VARCHAR(255),
    datePubli DATE NOT NULL,
    note INTEGER NOT NULL,
    nbPoucesHaut INTEGER NOT NULL DEFAULT 0,
    nbPoucesBas INTEGER NOT NULL DEFAULT 0,
    ratio INTEGER NOT NULL DEFAULT 0,
    idClient INTEGER NOT NULL,
    idProduit INTEGER NOT NULL,
    reponse VARCHAR(255),
    signale BOOLEAN NOT NULL DEFAULT FALSE,
    photo VARCHAR(500),
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

-- Table : Livraison
CREATE TABLE _livraison(
    idLivraison INTEGER AUTO_INCREMENT PRIMARY KEY,
    nomLivreur VARCHAR(50) NOT NULL,
    dateDebut DATE NOT NULL,
    dateFin DATE NOT NULL,
    etat INTEGER NOT NULL DEFAULT 0,
    nextStep TIME DEFAULT CURRENT_TIMESTAMP,
    -- contrainte de clé étrangère
    FOREIGN KEY (numCommande) REFERENCES _commande(numCommande)
);

-- Table : Expédition
CREATE TABLE _expedition(
    idLivraison INTEGER NOT NULL,
    numCommande INTEGER NOT NULL,
    -- contrainte de clé étrangère
    FOREIGN KEY (idLivraison) REFERENCES _livraison(idLivraison),
    FOREIGN KEY (numCommande) REFERENCES _commande(numCommande),
    -- Contrainte de clé primaire
    PRIMARY KEY (idLivraison, numCommande)
);