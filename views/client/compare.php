<h2>Compare Clients</h2>
<?php if (empty($this->occu->controller->view_data->clients)) { ?>
	<p><strong>Error</strong> Those values could not be compared. Make sure you select only two clients to compare.</p>
<?php } else { ?>
	<?php
		$client_one = $this->occu->controller->view_data->clients[0];
		$client_two = $this->occu->controller->view_data->clients[1];
		$compare_styling = 'style="background-color:darkblue; color:white;"';
	?>
	<table>
		<tr>
			<td>&nbsp;</td>
			<td>Client One</td>
			<td>Client Two</td>
		</tr>
		<tr>
			<td>Name</td>
			<td><?php print $client_one->name; ?></td>
			<td><?php print $client_two->name; ?></td>
		</tr>
		<tr>
			<td>Address</td>
			<td <?=($client_one->address != $client_two->address) ? $compare_styling : ''; ?>><?php print $client_one->address; ?></td>
			<td <?=($client_one->address != $client_two->address) ? $compare_styling : ''; ?>><?php print $client_two->address; ?></td>
		</tr>
		<tr>
			<td>Phone</td>
			<td <?=($client_one->phone != $client_two->phone) ? $compare_styling : ''; ?>><?php print $client_one->phone; ?></td>
			<td <?=($client_one->phone != $client_two->phone) ? $compare_styling : ''; ?>><?php print $client_two->phone; ?></td>
		</tr>
		<tr>
			<td>E-mail Address</td>
			<td <?=($client_one->email != $client_two->email) ? $compare_styling : ''; ?>><?php print $client_one->email; ?></td>
			<td <?=($client_one->email != $client_two->email) ? $compare_styling : ''; ?>><?php print $client_two->email; ?></td>
		</tr>
	</table>
<?php } ?>