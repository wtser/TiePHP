<?php
class messageModel extends Model{
	private $table;
	public function __construct($table){
		$this->table= $table;
	}

	public function selectAll(){
		$sql="SELECT * FROM $this->table ORDER BY id desc";
		$result = mysql_query($sql);
		//echo $sql;
		while($row = mysql_fetch_array($result)){
			$rows[]=$row;
		}
			 
		return $rows;  
	}
	
	/**
	 * 显示num条记录
	 * Enter description here ...
	 * @param unknown_type $num
	 */
	public function selectByNum($num){
		//$step为页码
    $step = URL_P3;

    
//表示每页显示8条记录
    $start = $num * $step;


    $result = mysql_query("SELECT nickName,content,reply,replyer,createTime,replyTime FROM message order by createTime desc,id desc limit $start,$num");

    $data = array();
    $json = array();

    while ($row = mysql_fetch_array($result)) {
        $json[] = $data[] = (object)array('nickName' => $row['nickName'], 'content' => $row['content'], 'createTime' => $row['createTime'], 'reply' => $row['reply'], 'replyer' => $row['replyer'], 'replyTime' => $row['replyTime']);
    }
    echo json_encode($json);
	}
	
	/**
	 * 提交留言操作
	 * Enter description here ...
	 */
	public function leaveMsg(){

    $nickName   = $_POST['nickName'];
    $content    = $_POST['content'];
    $replyer    = $_POST['replyer'];
    $ipAddress  = $_SERVER["REMOTE_ADDR"];
    $createTime = date("Y-m-d H:i:s");

    $realName = $_POST['realName'];
    $stuNum   = $_POST['stuNum'];
    $phone    = $_POST['phone'];

    $reply = "";


    $sql_check = "SELECT * FROM message WHERE content LIKE '$content' ORDER BY createTime desc,id desc LIMIT 0,8 ";
    $result    = mysql_query($sql_check);
    if ($row = mysql_fetch_array($result)) {
        die('<script type="text/javascript"> alert("留言内容重复，请不要刷屏。");history.back(-1);</script> <p style="font-size:2em;text-align: center;margin-top:80px;">留言内容重复，请不要刷屏。<a href="leaveMessage.php" onclick="javascript:history.back(-1);">返回</a></p>');

    }


    $sql = "INSERT INTO message (nickName, content, replyer,ipAddress,createTime,realName,stuNum,phone,reply)
	VALUES ('$nickName', '$content','$replyer','$ipAddress','$createTime','$realName','$stuNum','$phone','$reply')";


    if (!mysql_query($sql)) {
        die('Error: ' . mysql_error());
    }
    echo '<script language="javascript" type="text/javascript">
    
    pageUrl=""; 
	pageUrl = window.location;
	pageUrl = pageUrl.toString() ;
	n=pageUrl.indexOf("index.php");
	pageUrl=pageUrl.substring(0, n);
	
        var i = 3;  
        var intervalid;  
        intervalid = setInterval("fun()", 1000);  
        function fun() {  
            if (i == 0) {  
                window.location.href = pageUrl;  
                clearInterval(intervalid);  
            }  
            document.getElementById("mes").innerHTML = i;  
            i--;   
        }  
    </script>  ';
    echo '<p style="font-size:2em; text-align:center;">留言成功 <span id="mes">3</span> 秒钟后返回首页！</p> ';
    die();
	}
	
	
	public function getDepartment($department){
		//判断是否按照部门读取记录
		//若为空则全部读取
		
		
		
		if ($department) {
		    $department = "&& replyer='" . $department . "'";
		} else {
		    $department = "&& replyer!=''";		    
		}
		//设置显示的留言回复区间为2个月份
		$month = date("m") - 1;
		$time = date("Y") . '-' . $month . '-1';
		//echo "SELECT * FROM message where reply='' && createTime>='$time'  $replyer order by createTime desc, id desc";
		$result = mysql_query("SELECT * FROM message where reply='' && createTime>='$time'  $department order by createTime desc, id desc");
		$replyerResult = mysql_query("SELECT distinct replyer FROM message where reply='' && createTime>='$time'  order by createTime desc, id desc ");
		
		
		while($row = mysql_fetch_array($result)) {
            $data['result'][] = $row;
        }
        //var_dump($data['result']);
		while($row = mysql_fetch_array($replyerResult)) {
            $data['replyerResult'][] = $row;
        }
		return $data;
	}
}