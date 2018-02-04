<?php

use Phalcon\Mvc\Controller;
use App\Models;

class IndexController extends Controller
{

	public function indexAction()
	{
		$imoveis = Imovel::query()
                ->columns(array(
                    "Imovel.codigo as codigo",
                    "Imovel.titulo_imovel as titulo",
                    "Imovel.data_expiracao as data_expiracao",
                    "Imovel.valor_venda as venda",
                    "Imovel.valor_aluguel as aluguel",
                    "Imovel.id as id",
                    "im.caminho as caminho"
                        )
                )
                ->leftjoin('imovelimagem', 'im.imovel_id = Imovel.id', 'im')
                ->order('Imovel.data_expiracao')
                ->execute();
                
                $this->view->imoveis = $imoveis;

	}

}
