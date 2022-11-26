<?php

?>
<style>
			/* latin-ext */
			@font-face {
				font-family: 'Nunito';
				font-style: normal;
				font-weight: 400;
				/* normal */
				src: local('Nunito Regular'), local('Nunito-Regular'), url('../static/fonts/Nunito-Regular-latin-ext.woff2') format('woff2'), url('../fonts/Nunito-Regular.ttf') format('truetype');
				unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
			}

			/* latin */
			@font-face {
				font-family: 'Nunito';
				font-style: normal;
				font-weight: 400;
				/* normal */
				src: local('Nunito Regular'), local('Nunito-Regular'), url('../static/fonts/Nunito-Regular.woff2') format('woff2'), url('../fonts/Nunito-Regular.ttf') format('truetype');
				unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
			}

			/* latin-ext */
			@font-face {
				font-family: 'Nunito';
				font-style: normal;
				font-weight: 700;
				/* bold */
				src: local('Nunito Bold'), local('Nunito-Bold'), url('../static/fonts/Nunito-Bold-latin-ext.woff2') format('woff2'), url('../fonts/Nunito-Bold.ttf') format('truetype');
				unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
			}

			/* latin */
			@font-face {
				font-family: 'Nunito';
				font-style: normal;
				font-weight: 700;
				/* bold */
				src: local('Nunito Bold'), local('Nunito-Bold'), url('../static/fonts/Nunito-Bold.woff2') format('woff2'), url('../fonts/Nunito-Bold.ttf') format('truetype');
				unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
			}

			a {
				color: var(--linkColor);
				text-decoration: none;
			}

			body {
				margin: 0;
				padding: 0;
				min-height: 100vh;
				width: 100%;
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
			    max-width: 100%;
                max-height: calc( 100vh - 260px );
                cursor: pointer;
			}
			
			.hidden {
				display: none;
			}
			
			.image-overview {
				display: flex;
				flex-wrap: wrap;
				
				width: 100%;
			}
			
			.image-overview figure {
				width: 320px;
				height: 320px;
				margin: 10px;
			}
			
			.image-overview img {
				margin: auto;
				
				max-height: 300px;
				max-width: 300px;
			}
			
			input {
				width: 300px;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: solid #ccc 0.125em;
				border-radius: 4px;
				box-sizing: border-box;
			}
			
			input[type="submit"] {
				width: 300px;
				background-color: var(--linkColor);
				border: solid var(--linkColor) 0.125em;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border-radius: 4px;
				cursor: pointer;
				transition-duration: .3s;
			}
			
			input[type="submit"]:hover {
				color: var(--linkColor);
				border: solid var(--linkColor) 0.125em;
				background-color: white;
			}
		</style>