<?php
    
    class Reader {
        public static function isBeingWrittenTo($file) {
            $f = fopen($file, 'a');
            $beingWrittenTo = flock($f, LOCK_EX | LOCK_NB);
            fclose($f);
            return !$beingWrittenTo;            
        }  
        
        
        
        
    };
    

?>