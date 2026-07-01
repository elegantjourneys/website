<?php
class SetInclusion
{
	function setInclusionExclusionOrder($post)
	{
		$totalRecordsUpdated=0;
		foreach($post['recordsArray'] as $key=>$value)
		{
			
			$strsqlOrder = "update tbl_set_inclusion_exclusion set order_no = ".($key+1)." where id=".$value;
			if(mysql_query($strsqlOrder))
			{
				$totalRecordsUpdated++;
			}
			else
			{
				
			}
		}

		if($totalRecordsUpdated==count($post['recordsArray']))
		{
			return '1';
		}
		else if($totalRecordsUpdated>=1)
		{
			return '2';
		}
		else if($totalRecordsUpdated==0)
		{
			return '0';
		}
	}

	function deleteTourInclusionById($inclusionId)
	{
		$strsqlTourData = "delete from tbl_set_inclusion_exclusion where id=".$inclusionId;
		if(mysql_query($strsqlTourData))
		{
			return '1';
		}
		else
		{
			return '0';
		}
	}

	function addInclusionExclusion($post)
	{
		$strsqlTourUpd = "insert into tbl_set_inclusion_exclusion ( tour_id, inc_exc_id, order_no) values('".$post['tourId']."','".$post['exclusionId']."','0')";
		if(mysql_query($strsqlTourUpd))
		{
			return '1';
		}
		else
		{
			return '0';
		}
	}

	function removeInclusionExclusion($post)
	{
		$strsqlTourData = "delete from tbl_set_inclusion_exclusion where tour_id=".$post['tourId']." and inc_exc_id=".$post['exclusionId'];
		if(mysql_query($strsqlTourData))
		{
			return '1';
		}
		else
		{
			return '0';
		}
	}
}
?>