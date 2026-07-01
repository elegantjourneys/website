<?php
	switch($data['general']['page_url'])
	{
		case 'palace-on-wheels':
				echo $this->element('version2/luxurytrain/palace-on-wheel');
			break;
		case 'maharajas-express':
				echo $this->element('version2/luxurytrain/maharajas-express');
			break;
	}
?>