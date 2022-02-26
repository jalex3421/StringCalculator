<?php


declare(strict_types=1);

namespace Deg540\PHPTestingBoilerplate\Test;
use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;


class StringCalculatorTest  extends TestCase{

    /**
     * @test : determina que String es empty
     */
    public function string_is_empty(){
        $stringCalculator = new StringCalculator();
        $res = $stringCalculator->calculateEmpty("");
        $this->assertEquals("0",$res); //assert
    }

    /**
     * @test : determina que String es no empty
     */
    public function string_is_not_empty(){
        $stringCalculator = new StringCalculator();
        $res = $stringCalculator->calculateNotEmpty("");
        $this->assertNotEmpty($res); //assert
    }

    /**
     * @test : devuelve el valor entero de una cadena
     */
    public function string_to_int(){
        $stringCalculator = new StringCalculator();
        $res = $stringCalculator->calculateStringToFloat("1.1");
        $this->assertIsFloat($res); //assert
    }

    /**
     * @test : devuelve la suma de una secuencia separadas por coma
     */
    public function add(){
        $stringCalculator = new StringCalculator();
        $res = $stringCalculator->calculateAdd("1.1,2,3,4.1,5");
        $this->assertIsFloat($res);
    }

    /**
     * @test : devuelve la suma de una secuencia separadas por coma o saltos de linea
     */
    public function add_new_line(){
        $stringCalculator = new StringCalculator();
        $res = $stringCalculator->calculateAddNewLine("1\n2,3");
        $this->assertEquals(6,$res);
    }

    /**
     * @test : funcionamiento igual que anterior, salvo que no permite '/n'al final
     */
    public function add_new_line_restrictor(){
        $stringCalculator = new StringCalculator();
        $res = $stringCalculator->calculateAddNewLineRestrictor("175.2,\n35");
        $this->assertEquals("Number expected...",$res);
    }


}