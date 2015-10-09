<?php

require_once('protected/config/main-local-analytic.php');

error_reporting(E_ALL & ~E_NOTICE);

$date_from  = date("Y.m").'.01';
if(isset($_POST["dt1"]))		$date_from = $_POST["dt1"];

$date_to 	  = date("Y.m").'.31';
if(isset($_POST["dt2"]))		$date_to 	 = $_POST["dt2"];	


function get_statistic($stat_project_id, $stat_project_name, $dt1, $dt2 ) {

	
	  if($stat_project_id == 0) $sql_project = '';
	  else $sql_project = ' project_id='.$stat_project_id.' and ';

	  $dt_sql = 'dt_fixed >= "'.$dt1. '" and dt_fixed < "'.$dt2. '" and '; 
	
		$programmers_sql	= mysql_query('select id, f_name, l_name from b_user where type_id=2 order by l_name ASC');
    $n = mysql_num_rows($programmers_sql);
    
    $ii = 0;
    for($i=0; $i < $n; $i++){
    	
 			$programmer			= mysql_fetch_assoc($programmers_sql);
 		
 			$prog_sql = '( user_to_id = '.$programmer['id']. ' and ( user_id_fixed = '.$programmer['id'].'  or user_id_fixed =  4 )  )' ;
 			
 			$task_total	 = mysql_query('select count(id) as user_total_task, sum(time_to) as user_total_time from b_bugs where '.$dt_sql.$sql_project.$prog_sql );
 			$task_total	 = mysql_fetch_assoc($task_total);

 			$bug_bug		 = 'select count(id) as user_total_task, sum(time_to) as user_total_time from b_bugs where '.$dt_sql.$sql_project.' first_status_id <> 7 and'.$prog_sql;	
 			$bug_total	 = mysql_query('select count(id) as user_total_task, sum(time_to) as user_total_time from b_bugs where '.$dt_sql.$sql_project.' first_status_id <> 7 and'.$prog_sql);
 			$bug_total	 = mysql_fetch_assoc($bug_total);

 			$new_new   	 = 'select count(id) as user_total_task, sum(time_to) as user_total_time from b_bugs where '.$dt_sql.$sql_project.' first_status_id = 7 and '.$prog_sql;
 			$new_total	 = mysql_query('select count(id) as user_total_task, sum(time_to) as user_total_time from b_bugs where '.$dt_sql.$sql_project.' first_status_id = 7 and '.$prog_sql);
 			$new_total	 = mysql_fetch_assoc($new_total);


			if( $task_total['user_total_time'] > 0 ) {
				
				if($ii==0) echo '<tr height=40 bgcolor=#f0f0f0><td colspan=8 align=left>'.$stat_project_name.'</td></tr>'; $ii++;
				
	    	echo '<tr>
	    						<td align=left><small>&nbsp;-&nbsp;'.$programmer['l_name'].' '.$programmer['f_name'].'</small></td>
	    						
	    						<td bgcolor=#f0f0f0 align=right width=60>'.$task_total['user_total_task'].'&nbsp;</td>
	    						<td bgcolor=#f0f0f0 align=right width=60>'.$task_total['user_total_time'].'&nbsp;</td>

	    						<td bgcolor=#ffc2c0 align=right width=60><a target=_new href=get_search_data.php?user_id='.$programmer['id'].'&project_id='.$stat_project_id.'&dt1='.$dt1.'&dt2='.$dt2.'&task=bug>'.$bug_total['user_total_task'].'</a>&nbsp;</td>
	    						<td bgcolor=#ffc2c0 align=right width=60>'.$bug_total['user_total_time'].'&nbsp;</td>    						
	
	    						<td bgcolor=#E4FAD2 align=right width=60><a target=_new href=get_search_data.php?user_id='.$programmer['id'].'&project_id='.$stat_project_id.'&dt1='.$dt1.'&dt2='.$dt2.'&task=new>'.$new_total['user_total_task'].'</a>&nbsp;</td>
	    						<td bgcolor=#E4FAD2 align=right width=60>'.$new_total['user_total_time'].'&nbsp;</td>
	    						
	    						<td bgcolor=#F7E1F6 align=right width=60>'.round($new_total['user_total_time']/$task_total['user_total_time']*100).'%;</td>    						
	    				</tr>';	
    	}	
	
		}	
}


echo '<center>
			
			<table width="980" cellpadding="0" cellspacing="0" border="1">
				<tr><td><img src=images/logo.png></td></tr>
				<tr height=40>
					<form action="http://'.$_SERVER['HTTP_HOST'].'/analytic.php" method="post" enctype="multipart/form-data">
					<td colspan=8 align=right>
						from:&nbsp;<input style="width:88;text-align: center;" name=dt1 value="'.$date_from.'">&nbsp;&nbsp;
						to:&nbsp;<input style="width:88;text-align: center;" name=dt2 value="'.$date_to.'">&nbsp;&nbsp;
						<input style="cursor:pointer;" type=submit value="Analyze">&nbsp;
					</td>
					</form>
				</tr>
			</table><table width="984" cellpadding="6" cellspacing="0" border="1">';
				
	
    get_statistic(0, 'Total statistic', $date_from, $date_to);

		$projects_sql	= mysql_query('select id, name from b_project order by name ASC');
    $p = mysql_num_rows($projects_sql);
    
    for($j=0; $j < $p; $j++){
    	$project			= mysql_fetch_assoc($projects_sql);
	    get_statistic($project['id'], $project['name'], $date_from, $date_to);
  	}	

echo '</table>
			<table width="980" cellpadding="6" cellspacing="0" border="0">
				<tr><td align=right><small>Software Company Aura</small></td></tr>
			</table>	
</center>';
?>