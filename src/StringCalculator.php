<?php


namespace Deg540\PHPTestingBoilerplate;


class StringCalculator
{

    public function calculateEmpty(string $input_string):string{
        if(empty($input_string)){ return "0";}
        else{return "-1";}
    }

    public function calculateNotEmpty(string $input_string):string{
        if(!empty($input_string)){ return "Not empty";}
        else{return "";}
    }

    public function calculateStringToFloat(string $input_string):float{
       return floatval($input_string);
    }

    public function calculateAdd(string $input_string):float{
        $numbers = array_map('floatval', explode(',', $input_string));
        return array_sum($numbers);
    }

    public function calculateAddNewLine(string $input_string):float{
        $input_string = str_replace("\n",",",$input_string);
        //echo $input_string;
        $numbers = array_map('floatval', explode(',', $input_string));
        return array_sum($numbers);
    }

    public function calculateAddNewLineRestrictor(string $input_string):string{
        $input_string = str_replace("\n",",",$input_string);
        $pos1 = strpos($input_string, ",");
        $pos2 = strpos($input_string, ",",offset: $pos1+1);
        if(($pos2-$pos1) ==1){
            return "Number expected...";
        }
        else{
            return "Everything works";
        }
    }

}