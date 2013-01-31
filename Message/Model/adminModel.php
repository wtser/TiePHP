<?php
class adminModel extends Model{
	public function loginCheck(){
		
		//获取用户名
		@$getName = $_POST['name'];
		@$getPass = md5($_POST['pass']);
		
		if ($getName) {
		    //这里要先判断用户名和密码是否正确
		    $sql = "SELECT * FROM admin WHERE name='$getName' && pass='$getPass' ";
		
		    $action = mysql_fetch_array(mysql_query($sql));
		    if ($action) {
		    	
		        $_SESSION['name'] = $_POST['name'];
		        $_SESSION['pass'] = $_POST['pass'];
		        urlJump(APP_URL.'index.php/admin/index.html');
		    } else {
		        die('账号或密码错误[id or password is wrong]');
		
		    }
		
		
		}
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
