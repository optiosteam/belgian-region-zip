# Belgian region zip codes

The data in this library is based on the public data provided by **bpost** (https://www.bpost.be/nl/postcodes).

Zip codes are ordered by region/province. For these regions the ISO 3166 code is
used (https://www.iso.org/obp/ui/#iso:code:3166:BE)

## Installation

**Requirement**: PHP version >=7.2

```
composer require optiosteam/belgian-region-zip
```

## Description

This library contains 1 main class `BelgianRegionZipHelper` with 3 static functions:

- `BelgianRegionZipHelper::getRegions()` returns all Belgian Regions/Provinces
- `BelgianRegionZipHelper::getZipCodesByRegionIsoCode(string $regionIsoCode)` returns all zip codes within a certain
  region/province
- `BelgianRegionZipHelper::getMunicipalitiesByZipCode(string $zipCode, ?string $regionIsoCode = null, ?string $languageCode = null)`
  returns all municipalities for a certain zip code. Optionally you can pass the region and the language. **NOTE**:
  bpost only provides translations of municipalities in Brussels, for other regions the Dutch and French name are the
  same.

For more information on the data structure, you can look at the json data in `src/Data`

## Examples

### getMunicipalitiesByZipCode

```php
echo '<pre>';
var_dump(BelgianRegionZipHelper::getMunicipalitiesByZipCode(1000));
echo '</pre>';
```

returns:

```
array(2) {
  'nl' =>
  array(1) {
    [0] =>
    string(7) "Brussel"
  }
  'fr' =>
  array(1) {
    [0] =>
    string(9) "Bruxelles"
  }
}
```

---

```php
echo '<pre>';
var_dump(BelgianRegionZipHelper::getMunicipalitiesByZipCode(8000, 'BE-Vwv', 'nl'));
echo '</pre>';
```

returns:

```
array(2) {
  [0] =>
  string(6) "Brugge"
  [1] =>
  string(9) "Koolkerke"
}
```

### getZipCodesByRegionIsoCode

```php
echo '<pre>';
var_dump(BelgianRegionZipHelper::getZipCodesByRegionIsoCode('BE-BRU'));
echo '</pre>';
```

returns:

```
array(22) {
  [0] =>
  int(1000)
  [1] =>
  int(1020)
  [2] =>
  int(1030)
  [3] =>
  int(1040)
  [4] =>
  int(1050)
  [5] =>
  int(1060)
  [6] =>
  int(1070)
  [7] =>
  int(1080)
  [8] =>
  int(1081)
  [9] =>
  int(1082)
  [10] =>
  int(1083)
  [11] =>
  int(1090)
  [12] =>
  int(1120)
  [13] =>
  int(1130)
  [14] =>
  int(1140)
  [15] =>
  int(1150)
  [16] =>
  int(1160)
  [17] =>
  int(1170)
  [18] =>
  int(1180)
  [19] =>
  int(1190)
  [20] =>
  int(1200)
  [21] =>
  int(1210)
}
```

## Contributing

Feel free to submit pull requests for improvements & bug fixes.

MIT License
