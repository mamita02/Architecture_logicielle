CREATE DATABASE IF NOT EXISTS mglsi_news;
USE mglsi_news;

DROP TABLE IF EXISTS Article, Categorie;

CREATE TABLE Article(
    id int primary key auto_increment,
    titre varchar(255),
    contenu text,
    dateCreation datetime DEFAULT NOW(),
    dateModification datetime DEFAULT NOW(),
    categorie int
);

CREATE TABLE Categorie(
    id int primary key auto_increment,
    libelle varchar(20)
);

INSERT INTO Categorie(libelle) VALUES ('Sport'), ('Santé'), ('Education'), ('Politique');

INSERT INTO Article (titre, contenu, categorie) VALUES 
('lorem upsunnnn'),
('lorem upsunnnn'), 
('lorem upsunnnn');

ALTER TABLE Article ADD CONSTRAINT fk_categorie_article FOREIGN KEY(categorie) REFERENCES Categorie(id);

GRANT ALL PRIVILEGES ON mglsi_news.* TO mglsi_user IDENTIFIED BY 'passer';