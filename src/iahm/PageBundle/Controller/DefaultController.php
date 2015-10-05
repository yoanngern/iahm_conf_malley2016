<?php

namespace iahm\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction()
    {

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $email = $request->request->get('email');

            $message = \Swift_Message::newInstance()
                ->setSubject('Presence - Lausanne 2016')
                ->setFrom($email)
                //->setTo('graphiste@laguerison.org')
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
                    'message' => 'general.thanks_informed'
                )
            );
        }

        return $this->render('iahmPageBundle::home.html.twig');
    }

    public function mailTestAction()
    {

        return $this->render(
            'iahmPageBundle:Mail:default.html.twig',
            array(
                'title' => 'Formulaire de contact',
                'email' => "yoann@yoanngern.ch",
            )
        );
    }

    public function speakerAction($name)
    {

        return $this->render('iahmPageBundle:Speaker:'.$name.'.html.twig');
    }
}
