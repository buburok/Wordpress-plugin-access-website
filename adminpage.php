<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	?>
	<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>Access website</title>
		<link rel="stylesheet" type="text/css" href="/pluginpage.css">
	</head>
	<body><div id="conttent">
		<?php 
			session_start();			
			require_once(ABSPATH . 'wp-config.php');			
			$db  = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);			
			mysqli_select_db($db , DB_NAME);			
			
			
			// initialize variables
			$name = "";
			$address = "";
			$id = 0;
			$update = false;
			
			if (isset($_POST['save'])) {
				$site = $_POST['site'];
				$site_login = $_POST['site_login'];
				$site_user = $_POST['site_user'];
				$site_pass = $_POST['site_pass'];
				$ftp = $_POST['ftp'];
				$ftp_user = $_POST['ftp_user'];
				$ftp_pass = $_POST['ftp_pass'];
				$cpanel = $_POST['cpanel'];
				$cpanel_user = $_POST['cpanel_user'];
				$cpanel_pass = $_POST['cpanel_pass'];
				$hosting = $_POST['hosting'];
				$hosting_user = $_POST['hosting_user'];
				$hosting_pass = $_POST['hosting_pass'];
				
				mysqli_query($db, "INSERT INTO wp_all_sites_accesss (site, site_login, site_user, site_pass, ftp, ftp_user, ftp_pass, cpanel, cpanel_user, cpanel_pass, hosting, hosting_user, hosting_pass) VALUES ('$site', '$site_login', '$site_user', '$site_pass', '$ftp', '$ftp_user', '$ftp_pass', '$cpanel', '$cpanel_user', '$cpanel_pass', '$hosting', '$hosting_user', '$hosting_pass')"); 
				$_SESSION['message'] = "Address saved"; 
				header('location: /wp-admin/admin.php?page=accesswebsite/upload/adminpage.php');
			}
			if (isset($_POST['update'])) {
				$id = $_POST['id'];
				$site = $_POST['site'];
				$site_login = $_POST['site_login'];
				$site_user = $_POST['site_user'];
				$site_pass = $_POST['site_pass'];
				$ftp = $_POST['ftp'];
				$ftp_user = $_POST['ftp_user'];
				$ftp_pass = $_POST['ftp_pass'];
				$cpanel = $_POST['cpanel'];
				$cpanel_user = $_POST['cpanel_user'];
				$cpanel_pass = $_POST['cpanel_pass'];
				$hosting = $_POST['hosting'];
				$hosting_user = $_POST['hosting_user'];
				$hosting_pass = $_POST['hosting_pass'];
				
				mysqli_query($db, "UPDATE wp_all_sites_accesss SET site='$site', site_login='$site_login', site_user='$site_user', site_pass='$site_pass', ftp='$ftp', ftp_user='$ftp_user', ftp_pass='$ftp_pass', cpanel='$cpanel', cpanel_user='$cpanel_user', cpanel_pass='$cpanel_pass', hosting='$hosting', hosting_user='$hosting_user', hosting_pass='$hosting_pass' WHERE id='$id'");
				$_SESSION['message'] = "Address updated!"; 
				header('location: /wp-admin/admin.php?page=accesswebsite/upload/adminpage.php');
			}
			if (isset($_GET['del'])) {
				$id = $_GET['del'];
				mysqli_query($db, "DELETE FROM wp_all_sites_accesss WHERE id='$id'");
				$_SESSION['message'] = "Address deleted!"; 
				header('location: /wp-admin/admin.php?page=accesswebsite/upload/adminpage.php');
			}
		?>
		<?php 
			if (isset($_GET['edit'])) {
				$id = $_GET['edit'];
				$update = true;
				$record = mysqli_query($db, "SELECT * FROM wp_all_sites_accesss WHERE id=$id");
				
				if (count($record) == 1 ) {
					$n = mysqli_fetch_array($record);
					$site = $n['site'];
					$site_login = $n['site_login'];
					$site_user = $n['site_user'];
					$site_pass = $n['site_pass'];
					$ftp = $n['ftp'];
					$ftp_user = $n['ftp_user'];
					$ftp_pass = $n['ftp_pass'];
					$cpanel = $n['cpanel'];
					$cpanel_user = $n['cpanel_user'];
					$cpanel_pass = $n['cpanel_pass'];
					$hosting = $n['hosting'];
					$hosting_user = $n['hosting_user'];
					$hosting_pass = $n['hosting_pass'];
				}
			}
		?>
		<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
		<?php endif ?>	
		<div id="infoTable">
			
			<form method="post"  >
				<h2>Add WebSite</h2>
				<div class="input-group"></div>
				<div class="input-group">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="text" name="site" value="<?php echo $site; ?>" placeholder="SITE" pattern="https?://.+.|http?://.+" required >
				</div>
				<div class="input-group">
					<input type="text" name="site_login" value="<?php echo $site_login; ?>" placeholder="SITE login">
				</div>
				<div class="input-group">
					<input type="text" name="site_user" value="<?php echo $site_user; ?>" placeholder="SITE Username">
				</div>
				<div class="input-group">
					<input type="text" name="site_pass" value="<?php echo $site_pass; ?>" placeholder="SITE Password">
				</div>
				<div class="input-group">
					<input type="text" name="ftp" value="<?php echo $ftp; ?>" placeholder="FTP">
				</div>
				<div class="input-group">
					<input type="text" name="ftp_user" value="<?php echo $ftp_user; ?>" placeholder="FTP Username">
				</div>
				<div class="input-group">
					<input type="text" name="ftp_pass" value="<?php echo $ftp_pass; ?>" placeholder="FTP Password">
				</div>
				<div class="input-group">
					<input type="text" name="cpanel" value="<?php echo $cpanel; ?>" placeholder="C-PANEL">
				</div>
				<div class="input-group">
					<input type="text" name="cpanel_user" value="<?php echo $cpanel_user; ?>" placeholder="C-PANEL Username">
				</div>
				<div class="input-group">
					<input type="text" name="cpanel_pass" value="<?php echo $cpanel_pass; ?>" placeholder="C-PANEL Password">
				</div>
				<div class="input-group">
					<input type="text" name="hosting" value="<?php echo $hosting; ?>" placeholder="HOSTING">
				</div>
				<div class="input-group">
					<input type="text" name="hosting_user" value="<?php echo $hosting_user; ?>" placeholder="HOSTING Username">
				</div>
				<div class="input-group">
					<input type="text" name="hosting_pass" value="<?php echo $hosting_pass; ?>" placeholder="HOSTING Password">
				</div>
				<div class="input-group">
					<?php if ($update == true): ?>
					<button class="btn" type="submit" name="update" style="background: #484848;color:#fff;margin-top: 3px;" >Update</button>
					<?php else: ?>
					<button class="btn" type="submit" name="save" style="margin-top: 3px;" >Save</button>
					<?php endif ?>
				</div>
			</form>
		</div>
		<?php $results = mysqli_query($db, "SELECT * FROM wp_all_sites_accesss"); ?>
		<div><br>
			<select  id="test" class="selection" name="selection" onchange='filterText()'>
				<option value='all'>site selection</option>
			</select></div>
			<table class="tableLogins">
				<thead>
					<tr><th>EDIT</th>
						<th>DELIT</th>
						<th>SITE</th>
						<th>SITE Login</th>
						<th>SITE Username</th>
						<th>SITE Password</th>
						<th>FTP</th>
						<th>FTP Username</th>
						<th>FTP Password</th>
						<th>C-PANEL</th>
						<th>C-PANEL Username</th>
						<th>C-PANEL Password</th>
						<th>HOSTING</th>
						<th>HOSTING Username</th>
						<th>HOSTING Password</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
					<tr class="<?php echo $row["site"]; ?>">
						<td class="siteLinks"><div id="divName">SITE: </div><a href="<?php echo $row["site"]; ?>" target="_blank"><?php echo $row["site"]; ?></a></td>
						<td><div id="divName">SITE Login: </div><a href="<?php echo $row["site_login"]; ?>" target="_blank"><?php echo $row["site_login"]; ?></a></td>
						<td><div id="divName">SITE Username: </div><?php echo $row["site_user"]; ?></td>
						<td><div id="divName">SITE Password: </div><?php echo $row["site_pass"]; ?></td>
						<td><div id="divName">FTP: </div><?php echo $row["ftp"]; ?></td>
						<td><div id="divName">FTP Username: </div><?php echo $row["ftp_user"]; ?></td>
						<td><div id="divName">FTP Password: </div><?php echo $row["ftp_pass"]; ?></td>
						<td><div id="divName">C-PANEL: </div><a href="<?php echo $row["cpanel"]; ?>" target="_blank"><?php echo $row["cpanel"]; ?></a></td>
						<td><div id="divName">C-PANEL Username: </div><?php echo $row["cpanel_user"]; ?></td>
						<td><div id="divName">C-PANEL Password: </div><?php echo $row["cpanel_pass"]; ?></td>
						<td><div id="divName">HOSTING: </div><a href="<?php echo $row["hosting"]; ?>" target="_blank"><?php echo $row["hosting"]; ?></a></td>
						<td><div id="divName">HOSTING Username: </div><?php echo $row["hosting_user"]; ?></td>
						<td><div id="divName">HOSTING Password: </div><?php echo $row["hosting_pass"]; ?></td>
						<td class="ButEdit">
							<a href="/wp-admin/admin.php?page=accesswebsite/upload/adminpage.php&edit=<?php echo $row['id']; ?>" class="edit_btn" ><button>Edit</button</a>
							</td>
							<td class="ButEdit">
								<a href="/wp-admin/admin.php?page=accesswebsite/upload/adminpage.php&del=<?php echo $row['id']; ?>" class="edit_btn" ><button>Delete</button></a>
							</td>
							
						</tr>
						
					<?php } ?>
				</table>
				<form>
				</div>
				<br>
				<br>
				<br>
				<br>
				<div class="infoo">* The Site field is required, as you must paste the site address with http:// or https://<br><div>** This plugin was created by Plamen Yordanov and his web site <a href="https://websitepr.eu/">WebSitePR</a></div></div>
			</body>
			
			<script>	
				var urll = []
				jQuery(".siteLinks a").each(function(){
					urll.push(jQuery(this).text())
				})
				
				for (var i = 0; i < (urll).length; i++) {
					jQuery('#test').append('<option class="urlLinksDrop '+urll[i]+'">'+urll[i]+'</option>')
					jQuery('select').change(function(){
						jQuery(this).find(':selected').addClass('selecteda').siblings('option').removeClass('selecteda');
					jQuery("tr[class='"+jQuery(this).find(':selected').text()+"']").addClass('selecteda').siblings('tr').removeClass('selecteda')})}			
			</script>
			<script>
				
			</script>
	</html>						