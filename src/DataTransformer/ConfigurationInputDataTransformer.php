<?
declare(strict_types=1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Entity\Configuration;
use App\Entity\RectangleDim;
use Doctrine\ORM\EntityManagerInterface;

final class ConfigurationInputDataTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $newConfig = new Configuration();

        var_dump($data->dimension);

        if(isset($data->dimension->diameter))
        {
            $newDim = new CircularDim();
            $newDim->setConfig($newConfig);
            $newDim->setDeep($data->dimension->getDeep());
            $newDim->setDiameter($data->dimension->diameter);

            $newConfig->setDimension($newDim);
        }
        elseif (isset($data->dimension->heigh) && isset($data->dimension->width) )
        {
            $newDim = new RectangleDim();
            $newDim->setConfig($newConfig);
            $newDim->setDeep($data->dimension->getDeep());
            $newDim->setHeight($data->dimension->height);
            $newDim->setWidth($data->dimension->width);

            $newConfig->setDimension($newDim);
        }



        return $newConfig;
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
