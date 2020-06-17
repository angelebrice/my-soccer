<?php

namespace App\Controller;

use App\Form\SearchTeamType;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/recherche", name="search")
     */
    public function SearchTeam(Request $request, TeamRepository $teamRepo)
    {
        $teams = [];
        $searchTeam = $this->createForm(SearchTeamType::class);

        if($searchTeam->handleRequest($request)->isSubmitted() && $searchTeam->isValid()) {
            $option = $searchTeam->getData();
            $teams = $teamRepo->searchTeam($option);
        }

        return $this->render('search/index.html.twig',[
            'search_form' => $searchTeam->createView(),
            'teams' => $teams,
        ]);
    }
}
