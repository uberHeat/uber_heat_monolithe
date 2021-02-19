<?php

namespace App\Serializer;

use App\Entity\Dimension;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class DimensionDenormalizer implements DenormalizerInterface
{
    private $denormalizer;
    const ACCEPTED_CLASS = ['CircularDim', 'RectangleDim'];

    public function __construct(DenormalizerInterface $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }

    public function denormalize($data, string $class, string $format = null, array $context = [])
    {
        if (Dimension::class === $class) {
            $wantedClass = ucfirst($data['@type']);

            if (!in_array($wantedClass, self::ACCEPTED_CLASS)) {
                throw new Exception('Accepted class type: '.implode(' , ', self::ACCEPTED_CLASS));
            }
            $class = 'App\Entity\\'.$wantedClass;
            unset($data['@type']);
            $context['resource_class'] = $class;
        }

        return $this->denormalizer->denormalize($data, $class, $format, $context);
    }

    public function supportsDenormalization($data, $type, string $format = null)
    {
        return Dimension::class === $type; // we only want to process our abstract entity.
    }
}
