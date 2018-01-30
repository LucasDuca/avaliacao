{% extends "layouts/template.volt" %}

{% block content %}
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center">
            <h1>Adicionar Imovel</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Dados Básicos</h3>
                </div>
                <div class="panel-body">
                    Código, tipo de imovel, filial, etc..
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Localizacao</h3>
                </div>
                <div class="panel-body">
                    logradouro, bairro, numero...
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Valores</h3>
                </div>
                <div class="panel-body">
                    Qual o tipo do negocio (venda, aluguel) (Deve ser input Radio), valores.
                </div>
            </div>

            <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Imagem</h3>
                    </div>
                    <div class="panel-body">
                        Colocar aqui o Upload da imagem *validação de formato, jpg/jpeg e png apenas.
                    </div>
                </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Detalhes</h3>
                </div>
                <div class="panel-body">
                    Qtd de quartos, metragem, etc...
                </div>
            </div>

            <div class="text-center">
                <input type="submit" value="Salvar" class="btn btn-success">
            </div>
        </div>
    </div>
</div>
{% endblock %}
