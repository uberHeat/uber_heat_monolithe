<?

namespace App\Dto;

final class RectangleDimensionDto extends DimensionDto()
{
    private $height;
    private $width;

    public function getM2(){
        return $height * $width;
    }
}
