<?php
include_once(BASEPATH."class/first-class.php");
class Country extends FirstClass
{
	
	function getAllCountry()
	{
		$this->setDatabaseConnection();
		$strsqlCountry = "select * from tbls_country where featured =1 order by name";
		$resultCountry = mysql_query($strsqlCountry);
		$countryList = array();
		while($infoCountry  = mysql_fetch_array($resultCountry ,MYSQL_ASSOC))
		{
			$countryList[]=$infoCountry;
		}

		$strsqlCountry = "select * from tbls_country where featured =0 order by name";
		$resultCountry = mysql_query($strsqlCountry);
		while($infoCountry  = mysql_fetch_array($resultCountry ,MYSQL_ASSOC))
		{
			$countryList[]=$infoCountry;
		}

		$this->closeDBConnection();
		return $countryList;
	}

}
?>