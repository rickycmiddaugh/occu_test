<h2>Status list</h2>

<?php if (!isset($this->occu->controller->view_data->statuses) || empty($this->occu->controller->view_data->statuses)) { ?>
	<p>There were no statuses found.</p>
<?php }  else { ?>
<table>
	<tr>
		<td>ID</td>
		<td>Name</td>
	</tr>
	<?php foreach($this->occu->controller->view_data->statuses as $status) { ?>
		<tr>
			<td><?php print $status->id; ?></td>
			<td><?php print $status->name; ?></td>
		</tr>
	<?php } ?>	
</table>
<?php } ?>