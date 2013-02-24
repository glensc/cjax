<?php

require_once "ajax.php";

$ajax = ajax();


//button id, upload directory
$ajax->uploader('btn_saveForm', null, 
	//settings are optional
	array(
		'url' => 'ajax.php?upload_file/post', //post request after files are uploaded
		'suffix' => md5(time(). rand(1,10000000)), // makes files names universally unique,
		'debug' => 'Debug Option is turned on this Demo.',
		'success_message' => 'File(s) @files successfully uploaded.', //@files tag is replaced by files uploaded.
		'ext' => array('jpg','gif', 'png','jpeg'),
		'no_files' => 'Please select a file'
	)
);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $ajax->init(false);?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Flex Ajax Uploader</title>
	<link rel="stylesheet" type="text/css" href="resources/css/user_guide.css" media="all">
	<link rel="stylesheet" type="text/css" href="resources/send_form/view.css" media="all">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="resources/send_form/view.js"></script>
</head>
<body>
<!-- START NAVIGATION -->
<div id="nav"><div id="nav_inner"></div></div>
<div id="nav2"><a name="top">&nbsp;</a></div>
<div id="masthead">
<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
<tr>
<td><h1>Cjax Framework</h1></td>
<td id="breadcrumb_right"><a href="#">Demos</a></td>
</tr>
</table>
</div>
<!-- END NAVIGATION -->



<!-- START BREADCRUMB -->
<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
<tr>
<td id="breadcrumb">
<a href="http://cjax.sourceforge.net/">Project Home</a> &nbsp;&#8250;&nbsp;
<a href="http://cjax.sourceforge.net/examples/">Demos</a> &nbsp;&#8250;&nbsp;
Uploader
</td>
<td id="searchbox"><form method="get" action="http://www.google.com/search">
<input type="hidden" name="as_sitesearch" id="as_sitesearch" value="cjax.sourceforge.net/" />Search Project User Guide&nbsp; <input type="text" class="input" style="width:200px;" name="q" id="q" size="31" maxlength="255" value="" />&nbsp;<input type="submit" class="submit" name="sa" value="Go" /></form></td>
</tr>
</table>
<!-- END BREADCRUMB -->

<br clear="all" />

<div id="content">

<h1>Plugin Uploader</h1>

<p>This plugin is the former $ajax->upload() API, converted into an stand alone plugin (That is to fast and lightweight). If you were using the
$ajax->upload() APi, you must now download the plugin 'uploader'.</p>

<p>This plugin is straight forward, upload files through ajax, with some good features. This plugin is also versatile, allows for unique file names (so that
if more than once person uploads a file with the same name, it won't conflict), it also has PRE (Before)-URL  allows to contact the server before the file(s) are uploaded
lets say you wanted to do some operation or check for something before a file is uploaded, create directories structures etc.  URL, is after files have been uploaded operation,
if you are using unique name settings this is specially useful because the new names are posted to this URL. Among other settings.</p>

<p>Features:</p>

<ul>
	<li>Upload one file or Multitple Files at once</li>
	<li>"before" Pre-URL setting, allows to contact the server before the files are uploaded.</li>
	<li>"after"/URL allows to contact the server after the files are uploaded, and submits information about the uploaded files.</li>
	<li>Debug capabilities</li>
	<li>Prefix - Allows to add unique variables at the beginning of each file uploaded.</li>
	<li>Subfix - Allows to add unique variables at the end of of the name of each file uploaded.</li>
	<li>Error Handling and verbose respose</li>
	<li>Smoth and silent file uploads (you don't interfere at all), while all settings are optinal.
	
</ul>

<h2>Plugin Usage</h2>

<h3>Defining Settings</h3>

<p>This plugin takes a maximum of 3 parameters, the first two are required, the third one is optional - the thrid parameter is an array with options
you may specify to costimize the uploader, all options are optinal. </p>
<br />
<h2>Parameters</h2>

<p>Uploader plugin takes the following parameters</p>


<table cellspacing="1" cellpadding="0" border="0" class="tableborder" style="width:100%">
<tbody><tr>
	<th>Variable</th>
	<th>Required</th>
	<th>Type</th>
	<th>Options</th>
	<th>Description</th>
</tr>
<tr>
	<td class="td"><strong>$button_id</strong></td>
	<td class="td">Yes</td>
	<td class="td">String</td>
	<td class="td">May be a submit button, image or any element.</td>
	<td class="td">Button Id which you click on to upload the file(s). Button <kbd>MUST</kbd> be inside a form.</td>
</tr>
<tr>
	<td class="td"><strong>$upload_directory</strong></td>
	<td class="td">Yes</td>
	<td class="td">String</td>
	<td class="td">directory/uploads/</td>
	<td class="td">The uploads directory is where the files will be uploaded, it must have the proper permissions.</td>
</tr>
<tr>
	<td class="td"><strong>$options</strong></td>
	<td class="td">No</td>
	<td class="td">Array</td>
	<td class="td">
	<h3>Possible Options</h3>
		<ul>
			<li>url - will post files names after the files are uploaded.</li>
			<li>before - will send an ajax request before the files are uploaded.</li>
			<li>subfix - string/variable at the beginning of the file name.</li>
			<li>prefix - string/variable at the end of the file name.</li>
			<li>debug - display debug information after files are uploaded.</li>
			<li>success_message - message to display after files are uploaded.</li>
			<li>ext - list of file extensions allowed.</li>
			<li>no_files - message to display if user tries to upload/submit without selecting any files</li>
		</ul>
	</td>
	<td class="td">You may use these options to make the uploader work for you.</td>
</tr>
</tbody>
</table>


<h4>Additional Detatails About $options</h4>
<p> The "url" serves with the purpose of confirmation, lets say that you want to perform one or more operations right after the 
uploader has uploaded the files, (enter data to database, make new settings or files, you name it) or do more $ajax functions 
all this is possible because this callback is fired right after the files are uploaded and it posts the files names of the files
that were successfully upload (it won't post the names of the files that might have failed).
In the same way, the "before" setting can allow you to do additional tasks before the upload is performed. For instance if you wanted
to create a new directory for each user that uploads files, you will want to do that before the files are uploaded!. The reason for all
these settings is to allow you to fully operate with versatility and define and create your tasks within the scope of the uploader without modifying core files but instead just defining what you need and
using your own controllers.
 </p>


<h2>Example Code</h2>
<?php 
$code = $ajax->code("

\$options = array(
		'url' => 'ajax.php?upload_file/post', //submit request after files are uploaded
		'suffix' => md5(time(). rand(1,10000000)), // makes files names universally unique
		'debug' => true, //Remove if you are not debugging.
		'success_message' => 'File(s) @files successfully uploaded.',//@files tag is replaced by files uploaded.
		'ext' => array('jpg','gif', 'png','jpeg'),
		'no_files' => 'Please select a file.'
	);
	
//button id, upload directory
\$ajax->uploader('btn_saveForm', 'your/upload/directory', \$options);


");

echo $code;?>

<h2>Distribution</h2>

<p>As you already know, this is a <a href="http://cjax.sourceforge.net/">Cjax</a> plugin, and requires Cjax installed on your site for it to work. </p>


<h2>Download</h2>

<ul>
	<a target="_blank" href="http://sourceforge.net/projects/cjax/files/Plugins/">http://sourceforge.net/projects/cjax/files/Plugins/</a>
</ul>

<h2>Demo</h2>


<div id='not_found'></div>

<div id="main_body" >
	<img id="top" src="resources/send_form/top.png" alt="">
	<div id="form_container">
	
		<h1><a>Upload file using Ajax..</a></h1>

		<form id="form1" class="appnitro"  method="post" action="">
		<div class="form_description">
			<h2>Upload Files</h2>
			<p>Upload files using ajax...</p>
		</div>						
		<ul>
		<li id="li_3" >
		<label class="description" for="element_3">Select File </label>

		<div>
			<input name="my_file[]" class="element text medium" type="file" maxlength="255" value=""/> 
		</div> 
		</li>
		<li id="li_4" >
		<label class="description" for="element_4">Select File 2 </label>

		<div>
			<input name="my_file[]" class="element text medium" type="file" maxlength="255" value=""/> 
		</div> 
		</li>
		<li id="li_4" >
		<label class="description" for="element_4">Select File 3 </label>

		<div>
			<input name="xfile" class="element text medium" type="file" maxlength="255" value=""/> 
		</div> 
		</li>
		<li class="buttons">
				<input id="btn_saveForm" class="button_text" type="button"  value="Submit" />
		</li>
			</ul>
		</form>	
		<div id="footer">
			Generated by <a href="http://www.phpform.org">pForm</a>
		</div>
	</div>
	<img id="bottom" src="resources/send_form/bottom.png" alt="">
</div><!-- END demo -->

</div>
<!-- END CONTENT -->

<div id="myfooter">
	<p>
		Previous Topic:&nbsp;&nbsp;<a href="#">Previous Class</a>
		&nbsp;&nbsp;&nbsp;&middot;&nbsp;&nbsp;
		<a href="#top">Top of Page</a>&nbsp;&nbsp;&nbsp;&middot;&nbsp;&nbsp;
		<a href="http://cjax.sourceforge.net/examples">Demos Home</a>&nbsp;&nbsp;&nbsp;&middot;&nbsp;&nbsp;
		<!-- Next Topic:&nbsp;&nbsp;<a href="#">Next Class</a> -->
	</p>
	<p>
		<a href="http://codeigniter.com">CodeIgniter</a> &nbsp;&middot;&nbsp; Copyright &#169; 2006 - 2012 &nbsp;&middot;&nbsp;
		<a href="http://cjax.sourceforge.net/">Cjax</a>
	</p>
</div>

</body>
</html>