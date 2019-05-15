<?php require_once("../config/config.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>MVC GIBS</title>
	<link rel="stylesheet" type="text/css" href="<?php echo config::CSS_PATH?>/styles.css">
</head>
<body>
    <div align="center">

        <table class="container" width="804" border="1" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td width="804" height="60">
                    <table width="100%" border="0" cellspacing="0" cellpassing="0">
                        <tr>
                            <td><h1>MVC GIBS - Kontakte</h1></td>
                            <td align="right" nowrap><?php $this->content('datum'); ?></td>
                        </tr>
                    </table>
                <td>
            </tr>
            <tr>
                <td>
                     <?php $this->menu("", true); ?>
                </td>
            </tr>
            <tr>
		<td valign="top" align="left">
                    <table border="0" width="100%" cellpadding="5" cellspacing="0">
                    <tr><td> <?php $this->content(); ?> </td></tr>
                    </table>
                </td>
            </tr>
            <tr>
                 <td>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td height="15" align="center">
				<span class="s10">&copy; Copyright GIBS Solothurn</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
