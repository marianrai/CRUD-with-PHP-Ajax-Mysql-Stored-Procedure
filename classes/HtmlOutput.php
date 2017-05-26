<?php

class HtmlOutput
{

	private static $templateStart = '
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Created At</th>
					<th>Update</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody
	';

	private static	$templateRepeat = '
		<tr>
			<td>{{id}}</td>
			<td>{{first_name}}</td>
			<td>{{last_name}}</td>
			<td>{{created_at}}</td>
			<td><button type="button" name="update" id="user_{{id}}" class="btn btn-primary">Update</button></td>
			<td><button type="button" name="delete" id="user_{{id}}" class="btn btn-danger">Delete</button></td>
		</tr>
	';

	private static $templateIfEmpty = '
		<tr>
			<td colspan="6">There are no users in the database.</td>			
		</tr>	
	';

	private static	$templateEnd = '
			</tbody>
		</table>
	';

	private static $response = '';



	public static function displayInTable($data)
	{

		self::$response .= self::$templateStart;


		if (isset($data) && is_array($data)) {
			
			if (count($data) > 0) {

				foreach ($data as $user) {

					$temporary = self::$templateRepeat;
								
					foreach ($user as $name => $value) {
						$temporary = str_replace('{{' . $name . '}}', $value, $temporary);
					}

					self::$response .= $temporary;
				
				}




			}
			else {
				
				self::$response = self::$templateIfEmpty;

			}
		

		}
		else {
			
			self::$response = self::$templateIfEmpty;

		}


		self::$response .= self::$templateEnd;


		return self::$response;

	}


}