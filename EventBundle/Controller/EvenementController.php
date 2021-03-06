<?php
// src/MC/EventBundle/Controller/EvenementController.php

namespace MC\EventBundle\Controller;

use MC\EventBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EvenementController extends Controller
{
    public function indexAction($page)
    {
    // On ne sait pas combien de pages il y a
    // Mais on sait qu'une page doit �tre sup�rieure ou �gale � 1
    if ($page < 1) {
      // On d�clenche une exception NotFoundHttpException, cela va afficher
      // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }
    // Ici, on r�cup�rera la liste des �v�nements, puis on la passera au template
    $listEvenements = array(
      array(
        'nomEvenement'   => 'Soir�e post partiels',
        'id'      => 1,
        'nomOrganisateur'  => 'Coop�',
        'descriptif' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
        'dateDebut'    => 'lundi'),
      array(
        'nomEvenement'   => 'Blindtest',
        'id'      => 2,
        'nomOrganisateur'  => 'BdA',
        'descriptif' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'dateDebut'    => 'mardi'),
      array(
        'nomEvenement'   => 'JT de passation',
        'id'      => 3,
        'nomOrganisateur'  => 'SMS',
        'descriptif' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'dateDebut'    => 'jeudi')
    );
    // Mais pour l'instant, on ne fait qu'appeler le template
    return $this->render('MCEventBundle:Evenement:index.html.twig', array(
  'listEvenements'=> $listEvenements
  ));
  }

    public function viewAction($id)
    {
    $evenement = array(
      'nomEvenement'   => 'Soir�e post partiels',
      'id'      => $id,
      'nomOrganisateur'  => 'Coop�',
      'descriptif' => 'Blablabla...',
      'dateDebut'    => 'lundi'
    );

    return $this->render('MCEventBundle:Evenement:view.html.twig', array(
      'evenement' => $evenement
    ));
  }
  public function addAction(Request $request)
  {
    // Cr�ation de l'entit� Evenement
    $evenement = new Evenement();

    // Cr�ation du formulaire
    $form = $this->get('form.factory')->create(new EvenementType(), $evenement);
   
    // On v�rifie que les valeurs entr�es sont correctes
    if ($form->handleRequest($request)->isValid())
    { 
        $evenement->getImage()->upload();
        $em = $this->getDoctrine()->getManager();
        $em->persist($evenement);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Ev�nement bien enregistr�.');

        //On redirige vers la page de visualisation de l'�v�nement nouvellement cr��
        return $this->redirect($this->generateUrl('mc_event_view', array('id' => $evenement->getId())));

    }

    return $this->render('MCEventBundle:Evenement:add.html.twig',array('form' => $form->createView()));
  }


  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On r�cup�re l'�v�nement $id
    $evenement = $em->getRepository('MCEventBundle:Evenement')->find($id);

    if (null === $evenement) {
      throw new NotFoundHttpException("L'�v�nement d'id ".$id." n'existe pas.");
    }

    $form = $this->createForm(new EvenementEditType(), $evenement);

    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait d�j� notre �v�nement
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Ev�nement bien modifi�.');

      return $this->redirect($this->generateUrl('mc_event_view', array('id' => $evenement->getId())));
    }

    return $this->render('MCEventBundle:Evenement:edit.html.twig', array(
      'form'   => $form->createView(),
      'evenement' => $evenement // Je passe �galement l'�v�nement � la vue si jamais il veut l'afficher
    ));
  }

  public function deleteAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // On r�cup�re l'�v�nement $id
    $evenement = $em->getRepository('MCEventBundle:Evenement')->find($id);

    if (null === $evenement) {
      throw new NotFoundHttpException("L'�v�nement d'id ".$id." n'existe pas.");
    }

    // On cr�e un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de prot�ger la suppression d'�v�nement contre cette faille
    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($evenement);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "L'�v�nement a bien �t� supprim�.");

      return $this->redirect($this->generateUrl('mc_event_home'));
    }

    // Si la requ�te est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('MCEventBundle:Evenement:delete.html.twig', array(
      'evenement' => $evenement,
      'form'   => $form->createView()
    ));
  }

  public function menuAction()
  {
    // On fixe en dur une liste ici, bien entendu par la suite
    // on la r�cup�rera depuis la BDD !
    $listEvenements = array(
      array('id' => 2, 'nomEvenement' => 'Soir�e Coop� Post Partiels'),
      array('id' => 5, 'nomEvenement' => 'Blindtest'),
      array('id' => 9, 'nomEvenement' => 'JT de passation SMS')
    );

    return $this->render('MCEventBundle:Evenement:menu.html.twig', array(
      // Tout l'int�r�t est ici : le contr�leur passe
      // les variables n�cessaires au template !
      'listEvenements' => $listEvenements
    ));
  }
}