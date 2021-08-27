<?php
declare(strict_types = 1);

namespace Optios\BelgianRegionZip\Exception;

/**
 * Class ZipcodeDoesNotBelongToRegionException
 * @package Optios\BelgianRegionZip\Exception
 */
class ZipcodeDoesNotBelongToRegionException extends \Exception
{
    /**
     * @param int    $zipCode
     * @param string $regionIsoCode
     */
    public function __construct(int $zipCode, string $regionIsoCode)
    {
        parent::__construct(
            sprintf('Zip code %d does not belong to region %s', $zipCode, $regionIsoCode)
        );
    }
}
