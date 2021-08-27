<?php
declare(strict_types = 1);

namespace Optios\BelgianRegionZip;

use Optios\BelgianRegionZip\Exception\InvalidIso3166RegionCodeException;
use Optios\BelgianRegionZip\Exception\ZipcodeDoesNotBelongToRegionException;

/**
 * Class BelgianRegionZipHelper
 * @package Optios\BelgianRegionZip
 */
class BelgianRegionZipHelper
{
    /**
     * @return array
     */
    public static function getRegions(): array
    {
        return json_decode(
            file_get_contents(
                __DIR__ . '/Data/belgian_region_iso3166.json'
            ),
            true
        );
    }

    /**
     * @param string $regionIsoCode https://www.iso.org/obp/ui/#iso:code:3166:BE
     *
     * @return array
     * @throws InvalidIso3166RegionCodeException
     */
    public static function getZipCodesByRegionIsoCode(string $regionIsoCode): array
    {
        $regionIsoCode = strtoupper($regionIsoCode);

        $data = json_decode(
            file_get_contents(
                __DIR__ . '/Data/belgian_region_zipcode_mapping_nl.json'
            ),
            true
        );

        if (! array_key_exists($regionIsoCode, $data)) {
            throw new InvalidIso3166RegionCodeException($regionIsoCode);
        }

        return array_keys($data[ $regionIsoCode ]);
    }

    /**
     * @param int         $zipCode
     * @param string|null $regionIsoCode https://www.iso.org/obp/ui/#iso:code:3166:BE
     * @param string|null $languageCode
     *
     * @return array|null
     * @throws ZipcodeDoesNotBelongToRegionException
     */
    public static function getMunicipalitiesByZipCode(
        int $zipCode,
        ?string $regionIsoCode = null,
        ?string $languageCode = null
    ): ?array {
        if (null !== $regionIsoCode) {
            $regionIsoCode = strtoupper($regionIsoCode);
        }

        if (null !== $languageCode) {
            $languageCode = strtolower($languageCode);
        }

        switch ($languageCode) {
            case 'nl':
                $file = __DIR__ . '/Data/belgian_region_zipcode_mapping_nl.json';
                break;
            case 'fr':
                $file = __DIR__ . '/Data/belgian_region_zipcode_mapping_fr.json';
                break;
            default:
                $file = __DIR__ . '/Data/belgian_region_zipcode_mapping.json';
        }

        $data = json_decode(file_get_contents($file), true);

        if (null !== $regionIsoCode && array_key_exists($regionIsoCode, $data)) {
            if (! array_key_exists($zipCode, $data[ $regionIsoCode ])) {
                throw new ZipcodeDoesNotBelongToRegionException($zipCode, $regionIsoCode);
            }

            return $data[ $regionIsoCode ][ $zipCode ];
        }

        foreach ($data as $zipCodeNameMapping) {
            if (array_key_exists($zipCode, $zipCodeNameMapping)) {
                return $zipCodeNameMapping[ $zipCode ];
            }
        }

        return null;
    }
}
