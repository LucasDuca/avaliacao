{% extends "layouts/template.volt" %}

{% block content %}
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center">
            <h1>Listar Imóveis</h1>
        </div>
    </div>
    <div class="row">
        
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Buscar</h3>
                </div>
                <div class="panel-body">
                    <form action="/" method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3" class="input-group">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xs-12 col-sm-3" class="input-group">
                                <select name="tipo_imovel_id" id="tipo_imovel_id" class="form-control">
                                    <option value="1">Casa</option>
                                    <option value="2">Apartamento</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-3"><input type="submit" value="Buscar" class="btn btn-success"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xs-12 text-center">
                <hr>
            <a href="javascript:void(0)" class="btn btn-default btn-lg">Adicionar</a>
            <hr>
        </div>

        <div class="col-xs-12">
            <table class="table table-striped">
                <tr>
                    <th>Código</th>
                    <th>Tipo de Imóvel</th>
                    <th>Valor do Imóvel</th>
                    <th>Ações</th>
                </tr>
                <tr>
                    <td>ABC1</td>
                    <td>Casa</td>
                    <td>R$200.000,00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>CDE2</td>
                    <td>Apartamento</td>
                    <td>R$150.000,00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>JHK2</td>
                    <td>Cobertura</td>
                    <td>R$300.000,00</td>
                    <td></td>
                </tr>
                <tr>
                    <td>ASS3</td>
                    <td>Kitnet</td>
                    <td>R$20.000,00</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>
{% endblock %}
