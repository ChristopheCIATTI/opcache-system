<?php

namespace EsvOpcacheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Les fonctions à implémenter
class AbstractEsvOpcacheController extends Controller
{
    protected function clearCache()
    {
        if ("clear" === @$_GET["e"]) {
            opcache_reset();
            header("Location: ?");
        }
    }
    
    protected function memoryFree($cfg)
    {
        return ($cfg["memory_usage"]["free_memory"] / 1000 / 1000 . " MB");
    }
    
    protected function memoryUsing($cfg)
    {
        return ($cfg["memory_usage"]["used_memory"] / 1000 / 1000 . " MB");
    }
    
    protected function memoryUseless($cfg)
    {
        return($cfg["memory_usage"]["wasted_memory"] / 1000 / 1000 . " MB");
    }
    
    protected function memorySomme($cfg)
    {
        return (
            $this->memoryFree($cfg) 
            + $this->memoryUsing($cfg) 
            + $this->memoryUseless($cfg));
    }
    
    protected function memoryPercentFree($cfg)
    {
        return $this->memoryFree($cfg) * 100 / $this->memorySomme($cfg);
    }
    
    protected function memoryPercentUsing($cfg)
    {
        return $this->memoryUsing($cfg) * 100 / $this->memorySomme($cfg);
    }
    
    protected function memoryPercentUseless($cfg)
    {
        return $this->memoryUseless($cfg) * 100 / $this->memorySomme($cfg);
    }
    
    protected function keysFree($cfg)
    {
        return (
            ($cfg["opcache_statistics"]["max_cached_keys"]
        - $cfg["opcache_statistics"]["num_cached_keys"])
            );
    }
    
    protected function keysUsing($cfg)
    {
        return $cfg["opcache_statistics"]["num_cached_keys"];
    }
    
    protected function keysSomme($cfg)
    {
        return (
            $this->keysFree($cfg)
            + $this->keysUsing($cfg));
    }
    
    protected function keysPercentFree($cfg)
    {
        return $this->keysFree($cfg) * 100 / $this->keysSomme($cfg);
    }
    
    protected function keysPercentUsing($cfg)
    {
        return $this->keysUsing($cfg) * 100 / $this->keysSomme($cfg);
    }
    
    protected function hitsHit($cfg)
    {
        return (
            ($cfg["opcache_statistics"]["hits"])
            );
    }
    
    protected function hitsMiss($cfg)
    {
        return ($cfg["opcache_statistics"]["misses"]);
    }
    
    protected function hitsSomme($cfg)
    {
        return(
            $this->keysFree($cfg)
            + $this->keysUsing($cfg)
            );    
    }
    
    protected function hitsPercentMiss($cfg)
    {
        return $this->hitsMiss($cfg) * 100 / $this->hitsSomme($cfg);
    }
    
    protected function hitsPercentHits($cfg)
    {
        return $this->hitsHit($cfg) * 100 / $this->hitsSomme($cfg);
    }
    
    protected function scriptNumber($cfg)
    {
        return ($cfg["opcache_statistics"]["num_cached_scripts"]);
    }
    
    protected function percent (float $valeur): float  
    {
        return $valeur *  50 /100;
    }
   
}
