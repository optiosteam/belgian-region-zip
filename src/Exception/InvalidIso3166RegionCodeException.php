<?php
declare(strict_types = 1);

namespace Optios\BelgianRegionZip\Exception;

use Throwable;

/**
 * Class InvalidIso3166RegionCodeException
 * @package Optios\BelgianRegionZip\Exception
 */
class InvalidIso3166RegionCodeException extends \Exception
{
    /**
     * @param string $invalidRegionIsoCode
     */
    public function __construct(string $invalidRegionIsoCode)
    {
        parent::__construct(
            sprintf('%s is not a valid 3166 iso code for Belgium', $invalidRegionIsoCode)
        );
    }
}
