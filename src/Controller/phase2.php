<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\TaskPhase2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class phase2 extends Controller
{
  /**
      * @Route("/phase2")
      */
    public function number(Request $request)
    {
        $myGeocode = new geocoding();
        $task = new TaskPhase2();

        //default address and marker
        $latA = 0;  $lngA = 0;
        $latB = 0;  $lngB = 0;
        $add1 = ''; $add2 = '';
        $mode = 'DRIVING';

        //create form
        //Form documentation: https://symfony.com/doc/current/forms.html
        $form = $this->createFormBuilder($task)
          ->add('location1', TextType::class)
          ->add('location2', TextType::class)
          ->add('travel', ChoiceType::class, array(
            'choices'  => array(
                'DRIVING' => 1,
                'WALKING' => 2,
                'BICYCLING' => 3,
                'TRANSIT' => 4,
            ),))
          ->add('save', SubmitType::class, array('label' => 'Submit'))
          ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //get data
            $task = $form->getData();
            // get latitude, longitude and formatted address
            $data_arr1 = $myGeocode->geocode($task->getLocation1());
            $data_arr2 = $myGeocode->geocode($task->getLocation2());
            $mode = $myGeocode->travelMode($task->getTravel());

            // if able to geocode the address
            if($data_arr1 || $data_arr2){
              $latA = $data_arr1[0];
              $lngA = $data_arr1[1];
              $add1 = $data_arr1[2];

              $latB = $data_arr2[0];
              $lngB = $data_arr2[1];
              $add2 = $data_arr2[2];
            // if unable to geocode the address
            }
        }else {
          //Nothing
        }

        return $this->render('phase2.html.twig', array(
            'form' => $form->createView(),
            'latA' => $latA,
            'lngA' => $lngA,
            'latB' => $latB,
            'lngB' => $lngB,
            'add1' => $add1,
            'add2' => $add2,
            'mode' => $mode,
        ));
    }
}

?>
