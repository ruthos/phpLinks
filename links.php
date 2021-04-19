<?php 

namespace App\Models;

use PDO;
/**
 * Nested Links
 */
class NestedLinks extends \Core\Model {

    public static function has_children($rows, $id) {
        foreach ($rows as $row) {
          if ($row['parent_id'] == $id)
            return true;
        }
        return false;
      }
      
      public static function buildMenuInFront($rows,$parent=0) {  
        $result = "";
        foreach ($rows as $row) {
          if ($row['parent_id'] == $parent) {
            $result .= $row['slug']."/";

            if (self::has_children($rows,$row['id'])) {
              $result .= self::buildMenuInFront($rows,$row['id']);
              $result.="<br>";
            }
          }
        }
        return $result;
    }
}

