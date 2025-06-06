--TEST--
\PHPUnit\Framework\MockObject\Generator::generateClassFromWsdl('GoogleSearch.wsdl', 'GoogleSearch')
--SKIPIF--
<?php declare(strict_types=1);
if (!extension_loaded('soap')) echo 'skip: Extension soap is required';
--FILE--
<?php declare(strict_types=1);
require_once __DIR__ . '/../../../bootstrap.php';

$generator = new \PHPUnit\Framework\MockObject\Generator;

print $generator->generateClassFromWsdl(
    __DIR__ . '/../../../_files/GoogleSearch.wsdl',
    'GoogleSearch'
);
--EXPECTF--
declare(strict_types=1);

class GoogleSearch extends \SoapClient
{
    public function __construct($wsdl, array $options)
    {
        parent::__construct('%s/GoogleSearch.wsdl', $options);
    }

    public function doGoogleSearch($key, $q, $start, $maxResults, $filter, $restrict, $safeSearch, $lr, $ie, $oe)
    {
    }

    public function doGetCachedPage($key, $url)
    {
    }

    public function doSpellingSuggestion($key, $phrase)
    {
    }
}
