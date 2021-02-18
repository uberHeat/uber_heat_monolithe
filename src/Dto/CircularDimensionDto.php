<?

namespace App\Dto;

final class CircularDimensionDto extends DimensionDto()
{
    private $diameter;

    public function getM2(){
        return 3.14 * ((diameter/2)^2);
    }
}
