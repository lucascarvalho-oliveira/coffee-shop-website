<?php
    if (!isset($lista)) {
        require_once __DIR__ . "/controle/produto/ListarProduto.php";
        new ListarProduto();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café & Grão</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="topo">
        <div class="mensagem_topo">
            <p>Frete grátis para acima de R$ 150,00</p>
        </div>
        <div class="container cabecalho">
        <div class="title">
            <h1>Café <span>&</span> Grão</h1>
        </div>

        <nav>
            <ul>
                <li><a href="#">Início</a></li>
                <li><a href="#">Cafés</a></li>
                <li><a href="#">Acessórios</a></li>
                <li><a href="#">Sobre</a></li>
                <li><a href="#">Contato</a></li>
            </ul>
        </nav>

        <div class="btn_topo">
            <a href="#">Carrinho</a>
        </div>
        </div>
    </header>

    <section class="hero">
        <div class="container hero_conteudo">
        <div class="texto_hero">
        <div class="title_hero">
            <p>colheita 2026</p>
            <h1>Café freco, torrado toda semana.</h1>
            <p>Gãos especiais de pequenos produtores brasileiros, direto da torra para a sua xícara.</p>
        </div>
        <div class="btn_hero">
            <a href="#">Ver produtos</a>
        </div>
        </div>
        <img class="img_hero" src="assets/imagens/hero.svg" alt="Xícara de café fumegante sobre um pires">
        </div>
    </section>

    <main class="container produtos">
        <div class="title_produtos">
            <h2>Nossos produtos</h2>
            <p>Selecionados por quem entende de café</p>
        </div>

        <div class="btn_container">
            <button>Todos</button>
            <button>Cafés</button>
            <button>Acessórios</button>
            <button>Kits</button>
        </div>

        <div class="catalogo-container">
            <?php foreach ($lista as $p): ?>

            <?php
                $cat = mb_strtolower($p->getCategoriaNome());

                if($p->getPrecoPromocional() !== null && $p->getPrecoPromocional() > 0){
                    $temPromocao = true;
                }else{
                    $temPromocao = false;
                }
                
                if((int) $p->getNovo() === 1){
                    $produtoNovo = true;
                }else{
                    $produtoNovo = false;
                }
            ?>

            <?php
                if((int) $p->getAtivo() === 1):
            ?>

            <div class="card">
                <div class="topo-card <?= $corTopo ?>">
                    <?php if($produtoNovo): ?>
                        <span class="novo">NOVO</span>

                    <?php elseif($temPromocao): ?>
                        <span class="promocao">PROMOÇÃO</span> 
                    
                    <?php endif; ?>

                    <img
                        src="assets/imagens/<?= htmlspecialchars($p->getImagem()) ?>"
                        alt="<?= htmlspecialchars($p->getNome()) ?>"
                    >

                </div>

                <div class="corpo_card">
                    <div class="categoria">
                        <?= htmlspecialchars($p->getCategoriaNome()) ?>
                    </div>
                    <div class="nome">
                        <?= htmlspecialchars($p->getNome()) ?>
                    </div>
                    <div class="descricao">
                        <?= htmlspecialchars($p->getDescricao()) ?>
                    </div>
                </div>

                <div>
                    <?php if ($temPromocao): ?>
                        <div class="preco-antigo">
                            R$ <?= number_format($p->getPreco(), 2, ',', '.') ?>
                        </div>
                    <?php endif; ?>

                    <div class="preco <?= $temPromocao ? 'promocao-texto' : '' ?>">
                        R$ <?= number_format(
                            $temPromocao
                                ? $p->getPrecoPromocional()
                                : $p->getPreco(),
                            2,',','.'
                        ) ?>
                    </div>
                </div>

                <?php if ($p->getEstoque() > 0): ?>
                    <button class="btn-comprar">
                        Adicionar ao carrinho
                    </button>
                <?php else: ?>
                    <button class="btn-esgotado">
                        Esgotado
                    </button>
                <?php endif; ?> 
            </div>
            
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container rodape">
        <div class="sobre">
        <div class="title">
            <h1>Café <span>&</span> Grão</h1>
        </div>
        <p>Cafés especiais e acessórios para quem leva o preparo a serio. Torrando
            em pequenos lotes, enviado para todo o Brasil.
        </p>
        </div>
        <div class="conteudo">
            <h4>Categoria</h4>
            <ul>
                <li><p>cafés</p></li>
                <li><p>Acessórios</p></li>
                <li><p>kits</p></li>
            </ul>
        </div>
        <div class="conteudo">
            <h4>Contato</h4>
            <ul>
                <li><p>contato@cafeegrao.com.br</p></li>
                <li><p>(34) 99999-0000</p></li>
                <li><p>Seg a Sex, 8h ás 18h</p></li>
            </ul>
        </div>
        <div>
            <p>2026 café & Grão. projeto ficticio para fins didaticos</p>
        </div>
        </div>
    </footer>
</body>
</html>