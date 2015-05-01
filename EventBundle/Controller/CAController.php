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
    // Création de l'entité CA
    $ca = new CA();

    // Création du formulaire
    $form = $this->get('form.factory')->create(new CAType(), $ca);
   
    // On vérifie que les valeurs entrées sont correctes
    if ($form->handleRequest($request)->isValid())
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($ca);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Club ou association bien enregistré(e).');

        //On redirige vers la page de visualisation du CA nouvellement créé
        return $this->redirect($this->generateUrl('mc_event_view', array('id' => $ca->getId())));
         $contenu =$this->renderView('MCEventBundle:CA:email.txt.twig')
        mail ('louis.annabi@supelec.fr', 'Enregistrement club ou association ok', $contenu);


    }

    return $this->render('MCEventBundle:CA:add.html.twig',array('form' => $form->createView()));
  }


  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On récupère le ca $id
    $ca = $em->getRepository('MCEventBundle:CA')->find($id);

    if (null === $ca) {
      throw new NotFoundHttpException("Le club ou association d'id ".$id." n'existe pas.");
    }

    $form = $this->createForm(new CAEditType(), $ca);

    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre ca
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Club ou association bien modifié(e).');

      return $this->redirect($this->generateUrl('mc_event_view', array('id' => $ca->getId())));
    }

    return $this->render('MCEventBundle:CA:edit.html.twig', array(
      'form'   => $form->createView(),
      'ca' => $ca // Je passe également le ca à la vue si jamais il veut l'afficher
    ));
  }

  public function deleteAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On récupère le ca $id
    $ca = $em->getRepository('MCEventBundle:CA')->find($id);

    if (null === $ca) {
      throw new NotFoundHttpException("Le club ou association d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression de CA contre cette faille
    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($ca);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "Le club ou association a bien été supprimé(e).");

      return $this->redirect($this->generateUrl('mc_event_home'));
    }

    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('MCEventBundle:CA:delete.html.twig', array(
      'ca' => $ca,
      'form'   => $form->createView()
    ));
  }
}