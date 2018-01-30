<?php

class Imovel extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(column="codigo", type="string", length=10, nullable=false)
     */
    public $codigo;

    /**
     *
     * @var integer
     * @Column(column="tipo_imovel_id", type="integer", length=10, nullable=false)
     */
    public $tipo_imovel_id;

    /**
     *
     * @var integer
     * @Column(column="filial_id", type="integer", length=11, nullable=false)
     */
    public $filial_id;

    /**
     *
     * @var integer
     * @Column(column="logradouro_id", type="integer", length=11, nullable=false)
     */
    public $logradouro_id;

    /**
     *
     * @var integer
     * @Column(column="numero", type="integer", length=11, nullable=true)
     */
    public $numero;

    /**
     *
     * @var string
     * @Column(column="tipo_negocio", type="string", nullable=false)
     */
    public $tipo_negocio;

    /**
     *
     * @var string
     * @Column(column="valor_venda", type="string", nullable=true)
     */
    public $valor_venda;

    /**
     *
     * @var string
     * @Column(column="valor_aluguel", type="string", nullable=true)
     */
    public $valor_aluguel;

    /**
     *
     * @var integer
     * @Column(column="dormitorios", type="integer", length=11, nullable=true)
     */
    public $dormitorios;

    /**
     *
     * @var string
     * @Column(column="area_terreno", type="string", nullable=true)
     */
    public $area_terreno;

    /**
     *
     * @var integer
     * @Column(column="banheiros", type="integer", length=11, nullable=true)
     */
    public $banheiros;

    /**
     *
     * @var integer
     * @Column(column="vagas_garagem", type="integer", length=11, nullable=true)
     */
    public $vagas_garagem;

    /**
     *
     * @var string
     * @Column(column="titulo_imovel", type="string", length=255, nullable=true)
     */
    public $titulo_imovel;

    /**
     *
     * @var string
     * @Column(column="descricao", type="string", nullable=true)
     */
    public $descricao;

    /**
     *
     * @var string
     * @Column(column="publicado", type="string", nullable=false)
     */
    public $publicado;

    /**
     *
     * @var string
     * @Column(column="data_expiracao", type="string", nullable=true)
     */
    public $data_expiracao;

    /**
     *
     * @var string
     * @Column(column="ativo", type="string", nullable=false)
     */
    public $ativo;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("avaliacao1");
        $this->setSource("Imovel");
        $this->belongsTo('tipo_imovel_id', '\TipoImovel', 'id', ['alias' => 'TipoImovel']);
        $this->belongsTo('filial_id', '\Filial', 'id', ['alias' => 'Filial']);
        $this->belongsTo('logradouro_id', '\Logradouro', 'id', ['alias' => 'Logradouro']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'Imovel';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Imovel[]|Imovel|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Imovel|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
