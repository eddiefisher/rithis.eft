<?php

namespace Eft\RithisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eft\RithisBundle\Entity\Messages;
use Symfony\Component\HttpFoundation\Request;
use Eft\RithisBundle\Form\Type\MessagesType;

class DefaultController extends Controller
{
  public function indexAction()
  {
    return $this->render('EftRithisBundle:Default:index.html.twig');
  }
  
  public function aboutAction()
  {
    return $this->render('EftRithisBundle:Default:about.html.twig');
  }
  
  public function contactAction()
  {
    return $this->render('EftRithisBundle:Default:contact.html.twig');
  }
  
  public function formAction(Request $request)
  {
    $message = new Messages();
    $form = $this->createForm(new MessagesType(), $message);
    
    if ($request->getMethod() == 'POST') {
      $form->bindRequest($request);
      if ($form->isValid()) {
        $dataSet = $this->getDoctrine()->getEntityManager();
        $dataSet->persist($message);
        $dataSet->flush();
        $this->sendMessage($message);
        return $this->redirect($this->generateUrl('EftRithisBundle_success', array('id' => $message->getId())));
      }
    }
    return $this->render('EftRithisBundle:Default:form.html.twig', array('form' => $form->createView()));
  }
  
  public function historyAction()
  {
    $repository = $this->getDoctrine()->getRepository('EftRithisBundle:Messages');
    $messages = $repository->findAll();
    if (!$messages) {
      $messages = false;
    }
    return $this->render('EftRithisBundle:Default:history.html.twig', array('messages' => $messages));
  }
  
  public function successAction($id)
  {
    $repository = $this->getDoctrine()->getRepository('EftRithisBundle:Messages');
    $message = $repository->find($id);
    if (!$message) {
      throw $this->createNotFoundException('No message found');
    }
    return $this->render('EftRithisBundle:Default:success.html.twig', array('message' => $message));
  }
  
  public function sendMessage($data, $send_to = null, $send_from = 'rithis@eddifisher.co.cc')
  {
    $message = \Swift_Message::newInstance()
      ->setContentType('text/html')
      ->setFrom($send_from)
      ->setTo($data->getMailTo())
      ->setSubject($data->getMailSubject())
      ->setBody($this->renderView('EftRithisBundle:Default:email.txt.twig', array('content' => $data->getMailContent(), 'subject' => $data->getMailSubject())))
    ;
    $this->get('mailer')->send($message);
  }
}
