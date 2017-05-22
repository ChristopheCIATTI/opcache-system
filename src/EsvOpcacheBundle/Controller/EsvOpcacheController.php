<?php

namespace EsvOpcacheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EsvOpcacheController extends AbstractEsvOpcacheController
{
    /**
     * @Route("/opcache", name="opcache")
     */
    public function esvOpcacheAction()
    {
        
        if (!function_exists("opcache_get_status") 
            || !($cfg = opcache_get_status())
            || !$cfg["opcache_enabled"]) {
            die ("Zend opcache n'est pas activé");
            } else if ("clear" === @$_GET["e"]) {
                opcache_reset();
                header("Location: ?");
            }
      $valeur = 50/100;
                
                //Le rendu
            return $this->render(
                '@EsvOpcacheBundle/Resources/views/opcache.html.twig', [
                    "clearCacheRender" => $this->clearCache(),
                    "memoryFreeRender" => $this->memoryFree($cfg),
                    "memoryUsingRender" => $this->memoryUsing($cfg),
                    "memoryUselessRender" => $this->memoryUseless($cfg),
                    "memorySommeRender" => $this->memorySomme($cfg),
                    "memoryPercentFreeRender" => $this->memoryPercentFree($cfg),
                    "memoryPercentUsingRender" => $this->memoryPercentUsing($cfg),
                    "memoryPercentUselessRender" => $this->memoryPercentUseless($cfg),
                    "keysFreeRender" => $this->keysFree($cfg),
                    "keysUsingRender" => $this->keysUsing($cfg),
                    "keysSommeRender" => $this->keysSomme($cfg),
                    "keysPercentFreeRender" => $this->keysPercentFree($cfg),
                    "keysPercentUsingRender" => $this->keysPercentUsing($cfg),
                    "hitsHitRender" => $this->hitsHit($cfg),
                    "hitsMissRender" => $this->hitsMiss($cfg),
                    "hitsSommeRender" => $this->hitsSomme($cfg),
                    "hitsPercentMissRender" => $this->hitsPercentMiss($cfg),
                    "hitsPercentHitsRender" => $this->hitsPercentHits($cfg),
                    "scriptNumberRender" => $this->scriptNumber($cfg),
                    "percentRender" => $this->percent($valeur)
                         ]);
    }
}
