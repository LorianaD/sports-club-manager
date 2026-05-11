<?php

// src/Services/MonService.php
namespace App\Services;

use App\Entity\Player;
use App\Entity\Team;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AccessControlService
{
    public function __construct(private Security $security)
    {
    }

    private function getCurrentUser(): User
    {
        $user = $this->security->getUser();

        if (!$user instanceof User) {
            throw new AccessDeniedHttpException('Accès réservé aux coachs.');
        }

        return $user;
    }

    public function checkTeamAccess(Team $team): void
    {
        $user = $this->getCurrentUser();

        // Team devra avoir un getUser() ou getCoach()
        // if ($team->getUser()->getId() !== $user->getId()) {
        //     throw new AccessDeniedHttpException('Cette équipe ne t\'appartient pas.');
        // }
    }

    public function checkPlayerAccess(Player $player): void
    {
        $user = $this->getCurrentUser();

        // On remonte Player → Team → User
        // if ($player->getTeam()->getUser()->getId() !== $user->getId()) {
        //     throw new AccessDeniedHttpException('Ce joueur ne fait pas partie de tes équipes.');
        // }
    }
    
}