# Café & Grão

Vitrine de uma loja fictícia de cafés especiais e acessórios, feita em PHP com MySQL. A página inicial lê os produtos do banco e monta o catálogo dinamicamente, com selo de novidade, preço promocional e indicação de estoque esgotado.

Projeto com fins didáticos, desenvolvido como avaliação da disciplina de Web 1.

## Tecnologias

- PHP (PDO)
- MySQL
- HTML5 e CSS3 (sem frameworks)

## O que a página faz

- Lista os produtos cadastrados no banco, junto com o nome da categoria (`JOIN` entre `produtos` e `categorias`)
- Exibe apenas produtos com `ativo = 1`
- Mostra o selo **NOVO** quando `novo = 1`, ou **PROMOÇÃO** quando há preço promocional
- Em promoção, exibe o preço original riscado e o preço promocional em destaque
- Troca o botão "Adicionar ao carrinho" por "Esgotado" quando o estoque é zero
- Formata os preços no padrão brasileiro (`R$ 1.234,56`)
- Escapa os dados vindos do banco com `htmlspecialchars` antes de exibir

## Estrutura

```
coffee-shop-website/
├── index.php                      # View: página inicial e catálogo
├── controle/
│   └── produto/
│       └── ListarProduto.php      # Controller: busca os produtos e carrega a view
├── produto/
│   ├── Produto.php                # Model: entidade Produto
│   └── ProdutoDAO.php             # Acesso a dados dos produtos
├── modelo/
│   └── ConnectionFactory.php      # Conexão PDO única (singleton)
└── assets/
    ├── css/style.css
    └── imagens/                   # Imagens SVG dos produtos e do banner
```

O projeto segue uma separação no estilo MVC com DAO:

1. O `index.php` verifica se a lista de produtos já existe. Se não existe, instancia o `ListarProduto`.
2. O `ListarProduto` pede a lista ao `ProdutoDAO`.
3. O `ProdutoDAO` consulta o banco pela `ConnectionFactory` e converte cada linha em um objeto `Produto`.
4. O controller inclui o `index.php` de novo, agora com `$lista` preenchida, e a página é renderizada.

## Como rodar localmente

### Pré-requisitos

- PHP 7.4 ou superior com a extensão `pdo_mysql`
- MySQL ou MariaDB (XAMPP, WAMP ou Laragon já trazem os dois)

### 1. Clonar o repositório

```bash
git clone https://github.com/lucascarvalho-oliveira/coffee-shop-website.git
```

Se estiver usando XAMPP, coloque a pasta dentro de `htdocs`.

### 2. Criar o banco de dados

O banco é criado pelo script `banco_loja_cafe.sql`, que faz parte do material da disciplina e não está incluído neste repositório. Ele cria o banco `loja_cafe`, as tabelas e os dados de exemplo.

**Pelo phpMyAdmin:** abra a aba **Importar**, selecione o arquivo e clique em **Executar**.

**Pelo terminal:**

```bash
mysql -u root < banco_loja_cafe.sql
```

> O script começa com `DROP DATABASE IF EXISTS loja_cafe`. Se você já tiver um banco com esse nome, ele será apagado.

#### Modelo de dados

**`categorias`**

| Coluna | Tipo         | Descrição            |
|--------|--------------|----------------------|
| `id`   | INT UNSIGNED | Chave primária       |
| `nome` | VARCHAR(50)  | Nome da categoria    |

**`produtos`**

| Coluna              | Tipo          | Descrição                                          |
|---------------------|---------------|----------------------------------------------------|
| `id`                | INT UNSIGNED  | Chave primária                                     |
| `categoria_id`      | INT UNSIGNED  | Chave estrangeira para `categorias.id`             |
| `nome`              | VARCHAR(100)  | Nome do produto                                    |
| `descricao`         | VARCHAR(160)  | Descrição curta exibida no card                    |
| `preco`             | DECIMAL(10,2) | Preço normal                                       |
| `preco_promocional` | DECIMAL(10,2) | Preço em promoção; `NULL` quando não há promoção   |
| `imagem`            | VARCHAR(100)  | Nome do arquivo em `assets/imagens/`               |
| `novo`              | TINYINT(1)    | `1` exibe o selo "NOVO"                            |
| `ativo`             | TINYINT(1)    | `1` mostra na vitrine; `0` oculta                  |
| `estoque`           | INT UNSIGNED  | Quantidade disponível; `0` mostra "Esgotado"       |

#### Dados de exemplo

O script cadastra 3 categorias (Cafés, Acessórios e Kits) e 10 produtos, cobrindo todos os casos que a vitrine trata:

- **Novos:** Café Bourbon Amarelo 250g e Kit Degustação 3 Cafés
- **Em promoção:** Café Torra Escura 500g e Moedor Manual de Cerâmica
- **Esgotado:** Café Descafeinado 250g
- **Inativos (não aparecem na página):** Chaleira Bico de Ganso 1 L e Kit Presente Premium

Com isso, a vitrine exibe 8 produtos.

### 3. Configurar a conexão

As credenciais ficam em `modelo/ConnectionFactory.php`. O padrão é:

| Configuração | Valor       |
|--------------|-------------|
| Host         | `localhost` |
| Usuário      | `root`      |
| Senha        | *(vazia)*   |
| Banco        | `loja_cafe` |

Altere esses valores se o seu ambiente for diferente.

### 4. Executar

Com o Apache e o MySQL ligados, acesse `http://localhost/coffee-shop-website/`.

Ou, sem XAMPP, use o servidor embutido do PHP na raiz do projeto:

```bash
php -S localhost:8000
```

E acesse `http://localhost:8000`.

## Ainda não implementado

- Filtro do catálogo por categoria (os botões já estão na página, mas sem ação)
- Carrinho de compras
- Links de navegação do menu
- Painel para cadastrar e editar produtos

## Autor

Lucas Carvalho, estudante de Análise e Desenvolvimento de Sistemas no IFTM, Campus Patrocínio.

[GitHub](https://github.com/lucascarvalho-oliveira)
