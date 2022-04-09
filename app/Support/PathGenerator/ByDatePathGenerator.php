<?php

namespace App\Support\PathGenerator;


use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\BasePathGenerator;

class ByDatePathGenerator extends BasePathGenerator
{
    protected function getBasePath(Media $media): string
    {
        $prefix = config('medialibrary.prefix', '');
        $path = sprintf("$prefix/%s/%s/", 2022, 3);//place values staticly as using actual dates would invalidate urls in the next month

        if ($prefix !== '') {
            return $path . $media->getKey();
        }

        return $path . $media->getKey();
    }

}
