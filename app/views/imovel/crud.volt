{% extends "layouts/template.volt" %}

{% block content %}
<div class="container">
<form method="post" id="form" enctype="multipart/form-data" action="{{ url('/imoveis/') }}{{ action_url }}">
{{ form.render('id') }}
    {% if flash.output() != '' %}
    <div class="row">
        <div class="col-xs-12 text-left">
            {{ flash.output() }}
        </div>
    </div>
    {% endif %}
    <div class="row">
        <div class="col-xs-12 text-center">
            <h1>{{ action }} Imóvel </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Dados Básicos</h3>
                </div>


                <div class="panel-body ">
                    <div class="form-group row">

                        <div class='col-lg-2'>
                            <div id="div_codigo" class="form-group {% if codigo is defined %} has-error {% endif %}">
                                <label>Código</label>
                                {{ form.render('codigo') }}
                                {% if codigo is defined%}
                                    <label class='error'> {{ codigo }}</label> 
                                {% endif %}
 
                                <label class='error' id='error_codigo'></label>
                            </div>
                        </div>

                        <div class='col-lg-2'>
                            <div class="form-group {% if tipo_imovel is defined %} has-error {% endif %}">
                                <label>Tipo de Imóvel</label>
                                {{ form.render('tipo_imovel') }}
                                {% if tipo_imovel is defined%}
                                    <label class='error'> {{ tipo_imovel }}</label> 
                                {% endif %} 
                            </div>
                        </div>

                        <div class='col-lg-2'>
                            <div class="form-group  {% if filial is defined %} has-error {% endif %}">
                                <label>Filial</label>
                                {{ form.render('filial') }}
                                {% if filial is defined%}
                                    <label class='error'> {{ filial }}</label> 
                                {% endif %} 
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">                        
                        <div class='col-lg-6'>
                            <div class="form-group {% if titulo_imovel is defined %} has-error {% endif %}">
                                <label>Título do Imóvel</label>
                                {{ form.render('titulo_imovel') }}
                                {% if titulo_imovel is defined%}
                                    <label class='error'> {{ titulo_imovel }}</label> 
                                {% endif %} 
                            </div>
                        </div>                      
                        <div class='col-lg-6'>
                            <div class="form-group">
                                <label>Descrição</label>
                                {{ form.render('descricao') }}
                            </div>
                        </div>    
                    </div>

                    <div class="form-group row">                     
                        <div class='col-lg-1'>
                            <div class="form-group">
                                <label>Publicado</label>
                                {{ form.render('publicado') }}
                            </div>
                        </div>    

                        <div class='col-lg-1'>
                            <div class="form-group">
                                <label>Ativo?</label>
                                {{ form.render('ativo') }}
                            </div>
                        </div>  

                        <div class='col-lg-2'>
                            <div id='div_expiracao' class="form-group  {% if data_expiracao is defined %} has-error {% endif %}">
                                <label>Data de Expiração</label>
                                {{ form.render('data_expiracao') }}
                                {% if data_expiracao is defined%}
                                    <label class='error'> {{ data_expiracao }}</label> 
                                {% endif %} 
                                
                                <label id='error_data_expiracao' class='error'></label>
                            </div>
                        </div>  
                    </div> 
                </div>
            </div>


    


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Localizacao</h3>
                </div>
                <div class="panel-body form-group row">
                    <div class='col-lg-2'>
                        <div class="form-group {% if logradouro is defined %} has-error {% endif %}">
                            <label>Logradouro</label>
                            {{ form.render('logradouro') }}
                            {% if logradouro is defined%}
                                <label class='error'> {{ logradouro }}</label> 
                            {% endif %} 
                        </div>
                    </div>

                    <div class='col-lg-2'>
                        <div class="form-group">
                            <label>Bairro</label>
                                <input type="text" class='form-control' value='' id="bairro" name="bairro" disabled>
                        </div>
                    </div>

                    <div class='col-lg-4'>
                        <div class="form-group">
                            <label>Endereço</label>
                                <input type="text" class='form-control' value='' id="tiponome" name="rua" disabled>
                        </div>
                    </div>

                    <div class='col-lg-2'>
                        <div class="form-group  {% if numero is defined %} has-error {% endif %}">
                            <label>Número</label>
                                {{ form.render('numero') }}
                                {% if numero is defined%}
                                    <label class='error'> {{ numero }}</label> 
                                {% endif %} 
                        </div>
                    </div>
                </div>
            </div>





            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Valores</h3>
                </div>
                <div class="panel-body form-group row">
                    <div class='col-lg-2'>
                        <div class="form-group">
                            <label>Tipo de negócio</label>
                        </div>
                        <div class="form-group ">
                            <div class="radio  {% if tipo_negocio_venda is defined %} has-error {% endif %}">
                                <label>{{ form.render('tipo_negocio_venda') }}Venda</label>
                                
                                <br>
                                <label>{{ form.render('tipo_negocio_aluguel') }}Aluguel</label>
                                    <br>
                                {% if tipo_negocio_venda is defined%}
                                    <label class='error'> {{ tipo_negocio_venda }}</label> 
                                {% endif %} 
                            </div>
                        </div>
                    </div>

                    <div class='col-lg-2'>
                        <div class="form-group">
                            <label id="preco">Preço</label>
                        </div>
                        <div class="form-group  {% if valor is defined %} has-error {% endif %}">
                            {{ form.render('valor') }}
                            {% if numero is defined%}
                                <label class='error'> {{ valor }}</label> 
                            {% endif %} 
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Imagem</h3>
                    </div>
                    <div class="panel-body ">
                        <div class="form-group row">
                                            <div class='col-lg-2'>
                                                <div class="form-group  {% if imovel_imagem is defined %} has-error {% endif %}">
                                                      {% if url_foto is defined %}
                                                        <img src="{{ static_url(url_foto) }}">
                                                      {% endif %}
                                                </div>
                                            </div>
                        </div>
                  
                            <label for='imovel_imagem' class="file">Selecionar um arquivo &#187;</label>
                            {{ form.render('imovel_imagem') }}
                            {% if imovel_imagem is defined%}
                                <label class='error'> {{ imovel_imagem }}</label> 
                            {% endif %} <br>
<label>Formatos válidos jpg/jpeg e png apenas.</label>

                            

                    </div>
                </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Detalhes</h3>
                </div>
                <div class="panel-body form-group row">
                    <div class='col-lg-2'>
                        <div class="form-group ">
                            <label>Dormitórios</label>
                        </div>
                        <div class="form-group {% if dormitorios is defined %} has-error {% endif %}">
                            {{ form.render('dormitorios') }}
                            {% if dormitorios is defined%}
                                <label class='error'> {{ dormitorios }}</label> 
                            {% endif %} 
                        </div>
                    </div>
                    <div class='col-lg-2'>
                        <div class="form-group">
                            <label>Banheiros</label>
                        </div>
                        <div class="form-group {% if banheiros is defined %} has-error {% endif %}">
                            {{ form.render('banheiros') }}
                            {% if banheiros is defined%}
                                <label class='error'> {{ banheiros }}</label> 
                            {% endif %} 
                        </div>
                    </div>
                    <div class='col-lg-2'>
                        <div class="form-group">
                            <label>Vagas de Garagem</label>
                        </div>
                        <div class="form-group {% if vagas_garagem is defined %} has-error {% endif %}">
                            {{ form.render('vagas_garagem') }}
                            {% if vagas_garagem is defined%}
                                <label class='error'> {{ vagas_garagem }}</label> 
                            {% endif %} 
                        </div>
                    </div>
                    <div class='col-lg-2'>
                        <div class="form-group">
                            <label>Área de Terreno</label>
                        </div>
                        <div class="form-group {% if area_terreno is defined %} has-error {% endif %}"">
                            {{ form.render('area_terreno') }}
                            {% if area_terreno is defined%}
                                <label class='error'> {{ area_terreno }}</label> 
                            {% endif %} 
                        </div>
                    </div>
                </div>
            </div>







            {% if action == 'Adicionar' %}
            <div class="text-center">
                <center><input type="submit" value="Cadastrar" class="btn btn-success"></center>
            </div>
            {% elseif action == 'Editar' %}
                <center><input type="submit" value="Salvar" class="btn btn-success"></center>
            {% elseif action == 'Excluir' %}            
                <center><input type="submit" id="btnExcluir" value="Excluir" class="btn btn-danger"></center>
            {% elseif action == 'Visualizar' %}
                <center><a href='{{ url('imoveis') }}' class='btn bg-primary'>Voltar</a></center>
            {% endif %}


        </div>
    </div>
</form>
</div>
<link type="text/css" rel="stylesheet" href="/css/chosen.min.css">
<link type="text/css" rel="stylesheet" href="/css/crud.css">
<link type="text/css" rel="stylesheet" href="/css/jquery-confirm.css">
<script type="text/javascript" src="/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="/js/crud-imoveis.js"></script>
<script type="text/javascript" src="/js/jquery-confirm.js"></script>
{% endblock %}
