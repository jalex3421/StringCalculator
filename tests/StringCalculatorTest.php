<?php


declare(strict_types=1);

namespace Deg540\PHPTestingBoilerplate\Test;
use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;


class StringCalculatorTest  extends TestCase{

    /**
     * @setUp
     */
    protected function setUp():void{
        parent::setUp();
        $this->stringCalculator=  new StringCalculator();
    }

    /**
     * @test : check if string is empty
     */
    public function string_is_empty(){
        $res = $this->stringCalculator->add("");
        $this->assertEquals("0",$res); //assert
    }

    /**
     * @test : check if string is not empty
     */
    public function string_is_not_empty(){
        $res = $this->stringCalculator->add("3");
        $this->assertEquals("Not empty",$res); //assert
    }


    /**
     * @test : return sum of two numbers , deliminator:  comma
     */
    public function add_two_numbers(){
        $res = $this->stringCalculator->add("2,3.3");
        $this->assertEquals("5.3",$res);
    }

    /**
     * @test : return sum of a given sequence , delimitator:  comma
     */
    public function add(){
        $res = $this->stringCalculator->add("1.1,2,3,4.1,5");
        $this->assertEquals("15.2",$res);
    }

    /**
     * @test : return sum of a given sequence , delimitator: new line or comma
     */
    public function add_new_line(){
        $res = $this->stringCalculator->add("1\n2,3");
        $this->assertEquals("6",$res);
    }

    /**
     * @test : doesnt allow new line in final position
     */
    public function add_new_line_restrictor(){
        $res = $this->stringCalculator->calculateAddNewLineRestrictor("175.2,\n35");
        $this->assertEquals("Number expected but newline found at position 6",$res);
    }

    /**
     * @test : doesnt allow that an input sequence ended with a separator
     */
    public function eof_new_line_restrictor(){
        $res =$this->stringCalculator->add("1,3,");
        $this->assertEquals("Number expected but EOF found",$res);
    }

    /**
     * @test : allow to introduce your own separators
     */
    public function find_custom_separator_base(){
        $res = $this->stringCalculator->obtainCustomSeparators("//;\n1;3");
        $this->assertEquals("Separator is ;",$res);
    }

    /**
     * @test : allow to introduce your own separators and verify the syntax of given input
     */
    public function add_with_custom_separator_restrictor(){
        $res = $this->stringCalculator->AddWithCustomSeparator("//|\n3|2,1");
        $this->assertEquals("expected | found: , at position : 3",$res);
    }


    /**
     * @test : doesnt allow one negative number in sequence
     */
    public function find_one_negative(){
        $res = $this->stringCalculator->add("-1,2");
        $this->assertEquals("Negatives not allowed: -1\n",$res);
    }

    /**
     * @test : doesnt allow multiple negative numbers in sequence
     */
    public function find_multiple_negatives(){
        $res = $this->stringCalculator->add("2,-4,-5");
        $this->assertEquals("Negatives not allowed: -4-5\n",$res);
    }

    /**
     * @test : trigger multiple errors if it is necessary
     */
    public function multiple_errors(){
        $res = $this->stringCalculator->add("-1,,2");
        $this->assertEquals("Negatives not allowed: -1\nNumber expected but , found",$res);
    }

    /**
     * @test : return product of a given sequence , delimitator:  comma
     */
    public function multiply(){
        $res = $this->stringCalculator->calculateProduct("7,7,2");
        $this->assertEquals(98,$res);
    }

}