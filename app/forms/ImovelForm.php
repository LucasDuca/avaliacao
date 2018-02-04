<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Radio;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Callback;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class ImovelForm extends Form {

    public function initialize($imovel = null, $options = null) {

        $message = "Este campo é requerido";
        $disabled_all = "";
        $check_tp_venda = $imovel->tipo_negocio == 'V' ? 'checked' : '';
        $check_tp_aluguel = $imovel->tipo_negocio == 'A' ? 'checked' : '';
        
        $id = new Hidden("id");

        if($options['adicionar']) {
            $check_tp_venda = "checked";
        } elseif ($options['edit']) {
            $id->addValidator(new PresenceOf(array(
                'message' => 'O id não pode ser modificado'
            )));
        } elseif ($options['visualizar']) {
            $disabled_all = "disabled";
        } else {
            
        }

        $this->add($id);

        $codigo = new Text("codigo", array('class' => 'form-control rem', $disabled_all => ''));
        $codigo->addValidator(new PresenceOf(array(
            'message' => $message
        )));


        $this->add($codigo);





        $tipo_imovel = new Select('tipo_imovel', TipoImovel::find(), array('class' => 'form-control rem',
            $disabled_all => '',
            'useEmpty' => true,
            'emptyText' => 'Escolher...',
            'emptyValue' => '',
            'using' => array('id', 'nome'),
            'value' => $imovel->tipo_imovel_id)
        );

        $tipo_imovel->addValidator(new PresenceOf(array(
            'message' => $message
        )));


        $filial = new Select('filial', Filial::find(), array('class' => 'form-control rem',
            $disabled_all => '',
            'useEmpty' => true,
            'emptyText' => 'Escolher filial...',
            'emptyValue' => '',
            'using' => array('id', 'nome'),
            'value' => $imovel->filial_id)
        );

        $filial->addValidator(new PresenceOf(array(
            'message' => $message
        )));

        $this->add($filial);

        $logradouro = new Select('logradouro', Logradouro::find(), array('class' => 'form-control rem chosen logra',
            $disabled_all => '',
            'useEmpty' => true,
            'emptyText' => 'Escolher filial...',
            'emptyValue' => '',
            'using' => array('id', 'nome'),
            'value' => $imovel->logradouro_id)
        );

        $logradouro->addValidator(new PresenceOf(array(
            'message' => $message
        )));

        $this->add($logradouro);

        $numero = new Text("numero", array("class" => "form-control rem", $disabled_all => ''));

        $numero->addValidator(new PresenceOf(array(
            'message' => $message
        )));

        $this->add($numero);


        
        $tipo_negocio_venda = new Radio('tipo_negocio_venda', array("class" => "rem",  'value' => 'V', 'name' => 'tipo_negocio', $check_tp_venda => '', $disabled_all => ''));
        $this->add($tipo_negocio_venda);
        $tipo_negocio_aluguel = new Radio('tipo_negocio_aluguel', array("class" => "rem", 'value' => 'A', 'name' => 'tipo_negocio', $check_tp_aluguel => '', $disabled_all => ''));

        $this->add($tipo_negocio_aluguel);

        $vl = ($imovel->valor_venda > 0 ? $imovel->valor_venda : $imovel->valor_aluguel);
        $valor = new Text("valor", array("class" => "form-control rem", "value" => $vl, $disabled_all => ''));
        $valor->addValidator(new PresenceOf(array(
            'message' => $message
        )));

        $this->add($valor);


        $dormitorios = new Text("dormitorios", array("class" => "form-control rem", $disabled_all => ''));
        $dormitorios->addValidator(new PresenceOf(array(
            'message' => $message
        )));
        $this->add($dormitorios);

        $area_terreno = new Text("area_terreno", array("class" => "form-control rem", $disabled_all => ''));
        $area_terreno->addValidator(new PresenceOf(array(
            'message' => $message
        )));
        $this->add($area_terreno);

        $banheiros = new Text("banheiros", array("class" => "form-control rem", $disabled_all => ''));
        $banheiros->addValidator(new PresenceOf(array(
            'message' => $message
        )));
        $this->add($banheiros);

        $vagas_garagem = new Text("vagas_garagem", array("class" => "form-control rem", $disabled_all => ''));
        $vagas_garagem->addValidator(new PresenceOf(array(
            'message' => $message
        )));
        $this->add($vagas_garagem);

        $titulo_imovel = new Text("titulo_imovel", array("class" => "form-control rem", $disabled_all => ''));
        $titulo_imovel->addValidator(new PresenceOf(array(
            'message' => $message
        )));
        $this->add($titulo_imovel);

        $descricao = new Text("descricao", array("class" => "form-control", $disabled_all => ''));
        $this->add($descricao);

        $publicado = new Check("publicado", array("class" => "checkbox","value" => "S", $disabled_all => ''));

        $this->add($publicado);

        $data_expiracao = new Text("data_expiracao", array("class" => "form-control rem", $disabled_all => ''));

        $this->add($data_expiracao);

        $ativo = new Check("ativo", array("class" => "checkbox","value" => "S", $disabled_all => ''));

        $this->add($ativo);

        $imovel_imagem = new File("imovel_imagem", array("class" => "form-control rem", $disabled_all => ''));
        $this->add($imovel_imagem);








        $tipo_imovel->addValidator(new PresenceOf(array(
            'message' => $message
        )));
        $this->add($tipo_imovel);



        //$this->add($codigo);
        //}
    }

}
