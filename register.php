 <?php
//connecting the form to database using the php
//declaring the variable
$uname=$_POST['uname'];
$uregno=$_POST['uregno'];
$umail=$_POST['umail'];
$udept=$_POST['udept'];

if(!empty($uname) || !empty($uregno)||!empty($umail)|| !empty($udept)){
    $host="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="project1";

 //dafault connection code
 $conn=new mysqli($host,$dbusername,$dbpassword,$dbname);

 if(mysqli_connect_error()){
die('Connect Error('.
 mysqli_connect_error() .') '
 .mysqli_connect_error());
 
}
else{
//connecting codes if there is no error
$SELECT="SELECT uregno FROM register WHERE uregno=? LIMIT 1";
$INSERT="INSERT INTO register values(?,?,?,?)";

//preparing statement
$stmt=$conn->prepare($SELECT);
$stmt->bind_param("s",$uregno);
$stmt->execute();
$stmt->bind_result($uregno);
$stmt->store_result();
$rnum=$stmt->num_rows;

//checking the username
if($rnum==0){
    $stmt->close();
    $stmt=$conn->prepare($INSERT);
    $stmt->bind_param("ssss",$uname,$uregno,$umail,$udept);
    $stmt->execute();
    echo"New record inserted sucessfully";
}else{
    echo"someone have already registered using this register number";
}
$stmt->close();
$conn->close();
}
}
else{
    echo "All Fields are required";
    die();
}
?>