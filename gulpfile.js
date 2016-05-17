var	gulp = require('gulp'),
	plugins = require('gulp-load-plugins')({
		rename: {
			'gulp-autoprefixer': 'autoprefixer',
		}
	})

/**
 *	Scripts task
 *		- Concatenate to scripts.js
 *		- Rename to *.min.js with /min directory
 *		- Uglify
 *		- Send to destination
 */
gulp.task('scripts', function() {
	gulp.src('js/*.js')
		.pipe(plugins.plumber())
		.pipe(plugins.concat('scripts.js'))
		.pipe(plugins.rename(function(path) {
			path.dirname += "/min";
			path.basename += ".min";
			path.extname = ".js";
		}))
		.pipe(plugins.uglify())
		.pipe(gulp.dest('js'));
});

/**
 *	Styles task
 *		- Run Sass on partials
 *		- On main style.scss, run Sass, autoprefixer, rename to style.css, and send to /css
 *		- On /css/style.css, rename to style.min.css, uglify, and add to /css
 */
function runSass(src, newName) {
	var name = newName + '.css';
	var minName = newName + '.min.css';
	gulp.src(src)
		.pipe(plugins.plumber())
		.pipe(plugins.rename(name))
		.pipe(plugins.sass({
			outputStyle:'expanded',
			indentType:'tab',
			indentWidth:1
		}))
		.pipe(plugins.autoprefixer())
		.pipe(gulp.dest('css'))
		.on('end', function(){
			gulp.src('css/' + name)
				.pipe(plugins.rename(minName))
				.pipe(plugins.uglifycss())
				.pipe(gulp.dest('css'));
	});
}

gulp.task('styles', function() {
	runSass('sass/style.scss', 'style');
	runSass('sass/front-page.scss', 'front-page');
});

/**
 *	Images task
 *		- Run minification on images
 *		- Overwrite original
 */
gulp.task('images', function() {
	gulp.src('images/*.{png,gif,jpg}')
		.pipe(plugins.imagemin())
		.pipe(gulp.dest('images'));
});

/**
 *	Watch task
 */
gulp.task('watch', function() {
	gulp.watch('js/*.js', ['scripts']);
	gulp.watch('sass/partials/*.scss', ['styles']);
	gulp.watch('images', ['images']);
});

/**
 *	Default task
 */
gulp.task('default', ['scripts','styles','images','watch']);