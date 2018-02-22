<?php
namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
  /**
      * @Route("/testform")
      */
  public function new(Request $request)
  {
      // just setup a fresh $task object (remove the dummy data)
      $task = new Task();

      $form = $this->createFormBuilder($task)
          ->add('task', TextType::class)
          ->add('dueDate', DateType::class)
          ->add('save', SubmitType::class, array('label' => 'Create Task'))
          ->add('choice', ChoiceType::class, array(
            'choices'  => array(
                'Maybe' => 1,
                'Yes' => 2,
                'No' => 'false',
            ),))
          ->getForm();

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $task = $form->getData();
      }

      return $this->render('default/new.html.twig', array(
          'form' => $form->createView(),
          'task' => $task->getTask(),
          'choice' => $task->getChoice(),
      ));
  }
}

?>
