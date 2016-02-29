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
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $phone = $request->request->get('phone');
            $txt = $request->request->get('message');

            $message = \Swift_Message::newInstance()
                ->setSubject('Presence - Lausanne 2016')
                ->setFrom($email)
                ->setTo('iahm_web_event@ministries.io')
                ->setBody(
                    $this->renderView(
                        'iahmPageBundle:Mail:default.html.twig',
                        array(
                            'title' => 'Formulaire de contact',
                            'name' => $name,
                            'email' => $email,
                            'phone' => $phone,
                            'message' => $txt
                        )
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return $this->render(
                'iahmPageBundle:Mail:thanks.html.twig',
                array(
                    'message' => 'Thank you for subscribing. You will get informed when you can register to the conference.'
                )
            );
        }

        return $this->render('iahmPageBundle:Page:contact.html.twig',
            array(
                'page' => 'contact',
            ));
    }
}
