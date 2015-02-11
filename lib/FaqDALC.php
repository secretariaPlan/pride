<?php
//El dalc para las preguntas frecuentes
//Javier Alpizar, 23 Abr 08

include_once("phplib/DbFactory.inc.php");

class FaqDALC
{
	
	public static function ObtenCategorias($inicio=0,$cantidad=100000)
	{
		$oDb = DbFactory::ObtenDb();
		//regresa las cateogiras y el numero de preguntas por cada una
		$query = "select faq.faqId as faqId,categoria,count(id) as cantidad from faq left join faq_h on faq.faqId = faq_h.faqId group by faq.faqId";
		$oDb->query($query);
		$arr= array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		return $arr;
		
	}
	
	public static function ObtenPreguntasXCategoria($faqId,$inicio=0,$cantidad=100000)
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT id,pregunta,respuesta from faq_h where faqId = $faqId order by pregunta limit $inicio,$cantidad";
		$oDb->query($query);
		$arr= array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		return $arr;
		
	}
	
	public static function ObtenCategoria($faqId)
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT faqId,categoria from faq where faqId = $faqId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
		
	}
	
	public static function ObtenPregunta($id)
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT pregunta,respuesta from faq_h where id = $id";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
		
	}
	
	
}

?>