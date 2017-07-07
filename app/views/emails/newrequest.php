<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Új időpont kérés</h2>

		<div>
			Önnek új időpontkérése ésrkezett.<br/>
			Időpont kérője: <?=User::find($from_id)->displayname ?><br/>
			Találkozó tárgya: <?=$title?><br/>
		</div>
	</body>
</html>
