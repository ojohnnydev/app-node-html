<div id="conteudo-cardapio">
    <div class="col-md-12 w-35 mt-3 cabecalho">
        <label class="cabecalho-label">Cardápio</label>
    </div>

    <div class="txt-center mt-5" id="div-aviso">
        <span>Nenhum cardápio disponível!</span>
    </div>

    <div class="oculto" id="cardapios">
        <div class="col-md-10 offset-2 div-cardapio">
            <div class="col-md-3">
                <div class="txt-center">
                    <img src="images/prato.svg" class="w-25" alt="imagem-login" id="imagem-login" >
                </div>
                <div class="txt-center mt-2">
                    <span class="display-block itens-cardapio" id="c1p1"></span>
                    <span class="display-block itens-cardapio" id="c1p2"></span>
                    <span class="display-block itens-cardapio" id="c1p3"></span>
                    <span class="display-block itens-cardapio" id="c1p4"></span>
                    <span class="display-block itens-cardapio" id="c1p5"></span>
                    <span class="display-block itens-cardapio" id="c1p6"></span>
                    <span class="display-block itens-cardapio" id="c1p7"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="txt-center">
                    <img src="images/prato.svg" class="w-25" alt="imagem-login" id="imagem-login" >
                </div>
                <div class="txt-center mt-2">
                    <span class="display-block itens-cardapio" id="c2p1"></span>
                    <span class="display-block itens-cardapio" id="c2p2"></span>
                    <span class="display-block itens-cardapio" id="c2p3"></span>
                    <span class="display-block itens-cardapio" id="c2p4"></span>
                    <span class="display-block itens-cardapio" id="c2p5"></span>
                    <span class="display-block itens-cardapio" id="c2p6"></span>
                    <span class="display-block itens-cardapio" id="c2p7"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="txt-center">
                    <img src="images/prato.svg" class="w-25" alt="imagem-login" id="imagem-login" >
                </div>
                <div class="txt-center mt-2">
                    <span class="display-block itens-cardapio" id="c3p1"></span>
                    <span class="display-block itens-cardapio" id="c3p2"></span>
                    <span class="display-block itens-cardapio" id="c3p3"></span>
                    <span class="display-block itens-cardapio" id="c3p4"></span>
                    <span class="display-block itens-cardapio" id="c3p5"></span>
                    <span class="display-block itens-cardapio" id="c3p6"></span>
                    <span class="display-block itens-cardapio" id="c3p7"></span>
                </div>
            </div>
        </div>

        <div class="col-md-9 offset-3 div-cardapio">
            <div class="col-md-3">
                <div class="txt-center">
                    <img src="images/prato.svg" class="w-25" alt="imagem-login" id="imagem-login" >
                </div>
                <div class="txt-center mt-2">
                    <span class="display-block itens-cardapio" id="c4p1"></span>
                    <span class="display-block itens-cardapio" id="c4p2"></span>
                    <span class="display-block itens-cardapio" id="c4p3"></span>
                    <span class="display-block itens-cardapio" id="c4p4"></span>
                    <span class="display-block itens-cardapio" id="c4p5"></span>
                    <span class="display-block itens-cardapio" id="c4p6"></span>
                    <span class="display-block itens-cardapio" id="c4p7"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="txt-center">
                    <img src="images/prato.svg" class="w-25" alt="imagem-login" id="imagem-login" >
                </div>
                <div class="txt-center mt-2">
                    <span class="display-block itens-cardapio" id="c5p1"></span>
                    <span class="display-block itens-cardapio" id="c5p2"></span>
                    <span class="display-block itens-cardapio" id="c5p3"></span>
                    <span class="display-block itens-cardapio" id="c5p4"></span>
                    <span class="display-block itens-cardapio" id="c5p5"></span>
                    <span class="display-block itens-cardapio" id="c5p6"></span>
                    <span class="display-block itens-cardapio" id="c5p7"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 margin-auto mt-5 mb-5 oculto" id="div-pedido">

        <form class="display-flex" id="form-pedido">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="prato" id="prato-1" value="1" required>
                <label class="form-check-label" for="prato-1">Prato 1</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="prato" id="prato-2" value="2">
                <label class="form-check-label" for="prato-2">Prato 2</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="prato" id="prato-3" value="3">
                <label class="form-check-label" for="prato-3">Prato 3</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="prato" id="prato-4" value="4">
                <label class="form-check-label" for="prato-4">Prato 4</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="prato" id="prato-5" value="5">
                <label class="form-check-label" for="prato-5">Prato 5</label>
            </div>

            <div>
                <button type="submit" class="btn btn-primary" id="btn-pedido">Realizar Pedido</button>
            </div>
        </form>
    </div>
</div>