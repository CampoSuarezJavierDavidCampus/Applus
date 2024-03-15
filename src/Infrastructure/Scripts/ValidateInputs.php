<?php
namespace Infrastructure\Scripts;
trait ValidateInputs{
    public function sanitizarTextInput(string $input):string{
        $string = htmlspecialchars($input,ENT_QUOTES,"UTF-8");
        $string = filter_var($string,FILTER_SANITIZE_SPECIAL_CHARS);
        return $string;
    }

    public function sanitizarFloatNumberInput(float $input):string{        
        return filter_var($input,FILTER_VALIDATE_FLOAT);        
    }

    public function sanitizarNumberInput(float $input):string{        
        return filter_var($input,FILTER_VALIDATE_INT);        
    }
}