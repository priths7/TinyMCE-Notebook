<?php
class Code {	
   
	private $codeTable = 'sections';
    private $conn;
    
	public function __construct($db){
        $this->conn = $db;
    }	
	
	public function getPost(){		
		$sqlQuery = "
			SELECT section_UUID, created
			FROM ".$this->codeTable." ORDER BY section_UUID";
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();		
		return $result;	
	}
	
	public function insert(){
		
			$stmt = "INSERT INTO ".$this->codeTable."(`created`)
				VALUES(NOW())";
				$temp = insert_Ser();
			echo "Hello";
           	
		
	}
	
	private function insert_Ser()
	{
		$stmt = $this->conn->prepare("INSERT INTO `pages` ('section_UUID') VALUES(SELECT `section_UUID` FROM `pages` WHERE time_stamp=NOW())");

		if($stmt->execute())
		{
			return $stmt->insert_id;
		}
		
		
	}
}
?>