<div id="edit">
	<form action="index.php?action=edit" method='post' >
		<input type="hidden" name='path' value=<?php echo '"'.$path.'"' ?> >
		<textarea class="mce" rows="30" cols="70" <?php echo (empty($file)?'placeholder = "You can edit your file here."':'') ?> name="content"><?php echo $file; ?></textarea>
		<input type="submit" >
	</form>
</div>
<script language="javascript" type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
   tinyMCE.init({
        theme : "advanced",
        editor_selector : "mce",
        mode : "textareas"
   });
</script>