<?

namespace App\Dto;


use App\Entity\CircularDim;
use App\Entity\RectangleDim;

final class ConfigurationInput
{
    public ?CircularDim $circularDim = null;
    public ?RectangleDim $rectangleDim = null;
}
