<?php

namespace ForthoCorp\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ForthoCorpUserBundle extends Bundle
{
    public function getParent()
    {
        return "FOSUserBundle";
    }
}
