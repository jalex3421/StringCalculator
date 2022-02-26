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


}