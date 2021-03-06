<?php

/* $Id$ */
/*
	snort_dynamic_ip_reload.php
	Copyright (C) 2006 Scott Ullrich and Robert Zeleya
	All rights reserved.

	Redistribution and use in source and binary forms, with or without
	modification, are permitted provided that the following conditions are met:

	1. Redistributions of source code must retain the above copyright notice,
	   this list of conditions and the following disclaimer.

	2. Redistributions in binary form must reproduce the above copyright
	   notice, this list of conditions and the following disclaimer in the
	   documentation and/or other materials provided with the distribution.

	THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES,
	INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
	AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
	AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
	OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
	SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
	INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
	CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
	ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
	POSSIBILITY OF SUCH DAMAGE.
*/

/* NOTE: this file gets included from the pfSense filter.inc plugin process */
/* NOTE: file location /usr/local/pkg/pf, all files in pf dir get exec on filter reloads */

require_once("/usr/local/pkg/snort.inc");
require_once("service-utils.inc");
require_once("config.inc");


if($config['interfaces']['wan']['ipaddr'] == "pppoe" or
   $config['interfaces']['wan']['ipaddr'] == "dhcp") {
		create_snort_conf();
		exec("killall -HUP snort");
		/* define snortbarnyardlog_chk */
        $snortbarnyardlog_info_chk = $config['installedpackages']['snortadvanced']['config'][0]['snortbarnyardlog'];
        if ($snortbarnyardlog_info_chk == on)
                exec("killall -HUP barnyard2");
}

?>