<?

namespace App\Dto;


use App\Entity\CircularDim;

final class ConfigurationInput
{
    public ?CircularDimensionDto $circularDim = null;
    public ?RectangleDimensionDto $rectangleDim = null;
}
