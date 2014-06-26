<?php

namespace front\db;

require_once ('PDOFactory.php');

class Database {

	// CONNESSIONE
	private $_db;
	
	public function __construct(\DatabaseConfig $config) {
		
		// effettua connessione
		$this->_db = $this->nuovaConnessione($config->getHost(), $config->getUser(), $config->getPassword(), $config->getDatabase());

		// controllo connessione
		if (!$this->_db) { die("Errore nella connessione con il Database"); }

        return $this;
	}
	
    // apre nuova connessione PDO - utilizzato per moduli amministrativi (importazione)
    public function nuovaConnessione($host, $user, $password, $database, $port = 3307)
    {
        // indicare il supporto del charser nella stringa DSN - da passare alla GetPDO
        $charsetDSNSupport = false;
        
        // version_compare returns -1 if the first version is lower than the second, 0 if they are equal, and 1 if the second is lower. 
        if ((version_compare($this->_getPHPVersion(), "5.3.6") == -1))
        {
            // Versioni PHP inferiori alla 5.3.6 non supportano in charset nella stringa dsn 
            $dsn = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database;
        }
        else
        {
            $charsetDSNSupport = true;
            $dsn = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database . ';charset=utf8';
        }
        
        $db = PDOFactory::GetPDO($dsn, $user, $password, array(\PDO::ATTR_PERSISTENT), $charsetDSNSupport);
        
        return ($db ? $db : null);
    }
    
    // metodi privati
    private function _getPHPVersion()
    {
        $match = null;
        
        // estrazione numero di versione
        preg_match("/(\d+.\d+.\d+)/", phpversion(), $match);
        
        // ritorna numero di versione
        return (is_array($match) ? $match[0] : null);        
    }

	public function getConnessione() {
		return $this->_db;
	}
}