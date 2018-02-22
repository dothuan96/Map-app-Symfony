<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class index extends Controller
{
  /**
      * @Route("/")
      */
    public function name(){
      $phase1 = '/phase1';
      $phase2 = '/phase2';
      $phase4 = '/phase4';

      return $this->render('index.html.twig', array(
        'phase1' => $phase1,
        'phase2' => $phase2,
        'phase4' => $phase4,
      ));
    }
}

?>
