<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'user');
   define('DB_PASSWORD', 'user');
   define('DB_DATABASE', 'Bank');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
	}
class Transaction{
    const DB_HOST = 'localhost';
    const DB_NAME = 'Bank';
    const DB_USER = 'user';
    const DB_PASSWORD = 'user';
    public function __construct() {
        // open database connection
        $conStr = sprintf("mysql:host=%s;dbname=%s", self::DB_HOST, self::DB_NAME);
        try {
            $this->pdo = new PDO($conStr, self::DB_USER, self::DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    private $pdo = null;

    public function transfer($from, $to, $amount) {
 		if($from == $to){
		echo "Can't transfer to same acount";
                return false;
		}else{
        try {
            $this->pdo->beginTransaction();
 
            // get available amount of the transferer account
            $sql = 'SELECT account_balance FROM Account WHERE account_number=:from';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array(":from" => $from));
            $availableAmount = (int) $stmt->fetchColumn();
            $stmt->closeCursor();
 
            if ($availableAmount < $amount) {
                echo 'Insufficient amount to transfer';
                return false;
            }
            // deduct from the transferred account
            $sql_update_from = 'UPDATE Account
 		SET account_balance = account_balance - :amount
		 WHERE account_number = :from';
            $stmt = $this->pdo->prepare($sql_update_from);
            $stmt->execute(array(":from" => $from, ":amount" => $amount));
            $stmt->closeCursor();
 
            // add to the receiving account
            $sql_update_to = 'UPDATE Account
                                SET account_balance = account_balance + :amount
                                WHERE account_number = :to';
            $stmt = $this->pdo->prepare($sql_update_to);
            $stmt->execute(array(":to" => $to, ":amount" => $amount));
 		
	    // transaction
            $sql_update_tow = 'Insert INTO Transaction(prefix,date_of_transaction,reference,amount)
                                values(:prefix,:date,:reference,:amount)';
		$pre='online';
		$date=date("Y.m.d");
		$reference=1;
            $stmt = $this->pdo->prepare($sql_update_tow);
            $stmt->execute(array(":prefix" => $pre,":date" => $date,":reference" => $reference, ":amount" => $amount));
 	//online transaction
            $sql_update_towr = 'Insert INTO Online_Transaction(prefix,from_account_number,to_account_number)
                                values(:prefix,:from,:to)';
		
            $stmt = $this->pdo->prepare($sql_update_towr);
            $stmt->execute(array(":prefix" => $pre,":from" =>$from,":to" => $to));
            // commit the transaction
            $this->pdo->commit();
 
            echo 'The amount has been transferred successfully from '.$from." to ".$to."\n";
 
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            die($e->getMessage());
        }
}
    }
 
    /**
     * close the database connection
     */
    public function __destruct() {
        // close the database connection
        $this->pdo = null;
    }
 
}
?>
