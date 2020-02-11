<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function createAction(Request $request) {

        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add('name', TextType::class)
            ->add('prix', TextType::class)
            ->add('quantity', TextareaType::class)
            ->add('description', TextType::class)
            ->add('libelle', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'New Article'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $article = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect('/view-article/' . $article->getId());

        }

        return $this->render(
            'article/edit.html.twig',
            array('form' => $form->createView())
        );

    }
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('ArticleBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }

        $em->remove($article);
        $em->flush();

        return $this->redirect('/articles');

    }
    public function showAction() {

        $articles = $this->getDoctrine()
            ->getRepository('ArticleBundle:Article')
            ->findAll();

        return $this->render(
            'article/ShowArticles.html.twig',
            array('articles' => $articles)
        );

    }
    public function updateAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('ArticleBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }

        $form = $this->createFormBuilder($article)
            ->add('name', TextType::class)
            ->add('prix ', TextType::class)
            ->add('quantity', TextareaType::class)
            ->add('description', TextareaType::class)
            ->add('libelle', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Update'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $article = $form->getData();
            $em->flush();

            return $this->redirect('/article/' . $id);

        }

        return $this->render(
            'article/EditArticle.html.twig',
            array('form' => $form->createView())
        );

    }
    public function viewAction($id) {

        $article = $this->getDoctrine()
            ->getRepository('ArticleBundle:Article')
            ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }

        return $this->render(
            'article/view.html.twig',
            array('article' => $article)
        );

    }
}
