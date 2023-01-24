<!DOCTYPE html>
<html lang="en" class="h-100">
	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $TemplateVars['Title']; ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
		<link rel="stylesheet" href="/css/main.css">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
		<script src="/js/main.js"></script>
	</head>
	<body class="d-flex flex-column h-100">
		<header class="p-3 border-bottom">
			<div class="container">
				<nav class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
						<a href="/" class="d-flex align-items-center fs-3 mb-2 mb-lg-0 text-dark text-decoration-none">
						<span class="me-2"><i class="bi bi-triangle-fill"></i><i class="bi bi-triangle-fill"></i><i class="bi bi-shuffle fs-4"></i></span>
						</a>
					<div class="px-5"></div>
						<?php echo $TemplateVars['Navigation']; ?>
				</nav>
			</div>
		</header>
		<main class="flex-fill bg-light">
			<?php echo $TemplateVars['Content']; ?>
		</main>
		<footer class="footer text-left mt-auto py-3 bg-light">
			<div class="container">
				<div class="row">
					<div class="col-sm">
						<span class="text-muted"><small>Web Wrapper (<?php echo Config::Version;?>)<br />&copy;<?php echo date("o");?> hiimcody1</small></span>
					</div>
					<div class="col-sm">
						<span class="text-muted float-end text-end"><small>Using Z2R <?php echo Config::Z2RVersion;?><br />This project wouldn't be possible without the contributions of the Z2R developers and community</small></span>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>