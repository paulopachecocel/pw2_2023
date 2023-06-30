DROP DATABASE IF EXISTS pw2_2023;

CREATE DATABASE pw2_2023;

USE pw2_2023;

CREATE TABLE usuario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL,
  login VARCHAR(150) NOT NULL,
  senha VARCHAR(150) NOT NULL
);

CREATE TABLE categoria (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL
);

CREATE TABLE marca (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL
);

CREATE TABLE produto (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_categoria INT NOT NULL,
  id_marca INT NOT NULL,
  nome VARCHAR(150) NOT NULL,
  percentual_lucro FLOAT NOT NULL,
  FOREIGN KEY (id_categoria) REFERENCES categoria(id),
  FOREIGN KEY (id_marca) REFERENCES marca(id)
);

CREATE TABLE compra (
  id INT AUTO_INCREMENT PRIMARY KEY,
  dt_hora DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE venda (
  id INT AUTO_INCREMENT PRIMARY KEY,
  dt_hora DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE produto_compra (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  id_produto INT NOT NULL,
  id_compra INT NOT NULL,
  qtde INT NOT NULL,
  preco_custo FLOAT NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuario(id),
  FOREIGN KEY (id_produto) REFERENCES produto(id),
  FOREIGN KEY (id_compra) REFERENCES compra(id)
);

CREATE TABLE produto_venda (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  id_produto INT NOT NULL,
  id_venda INT NOT NULL,
  qtde INT NOT NULL,
  valor_unitario FLOAT NOT NULL,
  valor_total FLOAT NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuario(id),
  FOREIGN KEY (id_produto) REFERENCES produto(id),
  FOREIGN KEY (id_venda) REFERENCES venda(id)
);