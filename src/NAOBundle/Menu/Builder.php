<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 17/11/2017
 * Time: 16:31
 */

namespace NAOBundle\Menu;

use Knp\Menu\FactoryInterface;

class Builder
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * This creates the navbar menu in the header of the web site.
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     */
    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navbar-nav align-items-center mx-auto');
        $menu->addChild('Accueil', ['route' => 'nao_homepage'])
            ->setAttribute('class', 'nav-item text-center')
            ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('A propos', ['route' => 'nao_about'])
            ->setAttribute('class', 'nav-item text-center')
            ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Participer', ['route' => 'nao_participate'])
            ->setAttribute('class', 'nav-item text-center')
            ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('index', [
            'route' => 'nao_index',
            'extras' => [
                'safe_label' => true,
                'image' => 'img/mini-logo.png'
            ]
        ])
            ->setAttribute('class','nav-item d-none d-md-inline text-center')
            ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Rechercher', ['route' => 'nao_search'])
            ->setAttribute('class', 'nav-item text-center')
            ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Blog', ['route' => 'blog_homepage'])
            ->setAttribute('class', 'nav-item text-center')
            ->setLinkAttribute('class', 'nav-link');
        $menu->addChild('Observation', ['route' => 'nao_observation'])
            ->setAttribute('class', 'nav-item text-center')
            ->setLinkAttribute('class', 'nav-link');
        return $menu;

    }

    public function createSideMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav flex-column side-menu');
        $menu->addChild('Mes observations', ['route' => 'user_observation'])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link d-flex justify-content-between');
        $menu->addChild('Mes favoris', ['route' => 'user_favoris'])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link d-flex justify-content-between');
        $menu->addChild('Modifier mon profil', ['route' => 'user_profile'])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link d-flex justify-content-between');
        $menu->addChild('Mes badges', ['route' => 'user_badge'])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link d-flex justify-content-between');
        if (isset($options['level']) && ($options['level'] == 'PRO' || $options['level'] == 'ADMIN')) {
            $menu->addChild('Gestion des observations', ['route' => 'user_gestion_observation'])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link d-flex justify-content-between');
            $menu->addChild('Ecrire un article du blog', ['route' => 'user_article'])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link d-flex justify-content-between');
            $menu->addChild('Gestion des articles du blog', ['route' => 'user_gestion_article'])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link d-flex justify-content-between');
        }
        if (isset($options['level']) && $options['level'] == 'ADMIN') {
            $menu->addChild('Gestion des utilisateurs', ['route' => 'user_gestion_user'])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link d-flex justify-content-between');
        }
        $menu->addChild('Déconnexion', ['route' => 'logout'])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link d-flex justify-content-between');
        return $menu;
    }

    public function createUserMenu(array $options)
    {
        dump($options);
        $menu = $this->factory->createItem('root');
        if (isset($options['level'])) {
            $menu->addChild('Mes observations', ['route' => 'user_observation']);
            $menu->addChild('Mes favoris', ['route' => 'user_favoris']);
            $menu->addChild('Modifier profil', ['route' => 'user_profile']);
            $menu->addChild('Mes badges', ['route' => 'user_badge']);
            if ($options['level'] == 'PRO' || $options['level'] == 'ADMIN') {
                $menu->addChild('Gestion observations', ['route' => 'user_gestion_observation']);
                $menu->addChild('Ecrire un article', ['route' => 'user_article']);
                $menu->addChild('Gestion articles', ['route' => 'user_gestion_article']);
            }
            if ($options['level'] == 'ADMIN') {
                $menu->addChild('Gestion membres', ['route' => 'user_gestion_user']);
            }
            $menu->addChild('Déconnexion', ['route' => 'logout']);
        } else {
            $menu->addChild('Connexion', ['route' => 'login']);
            $menu->addChild('Inscription', ['route' => 'user_inscription']);
        }
        return $menu;
    }
}