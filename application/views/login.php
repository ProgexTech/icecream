<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body>

<div id="container">
	
	<div id="body">
              <form method="post" action="<?php echo base_url(); ?>user/authenticate">
            <table align="center">
                <tr>
                    <td>username :</td>
                    <td><input type="text" name="uName"/></td>
                </tr>
                 <tr>
                            <td>Password :</td>
                            <td><input type="password" name="password"/></td>
                        </tr>
                         <tr>
                            <td></td>
                            <td><input type="submit" name="login" value="Login"/></td>
                        </tr>
            </table>
                </form>
	</div>

	
</div>

</body>