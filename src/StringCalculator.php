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
            }elseif(strcmp($rules->obtainCustomSeparators($input_string),"Separator is ")!==0){
                return $rules->obtainCustomSeparators($input_string);
            }elseif(strcmp($rules->calculateAddNewLineRestrictor($input_string),"Number expected but newline found at position ")!==0){
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
            elseif(strcmp($rules->obtainCustomSeparators($input_string),"Separator is ")!==0){
                return $rules->obtainCustomSeparators($input_string);
            }
            elseif(strlen($rules->obtainMultipleErrors($input_string))>1){
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

    public function addWithCustomSeparator(string $input_string):string{
        $err1="expected ";
        $err2=" but ";
        $err3=" found: ";
        $err4=" at position : ";
        if(str_starts_with($input_string, '//')) {
            //list: allow to have individual variables from array
            list($delimiter, $numbers) = explode("\n", $input_string, 2);
            //offset 2 cuz at position 0 and 1 are '//'
            $aux = substr($delimiter, 2);
            $delimiter = '/' . substr($delimiter, 2) . '/';
        }
        if(!empty($pos_fake_delimiter =strpos($numbers, ","))){
            $fake_delimiter=",";
            return $err1.$aux.$err3.$fake_delimiter.$err4.$pos_fake_delimiter;
        }
        $numbers = preg_split($delimiter, $numbers);
        return array_sum($numbers);
    }

}



