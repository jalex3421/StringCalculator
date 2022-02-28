<?php

namespace Deg540\PHPTestingBoilerplate;


class StringCalculatorRules
{
    const DELIMITERS_BY_DEFAULT = "/,|\n/";

    public function calculateAddNewLineRestrictor(string $input_string):string{
        $pos1 = strpos($input_string, ","); //obtain position of comma
        $error="Number expected but newline found at position ";
        if(strpos(substr($input_string,$pos1), "\n") !== false){
            $pos2 = strpos(substr($input_string,$pos1), "\n");
            return $error.=strval($pos1+$pos2);
        }
        return $error;
    }

    public function obtainCustomSeparators(string $input_string):string{
        if(str_starts_with($input_string, '//')) {
            list($sep, $numbers) = explode("\n", $input_string, 2);
            $sep = substr($sep, 2);
            if(strcmp($sep,";")!==0){
                $sep = "";
            }
        }else{
            $sep = "";
        }
        $output="Separator is ";
        return $output.=$sep;
    }

    public function obtainMultipleErrors(string $input_string):string{
        $multipleNegatives=$this->obtainMultipleNegatives($input_string);
        $restrictorsTogether=$this->doesntAllowRestrictorsWhenAreTogether($input_string,",");
        return  $multipleNegatives.$restrictorsTogether;
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

    private function doesntAllowRestrictorsWhenAreTogether(string $input_string, string $separator):string{
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