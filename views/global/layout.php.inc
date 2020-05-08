<html>
	<head>
		<style>
			table, th, td {
			  border-collapse: collapse;
			  border: 1px solid black;
			  padding: 6px;
			}
		</style>
	</head>
	<body>
		<h1><?php print $this->view_data->site_title; ?></h1>

		<a href="?v=client/index">Clients</a>
		<a href="?v=status/index">Statuses</a>

		<?php include($this->view); ?>
	</body>
</html>