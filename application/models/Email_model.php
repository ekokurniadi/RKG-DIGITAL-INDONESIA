<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Email_model extends CI_Model
{
	public function sendEmail($pesan, $email)
	{
		$emailAdmin = $this->db->query("SELECT * FROM setting")->row();
		$this->load->library('PHPMailer_load'); //Load Library PHPMailer
		$mail = $this->phpmailer_load->load(); // Mendefinisikan Variabel Mail
		$mail->isSMTP();  // Mengirim menggunakan protokol SMTP
		$mail->Host = 'smtp.gmail.com'; // Host dari server SMTP
		$mail->SMTPAuth = true; // Autentikasi SMTP
		$mail->Username = $emailAdmin->email;
		$mail->Password = $emailAdmin->password;
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->setFrom($emailAdmin->email, 'Notifikasi'); // Sumber email
		$mail->addAddress($email, ''); // Masukkan alamat email dari variabel $email
		$mail->Subject = "Notifikasi dari RKG INDONESIA"; // Subjek Email
		$mail->msgHtml($pesan); // Isi email dengan format HTML


		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			//echo "Message sent!";
		} // Kirim email dengan cek kondisi
	}
}
