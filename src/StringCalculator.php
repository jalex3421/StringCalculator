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
        $numbers = array_map('floatval', explode(',', $input_string));
        return array_sum($numbers);
    }

    public function calculateAddNewLineRestrictor(string $input_string):string{
        $input_string = str_replace("\n",",",$input_string);
        $pos1 = strpos($input_string, ",");
        $pos2 = strpos($input_string, ",",offset: $pos1+1);
        $error="Number expected but newline found at position ";
        return $error.=strval($pos2);
    }

    public function calculateAddEOFLineRestrictor(string $input_string):string{
        if( (intval($input_string[strlen($input_string)-1])) ==0){
            return "Number expected but EOF found";
        }
        return "Nothing wrong";
    }

    public function obtainCustomSeparators(string $input_string):string{
        $separator = $input_string[2];
        $output="Separator is ";
        //echo $input_string[4];
        return $output.=$separator;
    }

    public function obtainCustomSeparatorsRestrictor(string $input_string):string{
        $separator = $input_string[2];
        $err1=" expected,but ";
        $err2=" found";
        for($i=4;$i<=strlen($input_string)-1;$i++){
            if($i%2!==0){
                if(strcmp($input_string[5],$separator)!==0){
                    return $separator.$err1.$input_string[5].$err2;
                }
            }
        }
        return "Nothing wrong";
    }



}



