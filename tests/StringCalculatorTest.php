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
    public function stringIsEmpty(){
        $res = $this->stringCalculator->add("");

        $this->assertEquals("0",$res);
    }

    /**
     * @test : check if string is not empty
     */
    public function stringIsNotEmpty(){
        $res = $this->stringCalculator->add("3");

        $this->assertEquals("Not empty",$res);
    }

    /**
     * @test : return sum of two numbers , deliminator:  comma
     */
    public function addTwoNumbers(){
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
    public function addNewLine(){
        $res = $this->stringCalculator->add("1\n2,3");

        $this->assertEquals("6",$res);
    }

    /**
     * @test : doesnt allow new line in final position
     */
    public function addNewLineRestrictor(){
        $res = $this->stringCalculator->calculateAddNewLineRestrictor("175.2,\n35");

        $this->assertEquals("Number expected but newline found at position 6",$res);
    }

    /**
     * @test : doesnt allow that an input sequence ended with a separator
     */
    public function eofNewLineRestrictor(){
        $res =$this->stringCalculator->add("1,3,");

        $this->assertEquals("Number expected but EOF found",$res);
    }

    /**
     * @test : allow to introduce your own separators
     */
    public function findCustomSeparatorBase(){
        $res = $this->stringCalculator->obtainCustomSeparators("//;\n1;3");

        $this->assertEquals("Separator is ;",$res);
    }

    /**
     * @test : allow to introduce your own separators and verify the syntax of given input
     */
    public function addWithCustomSeparatorRestrictor(){
        $res = $this->stringCalculator->addWithCustomSeparator("//|\n3|2,1");

        $this->assertEquals("expected | found: , at position : 3",$res);
    }

    /**
     * @test : doesnt allow one negative number in sequence
     */
    public function findOneNegative(){
        $res = $this->stringCalculator->add("-1,2");

        $this->assertEquals("Negatives not allowed: -1\n",$res);
    }

    /**
     * @test : doesnt allow multiple negative numbers in sequence
     */
    public function findMultipleNegatives(){
        $res = $this->stringCalculator->add("2,-4,-5");

        $this->assertEquals("Negatives not allowed: -4-5\n",$res);
    }

    /**
     * @test : trigger multiple errors if it is necessary
     */
    public function multipleErrors(){
        $res = $this->stringCalculator->add("-1,,2");

        $this->assertEquals("Negatives not allowed: -1\nNumber expected but , found",$res);
    }

    /**
     * @test : return product of a given sequence , delimitator:  comma
     */
    public function multiply(){
        $res = $this->stringCalculator->multiply("7,7,2");

        $this->assertEquals("98",$res);
    }

}