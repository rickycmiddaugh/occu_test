<h2>Clients list</h2>

<p><a href="?v=client/create">Create new Client</a></p>

<form action="?v=client/index" method="GET">
	<label for="search_name">Search By...</label>
	<select name="search_name">
	  <option value=""></option>
	  <option value="name" <?=($this->occu->controller->view_data->search_field == 'name') ? 'selected="selected"' : '' ?>>Name</option>
	  <option value="address"<?=($this->occu->controller->view_data->search_field == 'address') ? 'selected="selected"' : '' ?>>Address</option>
	  <option value="phone" <?=($this->occu->controller->view_data->search_field == 'phone') ? 'selected="selected"' : '' ?>>Phone</option>
	  <option value="email" <?=($this->occu->controller->view_data->search_field == 'email') ? 'selected="selected"' : '' ?>>Email</option>
	</select>

	<label for="search_value"> - </label>
	<input name="search_value" type="text" placeholder="Type your search here" value="<?=(!empty($this->occu->controller->view_data->search_value)) ? $this->occu->controller->view_data->search_value : '' ?>">

	<input type="submit" value="Search" />
</form>

<?php if (!isset($this->occu->controller->view_data->clients) || empty((array)$this->occu->controller->view_data->clients)) { ?>
	<p>There were no clients found.</p>
<?php }  else { ?>
<form action="?v=client/compare" method="POST">
	<table>
		<tr>
			<td>&nbsp;</td>
			<td>Name</td>
			<td>Address</td>
			<td>Phone</td>
			<td>E-mail address</td>
			<td>Last updated</td>
			<td>Actions</td>
		</tr>
		<?php foreach($this->occu->controller->view_data->clients as $client) { ?>
			<tr>
				<td><input type="checkbox" name="CompareClients[]" value="<?php print $client->name; ?>"></td>
				<td><?php print $client->name; ?></td>
				<td><?php print $client->address; ?></td>
				<td><?php print $client->phone; ?></td>
				<td><?php print $client->email; ?></td>
				<td><?php print date('F jS Y h:i:s A', $client->updated); ?></td>
				<td>
					<a href="?v=client/edit/<?=$client->name?>">Edit</a>
					<a href="?v=client/create/<?=$client->name?>">Copy</a>
					<a href="?v=client/delete/<?=$client->name?>">Delete</a>
				</td>
			</tr>
		<?php } ?>	
	</table>
	<input type="submit" value="Compare Two Clients" />
</form>
<?php } ?>