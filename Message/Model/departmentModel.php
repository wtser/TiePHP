<?php
class departmentModel extends Model{
	private $table;
	public function __construct($table){
		$this->table= $table;
	}
	public function getAll(){
		$sql="SELECT name FROM $this->table ORDER BY id ";
		$result = mysql_query($sql);
		//echo $sql;
		while($row = mysql_fetch_array($result)){
			$rows[]=$row['name'];
		}
			 
		return $rows;  
	}
	
	public function delMsg($id){
		if ($id) {
		    $sql    = "DELETE FROM message WHERE id=" . $id;
		    $action = mysql_query($sql);
		    if ($action) {
		        //echo $sql;
		        echo "删除成功";
		        
		    } else {
		        echo "删除失败";
		    }
		}
	}
	
	
	public function reply($id){
	if ($id) {
		    $reply     = $_POST['reply'];
		    $replyTime = date("Y-m-d");
		    $sql       = "UPDATE message SET reply = '$reply',replyTime='$replyTime' WHERE id=" . $id;
		    $action    = mysql_query($sql);
		    if ($action) {
		        //echo $sql;
		        echo "回复成功";
		    } else {
		        echo "回复失败";
		    }
		
		    die();
		}
	}
}
