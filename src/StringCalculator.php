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
        else{return "0";}
    }

    public function calculateStringToFloat(string $input_string):float{
        if(empty($input_string)){ return "0";}
       return floatval($input_string);
    }

    public function calculateAdd(string $input_string):float{
        if(empty($input_string)){ return "0";}
        $numbers = array_map('floatval', explode(',', $input_string));
        return array_sum($numbers);
    }

    public function calculateAddNewLine(string $input_string):float{
        if(empty($input_string)){ return "0";}
        $input_string = str_replace("\n",",",$input_string);
        $numbers = array_map('floatval', explode(',', $input_string));
        return array_sum($numbers);
    }

    public function calculateAddNewLineRestrictor(string $input_string):string{
        if(empty($input_string)){ return "0";}
        $input_string = str_replace("\n",",",$input_string);
        $pos1 = strpos($input_string, ",");
        $pos2 = strpos($input_string, ",",offset: $pos1+1);
        $error="Number expected but newline found at position ";
        return $error.=strval($pos2);
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
        $first_filter = strtok($input_string,"\n");
        $second_filter = substr($first_filter, strpos($first_filter, "/") + 1);
        $separator = substr($second_filter, strpos($second_filter, "/") + 1);
        $output="Separator is ";
        //echo $input_string[4];
        return $output.=$separator;
    }

    public function obtainCustomSeparatorsRestrictor(string $input_string):string{
        if(empty($input_string)){ return "0";}
        $first_filter = strtok($input_string,"\n");
        $second_filter = substr($first_filter, strpos($first_filter, "/") + 1);
        $separator = substr($second_filter, strpos($second_filter, "/") + 1);
        $pos_separator = strlen($separator) + 2;
        $err1=" expected ";
        $err2=" found: ";
        $err3=" at position : ";
        $input_numbers = explode($separator,substr($input_string, $pos_separator + 1));
        if(count($input_numbers)>1){
            return strval(array_sum($input_numbers));
        }else{
            foreach ($input_numbers as $maybe_a_number) {
                $input_numbers= str_split($maybe_a_number);
                $position_fake_delimiter=0;
                foreach ($input_numbers as $char) {
                    if (intval($char) == 0) {
                        $fake_delimiter = $char;
                        return $err1 . $separator . $err2 . $fake_delimiter.$err3.$position_fake_delimiter;
                    }
                    $position_fake_delimiter++;
                }
            }
        }

    }



}



