<?php

declare(strict_types=1);

namespace App\View;

use Twig\Environment;
use App\Service\Http\Session\Session;
use Twig\Loader\FilesystemLoader;

final class View
{
    private Environment $twig;

    public function __construct(private Session $session)
    {
        $loader = new FilesystemLoader('../templates');
        $this->twig = new Environment($loader);

    }

    public function render(array $data): string
    {
        $data['data']['session'] = $this->session->getAll();
        $data['data']['flashes'] = $this->session->getFlashes();

        //return $this->twig->render("frontoffice/${data['template']}.html.twig", $data['data']);
      
        return $this->twig->render("${data['path']}/${data['template']}.html.twig", $data['data']);
        
    }

}
