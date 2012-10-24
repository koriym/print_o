<?php
$html = <<<EOT
<!DOCTYPE html>
<html>
<head>
  <!-- Kenneth Kufluk 2008/09/10 -->
  <title>{$rootName}</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <base href="{$assetsPath}">
  <link href="//twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet" />
  <link href="debuglib.css" rel="stylesheet" />
  <link href="mindmap.css" rel="stylesheet" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js" type="text/javascript"></script>
  <!-- Raphael for SVG support (won't work on android) -->
  <script type="text/javascript" src="raphael-min.js"></script>
  <script type="text/javascript" src="mindmap.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
        $("#js-mindmap").mindmap({$config});
    });
	</script>
</head>
<body>
<p style="opacity:0.75;" id="show-var"></p>
<p class="credit"></p>
	<div id="js-mindmap">
	<ul id="navigation">
{$list}
</body>
</html>
EOT;
return $html;
