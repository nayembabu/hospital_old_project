<?php

	foreach ($opt_vew as $ovew) {
		echo $ovew->insert_date.'<br>';

		foreach ($opt_vw as $opvw) {
			if ($ovew->out_p_iid == $opvw->out_p_iid) {

			}
		}


		foreach ($opt_v as $optv) {
			if ($ovew->out_p_iid == $optv->out_p_iid) {
				echo $optv->out_p_name.'<br>';
			}
		}


	}

?>