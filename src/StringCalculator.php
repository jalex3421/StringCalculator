<?php


namespace Deg540\PHPTestingBoilerplate;




class StringCalculator
{
    const DELIMITERS_BY_DEFAULT = "/,|\n/";

    public function add(string $input_string):string{
        if(empty($input_string)){
            return "0";
        }
        elseif(is_numeric($input_string)){
            return "Not empty";
        }
        else{
            $error = $this->obtainMultipleErrors($input_string);
            if( (intval($input_string[strlen($input_string)-1])) ==0){
                return "Number expected but EOF found";
            }
            elseif(strlen($error)>1){
                return $error;
            }
            else{
                return strval(($this->calculateNewLine($input_string,"sum")));
            }
        }
    }

    public function multiply(string $input_string):string{
        if(empty($input_string)){
            return "0";
        }
        elseif(is_numeric($input_string)){
            return "Not empty";
        }
        else{
            $error = $this->obtainMultipleErrors($input_string);
            if( (intval($input_string[strlen($input_string)-1])) ==0){
                return "Number expected but EOF found";
            }
            elseif(strlen($error)>1){
                return $error;
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

    private function obtainMultipleNegatives(string $input_string):string{
        $numbers = preg_spliT(self::DELIMITERS_BY_DEFAULT,$input_string);
        $errormessage = "Negatives not allowed: ";
        $original_length = strlen($errormessage);
        foreach($numbers as $value) {
            if($value < 0) {
                $errormessage.=strval($value);
            }
        }
        if(strlen($errormessage)>$original_length){return $errormessage."\n"; }
        return "";
    }

    private function obtainMultipleErrors(string $input_string):string{
        $multipleNegatives=$this->obtainMultipleNegatives($input_string);
        $restrictorsTogether=$this->doestAllowRestrictorsWhenAreTogether($input_string,",");
        return  $multipleNegatives.$restrictorsTogether;
    }

    public function calculateAddNewLineRestrictor(string $input_string):string{
        if(empty($input_string)){ return "0";}
        $pos1 = strpos($input_string, ","); //obtain position of comma
        $pos2 = strpos(substr($input_string,$pos1), "\n");
        $error="Number expected but newline found at position ";
        return $error.=strval($pos1+$pos2);
    }

    public function obtainCustomSeparators(string $input_string):string{
        if(str_starts_with($input_string, '//')) {
            list($sep, $numbers) = explode("\n", $input_string, 2);
            $sep = substr($sep, 2);
        }
        $output="Separator is ";
        return $output.=$sep;
    }

    public function AddWithCustomSeparator(string $input_string):string{
        if(empty($input_string)){ return "0";}
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

    private function doestAllowRestrictorsWhenAreTogether(string $input_string, string $separator):string{
        $results = preg_split('/[;,]/', $input_string);
        $contains_empty = in_array("", $results, true);
        $err1 =  "Number expected but ";
        $err2 =" found";
        if($contains_empty==1){
            return $err1.$separator.$err2;
        }else{
            return "";
        }
    }

}



