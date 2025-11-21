<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        return $this->render('www/index.html.twig', [
            'title' => 'Forschungsmittel.com - Ihr kostenloser Fördermittelcheck',
            'menu' => [
                'main' => [
                    [
                        'name' => "Leistungen",
                        'url' => "#Leistungen",
                    ],
                    [
                        'name' => "Referenzen",
                        'url' => "#Referenzen",
                    ],
                    [
                        'name' => "Über uns",
                        'url' => "#Über-uns",
                    ],
                    [
                        'name' => "Kontakt",
                        'url' => "#Kontakt",
                    ]
                ],
                'footer' => [
                    [
                        'name' => "Leistungen",
                        'url' => "#Leistungen",
                    ],
                    [
                        'name' => "Referenzen",
                        'url' => "#Referenzen",
                    ],
                    [
                        'name' => "Über uns",
                        'url' => "#Über-uns",
                    ],
                    [
                        'name' => "Kontakt",
                        'url' => "#Kontakt",
                    ]
                ],
            ],
        ]);
    }
}
