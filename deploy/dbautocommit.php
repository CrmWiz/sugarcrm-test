<?php
define ('CURRENT_DIR', realpath(dirname(__FILE__)));
define ('SUGAR_DIR', realpath(dirname(__FILE__) . '/../wwwroot'));
define ('WEBSITE_DIR', realpath(dirname(__FILE__) . '/../'));

/*
echo "CURRENT_DIR : ".CURRENT_DIR."\n";
echo "SUGAR_DIR : ".SUGAR_DIR."\n";
echo "WEBSITE_DIR : ".WEBSITE_DIR."\n";
exit;
*/
echo "Running Sugar DB Export for Website : ".WEBSITE_DIR."\n";


$configFile	=	SUGAR_DIR.'/config.php';
$configOverrideFile	=	SUGAR_DIR.'/config_override.php';

//echo '$configFile : '.$configFile.' : exists ? '.(file_exists($configFile)?"yes":"no")."\n";
//echo '$configOverrideFile : '.$configOverrideFile.' : exists ? '.(file_exists($configOverrideFile)?"yes":"no")."\n";

$sugar_config	=	[];

if(file_exists($configFile)){
	include_once($configFile);
}else{
	echo "\nERROR : SugarCRM config.php DOESNT EXIST IN PATH : ".SUGAR_DIR.". Exiting.\n";
        exit;
}

include_once($configOverrideFile);

if(empty($sugar_config)){
	echo "\nERROR : SugarCRM config.php IS EMPTY. Exiting.\n";
	exit;
}

$autoCommitDir	=	CURRENT_DIR."/dbautocommit/";
//echo "\n autoCommitDir : {$autoCommitDir}\n";

if(!file_exists($autoCommitDir)){
	//echo "\nAuto commit dir doesnt exist :  `".$autoCommitDir."`\n";
	mkdir($autoCommitDir);
}

if(!file_exists($autoCommitDir)){
	echo "\nERROR : Unable to create dbautocommit dir in path `".$autoCommitDir."`. Exiting.\n";
	exit;
}else{
	//echo "\nAuto commit dir exists :  `".$autoCommitDir."`\n";
}

$db	=	$sugar_config['dbconfig'];

if(empty($db)){
        echo "\nERROR : DB config in SugarCRM config.php is empty. Cannot generate the DUMP commands. Exiting.\n";
        exit;
}


$baseDumpCmd	=	"mysqldump --skip-comments --create-options --extended-insert=FALSE -h {$db['db_host_name']} -u {$db['db_user_name']} -p\"{$db['db_password']}\" {$db['db_name']}";


$cmds[]	=	"{$baseDumpCmd} config > ".$autoCommitDir."".$db['db_name']."_config.sql";
$cmds[]	=	"{$baseDumpCmd} fields_meta_data > ".$autoCommitDir."".$db['db_name']."_fields_meta_data.sql";
$cmds[]	=	"{$baseDumpCmd} pmse_bpm_activity_definition pmse_bpm_activity_step pmse_bpm_activity_user pmse_bpm_config pmse_bpm_dynamic_forms pmse_bpm_event_definition pmse_bpm_flow pmse_bpm_form_action pmse_bpm_gateway_definition pmse_bpm_group pmse_bpm_group_user pmse_bpm_notes pmse_bpm_process_definition pmse_bpm_related_dependency pmse_bpm_thread pmse_bpmn_activity pmse_bpmn_artifact pmse_bpmn_bound pmse_bpmn_data pmse_bpmn_diagram pmse_bpmn_documentation pmse_bpmn_event pmse_bpmn_extension pmse_bpmn_flow pmse_bpmn_gateway pmse_bpmn_lane pmse_bpmn_laneset pmse_bpmn_participant pmse_bpmn_process pmse_business_rules pmse_emails_templates pmse_inbox pmse_project > ".$autoCommitDir."".$db['db_name']."_PD.sql";
$cmds[]	=	"{$baseDumpCmd} dri_subworkflow_templates dri_subworkflows dri_subworkflows_audit dri_workflow_task_templates dri_workflow_templates dri_workflows dri_workflows_audit > ".$autoCommitDir."".$db['db_name']."_CJ.sql";

foreach($cmds as $cmd){
	//echo "\n----\nCMD : {$cmd}";
	$cmdRes	=	exec($cmd);
	//echo "\nCMDRES : {$cmdRes} \n----";
}

