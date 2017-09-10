<?php
	if (!rex::isBackend()) {
		rex_extension::register('OUTPUT_FILTER', function (rex_extension_point $ep) {
			$logFile = rex_path::coreCache('system.log');
			if ($file = new rex_log_file($logFile)) {
				//Start  generate mailsubject
					$mailSubject = '';
					$mailSubject .= rex::getServerName().' | system.log';
				//End  generate mailsubject
				
				//Start - generate mailbody
					$mailBody = '';
					$mailBody .= '<table>';
					$mailBody .= '	<thead>';
					$mailBody .= '		<tr>';
					$mailBody .= '			<th>' . rex_i18n::msg('syslog_timestamp') . '</th>';
					$mailBody .= '			<th>' . rex_i18n::msg('syslog_type') . '</th>';
					$mailBody .= '			<th>' . rex_i18n::msg('syslog_message') . '</th>';
					$mailBody .= '			<th>' . rex_i18n::msg('syslog_file') . '</th>';
					$mailBody .= '			<th>' . rex_i18n::msg('syslog_line') . '</th>';
					$mailBody .= '		</tr>';
					$mailBody .= '	</thead>';
					$mailBody .= '	<tbody>';
					
					foreach (new LimitIterator($file, 0, 30) as $entry) {
						/* @var rex_log_entry $entry */
						$data = $entry->getData();
						
						$mailBody .= '		<tr>';
						$mailBody .= '			<td>' . $entry->getTimestamp('%d.%m.%Y %H:%M:%S') . '</td>';
						$mailBody .= '			<td>' . $data[0] . '</td>';
						$mailBody .= '			<td>' . $data[1] . '</td>';
						$mailBody .= '			<td>' . (isset($data[2]) ? $data[2] : '') . '</td>';
						$mailBody .= '			<td>' . (isset($data[3]) ? $data[3] : '') . '</td>';
						$mailBody .= '		</tr>';
					}
					
					$mailBody .= '	</tbody>';
					$mailBody .= '</table>';
				//End - generate mailbody
				
				//Start  send mail
					$mail = new rex_mailer();
					$mail->Subject = $mailSubject;
					$mail->Body    = $mailBody;
					$mail->AltBody = strip_tags($mailBody);
					$mail->setFrom(rex::getErrorEmail(), 'REDAXO Errormail');
					$mail->addAddress(rex::getErrorEmail());
					
					if ($mail->Send()) {
						// close logger, to free remaining file-handles to syslog
						// so we can safely delete the file
						rex_logger::close();
						rex_log_file::delete($logFile);
					}
				//End  send mail
			}
		}, rex_extension::LATE);
	}
?>