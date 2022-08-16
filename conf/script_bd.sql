CREATE SCHEMA recuperacao2;

CREATE TABLE livro(
    idlivro INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titulo varchar(45),
    resumo varchar(250),
    avaliacao decimal(6,2),
    autores varchar(250),
    ano_publicacao INT);

CREATE TABLE revista(
    idrevista INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titulo varchar(45),
    resumo varchar(250),
    avaliacao decimal(6,2),
    autores varchar(250),
    volume INT,
    quant_avaliacoes INT);