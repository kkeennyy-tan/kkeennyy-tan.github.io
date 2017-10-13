<?php 

	function email_send() {
		if(isset($_POST['send'])) {
			include 'PHPMailerAutoload.php';
			$name = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
			$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $mobile_no = filter_var($_POST['mobile_no'], FILTER_SANITIZE_STRING);
            $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
			$mailer = new PHPMailer();
			$mailer->IsSMTP();
			$mailer->Host = 'smtp.gmail.com:465'; 
			$mailer->SMTPAuth = TRUE;
			$mailer->Port = 465;
			$mailer->mailer="smtp";
			$mailer->SMTPSecure = 'ssl'; 
			$mailer->IsHTML(true);
			$mailer->SMTPOptions = array('ssl' => array(
									'verify_peer' => false, 
									'verify_peer_name' => false, 
									'allow_self_signed' => true)
									);
			$mailer->Username = 'kkeennyy.kt@gmail.com';
			$mailer->Password = 'nescafesapowerq1';
            $mailer->Subject = 'Customer Inquire from ' .$name;
			$mailer->AddAddress('kkeennyy.kt@gmail.com' );
            $mailer->SetFrom($email , 'Customer');
			$mailer->FromName = $_POST['fullname'];
			$mailer->Body =  '<div align="center"><div align="center" style="
                                display:inline-block;
                                background-color:#d48331;
                                height:auto;
                                width:auto;
                                ">
                                <div style="
                                background-color:#D04153;
                                display:inline-block;
                                width:100%;
                                height:100px;
                                text-align:center;
                                color:#fff;
                                align-content:center;
                                "><h1 style="
                                margin-top:40px;
                                ">Customer Inquire</h1>
                                </div>
                                <table style="background-color:rgb(255, 249, 249); color: #4a4646; margin:0px; padding:20px;">
                                <tr>
                                <td>Name :</td><td><h3>'.$_POST['fullname'].
                                '</h3></td></tr><tr><td>Email :</td><td><h3 text-decoration="none">'.$_POST['email'].
                                '</h3></td></tr><tr><td>Mobile No. :</td><td><h3>'.$_POST['mobile_no'].
                                '</h3></td></tr><tr><td>Message :</td><td><h3>'.$_POST['message'].
                                '</h3></td></tr>
                                </table>
                                <div text-align="center" style="
                                background-color:#102B49;
                                padding:5px;
                                height:auto;
                                overflow:hidden;
                                ">
                                <h4 style="color:#fff;">Created by <a href="https://www.facebook.com/kennyrobertson.tan" style="color:#ff5588;">Kenny Tan</a></h4></div>
                                </div></div>';
            
			
			if(!$mailer->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mailer->ErrorInfo;
			} else {
			header('location: thankyou.php');
			}
		}
	}
