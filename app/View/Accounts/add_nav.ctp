<?php
  $step1_active = $step2_active = $step3_active = '';
  switch($step){
    case 'init':
      $step1_active = 'active';
      break;
    case 'step2':
      $step2_active = 'active';
      break;
    case 'step3':
      $step3_active = 'active';
      break;
    default:
      $step1_active = 'active';

  }
?>

<div class="wizard-containers">
  <div class='wizard-step <?php echo $step1_active ?>'>
    <strong>Step 1:</strong>
    Generic Info
  </div>
  <div class='wizard-step <?php echo $step2_active ?>'>
    <strong>Step 2:</strong>
    Detail Info
  </div>
  <div class='wizard-step <?php echo $step3_active ?>'>
    <strong>Step 3:</strong>
    Upload Photo
  </div>
</div>

<?php echo $this->fetch('content'); ?>