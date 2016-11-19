<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



class fechayhoraController extends Controller
{
	/**
     * @Route("/fecha/{tema}")
     * @Method({"GET", "POST"})
     */
	 public function numberAction($tema)
    {
    	$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());

		$serializer = new Serializer($normalizers, $encoders);
        $number = mt_rand(8, 16);
        $day = mt_rand(1,30);
        $month = mt_rand(3,12);
        $year = 2016;
        $fecha = $number.'-'.$month.'-'.$year;
        $hora = array('hora' => $number,'fecha'=> $fecha,'tema' => $tema);
        $jsonContent = $serializer->serialize($hora, 'json');
        return new Response(
           $jsonContent
        );
    }





}
