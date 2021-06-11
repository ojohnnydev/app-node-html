<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"
        integrity="sha512-sR3EKGp4SG8zs7B0MEUxDeq8rw9wsuGVYNfbbO/GLCJ59LBE4baEfQBVsP2Y/h2n8M19YV1mujFANO1yA3ko7Q==" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

    $(document).ready(function () {

        carregaCardapio();

        $('input[type="tel"]').inputmask({
            mask: ["(99) 9999-9999", "(99) 99999-9999"],
            keepStatic: true
        });

        var cliente = 'cliente';
        var area_cliente = 'area-cliente';
        var cardapio = 'cardapio';

        $('#cliente').on('click', function () {
            $('#cardapio, #area-cliente').closest('.item-menu').removeClass('item-menu-ativo');
            $(this).closest('.item-menu').toggleClass('item-menu-ativo');

            $('.area-cliente, .cardapio').fadeOut('fast');
            $('.cliente').fadeIn('slow');
        });

        $('#area-cliente').on('click', function () {
            $('#cliente, #cardapio').closest('.item-menu').removeClass('item-menu-ativo');
            $(this).closest('.item-menu').toggleClass('item-menu-ativo');

            $('.cliente, .cardapio').fadeOut('fast');
            $('.area-cliente').fadeIn('slow');
        });

        $('#cardapio').on('click', function () {
            $('#cliente, #area-cliente').closest('.item-menu').removeClass('item-menu-ativo')
            $(this).closest('.item-menu').toggleClass('item-menu-ativo')

            $('.cliente, .area-cliente').fadeOut('fast');
            $('.cardapio').removeClass('oculto').fadeIn('slow');
        });

        $('#' + cliente).on('mouseover', function () {
            $('#area-cliente, #cardapio').closest('.item-menu').removeClass('mouseOverMenu')
            $(this).closest('.item-menu').toggleClass('mouseOverMenu')
        });

        $('#' + area_cliente).on('mouseover', function () {
            $('#cliente, #cardapio').closest('.item-menu').removeClass('mouseOverMenu')
            $(this).closest('.item-menu').toggleClass('mouseOverMenu')
        });

        $('#' + cardapio).on('mouseover', function () {
            $('#cliente, #area-cliente').closest('.item-menu').removeClass('mouseOverMenu')
            $(this).closest('.item-menu').toggleClass('mouseOverMenu')
        });

        // Muda para o formulário de login
        $('#btn-cadastro').click(function () {
            $('.login').fadeOut('slow', function () {
                $('.cadastro').fadeIn('slow');
            });
        });

        // Muda para o formulário de cadastro
        $('#btn-login').click(function () {
            $('.cadastro').fadeOut('slow', function () {
                $('.login').fadeIn('slow');
            });
        });

        // Envia os dados do cliente para api (Cadastro)
        $('#form-cadastro').submit(function (e) {

            e.preventDefault();
            var dados = $(this).serialize();

            $.ajax({
                url: 'http://localhost:3000/clientes',
                dataType: 'json',
                type: 'post',
                data: dados,

                success: function (response) {

                    swal('', 'Cliente cadastrado com sucesso!', 'success');

                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            });

        });

        // Envia os dados do cliente para api (Login)
        $('#form-login').submit(function (e) {

            e.preventDefault();
            var dados = $(this).serialize();

            $.ajax({
                url: 'http://localhost:3000/login',
                dataType: 'json',
                type: 'post',
                data: dados,

                success: function (response) {

                    if (response.length > 0) {

                        var cliente = response[0]['nome'];
                        var id_cliente = response[0]['id'];

                        localStorage.setItem('CLIENTE_LOGADO', cliente);
                        localStorage.setItem('ID_CLIENTE', id_cliente);

                        carregaCardapio();
                        buscaPedidosCliente(id_cliente);

                        $('#cliente, .login, .cadastro').addClass('oculto');
                        $('.cliente-logado').html('<span>Seja bem-vind@ '+ cliente +'!</span>').fadeIn('slow');

                        $('#' + area_cliente).closest('.item-menu').toggleClass('item-menu-ativo').removeClass('oculto').fadeIn('slow', function () {
                            $('.area-cliente').removeClass('oculto').fadeIn('slow');
                        });

                        $('#div-pedido').removeClass('oculto');
                    } else {
                        swal('', 'Cliente não cadastrado no sistema!', 'warning');
                    }
                }
            });
        });

        // Envia os dados do pedido para api
        $('#form-pedido').submit(function (e) {

            e.preventDefault();

            var cliente = localStorage.getItem('ID_CLIENTE');
            var prato = $('input[name="prato"]:checked').val();
            var data_pedido = formataData(new Date());

            $.ajax({
                url: 'http://localhost:3000/pedido',
                dataType: 'json',
                type: 'post',
                data: 'cliente=' + cliente + '&prato=' + prato + '&data=' + data_pedido,

                success: function (response) {
                    swal('', 'Pedido realizado com sucesso!', 'success');

                    setTimeout(function () {
                        $('#conteudo-cardapio').addClass('oculto');
                        $('#' + cardapio).closest('.item-menu').toggleClass('item-menu-ativo');
                        $('#' + area_cliente).closest('.item-menu').toggleClass('item-menu-ativo').fadeIn('slow', function () {
                            buscaPedidosCliente(cliente);
                            $('.area-cliente').removeClass('oculto').fadeIn('slow');
                        });
                    }, 1500);
                }
            });
        });

        function formataData (data) {
            return data.getFullYear() + '-' + (data.getMonth() + 1) + '-' + data.getDate();
        }

        function formataDataExibe (data) {
            return data.getDate() + '/' + (data.getMonth() + 1) + '/' + data.getFullYear();
        }

        // Carrega o cardápio direto da base
        function carregaCardapio () {

            $.get('http://localhost:3000/cardapio', function (response) {

                // Dados Cardápios vindos da api
                if (response.length > 0) {

                    $('#div-aviso').addClass('oculto');
                    $('#cardapios').removeClass('oculto');

                    $('#c1p1').html(response[0]['item_1']);
                    $('#c1p2').html(response[0]['item_2']);
                    $('#c1p3').html(response[0]['item_3']);
                    $('#c1p4').html(response[0]['salada']);
                    $('#c1p5').html(response[0]['carne']);
                    $('#c1p6').html(response[0]['bebida']);
                    $('#c1p7').html(response[0]['sobremesa']);

                    $('#c2p1').html(response[1]['item_1']);
                    $('#c2p2').html(response[1]['item_2']);
                    $('#c2p3').html(response[1]['item_3']);
                    $('#c2p4').html(response[1]['salada']);
                    $('#c2p5').html(response[1]['carne']);
                    $('#c2p6').html(response[1]['bebida']);
                    $('#c2p7').html(response[1]['sobremesa']);

                    $('#c3p1').html(response[2]['item_1']);
                    $('#c3p2').html(response[2]['item_2']);
                    $('#c3p3').html(response[2]['item_3']);
                    $('#c3p4').html(response[2]['salada']);
                    $('#c3p5').html(response[2]['carne']);
                    $('#c3p6').html(response[2]['bebida']);
                    $('#c3p7').html(response[2]['sobremesa']);

                    $('#c4p1').html(response[3]['item_1']);
                    $('#c4p2').html(response[3]['item_2']);
                    $('#c4p3').html(response[3]['item_3']);
                    $('#c4p4').html(response[3]['salada']);
                    $('#c4p5').html(response[3]['carne']);
                    $('#c4p6').html(response[3]['bebida']);
                    $('#c4p7').html(response[3]['sobremesa']);

                    $('#c5p1').html(response[4]['item_1']);
                    $('#c5p2').html(response[4]['item_2']);
                    $('#c5p3').html(response[4]['item_3']);
                    $('#c5p4').html(response[4]['salada']);
                    $('#c5p5').html(response[4]['carne']);
                    $('#c5p6').html(response[4]['bebida']);
                    $('#c5p7').html(response[4]['sobremesa']);

                }
            });
        }

        // Busca pedidos realizados pelo cliente logado
        function buscaPedidosCliente (id_cliente) {

            $.get('http://localhost:3000/pedido/' + id_cliente, function (response) {

                var cardapio = '';
                var table_body = 'table-body';

                if (response.length > 0) {

                    $('#' + table_body).empty();

                    $.each(response, function (key, value) {

                        cardapio = value['item_1'] + ', ' + value['item_2'];

                        if (value['item_3']) {
                            cardapio = cardapio + ', ' + value['item_3'];
                        }

                        if (value['salada']) {
                            cardapio = cardapio + ', ' + value['salada'];
                        }

                        if (value['bebida']) {
                            cardapio = cardapio + ', ' + value['bebida'];
                        }

                        if (value['sobremesa']) {
                            cardapio = cardapio + ', ' + value['sobremesa'];
                        }

                        $('#' + table_body)
                            .append('<tr><td>'+ value['id'] +'</td><td>'+ cardapio +'</td><td>'+ formataDataExibe(new Date(value['data'])) +'</td></tr>');
                    });
                } else {
                    $('#table-body')
                        .html('<tr class="txt-center"><td colspan="7">Nenhum registro encontrado!</td></tr>');
                }
            });
        }

        // Desloga o usuário e o retorna para a página inicial
        $('#btn-logout').click(function () {

            localStorage.removeItem('CLIENTE_LOGADO');
            localStorage.removeItem('ID_CLIENTE');

            $('#area-cliente, .area-cliente').addClass('oculto');

            $('#cliente').closest('.item-menu').toggleClass('item-menu-ativo').removeClass('oculto').fadeIn('slow', function () {
                $('.login').removeClass('oculto').fadeIn('slow');
            });

            setTimeout(function () {
                location.reload();
            }, 300);
        });
    });
</script>