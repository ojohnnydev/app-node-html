<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"
        integrity="sha512-sR3EKGp4SG8zs7B0MEUxDeq8rw9wsuGVYNfbbO/GLCJ59LBE4baEfQBVsP2Y/h2n8M19YV1mujFANO1yA3ko7Q==" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

    $(document).ready(function () {

        $('input[type="tel"]').inputmask({
            mask: ["(99) 9999-9999", "(99) 99999-9999"],
            keepStatic: true
        });

        var cliente = 'cliente';
        var area_cliente = 'area-cliente';
        var cardapio = 'cardapio';

        $('#cliente').on('click', function () {
            // $('#' + cardapio).closest('.item-menu').removeClass('item-menu-ativo');
            $('#cardapio, #area-cliente').closest('.item-menu').removeClass('item-menu-ativo');
            $(this).closest('.item-menu').toggleClass('item-menu-ativo');

            // $('.cardapio').fadeOut('fast');
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
            // $('#' + cliente).closest('.item-menu').removeClass('item-menu-ativo')
            $('#cliente, #area-cliente').closest('.item-menu').removeClass('item-menu-ativo')
            $(this).closest('.item-menu').toggleClass('item-menu-ativo')

            // $('.cliente').fadeOut('fast');
            $('.cliente, .area-cliente').fadeOut('fast');
            $('.cardapio').removeClass('oculto').fadeIn('slow');
        });

        $('#' + cliente).on('mouseover', function () {
            // $('#' + cardapio).closest('.item-menu').removeClass('mouseOverMenu')
            $('#area-cliente, #cardapio').closest('.item-menu').removeClass('mouseOverMenu')
            $(this).closest('.item-menu').toggleClass('mouseOverMenu')
        });

        $('#' + area_cliente).on('mouseover', function () {
            $('#cliente, #cardapio').closest('.item-menu').removeClass('mouseOverMenu')
            $(this).closest('.item-menu').toggleClass('mouseOverMenu')
        });

        $('#' + cardapio).on('mouseover', function () {
            // $('#' + cliente).closest('.item-menu').removeClass('mouseOverMenu')
            $('#cliente, #area-cliente').closest('.item-menu').removeClass('mouseOverMenu')
            $(this).closest('.item-menu').toggleClass('mouseOverMenu')
        });

        $('#btn-cadastro').click(function () {
            $('.login').fadeOut('slow', function () {
                $('.cadastro').fadeIn('slow');
            });
        });

        $('#btn-login').click(function () {
            $('.cadastro').fadeOut('slow', function () {
                $('.login').fadeIn('slow');
            });
        });

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

        $('#form-login').submit(function (e) {

            e.preventDefault();
            var dados = $(this).serialize();

            $.ajax({
                url: 'http://localhost:3000/login',
                dataType: 'json',
                type: 'post',
                data: dados,

                success: function (response) {

                    console.log(response.length)

                    if (response.length > 0) {

                        var cliente = response[0]['nome'];
                        var id_cliente = response[0]['id'];

                        localStorage.setItem('CLIENTE_LOGADO', cliente);
                        localStorage.setItem('ID_CLIENTE', id_cliente);

                        $('#cliente, .login, .cadastro').addClass('oculto');
                        $('.cliente-logado').html('<span>Seja bem-vindo '+ cliente +'!</span>').fadeIn('slow');
                        $('#' + area_cliente).closest('.item-menu').toggleClass('item-menu-ativo').removeClass('oculto').fadeIn('slow', function () {
                            $('.area-cliente').removeClass('oculto').fadeIn('slow');
                        });
                    } else {
                        swal('', 'Cliente não cadastrado no sistema!', 'warning');
                    }
                }
            });
        });
    });
</script>