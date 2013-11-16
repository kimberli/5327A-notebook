<?php
	$id=$_GET['id'];
	$width=$_GET['w'];
	$url="https://www.googleapis.com/drive/v2/files/" . $id ."?fields=thumbnailLink&key=AIzaSyDlmc-Vo-7FEH6z7ok_JGpB1HhQ9Rr4RHs";
	$content = file_get_contents($url);
	$content=substr($content,21);
	$parts=explode("=",$content);
	$content=$parts[0];
	$content.="=s" . $width;
	echo $content;
	header("Location: " . $content);
?>
<script>
	window.location="<?php echo $content; ?>"
</script>