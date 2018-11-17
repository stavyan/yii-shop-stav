<?php
require_once("../../vendor/API/qqConnectAPI.php");
$qc = new \QC();
echo $qc->qq_callback();
echo $qc->get_openid();
