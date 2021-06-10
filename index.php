<!DOCTYPE html>
<html lang="pt">

<head>
    <?php include 'metas.php'; ?>
    <title>Restaurante Virtual</title>
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 main">
            <div class="col-md-2 menu">
                <div class="col-md-12 item-menu item-menu-ativo" id="cliente">
                    <div class="col-md-1 tarja"></div>
                    <div class="col-md-11 descricao">
                        Cliente
                    </div>
                </div>
                <div class="col-md-12 item-menu oculto" id="area-cliente">
                    <div class="col-md-1 tarja"></div>
                    <div class="col-md-11 descricao">
                        Área do Cliente
                    </div>
                </div>
                <div class="col-md-12 item-menu" id="cardapio">
                    <div class="col-md-1 tarja"></div>
                    <div class="col-md-11 descricao">
                        Cardápio
                    </div>
                </div>
                <div class="col-md-12 menu-footer"></div>
            </div>
            <div class="col-md-10 conteudo">
                <div class="row cliente">
                    <?php include 'pages/login.php'; ?>
                </div>

                <div class="row oculto area-cliente">
                    <?php include 'pages/area_cliente.php'; ?>
                </div>

                <div class="row oculto cardapio">
                    <?php include 'pages/cardapio.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'scripts.php'; ?>
</body>
</html>
