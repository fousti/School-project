			<div id="tree">
				Directory Navigation :
			<?php
				$pos=0;
				echo "<ul id=\"main_ul\"><li><a class=\" "; if($path == ''){echo "active";} echo "\" href=\"index.php?action=readdir&dir=root\">root</a></li>";
				foreach($content_folder as $key => $value){
				echo '<li class="treeElem" data-position="'.$pos++.'" data-lvl="'.$lvl[$config['root'].$value].'" ><a class=\''; if($value == $path){echo " active";} echo'\' data-lvl=\''.$lvl[$config['root'].$value].'\' href=\'index.php?action=readdir&dir='.$value.'\'><img class="icon" src="images/folder_icon.png" alt="folder icon" />'.$name_tree[$config['root'].$value].'</a><span class="nav-coll" ><img class="icon" src="images/arrow.png" /></span></li>';
				}
				echo "</ul>";
			?>
			</div>
			<table id="tab_create">
				<tr>
					<td><form class="create" action="index.php?action=createdir" method="post" >
						<input class="text" type="text" name="dirname">
						<input type="hidden" value=<?php echo '"'.$path.'"' ?> name="path" >
					</td>
					<td>
						<input type='submit' value='Create Directory'>
						</form>
					</td>
					<td>
						<form class="create" action="index.php?action=createfile" method="post" >
						<input class="text" type="text" name="new_file">
						<input type="hidden" value=<?php echo '"'.$path.'"' ?> name="path" >
					</td>
					<td>
						<input type='submit' value='Create file'>
						</form>
					</td>
				</tr>

			</table>
			<table id="filer">
				<tr>
					<td colspan="4">
						<div id="parent"><a href=<?php echo '"index.php?action=prev_dir&dir='.$path.'"' ?> ><img class="icon" src="images/parent.png" alt="folder icon" />Parent directory</a></div>
					</td>
				</tr>
				<?php
				foreach ($content as $key => $value) {
					if ($key == 'dir') {
						foreach ($value as $key2 => $value2) {					
				?>
			<tr>
				<td>
					<img class="icon" src="images/folder_icon.png" alt="folder icon" /><a href= <?php echo '"index.php?action=readdir&dir='.urlencode($path.'/'.$value2).'"' ; ?> ><?php echo $value2 ?></a>&nbsp;&nbsp;<a class='delete_link' onclick="return false" href=<?php echo '"index.php?action=deletedir&dir='.urlencode($path.'/'.$value2).'"' ; ?> ><img class="icon" src="images/delete.png" alt="delete" /></a>
				</td>
				<td id="group"><button id="<?php echo 'rename'.$value2.$key2; ?>" class="show_control" >Rename folder</button><div class="control">
						<form action="index.php?action=renamedir" method="post" ><input class="text" type="text" name="new_path"/>
						<input type="hidden" value=<?php echo '"'.$path.'/'.$value2.'"' ?> name="path" /><input type="hidden" name ="dir" value=<?php echo '"'.$path.'"' ?> /><input type="submit" value="Renommer le dossier" /></form>
					</div>
						
				</td>
				<td><button id="<?php echo 'move'.$value2.$key2; ?>" class="show_control">Move folder</button><div class="control"><form action="index.php?action=movedirectory" method="post" ><select name="new_path"><?php echo '<option value="'.$config['root'].'">root</option>'; foreach ($content_folder as $destination) {
									if (strpos($destination, $value2)===false)
										echo '<option value="'.$destination.'">'.$destination.'</option>';
								} ?></select>
								<input type="hidden" value=<?php echo '"'.$path.'/'.$value2.'"' ?> name="path" />
								<input type="hidden" value=<?php echo '"'.$value2.'"' ?> name="dirname" />
								<input type="submit" value="Ok" />
								</form>
					</div>
					
				</td>
				<td class="control_group"><button id="<?php echo 'copy'.$value2.$key2; ?>" class="show_control">Copy folder</button><div class="control"><form action="index.php?action=copydirectory" method="post" ><select name="new_path"><?php echo '<option value="'.$config['root'].'">root</option>'; foreach ($content_folder as $destination) {
									if (strpos($destination, $value2)===false)
										echo '<option value="'.$destination.'">'.$destination.'</option>';
								} ?></select>
								<input type="hidden" value=<?php echo '"'.$path.'/'.$value2.'"' ?> name="pathfolder" />
								<input type="hidden" value=<?php echo '"'.$path.'"' ?> name="path" />
								<input type="hidden" value=<?php echo '"'.$value2.'"' ?> name="dirname" />
								<input type="submit" value="Ok" />
								</form>
					</div>	
				</td>
			</tr>
			<?php } } else { 
					foreach ($value as $key2 => $value2) {
			?>
			<tr>
				<td>
					<img class="icon" src="images/file.png" alt="folder icon" /><a href=<?php echo '"index.php?action=read&view=edit&file='.$path.'/'.$value2.'"' ; ?> ><?php echo $value2 ?></a><a href=<?php echo '"index.php?action=download&file='.$path.'/'.$value2.'"' ; ?> ><img class="icon" src="images/download.png" alt="folder icon" />Download</a> <a class="delete_link" onclick="return false" href=<?php echo '"index.php?action=deletefile&file='.$path.'/'.$value2.'"' ; ?> ><img class="icon" src="images/delete.png" alt="delete icon" /></a>
				</td>
				<td>
					<button id="<?php echo 'rename'.$value2.$key2; ?>" class="show_control">Rename file</button><div class="control"><form action="index.php?action=renamefile" method="post" ><input type="text" class="text" name="new_path"/>
					<input type="hidden" value=<?php echo '"'.$path.'/'.$value2.'"' ?> name="path" /><input type="hidden" name ="dir" value=<?php echo '"'.$path.'"' ?> /><input type="submit" value="Renommer le fichier" /></form>
					</div>
				</td>
				<td><button id="<?php echo 'move'.$value2.$key2; ?>" class="show_control">Move file</button><div class="control"><form action="index.php?action=movefile" method="post" ><select name="new_path"><?php echo '<option value="'.$config['root'].'">root</option>'; foreach ($content_folder as $destination) {
											if (strpos($destination, $value2)===false)
												echo '<option value="'.$destination.'">'.$destination.'</option>';
										} ?></select>
										<input type="hidden" value=<?php echo '"'.$path.'/'.$value2.'"' ?> name="path" />
										<input type="hidden" value=<?php echo '"'.$value2.'"' ?> name="filename" />
										<input type="submit" value="Ok" />
										</form>
									</div>
				</td>
				<td><button id="<?php echo 'copy'.$value2.$key2; ?>" class="show_control">Copy file</button><div class="control"><form action="index.php?action=copyfile" method="post" ><select name="new_path"><?php echo '<option value="'.$config['root'].'">root</option>'; foreach ($content_folder as $destination) {
											if (strpos($destination, $value2)===false)
												echo '<option value="'.$destination.'">'.$destination.'</option>';
										} ?></select>
										<input type="hidden" value=<?php echo '"'.$path.'/'.$value2.'"' ?> name="path" />
										<input type="hidden" value=<?php echo '"'.$value2.'"' ?> name="filename" />
										<input type="submit" value="Ok" />
										</form>
									</div>
				</td>
			</tr>
										<?php } } } ?>
		</table>
		<table id="upload">
			<tr>
				<td>
				<form action=<?php echo '"index.php?action=uploadfile"' ?> method="post" enctype="multipart/form-data" ><input type="hidden" name="path" value=<?php echo '"'.$path.'"' ?> />
					<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />Upload File<input class="input_upload" type="file" name="file_up" value="AttachFile" device="files" accept="text/*" />
				</td>
				<td>
					<input type="submit" value="Upload file" />
				</form>
				</td>

			</tr>
		</table>