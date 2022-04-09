<?php

namespace App\Support\DefaultFileNamer;

use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\Support\FileNamer\DefaultFileNamer;

class UniqueFileNamer extends DefaultFileNamer
{
    public function conversionFileName(string $fileName, Conversion $conversion): string
    {
        $strippedFileName = pathinfo($fileName, PATHINFO_FILENAME);

        return sprintf("%s-%s--%s--%s-", time(), mt_rand(1, 1000000), $strippedFileName, $conversion->getName());
    }
}
