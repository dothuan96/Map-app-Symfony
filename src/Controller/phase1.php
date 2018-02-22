<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\TaskPhase1;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class phase1 extends Controller
{
  /**
      * @Route("/phase1")
      */
    public function number(Request $request)
    {
        $myGeocode = new geocoding();
        $task = new TaskPhase1();

        //default address and marker
        $latitude = 40.7127753;
        $longitude = -74.0059728;
        $formatted_address = 'New York, NY, USA';
        $icon = 'https://i.imgur.com/U4URqbu.png';

        //create form
        //Form documentation: https://symfony.com/doc/current/forms.html
        $form = $this->createFormBuilder($task)
          ->add('location', TextType::class)
          ->add('icon', ChoiceType::class, array(
            'choices'  => array(
                'Ball' => 1,
                'Flag' => 2,
                'Pin' => 3,
            ),))
          ->add('color', ChoiceType::class, array(
            'choices'  => array(
                'Red' => 1,
                'Green' => 2,
                'Blue' => 3,
            ),))
          ->add('save', SubmitType::class, array('label' => 'Submit'))
          ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //get data
            $task = $form->getData();
            // get latitude, longitude and formatted address
            $data_arr = $myGeocode->geocode($task->getLocation());
            $icon = $myGeocode->changeMarker($task->getIcon(), $task->getColor());

            // if able to geocode the address
            if($data_arr){
                $latitude = $data_arr[0];
                $longitude = $data_arr[1];
                $formatted_address = $data_arr[2];
            // if unable to geocode the address
            }
        }else {
          //Nothing
        }

        return $this->render('phase1.html.twig', array(
            'form' => $form->createView(),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'formatted_address' => $formatted_address,
            'icon' => $icon,
        ));
    }
}

?>
