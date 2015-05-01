<?php
// src/MC/EventBundle/Controller/CAController.php

namespace MC\EventBundle\Controller;

use MC\EventBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CAController extends Controller
{
  public function addAction(Request $request)
  {
    // Cr�ation de l'entit� CA
    $ca = new CA();

    // Cr�ation du formulaire
    $form = $this->get('form.factory')->create(new CAType(), $ca);
   
    // On v�rifie que les valeurs entr�es sont correctes
    if ($form->handleRequest($request)->isValid())
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($ca);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Club ou association bien enregistr�(e).');

        //On redirige vers la page de visualisation du CA nouvellement cr��
        return $this->redirect($this->generateUrl('mc_event_view', array('id' => $ca->getId())));
         $contenu =$this->renderView('MCEventBundle:CA:email.txt.twig')
        mail ('louis.annabi@supelec.fr', 'Enregistrement club ou association ok', $contenu);


    }

    return $this->render('MCEventBundle:CA:add.html.twig',array('form' => $form->createView()));
  }


  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On r�cup�re le ca $id
    $ca = $em->getRepository('MCEventBundle:CA')->find($id);

    if (null === $ca) {
      throw new NotFoundHttpException("Le club ou association d'id ".$id." n'existe pas.");
    }

    $form = $this->createForm(new CAEditType(), $ca);

    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait d�j� notre ca
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Club ou association bien modifi�(e).');

      return $this->redirect($this->generateUrl('mc_event_view', array('id' => $ca->getId())));
    }

    return $this->render('MCEventBundle:CA:edit.html.twig', array(
      'form'   => $form->createView(),
      'ca' => $ca // Je passe �galement le ca � la vue si jamais il veut l'afficher
    ));
  }

  public function deleteAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On r�cup�re le ca $id
    $ca = $em->getRepository('MCEventBundle:CA')->find($id);

    if (null === $ca) {
      throw new NotFoundHttpException("Le club ou association d'id ".$id." n'existe pas.");
    }

    // On cr�e un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de prot�ger la suppression de CA contre cette faille
    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($ca);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "Le club ou association a bien �t� supprim�(e).");

      return $this->redirect($this->generateUrl('mc_event_home'));
    }

    // Si la requ�te est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('MCEventBundle:CA:delete.html.twig', array(
      'ca' => $ca,
      'form'   => $form->createView()
    ));
  }
}