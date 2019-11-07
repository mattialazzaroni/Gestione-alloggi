$connectionString = "Data Source=;Initial Catalog=YourDatabase;Integrated Security=SSPI";
$connection = New-Object System.Data.SqlClient.SqlConnection($connectionString);
$command = New-Object System.Data.SqlClient.SqlCommand("DELETE FROM dbo.YourTable WHERE YourTableID = 1", $connection);
$connection.Open();
$rowsDeleted = $command.ExecuteNonQuery();
Write-Host "$rowsDeleted rows deleted";
$connection.Close();