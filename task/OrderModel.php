<?php

class OrderModel extends DB{
            
    public function getAll(){
        
        $sql=" SELECT * FROM spk ";
                        
        return DB::fetch($sql);
    }
    
    public function getById($id){
        
        $sql=" SELECT * FROM spk WHERE id='".$id."' ";
                        
        return DB::fetch($sql);
    }
}
?>
