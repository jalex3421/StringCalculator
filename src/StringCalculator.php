<?php


namespace Deg540\PHPTestingBoilerplate;


class StringCalculator
{
    const DELIMITERS_BY_DEFAULT = "/,|\n/";

    public function add(string $input_string):string{
        $rules = new StringCalculatorRules();
        if(empty($input_string)){
            return "0";
        }
        elseif(is_numeric($input_string)){
            return "Not empty";
        }
        else{
            if( (intval($input_string[strlen($input_string)-1])) ==0){
                return "Number expected but EOF found";
            }elseif(strcmp($rules->addWithCustomSeparator($input_string),"nok")!==0){
                return $rules->addWithCustomSeparator($input_string);
            }
            elseif(strcmp($rules->calculateAddNewLineRestrictor($input_string),"Number expected but newline found at position ")!==0){
                return $rules->calculateAddNewLineRestrictor($input_string);
            }
            elseif(strlen($rules->obtainMultipleErrors($input_string))>1){
                return $rules->obtainMultipleErrors($input_string);
            }
            else{
                return strval(($this->calculateNewLine($input_string,"sum")));
            }
        }
    }

    public function multiply(string $input_string):string{
        $rules = new StringCalculatorRules();
        if(empty($input_string)){
            return "0";
        }
        elseif(is_numeric($input_string)){
            return "Not empty";
        }
        else{
            if( (intval($input_string[strlen($input_string)-1])) ==0){
                return "Number expected but EOF found";
            }elseif(strcmp($rules->calculateAddNewLineRestrictor($input_string),"Number expected but newline found at position ")!==0){
                return $rules->calculateAddNewLineRestrictor($input_string);
            }
            elseif(strcmp($rules->addWithCustomSeparator($input_string),"nok")!==0){
                return $rules->addWithCustomSeparator($input_string);
            }
            elseif(strlen($rules->obtainMultipleErrors($input_string))>1){
                echo "im here";
                return $rules->obtainMultipleErrors($input_string);
            }
            else{
                return strval(($this->calculateNewLine($input_string,"multiply")));
            }
        }
    }

    private function calculateNewLine(string $input_string,string $op):float{
        //search patter in input string and split it
        $numbers = preg_spliT(self::DELIMITERS_BY_DEFAULT,$input_string);
        if(strcmp($op,"sum")==0){
            return array_sum($numbers);
        }
        return array_product($numbers);
    }

}



