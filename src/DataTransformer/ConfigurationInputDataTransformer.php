<?
declare(strict_types=1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Configuration;
use App\Entity\RectangleDim;

final class ConfigurationInputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $tempConfig = new Configuration();

        if($data->circularDim !== null )
        {
            $tempConfig->setCircularDim($data->circularDim);
        }elseif ($data->rectangleDim !== null){
            $tempRectangularDim = new RectangleDim();
            $tempRectangularDim->setDeep($data->rectangleDim->deep)
                ->setWidth($data->rectangleDim->width)
                ->setHeight($data->rectangleDim->height);

            var_dump($tempConfig);

            $tempConfig->setRectangleDim($tempRectangularDim);
        }


        return $tempConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof Configuration) {
          return false;
        }

        return Configuration::class === $to && null !== ($context['input']['class'] ?? null);
    }
}
