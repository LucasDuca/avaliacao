<html>
    <head>
        <title>Avaliação InfoIdéias</title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css">
        <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    
                </div>
                <div id="navbar" class="navbar-collapse collapse navbar-right">
                    <ul class="nav navbar-nav">
                    <li class="active"><?= $this->tag->linkTo([['for' => 'site.inicio'], 'Início']) ?></li>
                    <li><?= $this->tag->linkTo([['for' => 'site.imovel.listar'], 'Cadastro de Imóveis']) ?></li>
                    </ul>
                </div>
            </div>
        </nav>
        
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center">
            <h1>Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3>Ultimos Imóveis Cadastrados</h3>
            <table class="table table-striped" style="margin-top: 40px;">
                <tr>
                    <th>Foto</th>
                    <th>Código</th>
                    <th>Título</th>
                    <th>Valor do Imóvel</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($imoveis as $imovel) { ?>  
                    <td><img src="<?= $imovel->caminho ?>" width="100" height="100"></td>          
                    <td><?= $imovel->codigo ?></td>
                    <td><?= $imovel->titulo ?></td>
                    <?php if ($imovel->venda > 0) { ?>
                    <td><?= $imovel->venda ?></td>
                    <?php } ?>

                    <?php if ($imovel->aluguel > 0) { ?>
                    <td><?= $imovel->aluguel ?></td>
                    <?php } ?>

                    <td><?= >data_expiracao/$imovel ?></td>
                    <td>
                         
                    </td></tr>
                
                <?php } ?>
            </table>
        </div>
    </div>
</div>

        <!-- Styles/Scripts-->
        <link type="text/css" rel="stylesheet" href="/css/styles.css">
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/jquery.maskMoney.js"></script>
        <script type="text/javascript" src="/js/jquery.mask.js"></script>
        <!--<script type="text/javascript" src="/js/scripts.js"></script>-->
    </body>
</html>