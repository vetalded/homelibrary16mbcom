<?php

/**
 * @var BBugs $issue
 */

?>

<p><strong><?= $issue->project->name ?></strong></p>
<p><a href="http://qa.aura.vn.ua/bBugs/update/id/<?= $issue->id ?>">#<?= $issue->id ?>: <?= $issue->name ?></a></p>
<?php if (!empty($issue->url)): ?>
  <p>
    <a href="<?= $issue->url ?>"><?= $issue->url ?></a>
  </p>
<?php endif; ?>
<p><?= $issue->description ?></p>
<p>Issued on <?= $issue->dt ?> by <?= $issue->user->getFullName() ?> &lt;<?= $issue->user->email ?>&gt;</p>
