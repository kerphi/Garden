<?php if (!defined('APPLICATION')) exit();
$this->AddSideMenu();
?>
<h2><?php echo T('Import'); ?></h2>
<?php
echo '<div class="Info">',
	sprintf(T('Garden.Import.Description', 'Use this page to import data from another forum that was exported using Vanilla\'s exporter. For more information see the documentation <a href="%s">here</a>.'), 'http://vanillaforums.com/blog/help-topics/importing-data/'),
	  '</div>';

if ($this->Data('LoadSpeedWarning')) {
   echo '<div class="Warning">',
   T('Warning: Loading tables can be slow.', '<b>Warning</b>: Your server configuration does not support fast data loading.
If you are importing a very large file (ex. over 200,000 comments) you might want to consider changing your configuration. Click <a href="http://vanillaforums.com/porter">here</a> for more information.'),
   '</div>';
}

echo $this->Form->Open(array('enctype' => 'multipart/form-data'));
echo $this->Form->Errors();
?>
<ul>
	<li>
      <?php
      echo '<div>', T('Select the file to import.'), '</div>';
      echo '<div class="Info">',
         T('You can place files in your /uploads folder.',
         'If your file is too large to upload directly to this page you can place it in your /uploads folder.
            Make sure the filename begins with the word <b>export</b> and ends with one of <b>.txt, .gz</b>.'),
           '</div>';

      foreach ($this->Data('ImportPaths') as $Path => $Text) {
         echo '<div>',
            $this->Form->Radio('PathSelect', $Text, array('value' => $Path)),
            '</div>';
      }
      ?>
		<?php 
         $OriginalFilename = GetValue('OriginalFilename', $this->Data);

         echo '<div>';
         if (count($this->Data('ImportPaths')) > 0)
            echo $this->Form->Radio('PathSelect', $this->Form->Input('ImportFile', 'file'), array('value' => 'NEW'));
			else
            echo $this->Form->Input('ImportFile', 'file');
         echo '</div>';

         if($OriginalFilename) {
				echo ' ', T('Current File: '.htmlspecialchars($OriginalFilename));
			}
		?>
	</li>
	<li>
		<?php
		//echo $this->Form->Radio('Overwrite', T('Garden.Import.Overwrite', 'Overwrite this forum.'), array('value' => 'overwrite', 'default' => 'overwrite'));
		echo '<div class="Warning">',
		T('Garden.Import.Overwrite.Desciption', 'Warning: All data in this forum will be overwritten. Enter the email and password of the admin user from the data being imported.'),
		'</div>';
		
		echo $this->Form->Label('Email', 'Email'),
			$this->Form->TextBox('Email');
		
		echo $this->Form->Label('Password', 'Password'),
			$this->Form->Input('Password', 'password');
		?>
	</li><?php /*
	<li>
		<?php
		echo $this->Form->Radio('Overwrite', T('Garden.Import.Merge', 'Merge with this forum.'), array('value' => 'merge'));
		echo '<div class="Info">',
		T('Garden.Import.Merge.Description', 'This will merge all of the user and discussion data from the import into this forum.
<b>Warning: If you merge the same data twice you will get duplicate discussions.</b>'),
		'</div>';
		
		?>
	</li> */?>
</ul>
<?php echo $this->Form->Close('Upload');