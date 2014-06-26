<?php 

namespace front\db;

class PDOFactory {
    public static function GetPDO($strDSN, $strUser, $strPass, $arParms, $charsetDSNSupport) {
        
        $strKey = md5(serialize(array($strDSN, $strUser, $strPass, $arParms)));
        
        if (!isset($GLOBALS["PDOS"][$strKey])) {
            try {
                
                if (!$charsetDSNSupport)
                {
                    $arParms[\PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES utf8';
                }
                
                $GLOBALS["PDOS"][$strKey] = new \PDO($strDSN, $strUser,$strPass, $arParms);
                
            } catch (PDOException $e) {
                return false;
            }
        }
        return ($GLOBALS["PDOS"][$strKey]);
    }
}
