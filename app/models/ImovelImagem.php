<?php

class ImovelImagem extends \Phalcon\Mvc\Model
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
     * @Column(column="imovel_id", type="integer", length=10, nullable=false)
     */
    public $imovel_id;

    /**
     *
     * @var string
     * @Column(column="caminho", type="string", nullable=false)
     */
    public $caminho;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("avaliacao1");
        $this->setSource("Imovel_Imagem");
        $this->belongsTo('imovel_id', '\Imovel', 'id', ['alias' => 'Imovel']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'Imovel_Imagem';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ImovelImagem[]|ImovelImagem|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ImovelImagem|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
