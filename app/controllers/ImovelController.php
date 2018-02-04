<?php

use Phalcon\Validation\Validator\Callback;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Controller;

class ImovelController extends Controller {

    public function validarCodigo($id, $codigo) {
        $res = Imovel::findFirst([
                    "id <> :id: and codigo = :cod:",
                    "bind" => ["id" => $id,
                        "cod" => $codigo]
        ]);
        return $res ? true : false;
    }

    public function preencherEnderecoAction() {
        $logradouro_id = (int) $this->request->getPost('logradouro_id');

        $dados = Logradouro::query()
                ->columns(array(
                    "b.nome as bairro",
                    "tipo as tipo",
                    "Logradouro.nome as nome"
                        )
                )
                ->join('bairro', 'b.id = Logradouro.bairro_id', 'b', 'INNER')
                ->where('Logradouro.id = :id:')
                ->bind(["id" => $logradouro_id])
                ->execute();

        $result = [[
        'endereco' => $dados[0]->tipo . " " . $dados[0]->nome,
        'bairro' => $dados[0]->bairro
        ]];

        echo json_encode($result);
    }

    public function validarCodigoAction() {

        $id = (int) $this->request->getPost('id');
        $codigo = $this->request->getPost('codigo');

        $result = $this->validarCodigo($id, $codigo);

        $result = [[
        'exists' => $result
        ]];

        echo json_encode($result);
    }

    public function listarAction() {

        $dados = $this->request->getQuery('dados');
        $tipo_imovel_id = $this->request->getQuery('tipo_imovel_id');
        $numberPage = $this->request->getQuery("page", "int");

        $where = "Imovel.codigo like :cod:";
        $bind = ['cod' => '%' . $dados . '%',];

        if (is_numeric($tipo_imovel_id)) {
            //adicionando condições na query
            $where .= " and Imovel.tipo_imovel_id = :tipo:";
            $bind = array_merge($bind, ["tipo" => $tipo_imovel_id]);
        }

        $imovel = Imovel::find([
                    $where,
                    'bind' => $bind,
        ]);

        $imovel = Imovel::query()
                ->columns(array(
                    "Imovel.codigo as codigo",
                    "Imovel.titulo_imovel as titulo",
                    "Imovel.descricao as descricao",
                    "Imovel.valor_venda as venda",
                    "Imovel.valor_aluguel as aluguel",
                    "Imovel.id as id",
                    "im.caminho as caminho"
                        )
                )
                ->leftjoin('imovelimagem', 'im.imovel_id = Imovel.id', 'im')
                ->where($where)
                ->bind($bind)
                ->execute();




        $paginator = new Paginator(array(
            "data" => $imovel,
            "limit" => 10,
            "page" => $numberPage
        ));

        $tipo_imovel = Phalcon\Tag::select(array(
                    "tipo_imovel_id",
                    TipoImovel::find(),
                    'useEmpty' => true,
                    'emptyText' => 'Escolher...',
                    'emptyValue' => '',
                    "using" => array("id", "nome"),
                    "class" => "form-control",
                    "value" => ($tipo_imovel_id ? $tipo_imovel_id : 0) // This is a setDefault() shortcut for tag call
        ));
        $this->view->tipo_imovel_id = $tipo_imovel_id;
        $this->view->tipo_imovel = $tipo_imovel;
        $this->view->dados = $dados;
        $this->view->page = $paginator->getPaginate();
    }

    public function crudAction() {
        if (!($this->view->form)) {
            $this->view->form = new ImovelForm();
        }
    }

    public function adicionarAction() {
        $this->view->action = "Adicionar";
        $this->view->action_url = "adicionar";

        $imovel = new Imovel();
        $form = new ImovelForm($imovel, ['adicionar' => true]);

        if ($this->request->isPost()) {

            //atualizar todos dados no form validando o post


            $valor = str_replace(",", "", $form->get('valor')->getValue());


            $flag_tipo_negocio = $this->request->getPost('tipo_negocio') == "V" ? "venda" : "aluguel";

            $dados['id'] = $this->request->getPost('id');
            $dados['codigo'] = $this->request->getPost('codigo');
            $dados['tipo_imovel_id'] = $this->request->getPost('tipo_imovel');
            $dados['filial_id'] = $this->request->getPost('filial');
            $dados['logradouro_id'] = $this->request->getPost('logradouro');
            $dados['numero'] = $this->request->getPost('numero');
            $dados['tipo_negocio_' . $flag_tipo_negocio] = $this->request->getPost('tipo_negocio');
            $dados['dormitorios'] = $this->request->getPost('dormitorios');
            $dados['area_terreno'] = $this->request->getPost('area_terreno');
            $dados['banheiros'] = $this->request->getPost('banheiros');
            $dados['vagas_garagem'] = $this->request->getPost('vagas_garagem');
            $dados['titulo_imovel'] = $this->request->getPost('titulo_imovel');
            $dados['descricao'] = $this->request->getPost('descricao');
            $dados['publicado'] = $this->request->getPost('publicado');
            $dados['ativo'] = $this->request->getPost('ativo');

            $form->isValid($dados);
            $form->get('codigo')->addValidator(new Callback(
                    [
                "callback" => function($data) {
                    return $this->validarCodigo($data['id'], $data['codigo']) == true ? false : true;
                },
                "message" => "O código " . $dados['codigo'] . " já existe."
                    ]
            ));


            if ($dados['publicado'] == 'S') {
                $form->get('data_expiracao')->addValidator(new PresenceOf(array(
                    'message' => "Para publicar é necessário preencher."
                )));

                $form->get('data_expiracao')->addValidator(new Callback(
                        ["callback" => function($data) {
                        //echo $data['data_expiracao']; exit;
                        $data = explode("/", $data['data_expiracao']);

                        return checkdate($data[1], $data[0], $data[2]) == false ? false : true;
                    },
                    "message" => "A data " . $this->request->getPost('data_expiracao') . " não é válida."
                        ]
                ));
            }

            $form->get('imovel_imagem')->addValidator(
                    new Callback(
                    [
                "hasFile" => function($data) {

                    return $this->request->hasFiles() ? false : true;
                },
                "message" => "A foto è obrigatòria."
                    ]
            ));


            if ($this->request->hasFiles() == true) {

                if ($this->request->getUploadedFiles()[0]->getExtension() != '') {
                    $form->get('imovel_imagem')->addValidator(new Callback(
                            [
                        "callback" => function($data) {

                            return in_array(strtolower($this->request->getUploadedFiles()[0]->getExtension()), array("png", "jpg", "jpeg")) ? true : false;
                        },
                        "message" => "Somente são aceitas extensões jpg/jpeg e png."
                            ]
                    ));
                }
            }



            if ($form->isValid($this->request->getPost()) != false) {


                $imovel = Imovel::findFirst($dados['id']);
                $form->bind($dados, $imovel);
                $imovel->tipo_negocio = $this->request->getPost('tipo_negocio') == "V" ? "V" : "A";
                $imovel->valor_venda = ($dados['tipo_negocio_' . $flag_tipo_negocio] == 'V' ? $valor : 0);
                $imovel->valor_aluguel = ($dados['tipo_negocio_' . $flag_tipo_negocio] == 'A' ? $valor : 0);
                $imovel->data_expiracao = $this->inverterData($this->request->getPost('data_expiracao'));

                


                $imvImg = new ImovelImagem();


                if ($imovel->save()) {

                    $upload = $this->request->getUploadedFiles();
                    $upload = $upload[0];
                    $path = "/uploads";
                    if ($upload->moveTo($path)) {
                        $name_of_miniature = "mini_" . $imovel->id;
                        $img = new Phalcon\Image\Adapter\Gd($path);
                        $path_mini = "uploads/" . $name_of_miniature . "." . $upload->getExtension();
                        $img->resize(600, 400)->crop(600, 400);

                        if ($img->save($path_mini, 100)) {
                            $imvImg->imovel_id = $imovel->id;
                            $imvImg->caminho = $path_mini;
                            $imvImg->save();
                        }
                    }

                    $this->flash->success('Imóvel cadastrado com sucesso!');
                    return $this->response->redirect('imoveis/editar?id=' . $imovel->id);
                }
            } else {
                $this->flash->error('Corrija os campos em vermelho para continuar.');
                $this->setErrors($form);
            }
        } else {
            $form = new ImovelForm($imovel, ['adicionar' => true]);
        }

        $this->view->form = $form;

        return $this->dispatcher->forward([
                    "action" => "crud"
        ]);
    }

    public function editarAction() {
        $this->view->action = "Editar";
        $this->view->action_url = "editar";
        $id = $this->request->isPost() ? $this->request->getPost("id") : $this->request->getQuery("id", "int");
        $imovel = Imovel::findFirst($id);

        #atualiza a data aqui para ser aplicar filtro e exibir corretamente no form
        if (isset($imovel->data_expiracao))
            $imovel->data_expiracao = $this->inverterData($imovel->data_expiracao);



        if ($this->request->isPost()) {
            $form = new ImovelForm();
            //pegar todos dados e inserir no imovel
            $form->isValid($this->request->getPost());
            $valor = str_replace(",", "", $form->get('valor')->getValue());


            $flag_tipo_negocio = $this->request->getPost('tipo_negocio') == "V" ? "venda" : "aluguel";

            $dados['id'] = $this->request->getPost('id');
            $dados['codigo'] = $this->request->getPost('codigo');
            $dados['tipo_imovel_id'] = $this->request->getPost('tipo_imovel');
            $dados['filial_id'] = $this->request->getPost('filial');
            $dados['logradouro_id'] = $this->request->getPost('logradouro');
            $dados['numero'] = $this->request->getPost('numero');
            $dados['tipo_negocio_' . $flag_tipo_negocio] = $this->request->getPost('tipo_negocio');
            $dados['dormitorios'] = $this->request->getPost('dormitorios');
            $dados['area_terreno'] = $this->request->getPost('area_terreno');
            $dados['banheiros'] = $this->request->getPost('banheiros');
            $dados['vagas_garagem'] = $this->request->getPost('vagas_garagem');
            $dados['titulo_imovel'] = $this->request->getPost('titulo_imovel');
            $dados['descricao'] = $this->request->getPost('descricao');
            $dados['publicado'] = $this->request->getPost('publicado');
            $dados['ativo'] = $this->request->getPost('ativo');
            //var_dump($dados); exit;

            $form->get('codigo')->addValidator(new Callback(
                    ["callback" => function($data) {
                    return $this->validarCodigo($data['id'], $data['codigo']) == true ? false : true;
                },
                "message" => "O código " . $dados['codigo'] . " já existe."
                    ]
            ));

            if ($this->request->hasFiles() == true) {

                if ($this->request->getUploadedFiles()[0]->getExtension() != '') {
                    $form->get('imovel_imagem')->addValidator(new Callback(
                            [
                        "callback" => function($data) {

                            return in_array(strtolower($this->request->getUploadedFiles()[0]->getExtension()), array("png", "jpg", "jpeg")) ? true : false;
                        },
                        "message" => "Somente são aceitas extensões jpg/jpeg e png."
                            ]
                    ));
                }
            }


            if ($dados['publicado'] == 'S') {
                $form->get('data_expiracao')->addValidator(new PresenceOf(array(
                    'message' => "Para publicar é necessário preencher."
                )));

                $form->get('data_expiracao')->addValidator(new Callback(
                        ["callback" => function($data) {
                        //echo $data['data_expiracao']; exit;
                        $data = explode("/", $data['data_expiracao']);

                        return checkdate($data[1], $data[0], $data[2]) == false ? false : true;
                    },
                    "message" => "A data " . $this->request->getPost('data_expiracao') . " não é válida."
                        ]
                ));
            }

            if ($dados['tipo_negocio_venda'] == '' && $dados['tipo_negocio_aluguel'] == '') {
                $form->get('tipo_negocio_venda')->addValidator(new PresenceOf(array(
                    'message' => "Selecione uma das opções."
                )));
            }


            if ($form->isValid($this->request->getPost()) != false) {
                $form->bind($dados, $imovel);
                $imovel->tipo_negocio = $dados['tipo_negocio_' . $flag_tipo_negocio];
                $imovel->valor_venda = ($dados['tipo_negocio_' . $flag_tipo_negocio] == 'V' ? $valor : 0);
                $imovel->valor_aluguel = ($dados['tipo_negocio_' . $flag_tipo_negocio] == 'A' ? $valor : 0);
                $imovel->data_expiracao = $this->inverterData($this->request->getPost('data_expiracao'));


              

                //echo $imovel->data_expiracao; exit;
                $imvImg = new ImovelImagem();

                if ($this->request->hasFiles() == true && $this->request->getUploadedFiles()[0]->getExtension() != '') {
                    $upload = $this->request->getUploadedFiles();
                    $upload = $upload[0];
                    $path = "/uploads";
                    if ($upload->moveTo($path)) {
                        $name_of_miniature = "mini_" . $dados['id'];
                        $img = new Phalcon\Image\Adapter\Gd($path);
                        $path_mini = "uploads/" . $name_of_miniature . "." . $upload->getExtension();
                        $img->resize(600, 400)->crop(600, 400);



                        if ($img->save($path_mini, 100)) {

                            $img_exists = ImovelImagem::findFirst(["imovel_id = :id:",
                                        "bind" => ['id' => $dados['id']]
                            ]);
                            if ($img_exists) {
                                $imvImg = $img_exists;
                            }


                            $imvImg->imovel_id = $dados["id"];
                            $imvImg->caminho = $path_mini;
                            $imvImg->save();
                        } else {
                            
                        }
                    }
                }

                if ($imovel->save()) {
                    foreach ($imovel->getMessages() as $message) {
                        echo $message->getMessage();
                    }
                    $this->flash->success('Imóvel alterado com sucesso!');
                    return $this->response->redirect('imoveis/editar?id=' . $dados['id']);
                } else {
                    foreach ($imovel->getMessages() as $message) {
                        echo $message;
                    }
                    echo "erro ao salvar";
                    exit;
                }
            } else {
                $this->flash->error('Corrija os campos em vermelho para continuar.');
                $this->setErrors($form);
            }
        } else {

            $form = new ImovelForm($imovel, ['edit' => true]);
        }

        $ft = ImovelImagem::findFirst(["imovel_id = :id:", "bind" => ['id' => $id]]);

        $this->view->url_foto = ($ft->caminho ? '/' . $ft->caminho : '');
        $this->view->form = $form;

        return $this->dispatcher->forward([
                    "action" => "crud",
        ]);
    }

    public function setErrors($form) {
        //função para facilitar o tratamento dos erros na view.
        foreach ($form as $element) {
            $filtered = $form->getMessages()->filter($element->getName());

            if ($filtered != null) {
                $concat = "";
                foreach ($filtered as $item) {
                    $concat = $item . '</br>';
                }
            } else {
                $concat = null;
            }
            $newvar = $element->getName();
            $this->view->$newvar = $concat;
        }
    }

    public function removerAction() {
        $this->view->action = "Excluir";
        $this->view->action_url = "remover";
        $id = $this->request->getQuery("id", "int");
        $imovel = Imovel::findFirst($id);
        $form = new ImovelForm($imovel, ['excluir' => true]);

        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost())) {
                $ft = ImovelImagem::findFirst(["imovel_id = :id:", "bind" => ['id' => $imovel->id]]);
                unlink($ft->caminho);
                $ft->delete();
                $imovel->delete();
                $this->flash->success('Imóvel deletado com sucesso!');


                return $this->response->redirect('imoveis/');
            }
        }

        $ft = ImovelImagem::findFirst(["imovel_id = :id:", "bind" => ['id' => $id]]);

        $this->view->url_foto = ($ft->caminho ? '/' . $ft->caminho : '');
        $this->view->form = $form;
        return $this->dispatcher->forward([
                    "action" => "crud"
        ]);
    }

    public function visualizarAction() {

        $this->view->action = "Visualizar";
        $id = $this->request->getQuery("id", "int");
        $imovel = Imovel::findFirst($id);
        $form = new ImovelForm($imovel, ['visualizar' => true]);
        $ft = ImovelImagem::findFirst(["imovel_id = :id:", "bind" => ['id' => $id]]);

        $this->view->url_foto = ($ft->caminho ? '/' . $ft->caminho : '');
        $this->view->form = $form;

        return $this->dispatcher->forward([
                    "action" => "crud"
        ]);
    }

    function inverterData($d) {
        if (count(explode("/", $d)) > 1) {
            return implode("-", array_reverse(explode("/", $d)));
        } elseif (count(explode("-", $d)) > 1) {
            $data = explode(" ", $d);
            return implode("/", array_reverse(explode("-", $data[0])));
        }
    }

    public function indexAction() {
        
    }

}
