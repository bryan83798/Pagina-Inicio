-- Script de criação das tabelas
-- NOTA: Crie o banco de dados pelo painel de controle da hospedagem
-- e selecione-o no phpMyAdmin antes de executar este script.

-- Tabela de Clientes com Auto-incremento
CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(50) UNIQUE,
    status VARCHAR(1) DEFAULT 'A'
);

-- Tabela de Produtos com Auto-incremento
CREATE TABLE IF NOT EXISTS produtos (
    id_produto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    dsc_produto VARCHAR(50) NOT NULL,
    vlr_unit DECIMAL(10,2) NOT NULL,
    status VARCHAR(1) DEFAULT 'A'
);

-- Tabela de Vendas (Relacionada ao Cliente)
CREATE TABLE IF NOT EXISTS vendas (
    id_venda INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    dat_venda DATE NOT NULL,
    CONSTRAINT fk_cliente_venda FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);

-- Tabela de Itens da Venda (Relaciona Vendas e Produtos)
CREATE TABLE IF NOT EXISTS itens_venda (
    id_item INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_venda INT NOT NULL,
    id_produto INT NOT NULL,
    qtd INT NOT NULL,
    vlr_item DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_venda_item FOREIGN KEY (id_venda) REFERENCES vendas(id_venda),
    CONSTRAINT fk_produto_item FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
);
