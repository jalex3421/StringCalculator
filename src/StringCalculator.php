<?php


namespace Deg540\PHPTestingBoilerplate;


class StringCalculator
{

    public function calculateEmpty(string $input_string):string
    {
        if(empty($input_string)){ return "0";}
        else{return "-1";}
    }

}