<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\Commande;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserVoter extends Voter
{
    // these strings are just invented: you can use anything
    const DELETE = 'deleteOrder';
   

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::DELETE])) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof Commande) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Post object, thanks to supports
        /** @var Commande $commande */
        $commande = $subject;

        switch ($attribute) {
            case self::DELETE:
                return $this->canDelete($commande, $user);
           
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canDelete(Commande $commande, User $user)
    {
      return $user->getId() === $commande->getCommandes()->getId();
    }

   
}