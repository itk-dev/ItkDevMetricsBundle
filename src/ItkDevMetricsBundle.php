<?php

namespace ItkDev\MetricsBundle;

use ItkDev\MetricsBundle\DependencyInjection\ItkDevMetricsExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ItkDevMetricsBundle extends Bundle
{

    /**
     * Overridden to allow for the custom extension alias.
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new ItkDevMetricsExtension();
        }
        return $this->extension;
    }
}
