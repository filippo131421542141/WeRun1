    <?php
    
    class gestionedb
    {   
        // Proprietà
        Public $servername;
        Public $username;
        Public $password;
        Public $dbname;

        public $conn;
        
        
        //$this: keyword che si riferisce all'istanza corrente che stiamo utilizzando
        //permette di accedere alle proprietà e ai metodi (pubbliche) della classe  
        //direttamente dal suo interno.
        //usando l'operatore ->

        private function setconnessione() 
        {
            //localhost 
            $this->servername = '127.0.0.1';  //l'host ovvero l’indirizzo della macchina dove è installato MySQL. 
                                              //indicato dal nome (in locale sarà "localhost") o dall’indirizzo IP
                                              
            $this->username = 'root';         //il nome utente dell'utilizzatore abilitato ad inviare istruzioni 
                                              //al DBMS sulla base dei permessi che gli sono stati accordati;
            $this->password = '';
            $this->dbname = 'dbwerun';
            
        }

        //MySQLi (la i sta per improved, che significa migliorata)
        //è un'estensione PHP per la gestione di un database MySQL.

        private function creaconnessione()
        {
            $this->setconnessione();
            
            //istanziamo un oggetto della classe mysqli e forniamo i parametri 
            //per creare e aprire la connessione al database (risorsa mysqli)
            $this->conn  = new mysqli($this->servername, $this->username, $this->password,  $this->dbname);
            
            //Visualizzo un messaggio d'errore se l'operazione non va a buon fine
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
               
            
            }
        }
        private function chiudiconnessione()
        {
            $this->conn->close();
            $this->conn = null;
        }

        public function eseguicomando($sql)
        {
            $this->creaconnessione();
            //Eseguo una select sul database grazie al metodo query
            //se l'operazione va a buon fine il metodo restituisce un oggetto con i dati estratti
            $result =  $this->conn->query($sql);
            $this->chiudiconnessione();
            return $result;
        }
    }
    ?>