<?php


namespace Deg540\PHPTestingBoilerplate;


class StringCalculator
{
    const DELIMITERS_BY_DEFAULT = "/,|\n/";

    public function calculateEmpty(string $input_string):string{
        if(empty($input_string)){ return "0";}
        else{return "-1";}
    }

    public function calculateNotEmpty(string $input_string):string{
        if(!empty($input_string)){ return "Not empty";}
        else{return "0";}
    }

    public function calculateStringToFloat(string $input_string):float{
        if(empty($input_string)){ return "0";}
       return floatval($input_string);
    }

    public function calculateAddTwoNumbers(string $input_string):float{
        if(empty($input_string)){ return "0";}
        $numbers = array_map('floatval', explode(',', $input_string));
        return array_sum($numbers);
    }

    public function calculateAdd(string $input_string):float{
        if(empty($input_string)){ return "0";}
        $numbers = array_map('floatval', explode(',', $input_string));
        return array_sum($numbers);
    }

    public function calculateAddNewLine(string $input_string):float{
        if(empty($input_string)){ return "0";}
        //search patter in input string and split it
        $numbers = preg_spliT(self::DELIMITERS_BY_DEFAULT,$input_string);
        return array_sum($numbers);
    }

    public function calculateAddNewLineRestrictor(string $input_string):string{
        if(empty($input_string)){ return "0";}
        $pos1 = strpos($input_string, ","); //obtain position of comma
        $pos2 = strpos(substr($input_string,$pos1), "\n");
        $error="Number expected but newline found at position ";
        return $error.=strval($pos1+$pos2);
    }

    public function calculateAddEOFLineRestrictor(string $input_string):string{
        if(empty($input_string)){ return "0";}
        if( (intval($input_string[strlen($input_string)-1])) ==0){
            return "Number expected but EOF found";
        }
        return "Nothing wrong";
    }

    public function obtainCustomSeparators(string $input_string):string{
        if(empty($input_string)){ return "0";}
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

    public function obtainOneNegative(string $input_string):string{
        if(empty($input_string)){ return "0";}
        $numbers = array_map('floatval', explode(',', $input_string));
        $errormessage = "Negative not allowed: ";
        foreach($numbers as $value) {
            if($value < 0) {return $errormessage.strval($value);}
        }
        return "Nothing wrong";
    }

    public function obtainMultipleNegatives(string $input_string):string{
        if(empty($input_string)){ return "0";}
        $numbers = array_map('floatval', explode(',', $input_string));
        $errormessage = "Negatives not allowed: ";
        $original_length = strlen($errormessage);
        foreach($numbers as $value) {
            if($value < 0) {
                $errormessage.=strval($value);
            }
        }
        if(strlen($errormessage)>$original_length){return $errormessage; }
        return "Nothing wrong";
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

    public function obtainMultipleErrors(string $input_string):string{
        if(empty($input_string)){ return "0";}
        $multipleNegatives=$this->obtainMultipleNegatives($input_string);
        $restrictorsTogether=$this->doestAllowRestrictorsWhenAreTogether($input_string,",");
        return  $multipleNegatives."\n".$restrictorsTogether;
    }

    public function calculateProduct(string $input_string):float{
        if(empty($input_string)){ return "0";}
        $numbers = array_map('floatval', explode(',', $input_string));
        return array_product($numbers);
    }

}



