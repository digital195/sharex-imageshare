<?php

?>
<style>
			@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400&display=swap');

			a {
				color: var(--linkColor);
				text-decoration: none;
			}

			body {
				margin: 0;
				padding: 0;
				min-height: 100vh;
				width: 100vw;
				font-family: var(--font);
				font-weight: 300;
				background: radial-gradient(ellipse at bottom, var(--bgColor) 0%, var(--bgColor2) 100%);
			}

			.wrapper {
				
			}

			.picture, .picture img {
				width: 6em;
				height: 6em;
				display: block;
				margin: 2.5em auto 1.25em;
				border-radius: 50%;
			}
			
			.header {
				width: 100%;
				height: 50px;
				
				background-image: linear-gradient(40deg,var(--headerColor) 0%,var(--headerColor2) 100%);
				background-color: var(--headerColor);
				
				padding: 0;
				text-align: left;
				
				color: white;
				
				display: flex;
				align-items: center;
			}
			
			.header .logo {
				padding-left: 12px;
			}
			
			.header .logo a {
				display: block;
				height: 38.75px;
			}
			
			.header .logo img {				
				max-width: 62px;
			}
			
			.header .title {
				color: var(--theme-main-font-color);
				font-size: 16px;
				font-weight: 300;
				margin: 0;
				padding: 0;
				padding-left: 12px;
			}

			.section {
				color: var(--accentColor);
                font-size: 1rem;
                font-weight: bold;
                line-height: 1.25;
                font-family: var(--font);
                text-align: center;
                text-decoration: none;
				padding: 1.25em;
			}
			
			.copyright {
				padding: 1.25em;
				padding-bottom: 2.5em;
				color: var(--accentColor);
				font-size: 0.7rem;
				font-family: var(--font);
				text-align: center;
			}
			
			.small {
				font-size: 0.9rem;
                font-weight: initial;
			}

			.image {
				padding: 1.25em;
			    text-align: center;
			}

			.image img {
				min-height: 400px;
			    max-width: 100%;
                max-height: calc( 100vh - 260px );
                cursor: pointer;
			}
			
			.hidden {
				display: none;
			}
		</style>