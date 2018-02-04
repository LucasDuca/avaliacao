{% extends "layouts/template.volt" %}

{% block content %}




<div class="container">

    {% if flash.output() != '' %}
    <div class="row">
        <div class="col-xs-12 text-left">
            {{ flash.output() }}
        </div>
    </div>
    {% endif %}
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
                    <form action="{{ url('imoveis/search') }}" method="get">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3" class="input-group">
                                <input type="text" id="dados" name="dados" value="{{ dados }}" class="form-control">
                            </div>
                            <div class="col-xs-12 col-sm-3" class="input-group">
                                {{ tipo_imovel }}
                            </div>
                            <div class="col-xs-2 col-sm-1"><input type="submit" value="Buscar" class="btn btn-success"></div>
                            <div class="col-xs-1 col-sm-1"><input type="button" id="reset" value="Limpar" class="btn btn-white"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xs-12 text-center">
                <hr>
            <a href="{{ url('imoveis/adicionar')}}" class="btn btn-success btn-lg">Adicionar</a>
            <hr>
        </div>

        <div class="col-xs-12">
            <table class="table table-striped">
                <tr>
                    <th>Foto</th>
                    <th>Código</th>
                    <th>Título</th>
                    <th>Descricao de Imóvel</th>
                    <th>Valor do Imóvel</th>
                    <th>Ações</th>
                </tr>
                {% for datas in page.items %}  
                    <td><img src="{{ static_url(datas.caminho) }}" width="100" height="100"></td>          
                    <td>{{ datas.codigo }}</td>
                    <td>{{ datas.titulo }}</td>
                    <td>{{ datas.descricao }}</td>
                    {% if datas.venda > 0 %}
                    <td>{{ formatarValor(datas.venda) }}</td>
                    {% endif %}

                    {% if datas.aluguel > 0 %}
                    <td>{{ formatarValor(datas.aluguel) }}</td>
                    {% endif %}

                    <td>
                              <a href="{{ url('/imoveis/visualizar?id=') }}{{ datas.id }}" class="btn btn-default btn-sm glyphicon glyphicon-search" title="Visualizar"></a> 
                            
                              <a href="{{ url('/imoveis/editar?id=') }}{{ datas.id }}" class="btn btn-default btn-sm glyphicon glyphicon-pencil" title="Editar"></a> 
                            
                              <a  href="{{ url('/imoveis/remover?id=') }}{{ datas.id }}" class="btn btn-danger btn-sm glyphicon glyphicon-trash" title="Excluir"></a> 
                            
                    </td></tr>
                
                {% endfor %}
            </table>
            <div class="container">
                <div class="row-fluid">
                    <div class="paginacao pull-right">
                    <nav aria-label="navigation">
                      <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="{{ url('imoveis') }}?dados={{ dados }}&tipo_imovel_id={{ tipo_imovel_id }}&page={{ page.before}}">Anterior</a></li>
                        <li class="page-item"><a class="page-link" href="{{ url('imoveis') }}?dados={{ dados }}&tipo_imovel_id={{ tipo_imovel_id }}&page={{ page.current}}">{{ page.current}}</a></li>
                        <li class="page-item"><a class="page-link" href="{{ url('imoveis') }}?dados={{ dados }}&tipo_imovel_id={{ tipo_imovel_id }}&page={{  page.total_pages }}">De {{ page.total_pages}}</a></li>
                        <li class="page-item"><a class="page-link" href="{{ url('imoveis') }}?dados={{ dados }}&tipo_imovel_id={{ tipo_imovel_id }}&page={{ page.next}}">Próximo</a></li>
                      </ul>
                    </nav>
                    </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/search.js"></script>
{% endblock %}
