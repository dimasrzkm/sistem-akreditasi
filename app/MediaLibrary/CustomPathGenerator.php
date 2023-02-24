<?php

namespace App\MediaLibrary;

use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
   /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string {
      switch ($media->model_type) {
        case User::class:
            return User::PATH.DIRECTORY_SEPARATOR.$media->model_id.DIRECTORY_SEPARATOR.$media->id.DIRECTORY_SEPARATOR;
          break;
        default:
            return $media->id.DIRECTORY_SEPARATOR;
          break;
      }
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string {
      return $this->getPath($media).'conversions/';
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string {
      return $this->getPath($media) . 'responsive/';
    }

}