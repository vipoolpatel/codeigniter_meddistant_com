<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email_temp {
	public function email_content($email_title, $email_description, $email_btn_link, $email_btn_title, $unsubscribe = NULL) {
		
		
		/*$ci =& get_instance();
		$ci->load->database();
		$ci->load->library('session');
		
		$social_media_data = $ci->db->query('SELECT * FROM tbl_social_media')->row_array();
		*/
		$social_media_data = '';
		
		
		!empty($email_btn_link) ? $btn = "<br><br><a target=\'_blank\' href=\" $email_btn_link \" class='link3' style='color:#555555;'>$email_btn_title</a>" : $btn = '';
		
		
		$email_msg = '
        
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Email Template</title>
  <style type="text/css">
 a,a.link1,img{text-decoration:none}body{padding-top:0!important;padding-bottom:0!important;margin:0!important;width:100%!important;-webkit-text-size-adjust:100%!important;-ms-text-size-adjust:100%!important;-webkit-font-smoothing:antialiased!important}.tableContent img{border:0!important;display:block!important;outline:0!important}a{color:#382F2E}.unsubscribe_lnk{font-size: 12px}div,h1,h2,li,ol,p,ul{margin:0;padding:0}h1,h2{font-weight:400;background:0 0!important;border:none!important}@media only screen and (max-width:480px){td[class=specbundle],td[class=specbundle2]{float:left!important;font-size:13px!important;line-height:17px!important;display:block!important}img[class=banner],table[class=MainContainer],td[class=cell]{width:100%!important;height:auto!important}td[class=specbundle]{width:100%!important;padding-bottom:15px!important}td[class=specbundle2]{width:80%!important;padding-bottom:10px!important;padding-left:10%!important;padding-right:10%!important}td[class=spechide]{display:none!important}td[class=left_pad]{padding-left:15px!important;padding-right:15px!important}}@media only screen and (max-width:540px){td[class=specbundle],td[class=specbundle2]{float:left!important;font-size:13px!important;line-height:17px!important;display:block!important}img[class=banner],table[class=MainContainer],td[class=cell]{width:100%!important;height:auto!important}td[class=specbundle]{width:100%!important;padding-bottom:15px!important}td[class=specbundle2]{width:80%!important;padding-bottom:10px!important;padding-left:10%!important;padding-right:10%!important}td[class=spechide]{display:none!important}td[class=left_pad]{padding-left:15px!important;padding-right:15px!important}}.link4,a.link1{line-height:24px}.contentEditable h1.big,.contentEditable h2.big{font-size:26px!important}.contentEditable h1.bigger,.contentEditable h2.bigger{font-size:37px!important}table,td{vertical-align:top}td.middle{vertical-align:middle}a.link1{font-size:13px;color:#27A1E5}.link2{color:#fff;border-top:10px solid #0172ff;border-bottom:10px solid #0172ff;border-left:18px solid #0172ff;border-right:18px solid #0172ff;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;background:#0172ff}.bgBody,.bgItem,.link3{background:#fff}.link3{color:#555;border:1px solid #ccc;padding:10px 18px;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px}.link4{color:#0172ff}h1,h2{line-height:20px}p{font-size:14px;line-height:21px;color:#AAA}img{outline:0;-ms-interpolation-mode:bicubic;width:auto;max-width:100%;clear:both;display:block;float:none}
</style>
<script type="colorScheme" class="swatch active">
{
    "name":"Default",
    "bgBody":"ffffff",
    "link":"27A1E5",
    "color":"AAAAAA",
    "bgItem":"ffffff",
    "title":"444444"
}
</script>
</head>

<body paddingwidth="0" paddingheight="0" bgcolor="#d1d3d4"  style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" style="font-family:helvetica, sans-serif;" class="MainContainer">
      <!-- =============== START HEADER =============== -->
  <tbody>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td valign="top" width="20">&nbsp;</td>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td class="movableContentContainer">
      <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
   
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0"  style="background: #a3e3e5;">
  <tbody>
    <tr>
      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
    <td class="spechide" width="185" valign="top">&nbsp;</td>
    <td></td>
      <td valign="top" width="200"><img src="' . base_url() . 'assets/images/demo-content/beach-main-logo.png" alt="Logo" title="Logo" width="150" height="100" data-max-width="150"></td>
      
                        <td class="spechide" width="185" valign="top">&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
    
    </tr>
  </tbody>
</table></td>
    </tr>
   
    <tr>
       <td ><hr style=\'height:1px;background:#DDDDDD;border:none;\'></td>
     </tr>
  </tbody>
</table>
	  </div>
      
      
     
    
      <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
  
  
  <tr>
      <td height="20"></td>
    </tr>
    <tr>  <td><h2 style="font-size: 20px; text-align: center">' . $email_title . '</h2></td>
</tr>
  
    <tr>
      <td height="20"></td>
    </tr>
    <tr>
      
      <td style="background:#F6F6F6; border-radius:6px;-moz-border-radius:6px;-webkit-border-radius:6px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      
  <tbody>
    <tr>
      <td width="40" valign="top">&nbsp;</td>
      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr><td height=\'25\'></td></tr>
                      <tr>
                        <td>
                          <div class=\'contentEditableContainer contentTextEditable\'>
                            <div class=\'contentEditable\' style=\'text-align: left;\'>
                           
                              <br>
                              <p>
                              ' . $email_description . '
                              </p>
                             
                             
                             ' . $btn . '
                             
                             
                             
                              <br>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr><td height=\'24\'></td></tr>
                    </table></td>
      <td width="40" valign="top">&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>

      
      
      </div>
      
     
    
<!-- =============== START FOOTER =============== -->

    
      <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td height="40"></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td valign="top" width="185" class="spechide">&nbsp;</td>
      <td valign="top" width="185" class="spechide">&nbsp;</td>
    </tr>


  </tbody>
</table>
</td>
    </tr>
    
    <tr>
    
    	<td height=\'40\' align="center"></td>
    </tr>
    
   
    
    
    
  </tbody>
</table>

     <!-- =============== END FOOTER =============== -->
      </div>
      </td>
    </tr>
  </tbody>
</table>
</td>
      <td valign="top" width="20">&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
  </body>
  </html> ';
		return $email_msg;
	}
	
	
}
