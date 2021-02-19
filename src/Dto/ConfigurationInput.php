<?php

declare(strict_types=1);

namespace App\Dto;

use App\Entity\Dimension;
use Symfony\Component\Serializer\Annotation\Groups;

final class ConfigurationInput
{
    /**
     * @Groups({"configurationWrite"})
     */
    public ?Dimension $dimension = null;
}
