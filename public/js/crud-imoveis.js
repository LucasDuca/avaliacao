$(document).ready(function () {

    $(".chosen").chosen();

    $('#data_expiracao').mask('00/00/0000');
    $('#numero').mask('00000');
    $('#valor').maskMoney();
    $('#valor').trigger('mask.maskMoney');


    $('#dormitorios').mask('00000');
    $('#banheiros').mask('00000');
    $('#vagas_garagem').mask('00000');
    $('#area_terreno').mask('00000');
    preencherEndereco();
    atualizaLabel();/*
    $("#tipo_negocio_venda").click(function () {
        atualizaLabel();
    })
    $("#tipo_negocio_aluguel").click(function () {
        atualizaLabel();
    })
*/
    $('.rem').change(function () {

        $(this).nextAll("label").text("");
        $(this).parent("div").removeClass("has-error");
    });

    function atualizaLabel() {
        if ($('input[name=tipo_negocio]:checked').val() == "V")
        {
            $("#preco").text("Preço de Venda");
        } else
        {
            $("#preco").text("Preço de Aluguel");

        }
    }

    $("#publicado").click(function () {

        if ($("#publicado").is(':checked')) {
            if ($("#data_expiracao").val() == '') {
                $("#error_data_expiracao").text("Para publicar é necessário preencher.");
                $("#div_expiracao").addClass("has-error");
            }
        } else {
            $("#error_data_expiracao").text("");
            $("#div_expiracao").removeClass("has-error");
        }
    });

    $("#logradouro").chosen().change(function () {
        preencherEndereco();
    });

    function preencherEndereco()
    {
        $.ajax({
            type: "POST",
            url: "/imoveis/preencherEndereco",
            dataType: "json",
            data: {"logradouro_id": $('#logradouro').val(), }
        }).done(function (data) {
            $("#bairro").val(data[0].bairro);
            $("#tiponome").val(data[0].endereco);
        });
    }

    $("#codigo").blur(function () {
        $.ajax({
            type: "POST",
            url: "/imoveis/validarCodigo",
            dataType: "json",
            data: {"id": $('#id').val(),
                "codigo": $("#codigo").val(), }
        }).done(function (data) {
            if (data[0].exists === true) {
                $("#error_codigo").text("O código " + $("#codigo").val() + " já existe.");
                $("#div_codigo").addClass("has-error");
            } else {
                $("#error_codigo").text("");
                $("#div_codigo").removeClass("has-error");
            }
        });
    });

    $("#btnExcluir").click(function () {
        event.preventDefault();

        $.confirm({
            title: 'Confirmar exclusão',
            content: 'Clique em confirmar para excluír permanentemente o imóvel.',
            buttons: {
                confirmar: function () {
                    $("#form").submit();
                },
                cancelar: {
                    text: 'Cancelar',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function () {
                        //nada acontece
                    }
                }
            }
        });

    });




});