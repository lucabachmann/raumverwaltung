<?php 
/**
 * @author Silvia Bavetta
 * @date 15. Mai 2019
 *
 * Überprüfung der Rechte vom eingeloggtem Account
 */
    class userHelper {
        public static function isUserAdmin() {
            if(isset($_SESSION["adminNumber"])) {
                if($_SESSION["adminNumber"] == "1"){
                    return true;
                }
            }
            return false;
        }
    }
?>
