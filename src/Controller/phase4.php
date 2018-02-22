<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\TaskPhase4;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class phase4 extends Controller
{
  /**
      * @Route("/phase4")
      */
    public function number(Request $request)
    {
        $task = new TaskPhase4();
        //set default infomation
        $name = '';
        $address = '';
        $content = '';
        $notice = '';

        //create form
        //Form documentation: https://symfony.com/doc/current/forms.html
        $form = $this->createFormBuilder($task)
          ->add('name', TextType::class)
          ->add('address', TextType::class)
          ->add('content', TextType::class)
          ->add('save', SubmitType::class, array('label' => 'Submit'))
          ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //get data
            $task = $form->getData();
            // get latitude, longitude and formatted address

            $name = $task->getName();
            $address = $task->getAddress();
            $content = $task->getContent();
            $notice = 'Location added!';
        }else {
          //Nothing
        }

        return $this->render('phase4.html.twig', array(
          'form' => $form->createView(),
          'name' => $name,
          'address' => $address,
          'content' => $content,
          'notice' => $notice,
        ));
    }
}

?>
