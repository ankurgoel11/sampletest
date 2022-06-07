<?php


namespace App\Models;

class MenuItemHelper
{

    private $items;

    public function __construct($items) {
        $this->items = $items;
      }

    public function all() {
        return $this->children();
      }

    private function children() {
        $result = array();
        //dd($this->items);
        $counter=0;
        foreach($this->items as $item) {
            
          if ($item->parent_id!=null && $item->parent_id > 0) {
              
            if($counter==1){
                //dd($item);
            }
            $result['children'] = $this->itemWithChildren($item);
            if($counter==1){
                //dd($result);
            }
          }
          
          $counter++;
        }
        return $result;
      }

      private function childrenOf($item) {
        $result = array();
        foreach($this->items as $i) {
          if ($i->id == $item->parent_id) {
            $result[] = $i;
          }
        }
        return $result;
      }
  
      private function itemWithChildren($item) {
          
        $result = array();
        $children = $this->childrenOf($item);
        $result=$children;
        //dd($children);
        foreach ($result as $child) {
          $child['children'] = $this->itemWithChildren($child);
        }
        //dd($result);
        return $result;
      }
}
