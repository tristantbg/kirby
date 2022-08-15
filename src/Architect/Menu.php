<?php

namespace Kirby\Architect;

use Kirby\Cms\ModelWithContent;
use Kirby\Blueprint\Blueprints;
use Kirby\Blueprint\FileBlueprints;
use Kirby\Blueprint\PageBlueprints;
use Kirby\Blueprint\UserBlueprints;

class Menu
{
    public function blueprints(ModelWithContent $model, Blueprints $blueprints)
    {
        return $blueprints->values(function ($blueprint) use ($model) {
            return (new BlueprintInfo($blueprint))->element($model);
        });
    }

    public function render(): array
    {
        $model = site();
        $cache = kirby()->cache('blueprints');
        $menu  = $cache->get('menu');

        if (empty($menu) === false) {
            return $menu;
        }

        $files = FileBlueprints::load();
        $pages = PageBlueprints::load();
        $users = UserBlueprints::load();

        $menu = [
            [
                'id'       => 'files',
                'isFolder' => true,
                'label'    => 'Files',
                'children' => $this->blueprints($model, $files)
            ],
            [
                'id'       => 'pages',
                'isFolder' => true,
                'label'    => 'Pages',
                'children' => $this->blueprints($model, $pages)
            ],
            [
                'id'       => 'users',
                'isFolder' => true,
                'label'    => 'Users',
                'children' => $this->blueprints($model, $users)
            ],
            [
                'icon'     => 'home',
                'id'       => 'site',
                'isFolder' => false,
                'label'    => 'Site',
                'url'      => '/blueprints/site'
            ]

        ];

        $cache->set('menu', $menu);

        return $menu;
    }

}
