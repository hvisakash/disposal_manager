<form name="frm" method='post'>
	<div>
		<br><br>
		<table>
		<tr>
		    <td>Name of Waste</td>
		    <td><input name="waste_name" type="text" value="<?php echo $session->__get('waste_name') ?>" required autofocus/></td>
		</tr>
		<tr>
		    <td>Process Generating Waste &nbsp;&nbsp;&nbsp;&nbsp;</td>
		    <td><input name="process_generating" type="text" value="<?php echo $session->__get('process_generating') ?>" required autofocus/></td>
		</tr>
		<tr>
		    <td>Profile Number</td>
		    <td><input name="profile_no" type="text" value="<?php if($session->__get('profile_no')) echo $session->__get('profile_no');
		    else echo $profile_no; ?>" required autofocus readonly/></td>
		</tr>
		</table>
		<br><br>
		<div>
		     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		     <a href="<?php echo BASE_URL;?>/generators/Services" class="btn btn-success">Previous</a>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <input name="Next" type="submit" value='Next' class="btn btn-success"/ >
		     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		     <input name="save" type="submit" value='Save & Return' class="btn btn-success save"/ > 
		</div>
	</div>
</form>