<form name="frm" method='post'>
	<div>
		<br><br>
	
		<table>
		<tr>
		    <td>Name of Waste</td>
		    <td><input name="waste_name" type="" value="" required autofocus/></td>
		</tr>
		<tr>
		    <td>Process Generating Waste &nbsp;&nbsp;&nbsp;&nbsp;</td>
		    <td><input name="process_generating" type="text" value="" required autofocus/></td>
		</tr>
		<tr>
		    <td>Profile Number</td>
		    <td><input name="profile_no" type="text" value="<?php echo $profile_no; ?>" required autofocus readonly/></td>
		</tr>
		<tr>
		    <td>Source</td>
		    <td><input name="source" type="text" value="" required autofocus/></td>
		</tr>
		<tr>
		    <td>Sample Available </td>
		    <td><input name="sample_available" type="text" value="" required autofocus/></td>
		</tr>
		</table>
		<br><br>
		<div>
		     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <button class="btn btn-success previous">Previous</button>
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <input name="Next" type="submit" value='Next' class="btn btn-success"/ >
		     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		     <input name="save" type="submit" value='Save & Return' class="btn btn-success"/ > 
		</div>
	</div>
</form>