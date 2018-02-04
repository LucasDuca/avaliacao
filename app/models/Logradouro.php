<?php

class Logradouro extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(column="bairro_id", type="integer", length=10, nullable=false)
     */
    public $bairro_id;

    /**
     *
     * @var string
     * @Column(column="tipo", type="string", length=15, nullable=false)
     */
    public $tipo;

    /**
     *
     * @var string
     * @Column(column="nome", type="string", length=70, nullable=false)
     */
    public $nome;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("avaliacao1");
        $this->setSource("logradouro");
        $this->hasMany('id', 'Imovel', 'logradouro_id', ['alias' => 'Imovel']);
        $this->belongsTo('bairro_id', '\Bairro', 'id', ['alias' => 'Bairro']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'logradouro';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Logradouro[]|Logradouro|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Logradouro|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
