<?php

namespace App\Controllers;

//use CodeIgniter\Database\ConnectionInterface;
use App\Models\MasterInformationModel;
use PhpImap\Exceptions\ConnectionException;
use Myth\Auth\IMAP;

use Config\Database;

class EmailController extends BaseController
{
	//private $db;
	public function __construct()
	{
		helper("custom");
		$db = db_connect();
		$this->db = \Config\Database::connect('second');
		$this->MasterInformationModel = new MasterInformationModel($db);
		session();
		$this->username = session_username($_SESSION["username"]);
		$this->admin = 0;
		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			$this->admin = 1;
		}
		$this->timezone = timezonedata();
	}

	public function check_email_connection()
	{

		if ($_POST['checkedTableId'] && !empty($_POST['checkedTableId'])) {
			$checkedTableId = $_POST['checkedTableId'];
		} else {
			$checkedTableId = "";
		}
		$table_name = $this->request->getPost('table');
		$insert_and_update_id_master = $_SESSION['master'];

		$query90 = "SELECT * FROM admin_platform_integration WHERE id= $checkedTableId AND  platform_status = 3 AND  master_id = '" . $insert_and_update_id_master . "'";

		$db_connection = \Config\Database::connect('second');
		$result = $db_connection->query($query90);
		$total_dataa_userr_22 = $result->getResultArray();


		$duplicate_check = array('master_id' => $_SESSION['master']);

		$checkDuplicateData_area = $this->MasterInformationModel->checkDuplicateData2($duplicate_check, $table_name);
		unset($_POST['table']);

		if ($checkDuplicateData_area == 1) {
			unset($_POST['checkedTableId']);
			unset($_POST['action']);

			$_POST['master_id'] = $_SESSION['master'];
			$insert_data = $_POST;
			$sql2 = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);
			$html = "";

			$return_array['msg'] = 'insert successfully';
			$return_array['html'] = $html;
		} else {
			unset($_POST['checkedTableId']);
			unset($_POST['action']);
			$update_data = $_POST;

			$sql2 = $this->MasterInformationModel->update_entry2($checkedTableId, $update_data, $table_name, 'master_id');
			// $html ="";
			// if(isset($sql2) && !empty($sql2) && $sql2!= 0)
			// {
			// 	$html .=" <i class='bi bi-pencil-fill fs-14'></i>";
			// }

			$return_array['msg'] = 'Update successfully';
			// $return_array['html'] = $html;


		}
		return json_encode($return_array);
	}
	public function email_account_insert()
	{
		$table_name = $this->request->getPost('table');

		$duplicate_check = array('master_id' => $_SESSION['master']);


		unset($_POST['checkedTableId']);
		unset($_POST['action']);
		unset($_POST['table']);

		$_POST['master_id'] = $_SESSION['master'];
		$insert_data = $_POST;
		$insert_data['platform_status'] = 3;

		$sql2 = $this->MasterInformationModel->insert_entry2($insert_data, $table_name);

		$return_array['msg'] = 'insert successfully';

		return json_encode($return_array);
	}
	public function mail_get()
	{
		if (isset($_POST['uid']) && !empty($_POST['uid'])) {
			$uidd = $_POST['uid'];
		} else {
			$uidd = '';
		}
		if (isset($_POST['data_from_email']) && !empty($_POST['data_from_email'])) {
			$data_from_email = $_POST['data_from_email'];
		} else {
			$data_from_email = '';
		}
		if (isset($_POST['data_host_name']) && !empty($_POST['data_host_name'])) {
			$data_host_name = $_POST['data_host_name'];
		} else {
			$data_host_name = '';
		}
		if (isset($_POST['email_id']) && !empty($_POST['email_id'])) {
			$mail_name = $_POST['email_id'];
		} else {
			$mail_name = '';
		}
		if (isset($_POST['tabmail_id']) && !empty($_POST['tabmail_id'])) {
			$tabmail_id = $_POST['tabmail_id'];
		} else {
			$tabmail_id = '';
		}

		$account_mail = "";
		$db_connection = \Config\Database::connect('second');
		$table_username = session_username($_SESSION['username']);
		$query90 = "SELECT * FROM admin_platform_integration WHERE platform_status = 3 AND  master_id = '" . $_SESSION['master'] . "'";
		$result = $db_connection->query($query90);
		$email_platform_data = $result->getResultArray();
		$html = "";
		$test = "";

		foreach ($email_platform_data as $email_key => $val_email) {

			$account_mail .= '<div class="accordion-item border-0 border-bottom">
				<h2 class="accordion-header">
					<button class="accordion-button border-0 shadow-none fw-medium  toggle-center" type="button"
						data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
						aria-controls="collapseOne">
						<p><i class="fa-solid fa-user fa-xl me-2"></i></p>
						<P class="fs-14 fw-bolder first-container-text">' . $val_email['smtp_user'] . '</P>
					</button>
				</h2>
				<div id="collapseOne" class="accordion-collapse collapse show px-4 py-3"
					data-bs-parent="#accordionExample">
					<div class="accordion-body account_list p-0">
						<li
							class=" menu-toggle bg-body-secondary col-12 d-flex my-2 flex-wrap active p-2 rounded-3 ViewSendMEssageDataTab border border-light-subtle menu-toggle nav-item Tab2Class hide-panel1" data-tabmail_id="1" data-email_id="' . $val_email['smtp_user'] . '">
							<div class="col-12 d-flex">
								<p><i class="fa-solid fa-inbox"></i></p>
								<span class="ms-3 first-container-text viewdata ">Inbox</span>
							</div>
						</li>
						<li
							class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 ViewSendMEssageDataTab border border-light-subtle menu-toggle nav-item Tab2Class hide-panel1" data-email_id="' . $val_email['smtp_user'] . '" data-tabmail_id="2">
							<div class="col-12 d-flex">
								<p><i class="fa-regular fa-star"></i></p>
								<span class="ms-3 first-container-text viewdata ">Starred</span>
							</div>
						</li>
						<li
							class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 ViewSendMEssageDataTab border border-light-subtle menu-toggle nav-item Tab2Class hide-panel1" data-email_id="' . $val_email['smtp_user'] . '" data-tabmail_id="3">
							<div class="col-12 d-flex">
								<p><i class="fa-regular fa-clock"></i></p>
								<span class="ms-3 first-container-text viewdata ">Snoozed</span>
							</div>
						</li>
						<li
							class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 ViewSendMEssageDataTab border border-light-subtle menu-toggle nav-item Tab2Class hide-panel1" data-email_id="' . $val_email['smtp_user'] . '">
							<div class="col-12 d-flex">
								<p><i class="fa-regular fa-paper-plane"></i></p>
								<span class="ms-3 first-container-text viewdata ">Sent</span>
							</div>
						</li>
						<li
							class="col-12 d-flex my-2 flex-wrap active p-2 rounded-3 ViewSendMEssageDataTab border border-light-subtle menu-toggle nav-item Tab2Class hide-panel1" data-email_id="' . $val_email['smtp_user'] . '" data-tabmail_id="5">
							<div class="col-12 d-flex">
								<p><i class="fa-solid fa-file"></i></p>
								<span class="ms-3 first-container-text viewdata ">Draft</span>
							</div>
						</li>
					</div>
				</div>
			</div>';


			$username = $val_email['smtp_user'];
			$password = $val_email['smtp_password'];
			$hostname =  '{' . $val_email['smtp_host'] . ':993/imap/ssl/novalidate-cert/norsh}INBOX';
			// Connect to the server
			$imapResource = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

			// Get emails
			// $emails = imap_search($mailbox, 'ALL');
			$check = imap_check($imapResource);
			
		
			if ($check->Nmsgs != 0) {
				$emails = imap_search($imapResource, 'ALL');

				rsort($emails);
				$i = 0;
				foreach ($emails as $email) {

					$overview = imap_fetch_overview($imapResource, $email);
					$maildata = $overview[0];

					// if (strpos($maildata->subject, 'developer') !== false) {
					// pre($maildata);


					$mailBody = imap_fetchbody($imapResource, $maildata->msgno, '1.1');
					if (trim($mailBody) == "") {
						$mailBody = imap_fetchbody($imapResource, $maildata->msgno, '1');
					}
					$message = nl2br(htmlentities(quoted_printable_decode($mailBody)));
					$header = imap_headerinfo($imapResource, $maildata->msgno);
					$fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;
					// pre($header->to[0]->host);
					// echo 'Subject: ' . htmlentities($maildata->subject) . '<br><br>';
					// echo 'From: ' . $maildata->from . '<br><br>';
					// echo 'From EMAIL: ' . $fromaddr . '<br><br>';
					// echo 'Date: ' . $maildata->date . '<br><br>';
					// echo 'Message: ' . $message . '<br><br>';
					
					if ($tabmail_id == 1 && $mail_name == $val_email['smtp_user'] ) {
						// pre($tabmail_id);
						// pre($mail_name);
						// pre($val_email['smtp_user']);
						$html .= '<div class="col-12 main-check-class_mail d-flex flex-wrap justify-content-start border-top border-bottom p-1 head-mail-hover align-items-center">
										<div class="col d-flex justify-content-start align-items-center ps-2">
											<input type="checkbox" name="inquiry_id[]" class="checkbox table_list_check_mail fs-5" data-mail_id="' . $maildata->uid . '" value="' . $maildata->uid . '">
											<button type="button" class="btn rounded-circle mx-2 p-0 bg-transparent start-message" style="--bs-btn-hover-border-color: transparent; --bs-btn-active-border-color: transparent;"><i class="fa-regular fa-star p-1 bg-transparent"></i></button>
										</div>
										<div class="col-11 d-flex flex-fill justify-content-start list-messages-header list_message_mail align-items-center p-2" data-host_name="' . $header->to[0]->host . '" data-from_email="' . $fromaddr . '" data-uid="' . $maildata->uid . '" data-tabmail_id="'.$tabmail_id.'" data-email_id="'.$mail_name.'">
											<div class="col-3 d-flex flex-wrap align-items-center justify-content-start">
												<p class="col-11 ps-2" style="font-size:16px;">' . ($header->fromaddress) . '</p>
											</div>
											<div class="col-9 d-flex flex-wrap align-items-center justify-content-start">
												<div class="col-11 d-flex flex-wrap align-items-center justify-content-start">
													<p class="col-12 ps-2" style="font-size:16px;">' . htmlentities($maildata->subject) . '</p>
												</div>
												<div class="col-1 d-flex align-items-center justify-content-end">';

						$date_email_display = $maildata->date;
						$date_display = new \DateTime($date_email_display);
						$formatted_date_display = $date_display->format("M d");
						$html .= '<span class="fs-12">' . $formatted_date_display . '</span>';

						$html .= '</div>
                                        	</div>
										</div>  
                            </div>';

						//list full message
						if ($uidd == $maildata->uid) {

							$date_email = $maildata->date;
							$date = new \DateTime($date_email);
							$formatted_date = $date->format("M d, Y, h:i A");


							$test .= '<div class="col-12 d-flex flex-wrap align-items-start align-self-start">
															<div class="col-12 d-flex flex-wrap ps-2 align-items-start mt-4">
																
																<div class="col-12 ps-5 d-flex justify-content-between align-items-center">
																	<p class="fs-3 fw-medium">' . htmlentities($maildata->subject) . '</p>
																	<div class="d-flex justify-content-end align-items-center">
																	<button type="button" class="btn rounded-circle hover-effect mx-1" style="--bs-btn-hover-border-color: white; --bs-btn-active-border-color: white;"><i class="fa-solid fa-print print-message-panel"></i></button>
																	<button type="button" class="btn rounded-circle hover-effect mx-1" style="--bs-btn-hover-border-color: white; --bs-btn-active-border-color: white;"><i class="fa-solid fa-arrow-up-right-from-square back-message-panel"></i></button>
																	</div>
																</div>
															</div>
															<div class="col-12 mt-3 d-flex flex-wrap w-100 flex-wrap align-items-center align-items-start align-self-start">
																<div class="rounded-circle border border-2 p-1" style="height:50px;width:50px;">
																	<span class="">
																	</span>
																</div>	
																<div class="d-flex col ps-2 flex-wrap justify-content-start align-items-center">
																	<div class="col-12 d-flex flex-wrap fs-12 fw-semibold align-items-center justify-content-between">
																		<div class="col-7 d-flex flex-nowrap align-items-center justify-content-start">
																			<p class="fw-semibold fs-6">
																			' . htmlentities($maildata->subject) . '
																			<p>
																			<span class="ms-2 fw-light fs-14">
																			< ' . $maildata->to . ' >
																			</span>
																		</div>
																		<div class="col-5 d-flex justify-content-end align-items-center">
																			<div class="col-6 d-flex justify-content-end align-items-center">
																				<span class="fw-light fs-14">
																					' . $formatted_date . ' 
																				</span>
																			</div>
																			<div class="col-6 d-flex justify-content-end align-items-center">
																				<button type="button" class="btn rounded-circle hover-effect start-message mx-1 p-0" style="--bs-btn-hover-border-color: white; --bs-btn-active-border-color: white;"><i class="fa-regular fa-star p-1"></i></button>
																				<button type="button" class="btn rounded-circle hover-effect mx-1 p-0" style="--bs-btn-hover-border-color: white; --bs-btn-active-border-color: white;"><i class="fa-regular fa-face-smile p-1"></i></button>
																				<button type="button" class="btn rounded-circle hover-effect mx-1 p-0" style="--bs-btn-hover-border-color: white; --bs-btn-active-border-color: white;"><i class="fa-solid fa-arrow-left-long p-1"></i></button>
																				<button type="button" class="btn rounded-circle hover-effect mx-1 p-0" style="--bs-btn-hover-border-color: white; --bs-btn-active-border-color: white;"><i class="fa-solid fa-ellipsis-vertical p-1"></i></button>
																			</div>
																		</div>
																	</div>
																	<div class="col-12 fs-12 fw-semibold">
																		<div class="btn-group">
																					<button type="button" class="btn btn-sm fw-semibold fs-12 p-0"  style="--bs-btn-hover-border-color: white; --bs-btn-active-border-color: white;">To Me</button>
																					<button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"  style="--bs-btn-hover-border-color: white; --bs-btn-active-border-color: white;">
																						<span class="visually-hidden">Toggle Dropdown</span>
																					</button>
																					<ul class="dropdown-menu" style="width:500px;">
																						<div class="col-12 d-flex flex-wrap">
																							<div class="col-12 my-2 d-flex flex-wrap justify-content-start align-items-center">
																								<div class="col-2 fw-normal fs-14 d-flex justify-content-end align-items-center">
																								 Form :
																								</div>
																								<div class="col-10 ps-3 d-flex flex-nowrap justify-content-start align-items-center">
																									<span class="fw-semibold fs-6">' . $maildata->from . '</span>';
							// if($fromaddr == $data_from_email)
							// {
							$test .= '<span class="fw-light ms-2 fs-14">
																										< ' . $maildata->to . ' >
																										</span>';
							// }
							$test .= '</div>
																							</div>
																							<div class="col-12 my-2 d-flex flex-wrap justify-content-start align-items-center">
																								<div class="col-2 fw-normal fs-14 d-flex justify-content-end align-items-center">
																								To :
																								</div>
																								<div class="col-10 ps-3 fs-6 fw-medium d-flex justify-content-start align-items-center">';
							if ($fromaddr == $data_from_email) {
								$test .= '' . $fromaddr . '';
							}
							$test .= '</div>
																							</div>
																							<div class="col-12 my-2 d-flex flex-wrap justify-content-start align-items-center">
																								<div class="col-2 fw-normal fs-14 d-flex justify-content-end align-items-center">
																								Date :
																								</div>
																								<div class="col-10 ps-3 fs-6 fw-medium d-flex justify-content-start align-items-center">
																								 ' . $formatted_date . '
																								</div>
																							</div>
																							<div class="col-12 my-2 d-flex flex-wrap justify-content-start align-items-center">
																								<div class="col-2 fw-normal fs-14 d-flex justify-content-end align-items-center">
																								Subject :
																								</div>
																								<div class="col-10 ps-3 fw-medium d-flex justify-content-start align-items-center">
																								' . $maildata->from . '
																								</div>
																							</div>
																							<div class="col-12 my-2 d-flex flex-wrap justify-content-start align-items-center">
																								<div class="col-2 fw-normal fs-14 d-flex justify-content-end align-items-center">
																								Mailed-By :
																								</div>
																								<div class="col-10 ps-3 fw-medium d-flex justify-content-start align-items-center">';
							if ($data_host_name == $header->to[0]->host) {
								$test .= '' . $header->to[0]->host . '';
							}
							$test .= '</div>
																							</div>
																						</div>
																					</ul>
																				</div>
																	</div>
																</div>
															</div>
															<div class="col-12 d-flex flex-wrap p-1 ps-2 mt-3 align-self-start">
																<div class="col ps-5">
																	<div class="fs-6">' . $message . '</div>
																</div>
															</div>
														</div>
															';
						}
						////////////////////FOR ATTACHMENT
						$structure = imap_fetchstructure($imapResource, $maildata->msgno);
						$attachments = array();
						if (isset($structure->parts) && count($structure->parts)) {

							for ($i = 0; $i < count($structure->parts); $i++) {

								$attachments[$i] = array(
									'is_attachment' => false,
									'filename' => '',
									'name' => '',
									'attachment' => ''
								);

								if ($structure->parts[$i]->ifdparameters) {
									foreach ($structure->parts[$i]->dparameters as $object) {
										if (strtolower($object->attribute) == 'filename') {
											$attachments[$i]['is_attachment'] = true;
											$attachments[$i]['filename'] = $object->value;
										}
									}
								}

								if ($structure->parts[$i]->ifparameters) {
									foreach ($structure->parts[$i]->parameters as $object) {
										if (strtolower($object->attribute) == 'name') {
											$attachments[$i]['is_attachment'] = true;
											$attachments[$i]['name'] = $object->value;
										}
									}
								}

								if ($attachments[$i]['is_attachment']) {
									$attachments[$i]['attachment'] = imap_fetchbody($imapResource, $maildata->msgno, $i + 1);
									if ($structure->parts[$i]->encoding == 3) { // 3 = BASE64
										$attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
									} elseif ($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
										$attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
									}
								}
							}
						}
						// foreach ($attachments as $key => $attachment) {
						//     $name = $attachment['name'];
						//     $contents = $attachment['attachment'];
						//     if ($name != '') {
						//         file_put_contents($name, $contents);

						//         echo '<embed src="' . $name . '" width="100%" height="600px" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">';
						//     }
						// }

						// $i++;
						// if ($i > 20) {
						// 	exit;
						// }
						
					}
				}
				// echo $html;
			}
			$return_array['Subject_show'] = $html;
		}
		$return_array['display_message_show'] = $test;
		$return_array['account_mail'] = $account_mail;
		return json_encode($return_array);
		// die();
		// Process the emails
		// foreach ($emails as $email) {
		//     // Fetch email details
		//     $headerInfo = imap_headerinfo($mailbox, $email);
		//     $subject = $headerInfo->subject;
		//     $from = $headerInfo->fromaddress;
		//     $body = imap_body($mailbox, $email);
		// 	pre($body);
		//     // Do something with the email data
		//     echo "Subject: $subject<br>";
		//     echo "From: $from<br>";
		//     echo "Body: $body<br>";
		//     echo "<hr>";
		// }
		// die();

		// Close the connection
		// imap_close($mailbox);
	}

	public function mail_delete()
	{

		if ($this->request->getPost('checkbox_value')) {
			$ids = $this->request->getPost('checkbox_value');
			$db_connection = \Config\Database::connect('second');
			$table_username = session_username($_SESSION['username']);
			$query90 = "SELECT * FROM admin_platform_integration WHERE platform_status = 3 AND  master_id = '" . $_SESSION['master'] . "'";
			$result = $db_connection->query($query90);
			$email_platform_data = $result->getResultArray();
			$ids = $this->request->getPost('checkbox_value');

			foreach ($email_platform_data as $email_key => $val_email) {
				$username = $val_email['smtp_user'];
				$password = $val_email['smtp_password'];
				$hostname =  '{' . $val_email['smtp_host'] . ':993/imap/ssl/novalidate-cert/norsh}INBOX';

				$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());
				$email_numbers = imap_search($inbox, 'ALL');

				if ($email_numbers) {
					if (count($email_numbers) >= 29) {
						$email_number_to_delete = 31;
						imap_delete($inbox, $email_number_to_delete);
						imap_expunge($inbox);
						echo "The 31st email has been deleted successfully.";
					} else {
						echo "There are not enough emails in the inbox to delete the 31st email.";
					}
				} else {
					echo "No emails found in the inbox.";
				}
			}
		}
	}
}
