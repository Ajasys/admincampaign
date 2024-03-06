<?= $this->include('partials/header') ?>
<?= $this->include('partials/sidebar') ?>


<div class="main-dashbord p-2 main-check-class">
    <div class="container-fluid p-0">
        <form action="https://admin.ajasys.com/emailsend" method="POST">

            <div class="col-12 p-2">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <label for="email" class="form-label main-label">From</label>
                    <div class="d-flex">
                        <input type="text" class="form-control main-control email"  name="fromemail" placeholder="Enter Email Address" value="">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 me-3">
                    <label for="email" class="form-label main-label">To</label>
                    <div class="d-flex">
                        <input type="text" class="form-control main-control email"  name="toemail" placeholder="Enter Email Address" value="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-6">
                    <h6 for="form-task-description" class="modal-body-title">Description</h6>
                    <textarea name="editor_content" style="display: none;"></textarea>
    <div id="editor_add"></div>
                </div>
                <button class="btn-primary add mt-3" type="submit" name="sendemail">
                    Send
                </button>
            </div>
        </form>
    </div>
</div>




<?php


if(isset($_POST['sendemail'])){
 

// $from = 'urvi.marelab@gmail.com';
$to = $_POST['toemail'];
$from = $_POST['fromemail'];
// $to = 'info@ajasys.com';


$fromName = 'Realtosmart';

$subject = "Realtosmart";

$htmlContent = ' 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
<html lang="en">

<head></head>
<body style="background-color:#f3f3f5;font-family:HelveticaNeue,Helvetica,Arial,sans-serif">
	<table align="center" role="presentation" cellSpacing="0" cellPadding="0" border="0" width="100%" style="max-width:680px;width:100%;margin:0 auto;background-color:#ffffff">
		<tr style="width:100%">
			<td>
			<table style="display:flex;background:#f3f3f5;padding:20px 30px" align="center" border="0" cellPadding="0" cellSpacing="0" role="presentation" width="100%">
			<tbody>
				<tr>
					<td></td>
				</tr>
			</tbody>
		</table>
				<table style="background:linear-gradient(45deg,#b55dcd,#724ebf);padding:20px 30px;" align="center" border="0" cellPadding="0" cellSpacing="0" role="presentation" width="100%">
					<tbody>
						<tr>
							<td ><img src="https://dev.realtosmart.com/assets/images/white-logo.png" width="200" style="display:block;outline:none;border:none;text-decoration:none;margin: 0 auto;" /></td>
						</tr>
					</tbody>
				</table>
				<table style="padding:30px 30px 40px 30px" align="center" border="0" cellPadding="0" cellSpacing="0" role="presentation" width="100%">
					<tbody>
						<tr>
							<td>
								'.$_POST['editor_content'].'
							</td>
						</tr>
					</tbody>
				</table>
                <table style="display:flex;background:#f3f3f5;padding:20px 30px" align="center" border="0" cellPadding="0" cellSpacing="0" role="presentation" width="100%">
					<tbody>
						<tr>
							<td></td>
						</tr>
					</tbody>
            	</table>
			</td>
		</tr>
	</table>    
</body>

</html>  

';



// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers 
$headers .= 'From: ' . $fromName . '<' . $from . '>' . "\r\n";
// $headers .= 'Cc: welcome@example.com' . "\r\n"; 
// $headers .= 'Bcc: welcome2@example.com' . "\r\n"; 
// $headers .= 'Cc:sagarchauan0ubg@gmail.com' . "\r\n";
// $headers .= 'Bcc:sagarchauan0ubg@gmail.com' . "\r\n";


//  echo $htmlContent ;
// Send email 
if (mail($to, $subject, $htmlContent, $headers)) {
	echo 'Email has sent successfully.';
} else {
	echo 'Email sending failed.';
}
}
?>

<?= $this->include('partials/footer') ?>
<?= $this->include('partials/vendor-scripts') ?>
<script src="https://rudrram.com/assets/js/ckeditor.js"></script>
<script>
    var classNames = ['#editor_add'];
    var editors = {};
    classNames.forEach(function(className) {
        ClassicEditor
            .create(document.querySelector(className), {
                toolbar: {
                    items: [
                        'undo',
                        'redo',
                        '|',
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        '|',
                        'bulletedList',
                        'numberedList',
                        '|',
                        // 'insertTable',
                        'Blockquote',
                        'outdent',
                        'indent'
                    ],
                    shouldNotGroupWhenFull: false
                },
                language: 'en'
            })
           .then(editor => {
        editor.model.document.on('change', () => {
            // Update the hidden textarea with CKEditor content on each change.
            document.querySelector('textarea[name="editor_content"]').value = editor.getData();
        });
    })
            .catch(error => {
                // console.error(error);
            });
    });
</script>