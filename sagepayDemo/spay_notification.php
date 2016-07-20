<?php
       $eol = "\r\n";
        $retStatus = "OK";
        $retStatusDetail = "dmchealthcare";
        $redirect_url = "http://api.dmc.loc/index.php?route=payment/sagepay_telephone_v3/callback&tx_code=";
        header("Content-type: text/plain");
        echo 'Status=' . $retStatus . $eol . 'StatusDetail=' . $retStatusDetail . $eol . 'RedirectURL=' . $redirect_url . $eol;        
        die;

?>