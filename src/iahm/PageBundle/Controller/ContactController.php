<?php

namespace iahm\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction()
    {

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $email = $request->request->get('email');

            $message = \Swift_Message::newInstance()
                ->setSubject('Presence - Lausanne 2016')
                ->setFrom($email)
                ->setTo('iahm_web_event@ministries.io')
                ->setBody(
                    $this->renderView(
                        'iahmPageBundle:Mail:default.html.twig',
                        array(
                            'title' => 'Formulaire de contact',
                            'email' => $email,
                        )
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return $this->render(
                'iahmPageBundle:Mail:thanks.html.twig',
                array(
                    'message' => 'Merci...'
                )
            );
        }

        return $this->redirect(
            $this->generateUrl('iahm_page_home')
        );
    }
}
