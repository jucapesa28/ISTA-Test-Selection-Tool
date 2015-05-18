<?php
		//start the session
		session_start();

		//if not logged in, re-direct to login.php
		if (!isset($_SESSION['username'])&& !isset($_SESSION['user_type'])) {
		header("location: login.php");
		}
		//include any libraries/classes needed
		include "header.php";
		?>
		
		<style type="text/css" title="currentStyle">
			@import "css/demo_table_jui.css";
			@import "css/datatable/jquery-ui-1.8.18.custom.css";
			
		</style>
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.jeditable.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.editable.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				var oTable=$('#example').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"bJQueryUI": true,
					"sAjaxSource": "scripts/server_processing.php",
					 "iDisplayLength": 20,	
					 "bLengthChange": false,
					 "aoColumnDefs": [
      { "bVisible": false, "aTargets": [ 0 ] }]
					
				} );
				
				 var oTable = $('#example').dataTable().makeEditable({
                           	
							sUpdateURL: "update_users.php",
                            sAddURL: "add_user.php",
                            sDeleteURL: "delete_user.php",
                            oAddNewRowButtonOptions: { 
				label: "Add...",
                               icons: { primary: 'ui-icon-plus' }
                            },
                            oDeleteRowButtonOptions: {
				label: "Remove",
                                icons: { primary: 'ui-icon-trash' }
                            },
                            oAddNewRowOkButtonOptions: {
				label: "Confirm",
                                icons: { primary: 'ui-icon-check' },
                                name: "action",
                                value: "add-new"
                            },
                            oAddNewRowCancelButtonOptions: { 
				label: "Close",
                                class: "back-class",
                                name: "action",
                                value: "cancel-add",
                                icons: { primary: 'ui-icon-close' }
                            },
                            oAddNewRowFormOptions: {
				title: 'Add a new employee - form',
                                show: "blind",
                                hide: "explode"
                            }
        });

				
			} );
		</script>
<div class="box datatable">
			<div id="container">
			<div id="dynamic">
			 <form id="formAddNewRow" class="employees" action="#" title="Add New Employee">
		<input type="hidden" name="id" rel="6"/>
        <label for="user">Username</label><br />
		<input type="user" name="user" class="required" rel="0" />
        <br />
        <label for="password">Password</label><br />
		<input type="password" name="password" class="required" rel="1" />
        <br />
        <label for="re_password">Re-type Password</label><br />
		<input type="password" name="re_password" class="required" rel="2" />
        <br />
        <label for="email">Email</label><br />
		<input type="email" name="email" class="required" rel="3" />      
		<br />
		<label for="device_id">User Type</label><br />
		<select id="cjComboBox" name="user_type" class="required" rel="4">
					<option value="">Select User Type</option>
					<option value="1">Administrator</option>
					<option value="2">Manager</option>
  
		</select> 
        <br />
</form>
		<div class="add_delete_toolbar"></div>	
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th width="10%">ID</th>
			<th width="10%">Username</th>
			<th width="15%">Email</th>
			<th width="5%">Usertype</th>
	
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="5" class="dataTables_empty">Loading data from server</td>
		</tr>
	</tbody>
	
</table>
			</div>
			<div class="spacer"></div>
		
		</div>
		</div>

</body>
</html>