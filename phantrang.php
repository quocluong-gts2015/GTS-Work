<!doctype html>
<html> 
<head> 
	<meta charset="utf-8"> 
	<title>Untitled Document</title> 
</head> 

<body> 
	<?php 
	include("Connect.php"); //Lấy tất cả sản phẩm:
	$kq=mysqli_query($link,"select * from webtm_sanpham"); 
	$tsp=mysqli_num_rows($kq); 
	$sd=5; // trang có 5 san phẩm
	$sn=5; // nhóm có 5 trang
	//tinh tong so trang:
	$tst=ceil($tsp/$sd);
	//Tinh tong so nhom:
	$tsn=ceil($tst/$sn); 

	//Tinh page, gr hiện hành:
	if(isset($_GET['gr'])) {
		$gr=$_GET['gr'];
		$page=($gr-1)*$sn+1; 
	} 
	else if (isset($_GET['page'])){ 
		$page=$_GET['page']; 
		$gr=ceil($page/$sn); }
	else{ 
	$gr=$page=1;
	}
	//Tính vị trị lấy sản phẩm: 
	$vitri=($page-1) *$sd; 
	//Query lấy sản phẩm theo vị trí: 
	$kq=mysqli_query($link,"select * from webtm_sanpham limit $vitri,$sd");
?> 
<table width="600" border="1"> 
<tbody> 
<tr> 
	<th scope="col">STT</th> 
	<th scope="col">Tên sản phẩm</th> 
	<th scope="col">Giá</th> 
	<th scope="col">Hình</th> 
</tr> 
<?php 
	while($d=mysqli_fetch_array($kq)) 
		{
		?> 
<tr> 
	<td>&nbsp;</td> 
	<td><?php echo $d['TenSP'];?></td> 
	<td><?php echo $d['Gia'];?></td> 
	<td width="150"><img src="<?php echo $d['UrlHinh']; ?>" width="150" height="100" /></td> 
</tr> 
<?php }?> 
</tbody> 
</table> 
<?php 

//Tính page đầu, cuối của nhóm hiện hành:
$dau=($gr-1)*$sn+1; 
$cuoi=$gr*$sn; 
if($cuoi>$tst)$cuoi=$tst; ?> 
<p>Trang: <?php 
//Lùi 1 nhóm 
if($gr>1) {?><a href="phantrang.php?gr=<?php echo $gr-1;?>">&lt;&lt;</a><?php } 
//In ra các trang từ $dau đến $cuoi của nhóm hiện hành: 
for($i=$dau;$i<=$cuoi;$i++){ 
	if($page==$i) echo "<b><i>$i</b></i> &nbsp;"; 
	else{ 
	?> <a href="phantrang.php?page=<?php echo $i;?>"><?php echo $i;?></a> &nbsp;<?php } 
	//kết thúc của else 
} //kết thúc for page; 
//Tiến tới 1 nhóm: 
if($gr<$tsn) {?><a href="phantrang.php?gr=<?php echo $gr+1;?>">&gt;&gt;</a><?php }?></p> 
</body> 
</html>