# TestePhpMocke
Projeto de PHP para aplicar paradigma de teste com mocke
SQL para criar tabela paciente:
´´´sql

CREATE TABLE patients ( id SERIAL PRIMARY KEY, name VARCHAR(100) NOT NULL, email VARCHAR(120) UNIQUE NOT NULL);

INSERT INTO patients (name, email) VALUES
('Maria Silva', 'maria@clinic.com'),
('João Santos', 'joao@clinic.com');
´´´
