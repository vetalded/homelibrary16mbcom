<?php

class HappyLettersCommand extends CConsoleCommand {
  public function actionSend() {
    $issues = $this->getIssues("CAST(dt_deadline AS DATE) = CAST(NOW() AS DATE)");
    $this->sendLetters('today', $issues);

    $issues = $this->getIssues("CAST(dt_deadline AS DATE) = CAST(DATE_ADD(NOW(), INTERVAL 1 DAY) AS DATE)");
    $this->sendLetters('tomorrow', $issues);
  }

  /**
   * @param string $dateCondition условие даты, по кторому проводить выборку
   *
   * @returns BBugs[]
   */
  protected function getIssues($dateCondition) {
    // Статусы, которые не fixed, closed
    return BBugs::model()->with('user_to', 'user')->together(true)->findAll("status_id NOT IN(3, 6) AND {$dateCondition}");
  }

  protected function sendLetters($when, $issues) {
    foreach ($issues as $issue) {
      ob_start();
      require __DIR__ . '/happy_letters/letter_template.php';
      $message = ob_get_clean();

      $subject = "QA :: deadline {$when} - {$issue->project->name}";

      $cc = ['vladimir.chepurnoy@gmail.com', 'Vladimir Chepurnoy'];

      MailFunctions::SendMailFunction($issue->user_to->email, 'software.aura+qa@gmail.com', $message, $subject, $cc);
    }
  }
}
