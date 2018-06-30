 <?php
	class Database {
		

		private $DB;
		
		public function __construct() {
			$db = 'mysql:dbname=SKI;host=127.0.0.1';
			$user = 'root';
			$password = '';
			
			try {
				$this->DB = new PDO ( $db, $user, $password );
				$this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			} catch ( PDOException $e ) {
				echo ('Error establishing Connection');
				exit ();
			}
		}
		
			public function addNewUser($FirstName,$LastName,$email, $hash) {
			$password = password_hash($hash, PASSWORD_DEFAULT);
			
			$stmt = $this->DB->prepare ( "INSERT INTO user (FirstName, LastName, email, password) values(:FirstName,:LastName,:email,:password)" );
			$stmt->bindParam ( 'FirstName', $FirstName );
			$stmt->bindParam ( 'LastName', $LastName );
			$stmt->bindParam ( 'email', $email );
			$stmt->bindParam ( 'password', $password );
			$stmt->execute ();

		}
		
			public function verified($email, $password) {
			$sth = $this->DB->prepare("SELECT password FROM user WHERE email = :email");
			$sth->bindParam ('email', $email );
			$sth->execute();
			$hash = $sth->fetchColumn();
			$password1="ciao";
			$success = password_verify($password,$hash);
			if ($success==1){
			$stmt = $this->DB->prepare ("SELECT email FROM user WHERE email = :email ");
			$stmt->bindParam ('email', $email );
			$stmt->execute ();
			if($stmt->rowCount() > 0){
				 $_SESSION['user_session'] = $email;
                return true;
			    } else {
			  
			        return false;
			    }
			}
			if ($success==0)
			    return false;

			
		}
		public function check($email){
		$sth = $this->DB->prepare("SELECT email FROM user WHERE email = :email");
		$sth->bindParam ('email', $email );
		$sth->execute();
		if($sth->rowCount() > 0){
			return true;
		}
		else 
		return false;	
		}
		 public function redirect($url)
   {
       header("Location: $url");
   }
   
   	  public function logout()
   {
        session_destroy();
        unset($_SESSION['email']);
        return true;
   }
   
     public function is_loggedin()
   {
      if(isset($_SESSION['email']))
      {
         return true;
      }
   }

   public function get_array(){
   	$stmt = $this->DB->prepare ( "SELECT * FROM inventory WHERE gear='ski' AND quantity>0" );
			$stmt->execute ();
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
   }

    public function get_array2(){
   	$stmt = $this->DB->prepare ( "SELECT * FROM inventory WHERE gear='board' AND quantity>0" );
			$stmt->execute ();
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
   }

     public function count(){
   	$stmt = $this->DB->prepare ( "SELECT COUNT(*) FROM inventory where gear='ski' AND quantity>0" );
			$count =$stmt->execute ();
			return $stmt->fetchColumn();
   }

      public function count2(){
   	$stmt = $this->DB->prepare ( "SELECT COUNT(*) FROM inventory where gear='board' AND quantity>0" );
			$count =$stmt->execute ();
			return $stmt->fetchColumn();
   }

	}		
		
?>

