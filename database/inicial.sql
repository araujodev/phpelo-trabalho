create database web2;
-- use web2;

-- Criar Tabela de Usuarios
CREATE TABLE IF NOT EXISTS usuarios(
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(150) NOT NULL,
    password VARCHAR(150) NOT NULL,
    role VARCHAR(50) NOT NULL,
    criado_em DATE NOT NULL,
    
    PRIMARY KEY (id)
);

-- Inserindo os primeiros dados em Usuarios
-- Login: admin, senha: 123456
-- Login: usuario, senha: 1234
INSERT INTO usuarios (username, password, role, criado_em) VALUES ('admin', 'e10adc3949ba59abbe56e057f20f883e', 'administrador', DATE(NOW()));
INSERT INTO usuarios (username, password, role, criado_em) VALUES ('usuario', '81dc9bdb52d04dc20036dbd8313ed055', 'usuario_comun', DATE(NOW()));

-- Criar Tabela de Jogadores
CREATE TABLE IF NOT EXISTS jogadores(
	id INT NOT NULL AUTO_INCREMENT,
	nome_completo VARCHAR(150) NOT NULL,
    idade INT NULL,
    rg VARCHAR(25) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    foto VARCHAR(255) NOT NULL,
    usuario_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Relatorios
CREATE TABLE IF NOT EXISTS relatorios(
	id INT NOT NULL AUTO_INCREMENT,
	time_atual VARCHAR(150) NOT NULL,
    idade_inicio VARCHAR(10) NOT NULL,
    lesao VARCHAR(5) NOT NULL,
    jogador_id INT NOT NULL,
    criado_em DATE NOT NULL,
    FOREIGN KEY (jogador_id) REFERENCES jogadores(id),
    PRIMARY KEY (id)
);
