<?php
    function sommeLuhn($n){
        $somme = 0;
        for($i = strlen($n)-1; $i > -1; $i--){
            if($i % 2 == 0){
                
                if(intval($n[$i]) * 2 > 9){
                    $somme += ($n[$i] * 2) - 10 + 1;
                }else{
                    $somme += $n[$i] * 2;
                }
            }else{
                $somme += $n[$i];
            }
        }
        return $somme;
    }
    
    function delivreCle($s){
        if ($s%10==0){
            return 0;
        }
        else{
            return 10 - ($s % 10);
        }
    }   
    

    function valideCB($cb){
        return delivreCle(sommeLuhn($cb))==0;
    }
       

?>