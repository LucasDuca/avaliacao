{% extends "layouts/template.volt" %}

{% block content %}
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
                    <th>Data de Expiração</th>
                </tr>
                {% for imovel in imoveis %}  
                    <td><img src="{{ imovel.caminho }}" width="100" height="100"></td>          
                    <td>{{ imovel.codigo }}</td>
                    <td>{{ imovel.titulo }}</td>
                    {% if imovel.venda > 0 %}
                    <td>{{ formatarValor(imovel.venda) }}</td>
                    {% endif %}

                    {% if imovel.aluguel > 0 %}
                    <td>{{ formatarValor(imovel.aluguel) }}</td>
                    {% endif %}

                    <td>{{ formatarData(imovel.data_expiracao) }}</td>
                    <td>
                         
                    </td></tr>
                
                {% endfor %}
            </table>
        </div>
    </div>
</div>
{% endblock %}
