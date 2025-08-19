use killjoy;
CREATE TABLE Usuario (
id_usuario int PRIMARY KEY AUTO_INCREMENT,
statusUsuario boolean,
permissao varchar(30),
nmUsuario varchar(50),
cpf varchar(12),
email varchar(50),
senha varchar(32)
);

ALTER TABLE Usuario ADD CONSTRAINT email_unico UNIQUE (email);


INSERT INTO Usuario(statusUsuario, permissao, nmUsuario, cpf, email, senha)
VALUES( true, "Admin", "Neithan","11122233344","email@email.com", md5("1234"));

CREATE TABLE Produto (
id_produto int PRIMARY KEY AUTO_INCREMENT,
nmProduto varchar(30),
descricao varchar(50),
preco double,
quantidade double,
ftCapa varchar(100)
);



CREATE TABLE Cliente (
id_cliente int PRIMARY KEY AUTO_INCREMENT,
nmCliente varchar(30),
cpf varchar(12),
email varchar(50),
senha varchar(32),
dtNacimento date,
genero char,
id_enderecoFaturamento int
);

CREATE TABLE Endereco (
id_endereco int PRIMARY KEY auto_increment,
cep varchar(14),
logradouro varchar(50),
complemento varchar(50),
rua varchar(30),
bairro varchar(30),
cidade varchar(50),
uf varchar(2),
numero int
);

CREATE TABLE Endereco_Entrega(
	id_cliente int,
    id_endereco int,
    padrao boolean
);


CREATE TABLE Pedido(
	id_pedido int PRIMARY KEY auto_increment,
	id_cliente int,
    id_endereco int,
    valor_total double,
    status_pedido varchar(200)
);

CREATE TABLE Produtos_Pedido(
	id_pedido  int,
	id_produto int,
    quantidade int
);

CREATE TABLE imagem_produto(
	id_produto  int,
	imagem varchar(100)
);


ALTER TABLE Endereco_Entrega ADD CONSTRAINT FK_Cliente_1
FOREIGN KEY (id_cliente)
REFERENCES Cliente (id_cliente);

ALTER TABLE Endereco_Entrega ADD CONSTRAINT FK_Cliente_2
FOREIGN KEY (id_endereco)
REFERENCES Endereco (id_endereco);

ALTER TABLE Cliente ADD CONSTRAINT FK_Cliente_3
FOREIGN KEY (id_enderecoFaturamento)
REFERENCES Endereco (id_endereco);

ALTER TABLE Pedido ADD CONSTRAINT FK_Pedido_1
FOREIGN KEY (id_cliente)
REFERENCES Cliente (id_cliente);

ALTER TABLE Pedido ADD CONSTRAINT FK_Pedido_4
FOREIGN KEY (id_endereco)
REFERENCES Endereco (id_endereco);

ALTER TABLE Produtos_Pedido ADD CONSTRAINT FK_Pedido_2
FOREIGN KEY (id_pedido)
REFERENCES Pedido (id_pedido);

ALTER TABLE Produtos_Pedido ADD CONSTRAINT FK_Pedido_3
FOREIGN KEY (id_produto)
REFERENCES Produto (id_produto);

ALTER TABLE imagem_produto ADD CONSTRAINT FK_Imagens
FOREIGN KEY (id_produto)
REFERENCES Produto (id_produto);



select * from produto;