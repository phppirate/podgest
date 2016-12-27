<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Podgest</title>
	<link rel="stylesheet" href="/css/design.css">
	<link rel="stylesheet" href="/css/additional.css">
</head>
<body>
	<header>
		<nav class="navbar has-shadow">
			<div class="is-container">
				<div class="brand-area">
					<a href="#" class="is-brand">Podgest</a>
					<button class="toggle-nav" onClick="document.toggleNav()">|||</button>
				</div>
				<div class="collapse">
					<ul class="navbar-nav">
						<li><a href="#0">Topics</a></li>
						<li><a href="#0">Episodes</a></li>
					</ul>
					<ul class="navbar-nav is-right">
						<li><a href="#0" class="is-btn">Suggest a Topic</a></li>
						<li class="has-profile">
							<a href="#0">
								Sam Podlogar
								<div class="avatar">
									<img src="/img/avatar.jpg" alt="">
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<div class="is-container has-pt-5">
		<div class="panel is-centered no-title is-add-topic has-shadow">
			<div class="panel-body">
				<form action="#">
					<input type="text" placeholder="Topic Title" class="is-form-control"/>
					<textarea placeholder="Topic Description" class="is-form-control has-mt-2"></textarea>
					<div class="is-float-control has-mt-2">
						<div></div>
						<div>
							<button class="is-btn">Suggest</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
		document.toggleNav = function(){
			let nav = document.querySelector('.navbar');
			if(nav.classList.contains('open')){
				nav.classList.remove('open');
			} else {
				nav.classList.add('open');
			}
		}
	</script>
</body>
</html>