<?php
/**
 *
 * This file is part of HESK - PHP Help Desk Software.
 *
 * (c) Copyright Klemen Stirn. All rights reserved.
 * https://www.hesk.com
 *
 * For the full copyright and license agreement information visit
 * https://www.hesk.com/eula.php
 *
 */

define('IN_SCRIPT',1);
define('HESK_PATH','../');

define('LOAD_TABS',1);

// Make sure the install folder is deleted
if (is_dir(HESK_PATH . 'install')) {die('Please delete the <b>install</b> folder from your server for security reasons then refresh this page!');}

// Get all the required files and functions
require(HESK_PATH . 'hesk_settings.inc.php');

// Save the default language for the settings page before choosing user's preferred one
$hesk_settings['language_default'] = $hesk_settings['language'];
require(HESK_PATH . 'inc/common.inc.php');
$hesk_settings['language'] = $hesk_settings['language_default'];
require(HESK_PATH . 'inc/admin_functions.inc.php');
require(HESK_PATH . 'inc/setup_functions.inc.php');
hesk_load_database_functions();

hesk_session_start();
hesk_dbConnect();
hesk_isLoggedIn();

// Check permissions for this feature
hesk_checkPermission('can_man_settings');

// Load custom fields
require_once(HESK_PATH . 'inc/custom_fields.inc.php');

$help_folder = '../language/' . $hesk_settings['languages'][$hesk_settings['language']]['folder'] . '/help_files/';

$enable_save_settings   = 0;
$enable_use_attachments = 0;

// Print header
require_once(HESK_PATH . 'inc/header.inc.php');

// Print main manage users page
require_once(HESK_PATH . 'inc/show_admin_nav.inc.php');

// Demo mode? Hide values of sensitive settings
if ( defined('HESK_DEMO') )
{
	$hesk_settings['db_host']			= $hesklang['hdemo'];
	$hesk_settings['db_name']			= $hesklang['hdemo'];
	$hesk_settings['db_user']			= $hesklang['hdemo'];
	$hesk_settings['db_pass']			= $hesklang['hdemo'];
	$hesk_settings['db_pfix']			= $hesklang['hdemo'];
	$hesk_settings['smtp_host_name']	= $hesklang['hdemo'];
	$hesk_settings['smtp_user']			= $hesklang['hdemo'];
	$hesk_settings['smtp_password']		= $hesklang['hdemo'];
	$hesk_settings['pop3_host_name']	= $hesklang['hdemo'];
	$hesk_settings['pop3_user']			= $hesklang['hdemo'];
	$hesk_settings['pop3_password']		= $hesklang['hdemo'];
	$hesk_settings['imap_host_name']	= $hesklang['hdemo'];
	$hesk_settings['imap_user']			= $hesklang['hdemo'];
	$hesk_settings['imap_password']		= $hesklang['hdemo'];
	$hesk_settings['recaptcha_public_key']	= $hesklang['hdemo'];
	$hesk_settings['recaptcha_private_key']	= $hesklang['hdemo'];
}

/* This will handle error, success and notice messages */
hesk_handle_messages();
?>
<div class="main__content settings">
    <div class="settings__status">
        <h3><?php echo $hesklang['check_status']; ?></h3>
        <ul class="settings__status_list">
            <li>
                <div class="list--name"><?php echo $hesklang['v']; ?></div>
                <div class="list--status">
                    <?php echo $hesk_settings['hesk_version']; ?>
                    <?php
                    if ($hesk_settings['check_updates']) {
                        $latest = hesk_checkVersion();

                        if ($latest === true) {
                            echo ' - <span style="color:green">' . $hesklang['hud'] . '</span> ';
                        } elseif ($latest != -1) {
                            // Is this a beta/dev version?
                            if (strpos($hesk_settings['hesk_version'], 'beta') || strpos($hesk_settings['hesk_version'], 'dev') || strpos($hesk_settings['hesk_version'], 'RC')) {
                                echo ' <span style="color:darkorange">' . $hesklang['beta'] . '</span> '; ?><br><a href="https://www.hesk.com/update.php?v=<?php echo $hesk_settings['hesk_version']; ?>" target="_blank"><?php echo $hesklang['check4updates']; ?></a><?php
                            } else {
                                echo ' - <span style="color:darkorange;font-weight:bold">' . $hesklang['hnw'] . '</span> '; ?><br><a href="https://www.hesk.com/update.php?v=<?php echo $hesk_settings['hesk_version']; ?>" target="_blank"><?php echo $hesklang['getup']; ?></a><?php
                            }
                        } else {
                            ?> - <a href="https://www.hesk.com/update.php?v=<?php echo $hesk_settings['hesk_version']; ?>" target="_blank"><?php echo $hesklang['check4updates']; ?></a><?php
                        }
                    } else {
                        ?> - <a href="https://www.hesk.com/update.php?v=<?php echo $hesk_settings['hesk_version']; ?>" target="_blank"><?php echo $hesklang['check4updates']; ?></a><?php
                    }
                    ?>
                </div>
            </li>
            <li>
                <div class="list--name"><?php echo $hesklang['phpv']; ?></div>
                <div class="list--status"><?php echo defined('HESK_DEMO') ? $hesklang['hdemo'] : PHP_VERSION . ' ' . (function_exists('mysqli_connect') ? '(MySQLi)' : '(MySQL)'); ?></div>
            </li>
            <li>
                <div class="list--name"><?php echo $hesklang['mysqlv']; ?></div>
                <div class="list--status"><?php echo defined('HESK_DEMO') ? $hesklang['hdemo'] : hesk_dbResult( hesk_dbQuery('SELECT VERSION() AS version') ); ?></div>
            </li>
            <li>
                <div class="list--name">/hesk_settings.inc.php</div>
                <div class="list--status">
                    <?php
                    if (is_writable(HESK_PATH . 'hesk_settings.inc.php')) {
                        $enable_save_settings = 1;
                        echo '<span class="success">'.$hesklang['exists'].'</span>, <span class="success">'.$hesklang['writable'].'</span>';
                    } else {
                        echo '<span class="success">'.$hesklang['exists'].'</span>, <span class="error">'.$hesklang['not_writable'].'</span><br>'.$hesklang['e_settings'];
                    }
                    ?>
                </div>
            </li>
            <li>
                <div class="list--name">/<?php echo $hesk_settings['attach_dir']; ?></div>
                <div class="list--status">
                    <?php
                    if (is_dir(HESK_PATH . $hesk_settings['attach_dir'])) {
                        echo '<span class="success">'.$hesklang['exists'].'</span>, ';
                        if (is_writable(HESK_PATH . $hesk_settings['attach_dir'])) {
                            $enable_use_attachments = 1;
                            echo '<span class="success">'.$hesklang['writable'].'</span>';
                        } else {
                            echo '<span class="error">'.$hesklang['not_writable'].'</span><br>'.$hesklang['e_attdir'];
                        }
                    } else {
                        echo '<span class="error">'.$hesklang['no_exists'].'</span>, <span class="error">'.$hesklang['not_writable'].'</span><br>'.$hesklang['e_attdir'];
                    }
                    ?>
                </div>
            </li>
            <li>
                <div class="list--name">/<?php echo $hesk_settings['cache_dir']; ?></div>
                <div class="list--status">
                    <?php
                    if (is_dir(HESK_PATH . $hesk_settings['cache_dir'])) {
                        echo '<span class="success">'.$hesklang['exists'].'</span>, ';
                        if (is_writable(HESK_PATH . $hesk_settings['cache_dir'])) {
                            $enable_use_attachments = 1;
                            echo '<span class="success">'.$hesklang['writable'].'</span>';
                        } else {
                            echo '<span class="error">'.$hesklang['not_writable'].'</span><br>'.$hesklang['e_cdir'];
                        }
                    } else {
                        echo '<span class="error">'.$hesklang['no_exists'].'</span>, <span class="error">'.$hesklang['not_writable'].'</span><br>'.$hesklang['e_cdir'];
                    }
                    ?>
                </div>
            </li>
        </ul>
    </div>
    <script language="javascript" type="text/javascript"><!--
        function hesk_checkFields() {
            var d = document.form1;

            // DISABLE SUBMIT BUTTON
            d.submitbutton.disabled=true;

            return true;
        }

        function hesk_toggleLayer(nr,setto) {
            if (document.all)
                document.all[nr].style.display = setto;
            else if (document.getElementById)
                document.getElementById(nr).style.display = setto;
        }
        //-->
    </script>
    <form method="post" action="admin_settings_save.php" name="form1" onsubmit="return hesk_checkFields()">
        <div class="settings__form form">
            <section class="settings__form_block">
                <h3><?php echo $hesklang['dat']; ?></h3>
                <div class="form-group timezone">
                    <label>
                        <span><?php echo $hesklang['TZ']; ?></span>
                        <a onclick="hesk_window('<?php echo $help_folder; ?>misc.html#63','400','500')">
                            <div class="tooltype right">
                                <svg class="icon icon-info">
                                    <use xlink:href="<?php echo HESK_PATH; ?>img/sprite.svg#icon-info"></use>
                                </svg>
                            </div>
                        </a>
                    </label>
                    <?php
                    // Get list of supported timezones
                    $timezone_list = hesk_generate_timezone_list();

                    // Do we need to localize month names?
                    if ($hesk_settings['language'] != 'English')
                    {
                        $timezone_list = hesk_translate_timezone_list($timezone_list);
                    }
                    ?>
                    <select name="s_timezone" id="timezone-select">
                        <?php
                        foreach ($timezone_list as $timezone => $description)
                        {
                            echo '<option value="' . $timezone . '"' . ($hesk_settings['timezone'] == $timezone ? ' selected' : '') . '>' . $description . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        <span><?php echo $hesklang['tfor']; ?></span>
                        <a onclick="hesk_window('<?php echo $help_folder; ?>misc.html#20','400','500')">
                            <div class="tooltype right">
                                <svg class="icon icon-info">
                                    <use xlink:href="<?php echo HESK_PATH; ?>img/sprite.svg#icon-info"></use>
                                </svg>
                            </div>
                        </a>
                    </label>
                    <input type="text" class="form-control" name="s_timeformat" maxlength="255" value="<?php echo $hesk_settings['timeformat']; ?>">
                </div>
            </section>
            <section class="settings__form_block">
                <h3><?php echo $hesklang['other']; ?></h3>
                <div class="form-group">
                    <label>
                        <span><?php echo $hesklang['ip_whois']; ?></span>
                        <a onclick="hesk_window('<?php echo $help_folder; ?>misc.html#61','400','500')">
                            <div class="tooltype right">
                                <svg class="icon icon-info">
                                    <use xlink:href="<?php echo HESK_PATH; ?>img/sprite.svg#icon-info"></use>
                                </svg>
                            </div>
                        </a>
                    </label>
                    <input type="text" class="form-control" name="s_ip_whois_url" maxlength="255" value="<?php echo $hesk_settings['ip_whois']; ?>">
                </div>
                <tr>
                    <td><label> </label></td>
                </tr>
                <div class="checkbox-group">
                    <h5>
                        <span><?php echo $hesklang['mms']; ?></span>
                        <a onclick="hesk_window('<?php echo $help_folder; ?>misc.html#62','400','500')">
                            <div class="tooltype right">
                                <svg class="icon icon-info">
                                    <use xlink:href="<?php echo HESK_PATH; ?>img/sprite.svg#icon-info"></use>
                                </svg>
                            </div>
                        </a>
                    </h5>
                    <div class="checkbox-custom">
                        <input type="checkbox" id="s_maintenance_mode1" name="s_maintenance_mode" value="1" <?php if ($hesk_settings['maintenance_mode']) {echo 'checked';} ?>>
                        <label for="s_maintenance_mode1"><?php echo $hesklang['mmd']; ?></label>
                    </div>
                </div>
                <div class="checkbox-group">
                    <h5>
                        <span><?php echo $hesklang['al']; ?></span>
                        <a onclick="hesk_window('<?php echo $help_folder; ?>misc.html#21','400','500')">
                            <div class="tooltype right">
                                <svg class="icon icon-info">
                                    <use xlink:href="<?php echo HESK_PATH; ?>img/sprite.svg#icon-info"></use>
                                </svg>
                            </div>
                        </a>
                    </h5>
                    <div class="checkbox-custom">
                        <input type="checkbox" id="s_alink1" name="s_alink" value="1" <?php if ($hesk_settings['alink']) {echo 'checked';} ?>/>
                        <label for="s_alink1"><?php echo $hesklang['dap']; ?></label>
                    </div>
                </div>
                <div class="checkbox-group">
                    <h5>
                        <span><?php echo $hesklang['subnot']; ?></span>
                        <a onclick="hesk_window('<?php echo $help_folder; ?>misc.html#48','400','500')">
                            <div class="tooltype right">
                                <svg class="icon icon-info">
                                    <use xlink:href="<?php echo HESK_PATH; ?>img/sprite.svg#icon-info"></use>
                                </svg>
                            </div>
                        </a>
                    </h5>
                    <div class="checkbox-custom">
                        <input type="checkbox" id="s_submit_notice1" name="s_submit_notice" value="1" <?php if ($hesk_settings['submit_notice']) {echo 'checked';} ?>/>
                        <label for="s_submit_notice1"><?php echo $hesklang['subnot2']; ?></label>
                    </div>
                </div>
                <div class="checkbox-group multiple-emails">
                    <h5>
                        <span><?php echo $hesklang['sonline']; ?></span>
                        <a onclick="hesk_window('<?php echo $help_folder; ?>misc.html#56','400','500')">
                            <div class="tooltype right">
                                <svg class="icon icon-info">
                                    <use xlink:href="<?php echo HESK_PATH; ?>img/sprite.svg#icon-info"></use>
                                </svg>
                            </div>
                        </a>
                    </h5>
                    <div class="checkbox-custom">
                        <input type="checkbox" id="s_online1" name="s_online" value="1" <?php if ($hesk_settings['online']) {echo 'checked';} ?>>
                        <label for="s_online1"><?php echo $hesklang['sonline2']; ?></label>
                        <div class="form-group">
                            <input type="text" name="s_online_min" class="form-control" maxlength="4" value="<?php echo $hesk_settings['online_min']; ?>">
                        </div>
                    </div>
                </div>
                <div class="checkbox-group">
                    <h5>
                        <span><?php echo $hesklang['updates']; ?></span>
                        <a onclick="hesk_window('<?php echo $help_folder; ?>misc.html#59','400','500')">
                            <div class="tooltype right">
                                <svg class="icon icon-info">
                                    <use xlink:href="<?php echo HESK_PATH; ?>img/sprite.svg#icon-info"></use>
                                </svg>
                            </div>
                        </a>
                    </h5>
                    <div class="checkbox-custom">
                        <input type="checkbox" id="s_check_updates1" name="s_check_updates" value="1" <?php if ($hesk_settings['check_updates']) {echo 'checked';} ?>>
                        <label for="s_check_updates1"><?php echo $hesklang['updates2']; ?></label>
                    </div>
                </div>
            </section>
            <div class="settings__form_submit">
                <input type="hidden" name="token" value="<?php hesk_token_echo(); ?>">
                <input type="hidden" name="section" value="MISC">
                <button id="submitbutton" style="display: inline-flex" type="submit" class="btn btn-full" ripple="ripple"
                    <?php echo $enable_save_settings ? '' : 'disabled'; ?>>
                    <?php echo $hesklang['save_changes']; ?>
                </button>

                <?php if (!$enable_save_settings): ?>
                    <div class="error"><?php echo $hesklang['e_save_settings']; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>
<?php
require_once(HESK_PATH . 'inc/footer.inc.php');
exit();


function hesk_checkVersion()
{
	global $hesk_settings;

	if ($latest = hesk_getLatestVersion() )
    {
    	if ( strlen($latest) > 12 )
        {
        	return -1;
        }
		elseif ($latest == $hesk_settings['hesk_version'])
        {
        	return true;
        }
        else
        {
        	return $latest;
        }
    }
    else
    {
		return -1;
    }

} // END hesk_checkVersion()


function hesk_getLatestVersion()
{
	global $hesk_settings;

	// Do we have a cached version file?
	if ( file_exists(HESK_PATH . $hesk_settings['cache_dir'] . '/__latest.txt') )
    {
        if ( preg_match('/^(\d+)\|([\d.]+)+$/', @file_get_contents(HESK_PATH . $hesk_settings['cache_dir'] . '/__latest.txt'), $matches) && (time() - intval($matches[1])) < 3600  )
        {
			return $matches[2];
        }
    }

	// No cached file or older than 3600 seconds, try to get an update
    $hesk_version_url = 'http://hesk.com/version';

	// Try using cURL
	if ( function_exists('curl_init') )
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $hesk_version_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
		$latest = curl_exec($ch);
		curl_close($ch);
		return hesk_cacheLatestVersion($latest);
	}

    // Try using a simple PHP function instead
	if ($latest = @file_get_contents($hesk_version_url) )
    {
		return hesk_cacheLatestVersion($latest);
    }

	// Can't check automatically, will need a manual check
    return false;

} // END hesk_getLatestVersion()


function hesk_cacheLatestVersion($latest)
{
	global $hesk_settings;

	@file_put_contents(HESK_PATH . $hesk_settings['cache_dir'] . '/__latest.txt', time() . '|' . $latest);

	return $latest;

} // END hesk_cacheLatestVersion()
?>
