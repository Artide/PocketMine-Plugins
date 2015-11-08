<?php

namespace domath\utils;

class ShapeCalculator{
    
    const FIND_A = 0;
    const FIND_B = 1;
    const FIND_C = 2;
    
    /**
     * Calculates the area of a circle
     * @param int $radius
     * @return int
     */
    public static function carea($radius){
        return M_PI * ($radius * $radius);
    }
    /**
     * Calculates the area of a parallelogram
     * @param int $length
     * @param int $width
     * @return int
     */
    public static function parea($length, $width){
        return $length * $width;
    }
    /**
     * Calculates the area of a triangle
     * @param int $base
     * @param int $height
     * @return int
     */
    public static function tarea($base, $height){
        return ($base * $height) / 2;
    }
    /**
     * Calculates the volume of a sphere
     * @param int $radius
     * @return int
     */
    public static function svolume($radius){
        return self::carea($radius) * 4;
    }
    /**
     * Calculates the volume of a rectangular/square prism
     * @param int $length
     * @param int $width
     * @param int $height
     * @return int
     */
    public static function pvolume($length, $width, $height){
        return self::parea($length, $width) * $height;
    }
    /**
     *Finds the length of any side of a triangle
     * @param int $a
     * @param int $b
     * @param int $c
     * @param int $mode
     * @return mixed
     */
    public static function pythagoreanTheorem($a, $b, $c, $mode){
	switch ($mode) {
		case self::FIND_A:
			$py1 = sqrt($b);
			$py2 = sqrt($c);
			$subtract = $py2 - $py1;
			$final = sqrt($subtract);
			return "A = " . $final;
		break;
		case self::FIND_B:
		    $py1 = sqrt($a);
			$py2 = sqrt($c);
			$subtract = $py2 - $py1;
			$final = sqrt($subtract);
			return "B = " . $final;
		break;
		case self::FIND_C:
		    $py1 = $a * $a + $b * $b;
		    $final = sqrt($py1);
		    return "C = " . $final;
		    break;
		default:
			return;
		break;
	      }
       }
    }
}
